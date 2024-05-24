<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $search = $request->input('search');

        $query = User::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        $users = $query->paginate($perPage);

        return view('users.index', compact('users'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', $ids)->delete();
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $password = Str::random(6);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($password);
        $user->save();

        $user->assignRole($request->input('role'));

        Mail::send('auth.emails.invite', ['user' => $user, 'password' => $password], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Verifikasi Akun Anda');
        });

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan. Silakan cek email Anda untuk verifikasi.');
    }


    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('users.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // Retrieve the role
        $role = $request->input('role');

        // Sync user roles
        $user->syncRoles([$role]);

        // Sync user permissions based on the assigned role
        $permissions = DB::table('permission_role')
            ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('permission_role.role_id', '=', $user->roles->first()->id)
            ->pluck('permissions.id')
            ->toArray();

        $user->syncPermissions($permissions);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Pengguna tidak ditemukan.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
