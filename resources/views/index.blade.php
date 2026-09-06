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
            --card-bg: rgba(17, 24, 39, 0.7);
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
        }

        .hero-section {
            background: linear-gradient(135deg, #030712 0%, #0f172a 50%, #111827 100%);
            border-bottom: 2px solid var(--neon-green);
            box-shadow: 0 10px 30px var(--neon-glow);
            padding: 70px 0;
            border-bottom-left-radius: 35px;
            border-bottom-right-radius: 35px;
        }

        .entity-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 18px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .entity-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px var(--neon-glow);
            border-color: var(--neon-green);
        }

        .badge-category {
            background-color: rgba(16, 185, 129, 0.15);
            color: var(--neon-green);
            font-weight: 600;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .btn-neon {
            background: linear-gradient(45deg, #059669, #10b981);
            border: none;
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 15px var(--neon-glow);
            transition: all 0.3s ease;
        }

        .btn-neon:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
            color: #ffffff;
        }

        .theme-toggle {
            position: fixed;
            top: 25px;
            left: 25px;
            z-index: 1000;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: var(--neon-green);
            color: #030712;
            border: none;
            box-shadow: 0 5px 20px var(--neon-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg border-bottom border-secondary border-opacity-25 px-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-landmark text-success me-2"></i> Syrian
                Directory</a>
            <div class="d-flex">
                <a href="{{ url('/login') }}" class="btn btn-outline-success btn-sm px-3 me-2 rounded-pill">Login</a>
                <a href="{{ url('/register') }}" class="btn btn-neon btn-sm px-3 rounded-pill">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-5 fw-bold mb-3">Official Syrian Government & Public Directory</h1>
            <p class="lead opacity-75">Find trusted ministries, universities, and public sector services instantly.</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="container my-4">
        <form action="{{ url('/') }}" method="GET"
            class="row g-3 p-4 glass-card rounded-4 shadow-sm align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-success"><i
                            class="fa-solid fa-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 shadow-none"
                        placeholder="Search ministries, universities, services..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select shadow-none">
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-neon w-100 py-2">Filter</button>
            </div>
        </form>
    </div>

    <!-- Main Cards Grid -->
    <div class="container my-5">
        <div class="row g-4">
            @foreach ($entities as $entity)
                <div class="col-md-4">
                    <div class="card entity-card h-100 p-3">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span
                                    class="badge badge-category px-3 py-2 rounded-pill">{{ $entity->category->name }}</span>
                            </div>
                            <h5 class="card-title fw-bold mt-2">{{ $entity->name }}</h5>
                            <p class="card-text opacity-75 small flex-grow-1">{{ $entity->description }}</p>

                            <ul class="list-unstyled small opacity-80 mb-3">
                                <li><i class="fa-solid fa-location-dot text-danger me-2"></i> {{ $entity->address }}
                                </li>
                                <li><i class="fa-solid fa-phone text-success me-2"></i> Emergency:
                                    {{ $entity->emergency_contact }}</li>
                            </ul>

                            <a href="{{ $entity->official_url }}" target="_blank"
                                class="btn btn-neon w-100 rounded-pill">
                                <i class="fa-solid fa-external-link-alt me-1"></i> Visit Official Portal
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Floating Dark/Light Mode Toggle Button -->
    <button class="theme-toggle" id="themeToggleBtn" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
        <i class="fa-solid fa-moon" id="themeIcon"></i>
    </button>

    <!-- Footer -->
    <footer class="text-center py-4 border-top border-secondary border-opacity-25 opacity-75">
        <p class="mb-0 small">Syrian Directory System &copy; 2026 - All Rights Reserved</p>
    </footer>

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
