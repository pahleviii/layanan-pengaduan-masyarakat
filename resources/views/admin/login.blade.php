<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login Administrator - Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        body { font-family: "Public Sans", sans-serif; }
        .login-bg {
            background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 30%, #f6f7f8 55%, #dbeafe 80%, #bfdbfe 100%);
        }
        .wave {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.5;
            pointer-events: none;
        }
    </style>
</head>
<body class="relative flex h-screen w-full flex-col overflow-hidden login-bg text-slate-900 font-display">
<div class="absolute inset-0 z-0 overflow-hidden">
    <div class="wave w-[600px] h-[600px] bg-blue-300 -top-40 -left-40"></div>
    <div class="wave w-[500px] h-[500px] bg-sky-200 top-1/3 -right-32"></div>
    <div class="wave w-[400px] h-[400px] bg-blue-200 bottom-0 left-1/3"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-slate-200/50"></div>
</div>
<div class="relative z-10 flex h-full w-full items-center justify-center p-4">
    <div class="w-full max-w-[480px] flex flex-col items-center">
        <div class="w-full rounded-xl bg-white shadow-2xl overflow-hidden border border-slate-200">
            <div class="p-8 sm:p-10 flex flex-col gap-6">
                <div class="flex flex-col items-center gap-2">
                    <div class="flex items-center justify-center w-14 h-14 rounded-full bg-primary/10 text-primary mb-2">
                        <span class="material-symbols-outlined text-[32px]">admin_panel_settings</span>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-900 text-center">Login Administrator</h1>
                    <p class="text-slate-500 text-sm text-center">Sistem Pengaduan Masyarakat</p>
                </div>
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form action="{{ route('admin.login.store') }}" method="POST" class="flex flex-col gap-5 w-full">
                    @csrf
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-slate-900" for="email">Email</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-slate-400 text-[20px]">mail</span>
                            <input id="email" name="email" value="{{ old('email') }}" class="w-full pl-11 pr-4 py-3 rounded-lg border border-slate-300 bg-slate-50 text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-colors" placeholder="admin@example.com" type="email" required/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-slate-900" for="password">Password</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-slate-400 text-[20px]">lock</span>
                            <input id="password" name="password" class="w-full pl-11 pr-11 py-3 rounded-lg border border-slate-300 bg-slate-50 text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-colors" placeholder="••••••••" type="password" required/>
                            <button class="absolute right-3 p-1 text-slate-400 hover:text-slate-600 transition-colors" type="button" onclick="const i=document.getElementById('password'); i.type = i.type==='password' ? 'text' : 'password';">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input name="remember" type="checkbox" value="1" class="h-5 w-5 rounded border-slate-300 bg-slate-50 text-primary focus:ring-primary focus:ring-offset-0 transition-all checked:bg-primary checked:border-primary"/>
                            <span class="text-sm font-normal text-slate-600 group-hover:text-slate-900 transition-colors">Ingat Saya</span>
                        </label>
                    </div>
                    <button type="submit" class="mt-2 w-full bg-primary hover:bg-blue-600 text-white font-semibold py-3.5 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                        <span>Masuk</span>
                        <span class="material-symbols-outlined text-[20px]">login</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="mt-8 text-center">
            <p class="text-sm text-slate-500 font-medium">Sistem Pengaduan Masyarakat © 2025</p>
        </div>
    </div>
</div>
</body>
</html>
