@extends('layout.dashboard.template')
@section('title', 'Dashboard')
@section('content') 
  <!-- Main Content -->
  <div class="flex flex-col h-screen bg-gray-100">
    <!-- Top Navigation Bar -->
    <header class="bg-slate-700 text-white shadow-lg p-4">
      <div class="container mx-auto flex justify-between items-center border-b border-gray-700">
        <h1 class="text-3xl font-extrabold tracking-wide font-serif" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Admin - <span>Dashboard</span></h1>
        <div class="flex items-center space-x-4">
          <img class="w-10 h-10 rounded-full border-2 border-indigo-500" src="https://via.placeholder.com/150" alt="Admin Avatar">
          <p class="text-sm font-semibold">Toni Zulfandy</p>
          <button class="bg-indigo-600 py-2 px-4 rounded-lg text-sm hover:bg-indigo-700 transition-colors">Logout</button>
        </div>
      </div>
    </header>
  
    <!-- Main Content -->
    <main class="flex-1 p-8 relative">
      <h2 class="text-3xl font-semibold text-gray-800 mb-8" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Welcome, Admin</h2>
  
      <!-- Dashboard Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- Card 1: Buku -->
        <div class="bg-white text-gray-800 shadow-md rounded-lg p-6 hover:shadow-lg transform hover:scale-105 transition-transform duration-200 relative overflow-hidden">
          <div class="absolute inset-0 opacity-10 bg-cover" style="background-image: url('https://images.unsplash.com/photo-1514516874510-3098f517f177?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTc1M3wwfDF8c2VhcmNofDF8fGJvb2t8ZW58MHx8fHwxNjc5NjY5OTU0&ixlib=rb-1.2.1&q=80&w=1080');"></div>
          <div class="relative z-10 flex justify-between items-center">
            <div>
              <p class="text-sm font-semibold">Buku</p>
              <h5 class="text-3xl font-bold">{{ $buku_count }}</h5>
            </div>
            <i class="bi bi-book-fill text-4xl"></i>
          </div>
        </div>
  
        <!-- Card 2: Peminjaman -->
        <div class="bg-white text-gray-800 shadow-md rounded-lg p-6 hover:shadow-lg transform hover:scale-105 transition-transform duration-200 relative overflow-hidden">
          <div class="absolute inset-0 opacity-10 bg-cover" style="background-image: url('https://images.unsplash.com/photo-1541171998967-7a248cb4ff46?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTc1M3wwfDF8c2VhcmNofDJ8fGxvYW58ZW58MHx8fHwxNjc5NjY5OTU0&ixlib=rb-1.2.1&q=80&w=1080');"></div>
          <div class="relative z-10 flex justify-between items-center">
            <div>
              <p class="text-sm font-semibold">Peminjaman</p>
              <h5 class="text-3xl font-bold">{{ $peminjaman_count }}</h5>
            </div>
            <i class="bi bi-hand-thumbs-up-fill text-4xl"></i>
          </div>
        </div>
  
        <!-- Card 3: User -->
        <div class="bg-white text-gray-800 shadow-md rounded-lg p-6 hover:shadow-lg transform hover:scale-105 transition-transform duration-200 relative overflow-hidden">
          <div class="absolute inset-0 opacity-10 bg-cover" style="background-image: url('https://images.unsplash.com/photo-1517336714731-489689fd1ca8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTc1M3wwfDF8c2VhcmNofDR8fHVzZXJ8ZW58MHx8fHwxNjc5NjY5OTU0&ixlib=rb-1.2.1&q=80&w=1080');"></div>
          <div class="relative z-10 flex justify-between items-center">
            <div>
              <p class="text-sm font-semibold">User</p>
              <h5 class="text-3xl font-bold">{{ $users_count }}</h5>
            </div>
            <i class="bi bi-person-fill text-4xl"></i>
          </div>
        </div>
  
        <!-- Card 4: Kategori -->
        <div class="bg-white text-gray-800 shadow-md rounded-lg p-6 hover:shadow-lg transform hover:scale-105 transition-transform duration-200 relative overflow-hidden">
          <div class="absolute inset-0 opacity-10 bg-cover" style="background-image: url('https://images.unsplash.com/photo-1584697964162-1d28f17b3e7e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTc1M3wwfDF8c2VhcmNofDF8fGZvbGRlcnxlbnwwfHx8fDE2Nzk2Njk5NTQ&ixlib=rb-1.2.1&q=80&w=1080');"></div>
          <div class="relative z-10 flex justify-between items-center">
            <div>
              <p class="text-sm font-semibold">Kategori</p>
              <h5 class="text-3xl font-bold">{{ $kategori_count }}</h5>
            </div>
            <i class="bi bi-folder-fill text-4xl"></i>
          </div>
        </div>
      </div>
    </main>
  </div>
  
  <!-- Add Bootstrap Icons CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  
  

@endsection