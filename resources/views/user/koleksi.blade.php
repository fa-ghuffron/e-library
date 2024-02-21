<x-app-layout>
    <div class="py-6 px-20">
    <div class="book-list-container mb-8">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-4">Buku mu</h1>
        <hr class="section-divider border-t-2 border-gray-300 w-[150px] mx-auto mb-8">
    </div>

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">history peminjaman</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Koleksi</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="grid grid-cols-7 gap-4">
                @foreach ($peminjaman as $index => $item)
                <div class="relative max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    @if ($item->status_peminjaman == 'N')
                    <span class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">Di pinjam</span>
                    @else
                    <span class="absolute top-0 right-0 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded">Di Kembalikan</span>
                    @endif

                    <a href="{{ route('buku.show', $item->buku->id) }}">
                        <img class="object-cover w-full h-60 rounded-t-lg" src="{{ $item->buku->foto }}" alt="" />
                    </a>
                    <div class="p-5">
                        @foreach ($item->buku->kategoriBukuRelasi as $kategori)
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 hover:underline">{{ $kategori->kategori->nama_kategori }}</span>
                        @endforeach
                        <p class="mb-3 mt-3 text-sm font-semibold text-gray-500">{{ $item->buku->judul }}</p>
                        <div class="flex justify-between items-center">
                            <h5 class="mb-2 text-sm font-semibold tracking-tight text-gray-900">{{ $item->buku->penulis }}</h5>
                            @if ( $item->status_peminjaman != 'N')
                            <div>
                                <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="opsiPeminjaman{{ $index }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-50 rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                    </svg>
                                </button>
                                <div id="opsiPeminjaman{{ $index }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl w-44">
                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton">
                                        <li>
                                            <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="block px-4 py-2 w-full text-left hover:bg-gray-100">Hapus</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <div>
                <button type="button" data-modal-target="modalTambah" data-modal-toggle="modalTambah" class="text-white bg-primary hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 mb-2">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-7 gap-4">
                @foreach ($koleksi as $index => $item)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                        <a href="{{ route('buku.show', $item->buku->id) }}">
                            <img class="object-cover w-full h-60 rounded-t-lg" src="{{ $item->buku->foto }}" alt="" />
                        </a>
                        <div class="p-5">
                            @foreach ($item->buku->kategoriBukuRelasi as $kategori)
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 hover:underline">{{ $kategori->kategori->nama_kategori }}</span>
                            @endforeach
                            <p class="mb-3 mt-3 text-sm font-semibold text-gray-500">{{ $item->buku->judul }}</p>
                            <div class="flex justify-between items-center">
                                <h5 class="mb-2 text-sm font-semibold tracking-tight text-gray-900">{{ $item->buku->penulis }}</h5>
                                <div>
                                    <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="opsiKoleksi{{ $index }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-50 rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                        </svg>
                                    </button>
                                    <div id="opsiKoleksi{{ $index }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl w-44">
                                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton">
                                            <li>
                                                <form action="{{ route('koleksi.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="block px-4 py-2 w-full text-left hover:bg-gray-100">Hapus</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>

</x-app-layout>

<!-- Modal Tambah -->
<div id="modalTambah" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambah Data
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="modalTambah">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('koleksi.store') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="buku_id" class="block mb-2 text-sm font-medium text-gray-900">Judul Buku</label>
                        <select name="buku_id" id="buku_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option selected="">Pilih Buku</option>
                            @foreach ($buku as $item)
                                <option value="{{ $item->id }}">{{ $item->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="text-white bg-primary hover:bg-blue-500 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-5">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
