<aside class="h-full bg-white border-r border-gray-100 shadow-sm overflow-y-auto">
   <div class="h-full flex flex-col">
       <!-- Sidebar Header -->
       <div class="h-16 flex items-center px-6 border-b border-gray-100">
           <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
               <!-- Logo (Left Side) -->
            <div class="flex-shrink-0 flex items-center" data-aos="fade-right" data-aos-duration="800">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo-trans.png') }}" alt="DreamIslands Logo" class="h-10 w-auto mr-2">
                    <a href="/" class="text-blue-600 font-bold text-l">SanurBoat</a>
                </div>
            </div>
           </a>
       </div>

       <!-- Sidebar Navigation -->
       <nav class="flex-1 overflow-y-auto py-4">
           <ul class="space-y-0.5 px-3">
               <li>
                   <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'custom-blue-light-bg custom-blue' : 'text-gray-600 hover:bg-gray-50' }}">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'custom-blue' : 'text-gray-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <rect x="3" y="3" width="7" height="7"></rect>
                           <rect x="14" y="3" width="7" height="7"></rect>
                           <rect x="14" y="14" width="7" height="7"></rect>
                           <rect x="3" y="14" width="7" height="7"></rect>
                       </svg>
                       Dashboard
                   </a>
               </li>
               <li>
                   <a href="{{ route('admin.schedule') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.schedule') ? 'custom-blue-light-bg custom-blue' : 'text-gray-600 hover:bg-gray-50' }}">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('admin.schedule') ? 'custom-blue' : 'text-gray-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                           <line x1="16" y1="2" x2="16" y2="6"></line>
                           <line x1="8" y1="2" x2="8" y2="6"></line>
                           <line x1="3" y1="10" x2="21" y2="10"></line>
                       </svg>
                       Jadwal & Tiket
                   </a>
               </li>
               <li>
                   <a href="{{ route('admin.boats') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.boats') ? 'custom-blue-light-bg custom-blue' : 'text-gray-600 hover:bg-gray-50' }}">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('admin.boats') ? 'custom-blue' : 'text-gray-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <path d="M21 10c0 0-3-3-9-3s-9 3-9 3"></path>
                           <path d="M3 10v7a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                           <path d="M12 7v6"></path>
                           <path d="M12 13l-3-3"></path>
                           <path d="M12 13l3-3"></path>
                       </svg>
                       Boat
                   </a>
               </li>
               <li>
                   <a href="{{ route('admin.payments') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.payments') ? 'custom-blue-light-bg custom-blue' : 'text-gray-600 hover:bg-gray-50' }}">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('admin.payments') ? 'custom-blue' : 'text-gray-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                           <line x1="2" y1="10" x2="22" y2="10"></line>
                       </svg>
                       Verifikasi Pembayaran
                   </a>
               </li>
               <li>
                   <a href="{{ route('admin.passengers') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.passengers*') ? 'custom-blue-light-bg custom-blue' : 'text-gray-600 hover:bg-gray-50' }}">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('admin.passengers*') ? 'custom-blue' : 'text-gray-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                           <circle cx="9" cy="7" r="4"></circle>
                           <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                           <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                       </svg>
                       Manajemen Penumpang
                   </a>
               </li>
               <li>
                   <a href="{{ route('admin.feedback') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.feedback') ? 'custom-blue-light-bg custom-blue' : 'text-gray-600 hover:bg-gray-50' }}">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('admin.feedback') ? 'custom-blue' : 'text-gray-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                       </svg>
                       Feedback
                   </a>
               </li>
           </ul>
       </nav>

       <!-- User Profile -->
       <div class="border-t border-gray-100 p-4">
           <div class="flex items-center">
               <div class="flex-shrink-0">
                   <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=2271B3&color=fff" alt="Guest User">
               </div>
               <div class="ml-3">
                   <p class="text-sm font-medium text-gray-700">Admin</p>
                   <p class="text-xs font-medium text-gray-500">SanurBoat</p>
               </div>
           </div>
       </div>
   </div>
</aside>
