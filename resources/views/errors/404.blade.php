<!-- File: resources/views/errors/403.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 Not Found</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Cabin+Sketch');

        html {
            height: 100%;
        }

        body {
            min-height: 100%;
        }

        body {
            display: flex;
        }

        h1 {
            font-family: 'Cabin Sketch', cursive;
            font-size: 3em;
            text-align: center;
            opacity: .8;
            order: 1;
        }

        h1 small {
            display: block;
        }

        .site {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            flex-direction: column;
            margin: 0 auto;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
        }


        .sketch {
            position: relative;
            height: 400px;
            min-width: 400px;
            margin: 0;
            overflow: visible;
            order: 2;

        }

        .bee-sketch {
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .red {
            background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-1.png) no-repeat center center;
            opacity: 1;
            animation: red 5s linear infinite, opacityRed 8s linear alternate infinite;
        }

        .blue {
            background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-1.png) no-repeat center center;
            opacity: 0;
            animation: blue 5s linear infinite, opacityBlue 8s linear alternate infinite;
        }


        @media only screen and (min-width: 780px) {
            .site {
                flex-direction: row;
                padding: 1em 3em 1em 0em;
            }

            h1 {
                text-align: right;
                order: 2;
                padding-bottom: 2em;
                padding-left: 2em;

            }

            .sketch {
                order: 1;
            }
        }


        @keyframes blue {
            0% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-1.png)
            }

            9.09% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-2.png)
            }

            27.27% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-3.png)
            }

            36.36% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-4.png)
            }

            45.45% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-5.png)
            }

            54.54% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-6.png)
            }

            63.63% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-7.png)
            }

            72.72% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-8.png)
            }

            81.81% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-9.png)
            }

            100% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/blue-1.png)
            }
        }

        @keyframes red {
            0% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-1.png)
            }

            9.09% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-2.png)
            }

            27.27% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-3.png)
            }

            36.36% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-4.png)
            }

            45.45% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-5.png)
            }

            54.54% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-6.png)
            }

            63.63% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-7.png)
            }

            72.72% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-8.png)
            }

            81.81% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-9.png)
            }

            100% {
                background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/198554/red-1.png)
            }
        }

        @keyframes opacityBlue {
            from {
                opacity: 0
            }

            25% {
                opacity: 0
            }

            75% {
                opacity: 1
            }

            to {
                opacity: 1
            }
        }

        @keyframes opacityRed {
            from {
                opacity: 1
            }

            25% {
                opacity: 1
            }

            75% {
                opacity: .3
            }

            to {
                opacity: .3
            }
        }

        button {
            --b: 5px;
            --s: 12px;
            --c: #BD5532;

            padding: calc(.05em + var(--s)) calc(.3em + var(--s));
            color: var(--c);
            --_p: var(--s);
            background:
                conic-gradient(from 90deg at var(--b) var(--b), #0000 90deg, var(--c) 0) var(--_p) var(--_p)/calc(100% - var(--b) - 2*var(--_p)) calc(100% - var(--b) - 2*var(--_p));
            transition: .3s linear, color 0s, background-color 0s;
            outline: var(--b) solid #0000;
            outline-offset: .2em;
        }

        button:hover,
        button:focus-visible {
            --_p: 0px;
            outline-color: var(--c);
            outline-offset: .05em;
        }

        button:active {
            background: var(--c);
            color: #fff;
        }

        button {
            font-family: 'Cabin Sketch', cursive;
            font-weight: bold;
            font-size: 2rem;
            cursor: pointer;
            border: none;
            margin: .1em;
        }
    </style>
</head>

<body>
    <div class="site">
        <div class="sketch">
            <div class="bee-sketch red"></div>
            <div class="bee-sketch blue"></div>
        </div>

        <h1>404:
            <small>Halaman Tidak Ditemukan</small>
            <a href="{{ url('/home')}}"><button style="--c: #000000" >Kembali Ke Home</button></a>
        </h1>
    </div>
</body>

</html>
