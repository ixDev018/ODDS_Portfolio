<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/ODDS_logo.svg') }}">
    <link rel="alternate icon" href="{{ asset('assets/img/ODDS_logo.svg') }}">
    <title>ODDS Studio | Admin Login</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0b0b0e;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            color: #e2e2e8;
        }

        /* Ambient Glow Orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            z-index: 0;
        }
        .orb-1 {
            width: 420px; height: 420px;
            background: rgba(135, 90, 245, 0.15);
            top: -100px; right: -80px;
        }
        .orb-2 {
            width: 340px; height: 340px;
            background: rgba(243, 89, 176, 0.12);
            bottom: -60px; left: -60px;
        }

        /* Card */
        .login-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 400px;
            background: #141418;
            border: 1px solid #22222a;
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        }

        .odds-input {
            width: 100%;
            background: #0b0b0e;
            border: 1px solid #22222a;
            border-radius: 0.6rem;
            padding: 0.7rem 1rem;
            color: #ffffff; font-size: 0.875rem;
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s;
        }
        .odds-input:focus {
            border-color: #875af5;
            box-shadow: 0 0 0 2px rgba(135, 90, 245, 0.25);
            background: #101014;
        }

        .btn-signin {
            width: 100%;
            padding: 0.75rem;
            background: #875af5;
            color: #fff; border: none;
            border-radius: 100px;
            font-size: 0.875rem; font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(135, 90, 245, 0.35);
            transition: all 0.18s;
            letter-spacing: 0.02em;
        }
        .btn-signin:hover {
            background: #966bf7;
            box-shadow: 0 6px 24px rgba(135, 90, 245, 0.5);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="login-card">
        <!-- Logo Header -->
        <div class="flex flex-col items-center mb-6">
            <svg width="88" height="28" viewBox="0 0 88 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-auto mb-2 text-white">
                <path d="M11.3567 12.2224C11.376 12.4818 11.5355 12.7099 11.7726 12.817L19.6574 16.378C20.1484 16.5998 20.6978 16.2154 20.6579 15.6782L20.2762 10.5463C20.2569 10.287 20.0974 10.0589 19.8603 9.95181L11.9755 6.39075C11.4845 6.169 10.9351 6.55335 10.975 7.09063L11.3567 12.2224Z" fill="white"/>
                <path d="M10.8914 13.253C11.0988 13.096 11.3754 13.0649 11.6124 13.172L19.4972 16.733C19.9882 16.9548 20.0631 17.6211 19.6336 17.9463L15.5312 21.053C15.3239 21.21 15.0472 21.2411 14.8102 21.1341L6.92539 17.573C6.43438 17.3512 6.35946 16.6849 6.78897 16.3597L10.8914 13.253Z" fill="white"/>
                <path d="M27.9087 13.9543C27.9087 21.6611 21.6611 27.9087 13.9543 27.9087C6.24757 27.9087 0 21.6611 0 13.9543C0 6.24757 6.24757 0 13.9543 0C21.6611 0 27.9087 6.24757 27.9087 13.9543ZM2.99795 13.9543C2.99795 20.0054 7.90329 24.9107 13.9543 24.9107C20.0054 24.9107 24.9107 20.0054 24.9107 13.9543C24.9107 7.90329 20.0054 2.99795 13.9543 2.99795C7.90329 2.99795 2.99795 7.90329 2.99795 13.9543Z" fill="white"/>
                <path d="M24.9844 27.4219V0.559082H33.5805C36.4459 0.559082 38.9147 1.13471 40.987 2.28598C43.0848 3.43725 44.7094 5.02343 45.8606 7.04454C47.0119 9.06565 47.5875 11.381 47.5875 13.9905C47.5875 16.6 47.0119 18.9154 45.8606 20.9365C44.7094 22.9576 43.0848 24.5438 40.987 25.695C38.9147 26.8463 36.4459 27.4219 33.5805 27.4219H24.9844ZM28.6684 24.16H33.6189C35.6144 24.16 37.3797 23.7507 38.9147 22.932C40.4753 22.1133 41.7033 20.9493 42.5987 19.4398C43.4942 17.9048 43.9419 16.0884 43.9419 13.9905C43.9419 11.8671 43.4942 10.0506 42.5987 8.54119C41.7033 7.03175 40.4753 5.86769 38.9147 5.04902C37.3797 4.23034 35.6144 3.821 33.6189 3.821H28.6684V24.16Z" fill="white"/>
                <path d="M46.7445 27.4219V0.559082H55.3406C58.206 0.559082 60.6748 1.13471 62.7471 2.28598C64.8449 3.43725 66.4695 5.02343 67.6207 7.04454C68.772 9.06565 69.3476 11.381 69.3476 13.9905C69.3476 16.6 68.772 18.9154 67.6207 20.9365C66.4695 22.9576 64.8449 24.5438 62.7471 25.695C60.6748 26.8463 58.206 27.4219 55.3406 27.4219H46.7445ZM50.4285 24.16H55.379C57.3745 24.16 59.1398 23.7507 60.6748 22.932C62.2354 22.1133 63.4634 20.9493 64.3588 19.4398C65.2543 17.9048 65.702 16.0884 65.702 13.9905C65.702 11.8671 65.2543 10.0506 64.3588 8.54119C63.4634 7.03175 62.2354 5.86769 60.6748 5.04902C59.1398 4.23034 57.3745 3.821 55.379 3.821H50.4285V24.16Z" fill="white"/>
                <path d="M25.597 27.4219V24.16H80.0172C80.9127 24.16 81.6802 23.9553 82.3198 23.546C82.9594 23.1111 83.4582 22.561 83.8164 21.8959C84.1746 21.2307 84.3537 20.5271 84.3537 19.7852C84.3537 19.0177 84.1746 18.3141 83.8164 17.6746C83.4838 17.0094 82.9977 16.4849 82.3581 16.1012C81.7441 15.6918 80.9894 15.4872 80.094 15.4872H75.0284C73.519 15.4872 72.1886 15.1801 71.0374 14.5661C69.8861 13.9265 68.9779 13.0567 68.3127 11.9566C67.6731 10.8309 67.3533 9.56453 67.3533 8.15743C67.3533 6.72475 67.6603 5.43277 68.2743 4.28151C68.9139 3.13024 69.7966 2.22202 70.9222 1.55685C72.0735 0.89167 73.3911 0.559082 74.8749 0.559082H86.2724V3.821H75.2203C74.376 3.821 73.6341 4.02567 72.9945 4.43501C72.3549 4.81876 71.8688 5.33044 71.5362 5.97003C71.2037 6.58404 71.0374 7.24921 71.0374 7.96555C71.0374 8.65631 71.1909 9.32149 71.4979 9.96108C71.8305 10.5751 72.3038 11.074 72.9178 11.4577C73.5574 11.8415 74.2865 12.0334 75.1052 12.0334H80.2859C81.8976 12.0334 83.2791 12.3532 84.4304 12.9927C85.5817 13.6323 86.4643 14.5022 87.0783 15.6023C87.6923 16.7024 87.9993 17.956 87.9993 19.3631C87.9993 20.9237 87.6795 22.318 87.0399 23.546C86.4259 24.7484 85.5433 25.695 84.392 26.3858C83.2408 27.0766 81.9232 27.4219 80.4394 27.4219H25.597Z" fill="white"/>
            </svg>
            <span class="text-[10px] font-mono text-gray-500 uppercase tracking-widest font-bold">Studio CMS Authentication</span>
        </div>

        <!-- Form -->
        <form action="{{ route('odds.admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            @error('auth')
                <div class="p-3 bg-red-950/60 border border-red-800 rounded-xl text-red-300 text-xs font-semibold text-center">
                    {{ $message }}
                </div>
            @enderror

            <div>
                <label class="block font-mono text-[10px] uppercase tracking-wider text-gray-400 mb-1.5 font-bold">Username</label>
                <input type="text" name="username" required autofocus autocomplete="username"
                       placeholder="admin" class="odds-input">
                @error('username')
                    <p class="text-[10px] text-red-400 font-mono mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-mono text-[10px] uppercase tracking-wider text-gray-400 mb-1.5 font-bold">Password</label>
                <input type="password" name="password" required autocomplete="current-password"
                       placeholder="••••••••" class="odds-input">
                @error('password')
                    <p class="text-[10px] text-red-400 font-mono mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-signin">
                    Authenticate &rarr;
                </button>
            </div>
        </form>

        <div class="mt-6 pt-4 border-t border-[#22222a] text-center">
            <a href="{{ route('portfolio.index') }}" class="font-mono text-[10px] uppercase tracking-wider text-gray-500 hover:text-[#875af5] transition-colors">
                &larr; Return to Front Page
            </a>
        </div>
    </div>

</body>
</html>
