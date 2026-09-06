<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Syrian Directory</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(17, 24, 39, 0.75);
            --text-color: #f3f4f6;
            --neon-green: #10b981;
            --neon-glow: rgba(16, 185, 129, 0.4);
            --border-color: rgba(255, 255, 255, 0.08);
            --input-bg: rgba(3, 7, 18, 0.6);
        }

        [data-bs-theme="light"] {
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-color: #1e293b;
            --neon-green: #059669;
            --neon-glow: rgba(5, 150, 105, 0.2);
            --border-color: rgba(0, 0, 0, 0.08);
            --input-bg: #f1f5f9;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            box-shadow: 0 20px 40px var(--neon-glow);
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            border-radius: 12px;
            padding: 12px;
        }

        .form-control:focus {
            background-color: var(--input-bg);
            color: var(--text-color);
            border-color: var(--neon-green);
            box-shadow: 0 0 10px var(--neon-glow);
        }

        .btn-neon {
            background: linear-gradient(45deg, #059669, #10b981);
            border: none;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px var(--neon-glow);
            border-radius: 12px;
            padding: 12px;
        }

        .btn-neon:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
            color: white;
        }

        .theme-toggle {
            position: absolute;
            top: 25px;
            left: 25px;
            z-index: 1000;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--neon-green);
            color: #030712;
            border: none;
            box-shadow: 0 4px 15px var(--neon-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        a {
            color: var(--neon-green);
            text-decoration: none;
        }

        a:hover {
            color: #34d399;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- Floating Dark/Light Mode Toggle Button in Top-Left -->
    <button class="theme-toggle" id="themeToggleBtn" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
        <i class="fa-solid fa-moon" id="themeIcon"></i>
    </button>

    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
        <div class="col-md-5">

            @if ($errors->any())
                <div class="alert alert-danger border-0 bg-danger text-white shadow-sm mb-3 rounded-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="glass-card p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="mb-3 text-success fs-1"><i class="fa-solid fa-user-plus"></i></div>
                    <h3 class="fw-bold">Create Account</h3>
                    <p class="opacity-75 small">Join Syrian Directory today</p>
                </div>

                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" autocomplete="new-password"
                            required>
                    </div>
                    <button type="submit" class="btn btn-neon w-100 mb-3">Register</button>
                </form>

                <div class="text-center mt-3">
                    <span class="opacity-75 small">Already have an account?</span>
                    <a href="{{ url('/login') }}" class="small fw-semibold ms-1">Login here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleTheme() {
            const htmlElement = document.documentElement;
            const themeIcon = document.getElementById('themeIcon');

            if (htmlElement.getAttribute('data-bs-theme') === 'dark') {
                htmlElement.setAttribute('data-bs-theme', 'light');
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            } else {
                htmlElement.setAttribute('data-bs-theme', 'dark');
                themeIcon.classList.replace('fa-sun', 'fa-moon');
            }
        }
    </script>

</body>

</html>
