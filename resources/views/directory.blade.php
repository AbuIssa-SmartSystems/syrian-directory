<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syrian Directory - Official Portals</title>
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
        }

        [data-bs-theme="light"] {
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-color: #1e293b;
            --neon-green: #059669;
            --neon-glow: rgba(5, 150, 105, 0.2);
            --border-color: rgba(0, 0, 0, 0.08);
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
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--neon-glow);
            transition: transform 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
        }

        .theme-toggle {
            position: fixed;
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
        }
    </style>
</head>

<body>

    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle Theme">
        <i class="fa-solid fa-moon" id="themeIcon"></i>
    </button>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-success mb-2"><i class="fa-solid fa-network-wired me-2"></i>Syrian Directory</h1>
            <p class="opacity-75">Verified Government and Public Service Portals</p>
            <div class="mt-3">
                <a href="{{ url('/submit') }}" class="btn btn-success rounded-pill px-4 me-2"><i
                        class="fa-solid fa-plus me-1"></i> Suggest Portal</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-light rounded-pill px-4">Dashboard</a>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-outline-light rounded-pill px-4">Login</a>
                @endauth
            </div>
        </div>

        <div class="row g-4">
            @forelse($entities as $entity)
                <div class="col-md-4">
                    <div class="glass-card p-4 h-d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span
                                    class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill">{{ $entity->category_name }}</span>
                                <span class="small text-muted"><i
                                        class="fa-solid fa-location-dot me-1 text-danger"></i>{{ $entity->governorate }}</span>
                            </div>
                            <h4 class="fw-bold mb-2">{{ $entity->entity_name }}</h4>
                            <p class="opacity-75 small mb-3">{{ $entity->description ?? 'No description provided.' }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ $entity->official_url }}" target="_blank"
                                class="btn btn-outline-success w-100 rounded-pill"><i
                                    class="fa-solid fa-external-link-alt me-1"></i> Visit Official Portal</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="opacity-50 fs-4"><i class="fa-solid fa-folder-open mb-2"></i></div>
                    <p class="opacity-75">No approved portals available in the directory yet. Be the first to suggest
                        one!</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('themeIcon');
            if (html.getAttribute('data-bs-theme') === 'dark') {
                html.setAttribute('data-bs-theme', 'light');
                icon.classList.replace('fa-moon', 'fa-sun');
            } else {
                html.setAttribute('data-bs-theme', 'dark');
                icon.classList.replace('fa-sun', 'fa-moon');
            }
        }
    </script>
</body>

</html>
