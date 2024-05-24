let cashflowTable;
let categoryTable;

function rupiah(number) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    }).format(number);
}

async function SwalConfirm(title, text) {
    let status = null;
    await Swal.fire({
        icon: 'question',
        title,
        text,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((e) => {
        status = e.isConfirmed;
    });
    return status;
}

function cashflowDelete(id, title) {
    SwalConfirm(null, `Apakah anda yakin ingin menghapus ${title}?`)
        .then(e => {
            if (e)
                $(`form[value="cashflow${id}"]`)[0].submit();
        });
}

function cashflowBulkDelete() {
    $.post('/cashflows/bulk-delete',
        {
            '_token': $('meta[name="_token"]').attr('content'),
            'data': Array.from($(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]:checked`), (e) => { return e.value })
        },
        function (result) {
            if (result > 0)
                Swal.fire({
                    icon: `success`,
                    text: `Berhasil menghapus ${result} data.`
                });
            else
                Swal.fire({
                    icon: `warning`,
                    text: `Tidak ada data yang dapat dihapus.`
                });
            cashflowTable.ajax.reload();
        });
}

function cashflow_select() {
    let allCheckbox = $(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]`);
    let allCheckboxChecked = $(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]:checked`);

    if (allCheckbox.length == allCheckboxChecked.length)
        $(`input[name="cashflow_selectAll"]`)[0]['checked'] = 1;
    else
        $(`input[name="cashflow_selectAll"]`)[0]['checked'] = 0;
}

function cashflow_selectAll(e) {
    Array.from($(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]`)).forEach(d => {
        d['checked'] = e['checked'];
    });
}

function cashflowExportPDF() {
    if (Array.from($(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]:checked`), (e) => { return e.value }).length > 0) {
        fetch(
            '/cashflows/export-pdf',
            {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                body: JSON.stringify({
                    data: Array.from($(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]:checked`), (e) => { return e.value })
                }),
            }
        )
            .then(x => x.blob())
            .then(y => {
                let url = URL.createObjectURL(y);
                let a = document.createElement('a');
                a.href = url;
                a.download = 'cashflows.pdf';
                document.body.appendChild(a);
                a.click();
                a.remove();
            });
    }
    else
        Swal.fire({
            icon: 'warning',
            text: 'Anda belum memilih cashflow.',
        });
}
function cashflowExportCSV() {
    if (Array.from($(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]:checked`), (e) => { return e.value }).length > 0) {
        fetch(
            '/cashflows/export-csv',
            {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                body: JSON.stringify({
                    data: Array.from($(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]:checked`), (e) => { return e.value })
                }),
            }
        )
            .then(x => x.blob())
            .then(y => {
                let url = URL.createObjectURL(y);
                let a = document.createElement('a');
                a.href = url;
                a.download = 'cashflows.csv';
                document.body.appendChild(a);
                a.click();
                a.remove();
            });
    }
    else
        Swal.fire({
            icon: 'warning',
            text: 'Anda belum memilih cashflow.',
        });
}

async function cashflowExportSelectFormat() {
    if (Array.from($(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]:checked`), (e) => { return e.value }).length > 0) {
        const opt = await Swal.fire({
            title: '',
            text: 'Silahkan pilih format',
            confirmButtonText: 'ekspor',
            showCancelButton: true,
            cancelButtonText: 'batal',
            input: 'select',
            inputOptions: {
                CSV: 'CSV',
                PDF: 'PDF'
            }
        });

        if (!!opt['value']) {
            if (opt['value'].toUpperCase() == ('PDF').toUpperCase()) {
                cashflowExportPDF();
            }
            else if (opt['value'].toUpperCase() == ('CSV').toUpperCase()) {
                cashflowExportCSV();
            }
        }
    }
    else {
        Swal.fire({
            icon: 'warning',
            text: 'Anda belum memilih cashflow.',
        });
    }
}

function cashflowImportSelectFormat() {
    Swal.fire({
        text: 'Silahkan pilih format file yang akan diimport',
        input: 'select',
        inputOptions: {
            CSV: 'CSV',
            PDF: 'PDF'
        },
        confirmButtonText: 'pilih',
        showCancelButton: true,
        cancelButtonText: 'batal',
    }).then((opt) => {
        if (!!opt['value']) {
            if (opt['value'].toUpperCase() == ('PDF').toUpperCase()) {
                $('#popup-import-pdf').click();
            }
            else if (opt['value'].toUpperCase() == ('CSV').toUpperCase()) {
                $('#popup-import-csv').click();
            }
        }
    });
}

function categoryBulkDelete() {
    $.post('/categories/bulk-delete',
        {
            '_token': $('meta[name="_token"]').attr('content'),
            'data': Array.from($(categoryTable.cells().nodes()).find(`input[name="category_checkbox"]:checked`), (e) => { return e.value })
        },
        function (result) {
            if (result > 0)
                Swal.fire({
                    icon: `success`,
                    text: `Berhasil menghapus ${result} kategori.`
                });
            else
                Swal.fire({
                    icon: `warning`,
                    text: `Tidak ada kategori yang dapat dihapus.`
                });
            categoryTable.ajax.reload();
        });
}

function categoryDelete(id, title) {
    SwalConfirm(null, `Apakah anda yakin ingin menghapus ${title}?`)
        .then(e => {
            if (e)
                $(`form[value="category${id}"]`)[0].submit();
        });
}

function category_select() {
    let allCheckbox = $(categoryTable.cells().nodes()).find(`input[name="category_checkbox"]`);
    let allCheckboxChecked = $(categoryTable.cells().nodes()).find(`input[name="category_checkbox"]:checked`);

    if (allCheckbox.length == allCheckboxChecked.length)
        $(`input[name="category_selectAll"]`)[0]['checked'] = 1;
    else
        $(`input[name="category_selectAll"]`)[0]['checked'] = 0;
}

function category_selectAll(e) {
    Array.from($(categoryTable.cells().nodes()).find(`input[name="category_checkbox"]`)).forEach(d => {
        d['checked'] = e['checked'];
    });
}

$(function () {
    $('#cashflow-bulk-delete-btn').on('click', () => {
        if (Array.from($(cashflowTable.cells().nodes()).find(`input[name="cashflow_checkbox"]:checked`), (e) => { return e.value }).length <= 0)
            Swal.fire({
                icon: 'warning',
                text: 'Anda belum memilih cashflow.',
            });
        else {
            SwalConfirm(null, `Apakah Anda yakin ingin menghapus yang anda pilih?`)
                .then((e) => {
                    if (e)
                        cashflowBulkDelete();
                });
        }
    });
    $('#category-bulk-delete-btn').on('click', () => {
        if (Array.from($(categoryTable.cells().nodes()).find(`input[name="category_checkbox"]:checked`), (e) => { return e.value }).length <= 0)
            Swal.fire({
                icon: 'warning',
                text: 'Anda belum memilih kategori.',
            });
        else {
            SwalConfirm(null, `Apakah Anda yakin ingin menghapus kategori yang anda pilih?`)
                .then((e) => {
                    if (e)
                        categoryBulkDelete();
                });
        }
    });

    cashflowTable = $('#cashflow-table').DataTable({
        ajax: {
            url: '/api/v1/cashflows',
            dataSrc: ''
        },
        language: {
            url: '/language/datatables/id.json'
        },
        columns: [
            {
                title: `<input type="checkbox" name="cashflow_selectAll" onchange="cashflow_selectAll(this)">`,
                render: (data, type, full) => {
                    return `<input type="checkbox" name="cashflow_checkbox" onchange="cashflow_select()" value="${full['id']
                        }">`;
                },
                bSearchable: false,
                bSortable: false
            },
            { data: 'title', title: 'Judul' },
            {
                render: (data, type, full) => {
                    return `<a class="text-blue-600 hover:underline hover:text-blue-700" href="/categories/${full['category_id']}">${full['category']}</a>`;
                },
                title: 'Kategori'
            },
            {
                render: (data, type, full) => {
                    return rupiah(full['amount']);
                },
                title: 'Nominal'
            },
            {
                render: (data, type, full) => {
                    return full['type'] ? 'kredit' : 'debit';
                },
                title: 'Jenis'
            },
            { data: 'created_at', title: 'Waktu Transaksi' },
            {
                render: (data, type, full) => {
                    return `<div class="flex">` +
                        `${cashflowAction.showBtn(full) +
                        cashflowAction.editBtn(full) +
                        cashflowAction.deleteBtn(full)
                        }` +
                        `</div>`;
                },
                title: 'Aksi',
                bSearchable: false,
                bSortable: false
            },
        ],
        order: [5, 'desc'],
        autoWidth: false,
        footerCallback: (tfoot, data, start, end, display) => {
            fetch('/api/v1/cashflows')
                .then(x => x.json())
                .then(y => {
                    let total = 0;
                    y.forEach(e => {
                        if (e.type) {
                            total += e.amount;
                        }
                        else {
                            total -= e.amount;
                        }
                    });
                    $(tfoot).find('th').eq(0).html(
                        (total >= 0)
                            ? `<span> Total saldo: ${rupiah(total)} </span>`
                            : `<span> Total saldo: ${rupiah(total)} </span> <span class="text-red-500"> (Jumlah debit terlalu besar) </span>`
                    );
                });
        }
    });

    categoryTable = $('#category-table').DataTable({
        ajax: {
            url: '/api/v1/categories',
            dataSrc: ''
        },
        language: {
            url: '/language/datatables/id.json'
        },
        columns: [
            {
                render: (data, type, full) => {
                    return `<input type="checkbox" name="category_checkbox" onchange="category_select()" value="${full['id']}">`;
                },
                title: `<input type="checkbox" name="category_selectAll" onchange="category_selectAll(this)">`,
                bSearchable: false,
                bSortable: false
            },
            { data: 'name', title: 'Nama' },
            { data: 'created_at', title: 'Waktu dibuat' },
            {
                render: (data, type, full) => {
                    return (!!full['updated_at']) ? full['updated_at'] : '<span class="hidden">0</span>Belum diubah';
                },
                title: 'Waktu diubah'
            },
            {
                render: (data, type, full) => {
                    return `<div class="flex">` +
                        `${categoryAction.showBtn(full) +
                        categoryAction.editBtn(full) +
                        categoryAction.deleteBtn(full)}` +
                        `</div>`;
                },
                title: 'Aksi',
                bSearchable: false,
                bSortable: false
            },
        ],
        order: [2, 'desc'],
        autoWidth: false
    });
});
