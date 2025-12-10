<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Asset Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
        }
        /* Animasi Chat Widget */
        .chat-widget { transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); transform-origin: bottom right; }
        .chat-hidden { transform: scale(0); opacity: 0; pointer-events: none; }
        /* Style Tabel Markdown */
        .prose table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 0.875rem; }
        .prose th, .prose td { border: 1px solid #e5e7eb; padding: 4px 8px; }
        .prose th { background-color: #f3f4f6; }
        
        /* Animasi Smooth */
        @keyframes slideInLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes scaleIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .animate-slide-in { animation: slideInLeft 0.5s ease-out; }
        .animate-fade-up { animation: fadeInUp 0.6s ease-out; }
        .animate-scale { animation: scaleIn 0.4s ease-out; }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Hover Effects */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        /* Scrollbar Custom */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); }
        
        /* Sidebar Toggle */
        .sidebar { 
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            width: 16rem;
            overflow: hidden;
        }
        
        .sidebar.collapsed { 
            width: 5rem; 
        }
        
        /* Text elements - smooth fade */
        .nav-text,
        .brand-text { 
            transition: opacity 0.15s ease;
            white-space: nowrap;
            display: inline-block;
        }
        
        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .brand-text { 
            opacity: 0;
            width: 0;
            overflow: hidden;
        }
        
        /* Nav items positioning */
        .nav-item { 
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }
        
        .sidebar.collapsed .nav-item { 
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }
        
        .sidebar.collapsed .nav-item .nav-content {
            justify-content: center;
        }
        
        /* Header alignment when collapsed */
        .sidebar.collapsed .header-content {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }
        
        /* Footer handling */
        .footer-text {
            transition: opacity 0.15s ease;
            white-space: nowrap;
        }
        
        .sidebar.collapsed .footer-text {
            opacity: 0;
            display: none;
        }
        
        .sidebar.collapsed .footer-content {
            justify-content: center;
        }
        
        /* Hide brand container content when collapsed */
        .sidebar.collapsed .brand-container {
            opacity: 0;
            width: 0;
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <aside id="sidebar" class="sidebar bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-white flex flex-col shadow-2xl z-20 animate-slide-in relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-10 -left-10 w-40 h-40 bg-purple-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 -right-10 w-40 h-40 bg-blue-500 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative p-4 border-b border-white/10">
            <div class="header-content flex items-center justify-center gap-3">
                <button onclick="toggleSidebar()" class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-purple-400 to-blue-500 rounded-xl flex items-center justify-center shadow-lg transition-all duration-200 hover:scale-105 hover:shadow-xl cursor-pointer">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                </button>
                <span class="brand-text font-bold text-base bg-gradient-to-r from-purple-200 to-blue-200 bg-clip-text text-transparent overflow-hidden">Asset Management</span>
            </div>
        </div>
        
        <nav class="relative flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="nav-item group px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-purple-500 to-blue-500 shadow-lg shadow-purple-500/50' : '' }}">
                <div class="nav-content flex items-center gap-3">
                    <svg class="w-6 h-6 flex-shrink-0 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/></svg>
                    <span class="nav-text font-medium transition-all duration-300">Dashboard</span>
                    @if(request()->routeIs('dashboard'))
                        <span class="nav-text ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></span>
                    @endif
                </div>
            </a>
            <a href="{{ route('assets.index') }}" class="nav-item group px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('assets.*') ? 'bg-gradient-to-r from-purple-500 to-blue-500 shadow-lg shadow-purple-500/50' : '' }}">
                <div class="nav-content flex items-center gap-3">
                    <svg class="w-6 h-6 flex-shrink-0 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/></svg>
                    <span class="nav-text font-medium transition-all duration-300">Data Aset</span>
                    @if(request()->routeIs('assets.*'))
                        <span class="nav-text ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></span>
                    @endif
                </div>
            </a>
        </nav>
        
        <div class="relative p-4 border-t border-white/10 text-xs text-purple-200">
            <div class="footer-content mb-2 flex items-center justify-center gap-2 transition-all duration-300">
                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse flex-shrink-0"></div>
                <span class="footer-text">System Online</span>
            </div>
            <div class="footer-text text-white/50 text-center transition-all duration-300">© 2025 BNSP</div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col relative overflow-hidden">
        <header class="glass shadow-xl p-5 flex justify-between items-center z-10 animate-fade-up border-b border-white/20">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden w-9 h-9 rounded-lg bg-gradient-to-br from-purple-500 to-blue-500 text-white flex items-center justify-center hover:shadow-lg transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1 class="text-xl font-bold gradient-text">@yield('title')</h1>
                    <p class="text-xs text-gray-500 mt-1">@yield('subtitle', 'Kelola aset perusahaan Anda dengan mudah')</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center gap-2 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100">
                    <span class="text-xs text-gray-500">{{ now()->format('d M Y') }}</span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="text-xs font-semibold text-gray-700">{{ now()->format('H:i') }}</span>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 scroll-smooth bg-gradient-to-br from-gray-50 to-purple-50">
            <div class="animate-scale">
                @yield('content')
            </div>
        </div>

        @include('components.chatbot')
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            
            // Save state to localStorage
            if (sidebar.classList.contains('collapsed')) {
                localStorage.setItem('sidebarCollapsed', 'true');
            } else {
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        }
        
        // Restore sidebar state on page load
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
            }
        });
    </script>
</body>
</html>