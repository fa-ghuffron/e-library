<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-Literasi') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            * {
                font-family: Arial, sans-serif;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }

            .text-2xl {
                font-size: 1.5rem;
            }

            .font-semibold {
                font-weight: 600;
            }

            .text-primary {
                color: #50A4FF;
            }

            .mt-10 {
                margin-top: 2.5rem;
            }

            .text-right {
                text-align: right;
            }

            .mb-2 {
                margin-bottom: 0.5rem;
            }

            .underline {
                text-decoration: underline;
            }

            .bg-primary {
                background-color: #50A4FF;
            }

            .w-full {
                width: 100%;
            }

            .h-10 {
                height: 2.5rem;
            }

            .my-5 {
                margin-top: 1.25rem;
                margin-bottom: 1.25rem;
            }

            .font-semibold {
                font-weight: 600;
            }

            .text-lg {
                font-size: 1.125rem;
            }

            .mb-2 {
                margin-bottom: 0.5rem;
            }
        </style>
    </head>
    <body>
        <div>
            <div class="mt-10">
                <div style="float: left;">
                    <p class="mb-2"><span class="font-semibold">Dilaporkan oleh :</span> <span class="underline underline-offset-[6px]">{{ Auth::user()->nama_lengkap }}</span></p>
                    <p><span class="font-semibold">Tipe laporan :</span> <span class="underline underline-offset-[6px]">Pendataan Buku</span></p>
                </div>
                <div style="float: right;">
                    <p><span class="font-semibold">Tanggal pembuatan :</span> <span class="underline underline-offset-[6px]">{{ now()->format('d-m-Y') }}</span></p>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div>
                <svg viewBox="-35 0 326 326" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <path d="M244.828364,64.4290247 L139.050994,3.38839172 C132.188872,-0.58635615 123.724702,-0.58635615 116.86258,3.38839172 L11.0672138,64.4290247 C4.21670092,68.4140969 5.68434189e-14,75.7408852 5.68434189e-14,83.6661817 L5.68434189e-14,205.837425 C0.00604377806,213.747388 4.22254667,221.055993 11.0672138,225.020596 L63.99189,255.612894 L63.99189,317.985192 C64.0010519,320.359385 65.2737404,322.549075 67.3321592,323.732202 C69.390578,324.915329 71.9232588,324.91287 73.9793756,323.725747 L244.936337,225.074582 C251.789146,221.118113 256.008624,213.804351 256.003556,205.891411 L256.003556,83.6481863 C255.962209,75.7100959 251.7068,68.3916143 244.828364,64.4290247 L244.828364,64.4290247 Z" id="path-1"> </path> </defs> <g> <mask id="mask-2" fill="white"> <use xlink:href="#path-1"> </use> </mask> <polygon fill="#EF6C00" mask="url(#mask-2)" points="255.895578 70.8714028 127.98378 144.742806 0 70.8714028 0 218.614208 63.99189 255.522917 63.99189 329.412315 255.895578 218.614208"> </polygon> <polygon fill="#FF9800" mask="url(#mask-2)" points="127.98378 144.742806 2.84217094e-14 70.8714028 127.98378 -3 255.895578 70.8714028"> </polygon> <polygon fill="#FF9800" mask="url(#mask-2)" points="125.716351 142.493372 0.809796133 70.3855251 2.84217094e-14 70.8714028 127.98378 144.742806 255.895578 70.8714028 252.890335 69.0898513"> </polygon> <polygon fill="#FF9800" mask="url(#mask-2)" points="127.98378 145.660575 127.98378 144.742806 0.809796133 71.3032941 2.84217094e-14 71.7891718"> </polygon> </g> </g></svg>
                <h2 class="font-semibold text-lg mb-2">Daftar Buku</h2>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->penulis }}</td>
                            <td>{{ $item->penerbit }}</td>
                            <td>{{ $item->tahun_terbit }}</td>
                            <td>{{ $item->stok }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
