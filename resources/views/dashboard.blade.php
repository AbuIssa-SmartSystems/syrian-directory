<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Syrian Directory Control Center</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(17, 24, 39, 0.85);
            --text-color: #f3f4f6;
            --neon-green: #10b981;
            --neon-glow: rgba(16, 185, 129, 0.4);
            --border-color: rgba(255, 255, 255, 0.08);
            --sidebar-width: 280px;
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
            overflow-x: hidden;
        }

        /* Sticky Navbar */
        .navbar-sticky {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-color);
            z-index: 1050;
            padding: 0 20px;
        }

        /* Hidden Sidebar by Default (Triggers on click) */
        .sidebar {
            position: fixed;
            top: 70px;
            left: calc(-1 * var(--sidebar-width));
            width: var(--sidebar-width);
            bottom: 0;
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border-right: 1px solid var(--border-color);
            transition: left 0.3s ease-in-out;
            z-index: 1040;
            overflow-y: auto;
            padding: 20px;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.5);
        }

        .sidebar.active {
            left: 0;
        }

        /* Main Content expands fully when sidebar is hidden */
        .main-content {
            margin-top: 90px;
            padding: 20px;
            margin-left: 0;
            transition: margin-left 0.3s ease-in-out;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--neon-glow);
        }

        .form-control,
        .form-select {
            background-color: rgba(3, 7, 18, 0.6);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            border-radius: 12px;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: rgba(3, 7, 18, 0.8);
            color: var(--text-color);
            border-color: var(--neon-green);
            box-shadow: 0 0 10px var(--neon-glow);
        }

        .btn-neon {
            background: linear-gradient(45deg, #059669, #10b981);
            border: none;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 15px var(--neon-glow);
            transition: all 0.3s ease;
        }

        .btn-neon:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
            color: white;
        }

        .sidebar-menu .accordion-button {
            background: transparent;
            color: var(--text-color);
            box-shadow: none;
            font-size: 0.95rem;
            padding: 10px 15px;
        }

        .sidebar-menu .accordion-button:not(.collapsed) {
            color: var(--neon-green);
            background: rgba(16, 185, 129, 0.1);
        }

        .sidebar-menu .accordion-body {
            padding: 5px 15px 15px 25px;
        }

        .sidebar-menu a.sub-item {
            color: var(--text-color);
            text-decoration: none;
            display: block;
            padding: 6px 0;
            font-size: 0.85rem;
            opacity: 0.8;
            transition: opacity 0.2s, color 0.2s;
            cursor: pointer;
        }

        .sidebar-menu a.sub-item:hover {
            color: var(--neon-green);
            opacity: 1;
        }

        .theme-toggle-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .theme-toggle-btn:hover {
            border-color: var(--neon-green);
            color: var(--neon-green);
        }
    </style>
</head>

<body>

    <!-- 1. Sticky Navbar -->
    <nav class="navbar navbar-sticky d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- Sidebar Toggle Icon Button -->
            <button class="btn btn-outline-success me-3" id="sidebarToggle" onclick="toggleSidebar()"
                title="Toggle Categories Menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <a class="navbar-brand fw-bold text-success m-0" href="{{ url('/dashboard') }}">
                <i class="fa-solid fa-landmark me-2"></i> Syrian Directory <span
                    class="badge bg-success text-dark ms-2 fs-6">Pro</span>
            </a>
        </div>

        <!-- Center Search Bar inside Navbar -->
        <div class="d-none d-md-flex flex-grow-1 mx-4 max-w-50">
            <form action="{{ url('/dashboard') }}" method="GET" class="input-group">
                <input type="text" name="search" class="form-control border-end-0"
                    placeholder="Search official portals..." value="{{ request('search') }}">
                <button class="btn btn-neon px-3" type="submit"><i class="fa-solid fa-search"></i></button>
            </form>
        </div>

        <!-- Right Actions: Suggest Portal, Theme Toggle, User & Logout -->
        <div class="d-flex align-items-center gap-3">
            <a href="{{ url('/submit') }}"
                class="btn btn-outline-success btn-sm rounded-pill px-3 d-none d-sm-inline-block">
                <i class="fa-solid fa-plus me-1"></i> Suggest Portal
            </a>

            <button class="theme-toggle-btn" onclick="toggleTheme()" title="Toggle Theme">
                <i class="fa-solid fa-moon" id="themeIcon"></i>
            </button>

            <div class="dropdown">
                <button
                    class="btn btn-secondary dropdown-toggle btn-sm rounded-pill px-3 bg-transparent border-secondary"
                    style="color: var(--text-color);" type="button" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-user-shield text-success me-1"></i> {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end glass-card border-secondary mt-2">
                    <li><a class="dropdown-item text-light small" href="{{ url('/admin/submissions') }}"><i
                                class="fa-solid fa-clipboard-list me-2 text-warning"></i> Approval Queue</a></li>
                    <li>
                        <hr class="dropdown-divider border-secondary">
                    </li>
                    <li>
                        <form action="{{ url('/logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger small"><i
                                    class="fa-solid fa-power-off me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 2. Hidden Sidebar Navigation (Appears on click) -->
    <div class="sidebar sidebar-menu" id="appSidebar">
        <div class="mb-4 pt-2">
            <label class="form-label small fw-bold text-uppercase opacity-75 mb-2"><i
                    class="fa-solid fa-map-location-dot text-success me-1"></i> Select Governorate</label>
            <select id="governorateFilter" class="form-select bg-dark text-white border-secondary"
                onchange="filterEntities()">
                <option value="" selected>All Governorates</option>
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

        <hr class="border-secondary opacity-25 mb-3">

        <!-- Categories Accordion -->
        <div class="accordion accordion-flush" id="categoriesAccordion">

            <!-- Governmental Section -->
            <div class="accordion-item bg-transparent border-0 mb-2">
                <h2 class="accordion-header" id="headingGov">
                    <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseGov">
                        <i class="fa-solid fa-building-columns text-success me-2"></i> Governmental
                    </button>
                </h2>
                <div id="collapseGov" class="accordion-collapse collapse" data-bs-parent="#categoriesAccordion">
                    <div class="accordion-body">
                        <a onclick="filterByCategory('Ministries')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-success"></i> Ministries </a>
                        <a onclick="filterByCategory('Institutions')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-success"></i> Institutions </a>
                        <a onclick="filterByCategory('Directorates')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-success"></i> Directorates </a>
                        <a onclick="filterByCategory('Courts')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-success"></i> Courts </a>
                        <a onclick="filterByCategory('Hospitals')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-success"></i> Hospitals </a>
                        <a onclick="filterByCategory('Schools')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-success"></i> Schools </a>
                    </div>
                </div>
            </div>

            <!-- Non-Governmental Section -->
            <div class="accordion-item bg-transparent border-0">
                <h2 class="accordion-header" id="headingNonGov">
                    <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseNonGov">
                        <i class="fa-solid fa-city text-info me-2"></i> Non-Governmental
                    </button>
                </h2>
                <div id="collapseNonGov" class="accordion-collapse collapse" data-bs-parent="#categoriesAccordion">
                    <div class="accordion-body">
                        <a onclick="filterByCategory('Workshops & Crafts')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-info"></i> Workshops & Crafts </a>
                        <a onclick="filterByCategory('Companies')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-info"></i> Companies </a>
                        <a onclick="filterByCategory('Factories')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-info"></i> Factories </a>
                        <a onclick="filterByCategory('Private Hospitals')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-info"></i> Private Hospitals </a>
                        <a onclick="filterByCategory('Malls & Markets')" class="sub-item"><i
                                class="fa-solid fa-angle-right me-1 text-info"></i> Malls & Markets </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- 3. Main Content Area -->
    <div class="main-content">
        <div class="container-fluid">

            <!-- Welcome Banner with Custom Description -->
            <div class="glass-card p-4 p-md-5 mb-4 position-relative overflow-hidden">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span
                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill mb-3">
                            <i class="fa-solid fa-circle-check me-1"></i> Syrian Directory Official Hub
                        </span>
                        <h1 class="fw-bold display-6 mb-2">Welcome Back</h1>
                        <p class="opacity-75 mb-4">
                            <strong>Syrian Directory</strong> is your comprehensive digital gateway to access and
                            explore official Syrian governmental ministries, universities, public directorates, as well
                            as private sector entities, institutions, and traditional crafts across all governorates
                            with maximum speed and precision.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="{{ url('/admin/submissions') }}" class="btn btn-neon px-4 py-2 rounded-pill">
                                <i class="fa-solid fa-clipboard-list me-2"></i> Review Submissions
                            </a>
                            <a href="{{ url('/submit') }}" class="btn px-4 py-2 rounded-pill"
                                style="border: 1px solid var(--border-color); color: var(--text-color);">
                                <i class="fa-solid fa-plus me-2 text-success"></i> Suggest Portal
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center d-none d-lg-block">
                        <div class="fs-1 text-success opacity-50 display-1">
                            <i class="fa-solid fa-network-wired"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Directory Entities Cards (Abu Issa's Custom Cards) -->
            <!-- Grid container for all cards -->
            <div class="row g-4" id="entitiesGrid">
                @forelse($entities as $entity)
                    <div class="col-md-4 entity-card" data-governorate="{{ $entity->governorate }}"
                        data-category="{{ $entity->category_name }}">
                        <div class="glass-card p-4 d-flex flex-column justify-content-between h-100">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span
                                        class="badge bg-success bg-opacity-10 text-success">{{ $entity->category_name }}</span>
                                    <small class="text-muted"><i class="fa-solid fa-map-pin me-1"></i>
                                        {{ $entity->governorate }}</small>
                                </div>
                                <h5 class="fw-bold mb-2">{{ $entity->entity_name }}</h5>
                                <p class="small opacity-75 mb-3">{{ $entity->description }}</p>
                            </div>

                            <div>
                                <!-- زر Visit Portal يأخذ كل كرت إلى رابطه الحقيقي الخاص به حصراً -->
                                <a href="{{ $entity->official_url }}" target="_blank"
                                    class="btn btn-outline-success btn-sm rounded-pill w-100 mb-2">
                                    Visit Portal <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>

                                <!-- Rating Section inside the card -->
                                <div
                                    class="pt-2 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
                                    <span class="small text-muted">
                                        Rating: <strong
                                            class="text-warning">{{ number_format($entity->averageRating(), 1) }}</strong>
                                        <small>({{ $entity->ratings()->count() }})</small>
                                    </span>

                                    <form action="{{ route('entities.rate', $entity->id) }}" method="POST"
                                        class="d-flex align-items-center gap-1">
                                        @csrf
                                        <div class="star-rating d-flex gap-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <button type="submit" name="rating" value="{{ $i }}"
                                                    class="btn btn-link p-0 text-warning text-decoration-none"
                                                    title="Rate {{ $i }} Stars">
                                                    <i class="fa-solid fa-star small"></i>
                                                </button>
                                            @endfor
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No entities found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar visibility on icon click
        function toggleSidebar() {
            document.getElementById('appSidebar').classList.toggle('active');
        }

        // Toggle Dark/Light Theme
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

        // Filtering logic for Sidebar selections
        function filterEntities() {
            const selectedGov = document.getElementById('governorateFilter').value.toLowerCase();
            const cards = document.querySelectorAll('.entity-card');

            cards.forEach(card => {
                const cardGov = card.getAttribute('data-governorate').toLowerCase();
                if (!selectedGov || cardGov === selectedGov) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function filterByCategory(categoryName) {
            const cards = document.querySelectorAll('.entity-card');
            cards.forEach(card => {
                const cardCat = card.getAttribute('data-category');
                if (cardCat === categoryName) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            // Close sidebar on mobile after click for better UX
            if (window.innerWidth < 992) {
                toggleSidebar();
            }
        }
    </script>

</body>

</html>
