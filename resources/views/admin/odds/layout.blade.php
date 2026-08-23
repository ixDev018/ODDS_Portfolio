<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>ODDS Studio | Admin Portal</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <style>
        :root {
            --font-primary: 'Plus Jakarta Sans', sans-serif;
            --font-mono: 'JetBrains Mono', 'Space Mono', monospace;
            --odds-purple: #875af5;
            --odds-purple-dark: #6e3ce6;
            --odds-pink: #f359b0;
            --bg-canvas: #0b0b0e;
            --bg-sidebar: #111115;
            --bg-card: #16161c;
            --bg-card-hover: #1c1c24;
            --border-color: #22222a;
            --border-light: #2c2c36;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-primary);
            background: var(--bg-canvas);
            color: #e2e2e8;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            height: 100vh;
        }

        /* Docked Full-Height Sidebar (Zero Floating Gap) */
        .odds-sidebar {
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            width: 250px;
            height: 100vh;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            z-index: 40;
        }

        .odds-sidebar-brand {
            padding: 1.5rem 1.5rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
        }

        .odds-nav-section {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            padding: 1rem 0.75rem;
        }

        .odds-nav-link {
            font-family: var(--font-primary);
            font-weight: 600;
            font-size: 0.8125rem;
            color: #8a8a99;
            text-decoration: none;
            padding: 0.6rem 0.85rem;
            border-radius: 0.65rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.15s ease;
        }

        .odds-nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.04);
        }

        .odds-nav-link.active {
            color: #ffffff;
            background: rgba(135, 90, 245, 0.12);
            border: 1px solid rgba(135, 90, 245, 0.3);
        }

        .odds-nav-link.active i {
            color: var(--odds-purple);
        }

        .odds-sidebar-bottom {
            margin-top: auto;
            padding: 1rem 0.85rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        /* Buttons matching ODDS front page */
        .odds-btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            padding: 0.55rem 1.25rem;
            background: var(--odds-purple);
            color: #fff;
            border: 1px solid transparent;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 700;
            font-family: var(--font-primary);
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(135, 90, 245, 0.25);
        }

        .odds-btn-primary:hover {
            background: #966bf7;
            box-shadow: 0 6px 20px rgba(135, 90, 245, 0.4);
            transform: translateY(-1px);
        }

        .odds-btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            padding: 0.55rem 1.15rem;
            background: #1e1e26;
            color: #d1d1db;
            border: 1px solid var(--border-color);
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .odds-btn-secondary:hover {
            background: #282834;
            color: #ffffff;
            border-color: var(--border-light);
        }

        /* Card container */
        .odds-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
        }

        /* Input inputs */
        .odds-input {
            width: 100%;
            background: #0f0f13;
            border: 1px solid var(--border-color);
            border-radius: 0.6rem;
            padding: 0.65rem 0.85rem;
            color: #ffffff;
            font-size: 0.85rem;
            outline: none;
            transition: all 0.15s ease;
        }

        .odds-input:focus {
            border-color: var(--odds-purple);
            box-shadow: 0 0 0 2px rgba(135, 90, 245, 0.2);
            background: #14141a;
        }

        .odds-input::placeholder { color: #555562; }

        .odds-label {
            display: block;
            font-size: 0.68rem;
            font-family: var(--font-mono);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #8a8a99;
            margin-bottom: 0.35rem;
            font-weight: 600;
        }

        /* Table */
        .odds-table {
            width: 100%;
            border-collapse: collapse;
        }
        .odds-table th {
            font-family: var(--font-mono);
            font-size: 0.62rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #6c6c7d;
            padding: 0.7rem 1rem;
            border-bottom: 1px solid var(--border-color);
            text-align: left;
        }
        .odds-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #1c1c24;
            font-size: 0.85rem;
            color: #d1d1db;
            vertical-align: middle;
        }

        /* Badges */
        .odds-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.6rem;
            border-radius: 100px;
            font-size: 0.62rem;
            font-family: var(--font-mono);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        .odds-badge-purple {
            background: rgba(135, 90, 245, 0.15);
            color: #a78bfa;
            border: 1px solid rgba(135, 90, 245, 0.3);
        }
        .odds-badge-green {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }
        .odds-badge-pink {
            background: rgba(243, 89, 176, 0.15);
            color: #f472b6;
            border: 1px solid rgba(243, 89, 176, 0.3);
        }

        /* Success & Notification Modal */
        @keyframes modalPopIn {
            0% { opacity: 0; transform: scale(0.9) translateY(15px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        .odds-modal-card {
            animation: modalPopIn 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Main Content Container */
        .odds-main-content {
            flex: 1;
            height: 100vh;
            overflow-y: auto;
            padding: 2rem 2.5rem;
            background: var(--bg-canvas);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .odds-page-container {
            width: 100%;
            max-width: 1380px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #262632; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #3c3c4e; }
    </style>
    @stack('styles')
</head>
<body class="flex" x-data="{ mobileNav: false }">

    <!-- Docked Left Sidebar (Edge-to-Edge, Non-Floating) -->
    <aside class="odds-sidebar fixed md:static inset-y-0 left-0 transition-transform duration-300 md:translate-x-0"
           :class="mobileNav ? 'translate-x-0' : '-translate-x-full'">
        
        <!-- Brand Header with Logo -->
        <div class="odds-sidebar-brand">
            <a href="{{ route('odds.admin.dashboard') }}" class="flex items-center space-x-2.5">
                <svg width="74" height="24" viewBox="0 0 88 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-auto text-white">
                    <path d="M11.3567 12.2224C11.376 12.4818 11.5355 12.7099 11.7726 12.817L19.6574 16.378C20.1484 16.5998 20.6978 16.2154 20.6579 15.6782L20.2762 10.5463C20.2569 10.287 20.0974 10.0589 19.8603 9.95181L11.9755 6.39075C11.4845 6.169 10.9351 6.55335 10.975 7.09063L11.3567 12.2224Z" fill="white"/>
                    <path d="M10.8914 13.253C11.0988 13.096 11.3754 13.0649 11.6124 13.172L19.4972 16.733C19.9882 16.9548 20.0631 17.6211 19.6336 17.9463L15.5312 21.053C15.3239 21.21 15.0472 21.2411 14.8102 21.1341L6.92539 17.573C6.43438 17.3512 6.35946 16.6849 6.78897 16.3597L10.8914 13.253Z" fill="white"/>
                    <path d="M27.9087 13.9543C27.9087 21.6611 21.6611 27.9087 13.9543 27.9087C6.24757 27.9087 0 21.6611 0 13.9543C0 6.24757 6.24757 0 13.9543 0C21.6611 0 27.9087 6.24757 27.9087 13.9543ZM2.99795 13.9543C2.99795 20.0054 7.90329 24.9107 13.9543 24.9107C20.0054 24.9107 24.9107 20.0054 24.9107 13.9543C24.9107 7.90329 20.0054 2.99795 13.9543 2.99795C7.90329 2.99795 2.99795 7.90329 2.99795 13.9543Z" fill="white"/>
                    <path d="M24.9844 27.4219V0.559082H33.5805C36.4459 0.559082 38.9147 1.13471 40.987 2.28598C43.0848 3.43725 44.7094 5.02343 45.8606 7.04454C47.0119 9.06565 47.5875 11.381 47.5875 13.9905C47.5875 16.6 47.0119 18.9154 45.8606 20.9365C44.7094 22.9576 43.0848 24.5438 40.987 25.695C38.9147 26.8463 36.4459 27.4219 33.5805 27.4219H24.9844ZM28.6684 24.16H33.6189C35.6144 24.16 37.3797 23.7507 38.9147 22.932C40.4753 22.1133 41.7033 20.9493 42.5987 19.4398C43.4942 17.9048 43.9419 16.0884 43.9419 13.9905C43.9419 11.8671 43.4942 10.0506 42.5987 8.54119C41.7033 7.03175 40.4753 5.86769 38.9147 5.04902C37.3797 4.23034 35.6144 3.821 33.6189 3.821H28.6684V24.16Z" fill="white"/>
                    <path d="M46.7445 27.4219V0.559082H55.3406C58.206 0.559082 60.6748 1.13471 62.7471 2.28598C64.8449 3.43725 66.4695 5.02343 67.6207 7.04454C68.772 9.06565 69.3476 11.381 69.3476 13.9905C69.3476 16.6 68.772 18.9154 67.6207 20.9365C66.4695 22.9576 64.8449 24.5438 62.7471 25.695C60.6748 26.8463 58.206 27.4219 55.3406 27.4219H46.7445ZM50.4285 24.16H55.379C57.3745 24.16 59.1398 23.7507 60.6748 22.932C62.2354 22.1133 63.4634 20.9493 64.3588 19.4398C65.2543 17.9048 65.702 16.0884 65.702 13.9905C65.702 11.8671 65.2543 10.0506 64.3588 8.54119C63.4634 7.03175 62.2354 5.86769 60.6748 5.04902C59.1398 4.23034 57.3745 3.821 55.379 3.821H50.4285V24.16Z" fill="white"/>
                    <path d="M25.597 27.4219V24.16H80.0172C80.9127 24.16 81.6802 23.9553 82.3198 23.546C82.9594 23.1111 83.4582 22.561 83.8164 21.8959C84.1746 21.2307 84.3537 20.5271 84.3537 19.7852C84.3537 19.0177 84.1746 18.3141 83.8164 17.6746C83.4838 17.0094 82.9977 16.4849 82.3581 16.1012C81.7441 15.6918 80.9894 15.4872 80.094 15.4872H75.0284C73.519 15.4872 72.1886 15.1801 71.0374 14.5661C69.8861 13.9265 68.9779 13.0567 68.3127 11.9566C67.6731 10.8309 67.3533 9.56453 67.3533 8.15743C67.3533 6.72475 67.6603 5.43277 68.2743 4.28151C68.9139 3.13024 69.7966 2.22202 70.9222 1.55685C72.0735 0.89167 73.3911 0.559082 74.8749 0.559082H86.2724V3.821H75.2203C74.376 3.821 73.6341 4.02567 72.9945 4.43501C72.3549 4.81876 71.8688 5.33044 71.5362 5.97003C71.2037 6.58404 71.0374 7.24921 71.0374 7.96555C71.0374 8.65631 71.1909 9.32149 71.4979 9.96108C71.8305 10.5751 72.3038 11.074 72.9178 11.4577C73.5574 11.8415 74.2865 12.0334 75.1052 12.0334H80.2859C81.8976 12.0334 83.2791 12.3532 84.4304 12.9927C85.5817 13.6323 86.4643 14.5022 87.0783 15.6023C87.6923 16.7024 87.9993 17.956 87.9993 19.3631C87.9993 20.9237 87.6795 22.318 87.0399 23.546C86.4259 24.7484 85.5433 25.695 84.392 26.3858C83.2408 27.0766 81.9232 27.4219 80.4394 27.4219H25.597Z" fill="white"/>
                </svg>
                <span class="px-2 py-0.5 rounded-full bg-[#875af5]/15 border border-[#875af5]/30 text-[#875af5] text-[9px] font-mono font-bold uppercase tracking-wider">CMS</span>
            </a>
            <button @click="mobileNav = false" class="md:hidden text-gray-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Navigation Tabs -->
        <nav class="flex-1 overflow-y-auto odds-nav-section">
            <a href="{{ route('odds.admin.dashboard') }}" 
               class="odds-nav-link {{ request()->routeIs('odds.admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie w-4 text-center"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('odds.admin.settings') }}" 
               class="odds-nav-link {{ request()->routeIs('odds.admin.settings') ? 'active' : '' }}">
                <i class="fa-solid fa-sliders w-4 text-center"></i>
                <span>Hero & General</span>
            </a>

            <a href="{{ route('odds.admin.works.index') }}" 
               class="odds-nav-link {{ request()->routeIs('odds.admin.works*') ? 'active' : '' }}">
                <i class="fa-solid fa-folder-tree w-4 text-center"></i>
                <span>Outputs / Works</span>
            </a>

            <a href="{{ route('odds.admin.services.index') }}" 
               class="odds-nav-link {{ request()->routeIs('odds.admin.services*') ? 'active' : '' }}">
                <i class="fa-solid fa-cubes w-4 text-center"></i>
                <span>Services</span>
            </a>

            <a href="{{ route('odds.admin.testimonials.index') }}" 
               class="odds-nav-link {{ request()->routeIs('odds.admin.testimonials*') ? 'active' : '' }}">
                <i class="fa-solid fa-star w-4 text-center"></i>
                <span>Testimonials</span>
            </a>

            <a href="{{ route('odds.admin.why.index') }}" 
               class="odds-nav-link {{ request()->routeIs('odds.admin.why*') ? 'active' : '' }}">
                <i class="fa-solid fa-lightbulb w-4 text-center"></i>
                <span>Why Bet on ODDS</span>
            </a>

            <div class="pt-3 mt-3 border-t border-[#22222a]">
                <a href="{{ route('odds.admin.inquiries.index') }}" 
                   class="odds-nav-link justify-between {{ request()->routeIs('odds.admin.inquiries*') ? 'active' : '' }}">
                    <div class="flex items-center space-x-2.5">
                        <i class="fa-solid fa-inbox w-4 text-center"></i>
                        <span>Visitor Inbox</span>
                    </div>
                    @php $unreadCount = \App\Models\OddsInquiry::where('is_read', false)->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="px-2 py-0.5 text-[9px] font-bold bg-[#875af5] text-white rounded-full font-mono">{{ $unreadCount }}</span>
                    @endif
                </a>
            </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="odds-sidebar-bottom">
            <a href="{{ route('portfolio.index') }}" target="_blank" class="odds-btn-secondary w-full justify-center text-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                <span>View Front Page</span>
            </a>
            <form action="{{ route('odds.admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2 px-3 text-xs font-semibold text-gray-400 hover:text-red-400 hover:bg-red-950/20 rounded-lg transition-colors flex items-center justify-center space-x-1.5 font-mono">
                    <i class="fa-solid fa-right-from-bracket text-[11px]"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area (Centered Canvas) -->
    <main class="odds-main-content">
        <div class="odds-page-container">
            
            <!-- Mobile Toggle Button -->
            <div class="md:hidden flex items-center justify-between pb-4 border-b border-[#22222a] mb-6">
                <svg width="74" height="24" viewBox="0 0 88 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4 w-auto text-white">
                    <path d="M11.3567 12.2224C11.376 12.4818 11.5355 12.7099 11.7726 12.817L19.6574 16.378C20.1484 16.5998 20.6978 16.2154 20.6579 15.6782L20.2762 10.5463C20.2569 10.287 20.0974 10.0589 19.8603 9.95181L11.9755 6.39075C11.4845 6.169 10.9351 6.55335 10.975 7.09063L11.3567 12.2224Z" fill="white"/>
                    <path d="M10.8914 13.253C11.0988 13.096 11.3754 13.0649 11.6124 13.172L19.4972 16.733C19.9882 16.9548 20.0631 17.6211 19.6336 17.9463L15.5312 21.053C15.3239 21.21 15.0472 21.2411 14.8102 21.1341L6.92539 17.573C6.43438 17.3512 6.35946 16.6849 6.78897 16.3597L10.8914 13.253Z" fill="white"/>
                    <path d="M27.9087 13.9543C27.9087 21.6611 21.6611 27.9087 13.9543 27.9087C6.24757 27.9087 0 21.6611 0 13.9543C0 6.24757 6.24757 0 13.9543 0C21.6611 0 27.9087 6.24757 27.9087 13.9543ZM2.99795 13.9543C2.99795 20.0054 7.90329 24.9107 13.9543 24.9107C20.0054 24.9107 24.9107 20.0054 24.9107 13.9543C24.9107 7.90329 20.0054 2.99795 13.9543 2.99795C7.90329 2.99795 2.99795 7.90329 2.99795 13.9543Z" fill="white"/>
                    <path d="M24.9844 27.4219V0.559082H33.5805C36.4459 0.559082 38.9147 1.13471 40.987 2.28598C43.0848 3.43725 44.7094 5.02343 45.8606 7.04454C47.0119 9.06565 47.5875 11.381 47.5875 13.9905C47.5875 16.6 47.0119 18.9154 45.8606 20.9365C44.7094 22.9576 43.0848 24.5438 40.987 25.695C38.9147 26.8463 36.4459 27.4219 33.5805 27.4219H24.9844ZM28.6684 24.16H33.6189C35.6144 24.16 37.3797 23.7507 38.9147 22.932C40.4753 22.1133 41.7033 20.9493 42.5987 19.4398C43.4942 17.9048 43.9419 16.0884 43.9419 13.9905C43.9419 11.8671 43.4942 10.0506 42.5987 8.54119C41.7033 7.03175 40.4753 5.86769 38.9147 5.04902C37.3797 4.23034 35.6144 3.821 33.6189 3.821H28.6684V24.16Z" fill="white"/>
                    <path d="M46.7445 27.4219V0.559082H55.3406C58.206 0.559082 60.6748 1.13471 62.7471 2.28598C64.8449 3.43725 66.4695 5.02343 67.6207 7.04454C68.772 9.06565 69.3476 11.381 69.3476 13.9905C69.3476 16.6 68.772 18.9154 67.6207 20.9365C66.4695 22.9576 64.8449 24.5438 62.7471 25.695C60.6748 26.8463 58.206 27.4219 55.3406 27.4219H46.7445ZM50.4285 24.16H55.379C57.3745 24.16 59.1398 23.7507 60.6748 22.932C62.2354 22.1133 63.4634 20.9493 64.3588 19.4398C65.2543 17.9048 65.702 16.0884 65.702 13.9905C65.702 11.8671 65.2543 10.0506 64.3588 8.54119C63.4634 7.03175 62.2354 5.86769 60.6748 5.04902C59.1398 4.23034 57.3745 3.821 55.379 3.821H50.4285V24.16Z" fill="white"/>
                    <path d="M25.597 27.4219V24.16H80.0172C80.9127 24.16 81.6802 23.9553 82.3198 23.546C82.9594 23.1111 83.4582 22.561 83.8164 21.8959C84.1746 21.2307 84.3537 20.5271 84.3537 19.7852C84.3537 19.0177 84.1746 18.3141 83.8164 17.6746C83.4838 17.0094 82.9977 16.4849 82.3581 16.1012C81.7441 15.6918 80.9894 15.4872 80.094 15.4872H75.0284C73.519 15.4872 72.1886 15.1801 71.0374 14.5661C69.8861 13.9265 68.9779 13.0567 68.3127 11.9566C67.6731 10.8309 67.3533 9.56453 67.3533 8.15743C67.3533 6.72475 67.6603 5.43277 68.2743 4.28151C68.9139 3.13024 69.7966 2.22202 70.9222 1.55685C72.0735 0.89167 73.3911 0.559082 74.8749 0.559082H86.2724V3.821H75.2203C74.376 3.821 73.6341 4.02567 72.9945 4.43501C72.3549 4.81876 71.8688 5.33044 71.5362 5.97003C71.2037 6.58404 71.0374 7.24921 71.0374 7.96555C71.0374 8.65631 71.1909 9.32149 71.4979 9.96108C71.8305 10.5751 72.3038 11.074 72.9178 11.4577C73.5574 11.8415 74.2865 12.0334 75.1052 12.0334H80.2859C81.8976 12.0334 83.2791 12.3532 84.4304 12.9927C85.5817 13.6323 86.4643 14.5022 87.0783 15.6023C87.6923 16.7024 87.9993 17.956 87.9993 19.3631C87.9993 20.9237 87.6795 22.318 87.0399 23.546C86.4259 24.7484 85.5433 25.695 84.392 26.3858C83.2408 27.0766 81.9232 27.4219 80.4394 27.4219H25.597Z" fill="white"/>
                </svg>
                <button @click="mobileNav = true" class="p-2 text-gray-400 hover:text-white">
                    <i class="fa-solid fa-bars text-base"></i>
                </button>
            </div>

            {{-- Animated Success Toast --}}
            @if(session('success') || session('error'))
                @php
                    $isSuccess = session('success');
                    $msg = session('success') ?? session('error');
                @endphp
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                     class="fixed bottom-6 right-6 z-50 odds-modal-card">
                    <div class="px-4 py-3 rounded-xl border flex items-center space-x-3 shadow-2xl backdrop-blur-md {{ $isSuccess ? 'bg-[#141418]/95 border-[#875af5]/40 text-white' : 'bg-red-950/90 border-red-800 text-red-200' }}">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center {{ $isSuccess ? 'bg-[#875af5] text-white' : 'bg-red-600 text-white' }}">
                            <i class="fa-solid {{ $isSuccess ? 'fa-check' : 'fa-triangle-exclamation' }} text-xs"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs">{{ $isSuccess ? 'Success' : 'Notice' }}</div>
                            <div class="text-xs opacity-90">{{ $msg }}</div>
                        </div>
                        <button @click="show = false" class="text-gray-400 hover:text-white text-xs pl-2">&times;</button>
                    </div>
                </div>
            @endif

            @if(View::hasSection('admin_content'))
                @yield('admin_content')
            @else
                @yield('content')
            @endif
        </div>
    </main>

    @stack('scripts')
</body>
</html>
