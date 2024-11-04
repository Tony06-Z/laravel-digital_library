@extends('layout.dashboard.template')
@section('title', 'Table Kategori Buku | Admin')
@section('content')
    <main class="relative h-full max-h-screen transtiion-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->

        <div class="w-full px-6 py-6 mx-auto">
            <!-- Table 1 -->

            @if(session('success'))
            <div class="alert alert-success mb-4" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent">
                        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6 class="dark:text-white">Tabel Kategori Buku</h6>
                            <button class="btn btn-success mb-2 mt-3" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>

                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity 70">Kategori</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity 70">Action</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity 70"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategori as $item)

                                        <tr>
                                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $loop->iteration }}</span>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $item->nama_kategori }}</span>
                                            </td>
                                            <td class="p-2 align-middle items-center bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <div class="flex justify-evenly">
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
        @include('admin.kategori.create')
        @include('admin.kategori.edit')
        @include('admin.kategori.delete')
    </main>
@endsection
