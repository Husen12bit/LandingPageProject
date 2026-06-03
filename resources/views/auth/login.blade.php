<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SkillBantuin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', 'Plus Jakarta Sans', sans-serif;
            background: #020617;
            background-image: radial-gradient(circle at 20% 30%, rgba(16, 185, 129, 0.15) 0%, transparent 50%),
                              radial-gradient(circle at 80% 70%, rgba(20, 184, 166, 0.1) 0%, transparent 55%);
        }
        .glass-card {
            background: rgba(15, 25, 45, 0.6);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(20, 184, 166, 0.3);
        }
        .input-glass {
            background: rgba(11, 17, 32, 0.6);
            border: 1px solid rgba(20, 184, 166, 0.4);
            border-radius: 10px;
            padding: 10px 14px;
            color: white;
            width: 100%;
        }
        .input-glass:focus {
            outline: none;
            border-color: #10B981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
        }
        .btn-emerald {
            background: linear-gradient(95deg, #10B981, #059669);
        }
        .btn-emerald:hover {
            box-shadow: 0 0 12px rgba(16, 185, 129, 0.5);
            transform: scale(1.02);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="glass-card rounded-2xl p-8 w-full max-w-md">
        <div class="text-center mb-6">
            <i class="fas fa-handshake text-4xl text-emerald-400"></i>
            <h2 class="text-2xl font-bold mt-2 text-white">SkillBantuin Admin</h2>
            <p class="text-gray-400 text-sm">Masuk ke panel administrasi</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/20 border border-red-400/50 text-red-300 px-4 py-3 rounded-lg mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-gray-300 mb-1">Email</label>
                <input type="email" name="email" class="input-glass" required autofocus>
            </div>
            <div class="mb-6">
                <label class="block text-sm text-gray-300 mb-1">Password</label>
                <input type="password" name="password" class="input-glass" required>
            </div>
            <button type="submit" class="btn-emerald w-full py-2 rounded-lg text-white font-semibold transition">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </button>
        </form>
    </div>
</body>
</html>
