<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Portal - Syrian Directory</title>
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

        .form-control,
        .form-select {
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            border-radius: 12px;
            padding: 12px;
        }

        .form-control:focus,
        .form-select:focus {
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
    </style>
</head>

<body>

    <!-- Floating Dark/Light Mode Toggle Button in Top-Left -->
    <button class="theme-toggle" id="themeToggleBtn" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
        <i class="fa-solid fa-moon" id="themeIcon"></i>
    </button>

    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
        <div class="col-md-6">

            @if (session('success'))
                <div class="alert alert-success border-0 bg-success text-white shadow-sm mb-3 rounded-4">
                    {{ session('success') }}</div>
            @endif

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
                    <div class="mb-2 text-success fs-1"><i class="fa-solid fa-circle-plus"></i></div>
                    <h3 class="fw-bold">Suggest a New Portal</h3>
                    <p class="opacity-75 small">Submit a government or public service site for review</p>
                </div>

                <form action="{{ url('/submit') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Entity Name</label>
                        <input type="text" name="entity_name" class="form-control"
                            placeholder="e.g., Ministry of Education" autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Official URL (.gov.sy or .sy)</label>
                        <input type="url" name="official_url" class="form-control"
                            placeholder="https://example.gov.sy" autocomplete="off" required>
                    </div>

                    <!-- Fixed Category Type Select Menu -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Category Type</label>
                        <select name="category_name" class="form-select" required>
                            <option value="" selected disabled>Select Category Type</option>
                            <option value="Ministries">Ministries</option>
                            <option value="Universities">Universities</option>
                            <option value="Public Services">Public Services</option>
                            <option value="Municipalities">Municipalities</option>
                            <option value="Courts">Courts</option>
                            <option value="Schools">Schools</option>
                        </select>
                    </div>

                    <!-- Fixed Governorate Select Menu -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Governorate</label>
                        <select name="governorate" class="form-select" required>
                            <option value="" selected disabled>Select Governorate</option>
                            <option value="Damascus">Damascus</option>
                            <option value="Aleppo">Aleppo</option>
                            <option value="Homs">Homs</option>
                            <option value="Latakia">Latakia</option>
                            <option value="Hama">Hama</option>
                            <option value="Tartus">Tartus</option>
                            <option value="Daraa">Daraa</option>
                            <option value="Deir ez-Zor">Deir ez-Zor</option>
                            <option value="Raqqa">Raqqa</option>
                            <option value="Hasakah">Hasakah</option>
                            <option value="Quneitra">Quneitra</option>
                            <option value="Sweida">Sweida</option>
                            <option value="Idlib">Idlib</option>
                            <option value="Rural Damascus">Rural Damascus</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Brief details about services..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-neon w-100 mb-3">Submit for Review</button>
                </form>

                <div class="text-center mt-2">
                    <a href="{{ url('/dashboard') }}" class="small text-success text-decoration-none"><i
                            class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard</a>
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