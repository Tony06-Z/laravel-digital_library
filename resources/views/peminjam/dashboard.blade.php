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

     {{-- Header --}}
    @include('layout.landing.header')

     {{-- Jumbotron --}}
     @include('layout.landing.jumbotron')
     
     {{-- Description --}}
     @include('layout.landing.desc')

    {{-- List Buku --}}
    @include('layout.landing.list-buku')

      {{-- Ajakan --}}
      <section class="bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
            <div class="max-w-screen-sm mx-auto text-center">
                <h2 class="mb-4 text-3xl font-extrabold leading-tight tracking-tight text-gray-900 dark:text-white">Mulai Membaca Sekarang!📚</h2>
                <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">Silahkan lihat list buku dan pilih buku yang anda inginkan🤩</p>
                <a href="#" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Check Sekarang</a>
            </div>
        </div>
    </section>


     {{-- Footer --}}
     @include('layout.landing.footer')

<!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="{{ asset('js/app.js') }}"></script>
</body>
</html>



z