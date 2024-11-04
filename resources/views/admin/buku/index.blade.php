@extends('layout.dashboard.template')
@section('title', 'Table Buku | Admin')
@section('content')
</main>
<main>
    {{-- Navbar --}}

    <div>

        <div class="w-full px-6 py-6 mx-auto">
            <!-- Display Success Message -->
            @if(session('success'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- table 1 -->
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border border-transparent shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl">
                        <div class="p-6 pb-0 mb-0 border-b border-b-solid rounded-t-2xl border-b-transparent">
                            <h6 class="dark:text-white">Tabel Buku</h6>
                            <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
                            <a href=""></a>
                            <a href=""></a>
                        </div>
                        <div class="flex-auto px-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Judul</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Gambar</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Penulis</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Penerbit</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Stock</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Tahun Terbit</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Kategori</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-b-solid dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($buku as $item)
                                            <tr>
                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                                    <span>{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                                    <span>{{ $item->judul }}</span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                                    <span>
                                                        <img src="{{ asset('storage/buku/' . $item->sampul) }}" alt="{{ $item->judul }}" class="max-w-[100px]">
                                                    </span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                                    <span>{{ $item->penulis }}</span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                                    <span>{{ $item->penerbit }}</span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                                    <span>{{ $item->stock }}</span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                                    <span>{{ $item->tahun_terbit }}</span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                                    <span>{{ $item->kategori->nama_kategori }}</span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                                    <div>
                                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $item->id }}">Edit</button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">Delete</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.buku.create')
    @include('admin.buku.edit')
    @include('admin.buku.delete')
</main>

@endsection