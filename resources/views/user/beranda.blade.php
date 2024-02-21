<x-app-layout>
<div class="py-6 px-20">
    <div class="book-list-container mb-8">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-4">Daftar Buku</h1>
        <hr class="section-divider border-t-2 border-gray-300 w-[150px] mx-auto mb-8">
    </div>


    <div class="flex">
        <div class="grid grid-cols-4 gap-4">
            @foreach ($buku as $item)
            <div class="bg-white shadow-md rounded-lg overflow-hidden max-w-xs dark:bg-gray-800 dark:border-gray-700">
                <a href="{{ route('buku.show', $item->id) }}">
                    <img class="object-cover w-full h-72" src="{{ asset($item->foto) }}" alt="{{ $item->judul }}" />
                </a>

                <div class="p-4">

                    <a href="{{ route('buku.show', $item->id) }}" class="text-gray-900 text-lg font-semibold  dark:text-white hover:underline">
                        {{ $item->judul }}
                    </a>
                    <div>
                        @foreach ($item->kategoriBukuRelasi as $kategoriBuku)
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 hover:underline">{{ $kategoriBuku->kategori->nama_kategori }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center mt-1.5 mb-3">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < $averages[$item->id])
                                <svg class="w-4 h-4 text-yellow-300 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endif
                        @endfor
                        <span class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ number_format($averages[$item->id], 1) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-gray-900 dark:text-white">
                            {{ $item->penulis }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>



                    <div class="flex-shrink-0 w-1/4 ml-4 sticky">
                        <div class="mb-8">
                            <form action="{{ route('beranda') }}" method="GET" id="formPencarian" class="mb-4">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="search" id="pencarianBuku" name="query" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-300 focus:border-blue-300" placeholder="Pencarian Buku ...">
                                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-primary hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Cari</button>
                                </div>
                            </form>

                            {{-- <div class="p-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300">
                                <p class="mb-2 font-semibold">Kategori:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($kategori as $item)
                                        <a href="{{ route('beranda', ['query' => $item->nama_kategori]) }}" class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 hover:underline">
                                            {{ $item->nama_kategori }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="p-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300">
                    <p class="mb-2 font-semibold">Kategori:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($kategori as $item)
                            <a href="{{ route('pencarian', ['query' => $item->nama_kategori]) }}" class="category-link bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 hover:underline" onclick="updateCategory('{{ route('beranda', ['query' => $item->nama_kategori]) }}')">
                                {{ $item->nama_kategori }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>



</x-app-layout>


