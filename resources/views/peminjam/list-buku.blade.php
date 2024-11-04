<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pustaka</title>

    {{-- TailwindCSS & FlowbiteCSS --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    {{-- Section for includes file css --}}
    @stack('styles')

    {{-- Font Awesome --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">List Buku
                    Berdasarkan Kategori
                </h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Baca Ratusan Buku Sesuai
                    Kategori Kesukaanmu🤩</p>
            </div>
            @forelse ($kategori as $item)
                <div
                    class="my-4 flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                        {{ $item->nama_kategori }}
                    </h2>
                </div>

                <div class="flex flex-wrap justify-center gap-[25px] items-center">
                    @forelse ($buku as $bukuItem)
                        @if ($bukuItem->kategori_id == $item->id)
                            <div class="flex justify-start items-center gap-2 flex-wrap">
                                <div
                                    class="my-4 flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                                    <h3 class="mb-4 text-2xl font-semibold">{{ $bukuItem->judul }}</h3>
                                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                                        {{ $bukuItem->penulis }}</p>
                                    <div class="mx-auto items-center justify-center my-8 w-[100px]">
                                        <img src="{{ asset('storage/buku/' . $bukuItem->sampul) }}"
                                            alt="{{ $bukuItem->judul }}">
                                    </div>
                                    <ul role="list" class="mb-8 space-y-4 text-left">
                                    </ul>
                                    <a href="{{ route('detail_buku', $bukuItem->id) }}"
                                        class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">Lihat</a>
                                </div>
                            </div>
                        @else
                        @endif
                    @empty
                    @endforelse
                </div>

            @empty
                <div
                    class="my-4 flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                        Tidak Ada Kategori
                    </h2>
                </div>
            @endforelse
        </div>
    </section>

<!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="{{ asset('js/app.js') }}"></script>
</body>
</html>



z