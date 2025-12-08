<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPTI - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("{{ asset('storage/assets/bg.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .input-glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-glass:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(99, 179, 237, 0.4);
            box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.1);
        }

        .btn-glow {
            background: linear-gradient(135deg, #38bdf8 0%, #0d9488 100%);
            box-shadow: 0 4px 15px rgba(56, 189, 248, 0.4);
            transition: all 0.3s ease;
        }

        .btn-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(56, 189, 248, 0.6);
        }

        .logo-glow {
            filter: drop-shadow(0 4px 8px rgba(56, 189, 248, 0.3));
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md glass-card rounded-3xl overflow-hidden relative">
        <!-- Decorative Elements -->
        <div
            class="absolute -top-20 -right-20 w-40 h-40 bg-gradient-to-br from-sky-400/20 to-teal-500/20 rounded-full blur-xl">
        </div>
        <div
            class="absolute -bottom-20 -left-20 w-40 h-40 bg-gradient-to-tr from-sky-400/20 to-teal-500/20 rounded-full blur-xl">
        </div>

        <!-- Main Content -->
        <div class="relative z-10 px-10 py-12">
            <!-- Logo -->
            <div class="flex flex-col items-center mb-10">
                <div class="logo-glow mb-6">
                    <img src="{{ asset('storage/assets/LogoIpti.png') }}" alt="IPTI Logo"
                        class="w-28 h-34 drop-shadow-lg">
                </div>
                <p class="text-sky-100/90 text-lg">Welcome Back</p>
                <div class="w-24 h-1 bg-gradient-to-r from-sky-400 to-teal-500 rounded-full mt-3"></div>
            </div>

            <!-- Messages -->
            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-gradient-to-r from-green-500/20 to-emerald-500/20 backdrop-blur-sm border border-green-500/30 rounded-xl text-white text-sm">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-6 p-4 bg-gradient-to-r from-red-500/20 to-pink-500/20 backdrop-blur-sm border border-red-500/30 rounded-xl text-white text-sm">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="mb-6 p-4 bg-gradient-to-r from-red-500/20 to-pink-500/20 backdrop-blur-sm border border-red-500/30 rounded-xl text-white text-sm">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <ul class="mt-1 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <!-- Email Field -->
                    <div class="group">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-envelope text-sky-300 mr-2 text-lg"></i>
                            <label class="text-sky-100 text-sm font-medium">Email Address</label>
                        </div>
                        <div class="relative">
                            <input type="email" name="email" placeholder="you@example.com"
                                value="{{ old('email') }}"
                                class="w-full px-4 pl-12 py-4 input-glass rounded-xl text-white placeholder-sky-200/60 outline-none transition-all duration-300 group-hover:border-sky-300/30"
                                required>
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-user text-sky-300/80"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="group">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-lock text-sky-300 mr-2 text-lg"></i>
                            <label class="text-sky-100 text-sm font-medium">Password</label>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full px-4 pl-12 py-4 input-glass rounded-xl text-white placeholder-sky-200/60 outline-none transition-all duration-300 group-hover:border-sky-300/30"
                                required>
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-key text-sky-300/80"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" class="sr-only">
                                <div class="w-5 h-5 input-glass rounded flex items-center justify-center">
                                    <i class="fas fa-check text-sky-400 opacity-0"></i>
                                </div>
                            </div>
                            <span class="ml-2 text-sky-100/80 text-sm">Remember me</span>
                        </label>
                        <a href="#" class="text-sky-300 hover:text-white text-sm transition-colors">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full btn-glow text-white py-4 rounded-xl font-semibold text-lg mt-8 relative overflow-hidden group">
                        <span class="relative z-10 flex items-center justify-center">
                            <i class="fas fa-sign-in-alt mr-3"></i>
                            Login to Dashboard
                        </span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-sky-500 to-teal-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </button>
                </div>
            </form>


        </div>
    </div>

    <script>
        // Add focus effects
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('border-sky-400/40');
            });

            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('border-sky-400/40');
            });
        });

        // Remember me checkbox
        const checkbox = document.querySelector('input[type="checkbox"]');
        checkbox.addEventListener('change', function() {
            const icon = this.nextElementSibling.querySelector('i');
            if (this.checked) {
                icon.classList.remove('opacity-0');
                icon.classList.add('opacity-100');
            } else {
                icon.classList.add('opacity-0');
                icon.classList.remove('opacity-100');
            }
        });
    </script>
</body>

</html>
