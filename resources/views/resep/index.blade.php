<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Recipe App Admin</title>
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --pink-soft: #f8bbd0;
            --pink-main: #f48fb1;
            --pink-accent: #f06292;
            --pink-dark: #e91e63;
            --pink-bg: #fdf7f9;
            --pink-border: #fce4ec;
            --text-dark: #3e3238;
            --text-muted: #8e7a83;
            --sidebar-width: 235px;
        }

        body {
            background-color: var(--pink-bg);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-dark);
        }

        /* Sidebar Soft Pink */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #f7a8c4 0%, #f48fb1 50%, #ed7a9e 100%);
            color: #ffffff;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(244, 143, 177, 0.15);
        }

        .sidebar-brand {
            padding: 24px 20px;
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: 0.6px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
            text-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .sidebar-menu {
            list-style: none;
            padding: 15px 10px;
            margin: 0;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 11px 18px;
            color: rgba(255, 255, 255, 0.92);
            text-decoration: none;
            font-size: 0.94rem;
            font-weight: 500;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }

        .sidebar-menu li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .sidebar-menu li a.active {
            background-color: rgba(255, 255, 255, 0.28);
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        .sidebar-menu li a i {
            width: 24px;
            font-size: 1.05rem;
            margin-right: 10px;
        }

        /* Main Content Layout */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background-color: #ffffff;
            height: 60px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 40px;
            border-bottom: 1px solid var(--pink-border);
        }

        .top-user {
            font-weight: 600;
            font-size: 0.92rem;
            color: #55444b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .content-body {
            padding: 30px 40px;
            flex: 1;
        }

        .page-title {
            font-size: 1.55rem;
            font-weight: 700;
            color: #3b2c32;
            margin-bottom: 25px;
        }

        /* 4 Cards Statistik Soft Pink Accent */
        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 22px 24px;
            box-shadow: 0 3px 12px rgba(244, 143, 177, 0.06);
            border: 1px solid var(--pink-border);
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
        }

        /* Aksen pastel lembut di sisi kiri tiap card */
        .stat-card.card-pink::before { background-color: #f48fb1; }
        .stat-card.card-teal::before { background-color: #a7f3d0; }
        .stat-card.card-blue::before { background-color: #bae6fd; }
        .stat-card.card-amber::before { background-color: #fde68a; }

        .stat-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 2.1rem;
            font-weight: 700;
            color: #2e2428;
            line-height: 1;
        }

        /* Recent Table Card */
        .card-table {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid var(--pink-border);
            box-shadow: 0 3px 12px rgba(244, 143, 177, 0.06);
            margin-top: 30px;
            padding: 26px;
        }

        .card-table-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #d85d82;
            margin-bottom: 20px;
        }

        .custom-table th {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #8c737c;
            border-bottom: 1px solid var(--pink-border);
            padding: 13px 16px;
            background-color: #fff9fb;
        }

        .custom-table td {
            font-size: 0.92rem;
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #fdf0f4;
            color: #44343a;
        }

        /* Soft Pastel Badges */
        .badge-published {
            background-color: #d1fae5;
            color: #065f46;
            font-size: 0.75rem;
            padding: 5px 12px;
            border-radius: 12px;
            font-weight: 600;
        }

        .badge-draft {
            background-color: #fef3c7;
            color: #92400e;
            font-size: 0.75rem;
            padding: 5px 12px;
            border-radius: 12px;
            font-weight: 600;
        }

        .badge-difficulty {
            background-color: #fce7f3;
            color: #9d174d;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 500;
        }

        /* Tombol Soft Pink */
        .btn-soft-pink {
            background-color: #f06292;
            color: white;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 18px;
            box-shadow: 0 3px 8px rgba(240, 98, 146, 0.25);
            transition: all 0.2s;
        }

        .btn-soft-pink:hover {
            background-color: #e91e63;
            color: white;
            box-shadow: 0 4px 12px rgba(240, 98, 146, 0.35);
        }

        .btn-action-edit {
            background-color: #fdf2f8;
            color: #db2777;
            border: 1px solid #fbcfe8;
            border-radius: 6px;
            font-weight: 500;
        }

        .btn-action-edit:hover {
            background-color: #fbcfe8;
            color: #9d174d;
        }

        .btn-action-delete {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            border-radius: 6px;
            font-weight: 500;
        }

        .btn-action-delete:hover {
            background-color: #fecaca;
            color: #991b1b;
        }

        .footer-text {
            text-align: center;
            font-size: 0.82rem;
            color: #a8949c;
            padding: 24px 0 10px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Soft Pink -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-utensils me-2"></i> RECIPE APP
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="/" class="active">
                    <i class="fa-solid fa-compass"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#categories">
                    <i class="fa-solid fa-layer-group"></i> Categories
                </a>
            </li>
            <li>
                <a href="{{ route('resep.create') }}">
                    <i class="fa-solid fa-bowl-food"></i> Add Recipe
                </a>
            </li>
            <li>
                <a href="#ingredients">
                    <i class="fa-solid fa-seedling"></i> Ingredients
                </a>
            </li>
            <li>
                <a href="#reviews">
                    <i class="fa-regular fa-star"></i> Reviews
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="top-user">
                <i class="fa-solid fa-circle-user fa-lg text-secondary"></i>
                <span>Aisha Nazela</span>
            </div>
        </div>

        <!-- Content Body -->
        <div class="content-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="page-title mb-0">Recipe App Dashboard</h2>
                <a href="{{ route('resep.create') }}" class="btn btn-soft-pink">
                    <i class="fa-solid fa-plus me-1"></i> Add Recipe
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="background-color: #e8f5e9; color: #2e7d32;" role="alert">
                    <i class="fa-solid fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- 4 Cards Statistik Pastel Sesuai Screenshot -->
            <div class="row g-4">
                <!-- Categories -->
                <div class="col-md-3">
                    <div class="stat-card card-pink">
                        <div class="stat-label">Categories</div>
                        <div class="stat-value">{{ $categoriesCount ?? 6 }}</div>
                    </div>
                </div>

                <!-- Recipes -->
                <div class="col-md-3">
                    <div class="stat-card card-teal">
                        <div class="stat-label">Recipes</div>
                        <div class="stat-value">{{ $recipesCount ?? 0 }}</div>
                    </div>
                </div>

                <!-- Ingredients -->
                <div class="col-md-3">
                    <div class="stat-card card-blue">
                        <div class="stat-label">Ingredients</div>
                        <div class="stat-value">{{ $ingredientsCount ?? 10 }}</div>
                    </div>
                </div>

                <!-- Reviews -->
                <div class="col-md-3">
                    <div class="stat-card card-amber">
                        <div class="stat-label">Reviews</div>
                        <div class="stat-value">{{ $reviewsCount ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <!-- Recent Recipes Table -->
            <div class="card-table">
                <div class="card-table-title">Recent Recipes</div>
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Recipe Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Cook Time</th>
                                <th>Difficulty</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRecipes as $recipe)
                            <tr>
                                <td class="fw-bold">{{ $recipe->title }}</td>
                                <td>{{ $recipe->category->name ?? 'Category ' . $recipe->category_id }}</td>
                                <td>{{ $recipe->user->name ?? 'Aisha Nazela' }}</td>
                                <td>{{ $recipe->cook_time_minutes }} Minutes</td>
                                <td>
                                    <span class="badge-difficulty">
                                        {{ ucfirst($recipe->difficulty ?? 'easy') }}
                                    </span>
                                </td>
                                <td>
                                    @if($recipe->is_published)
                                        <span class="badge-published">Published</span>
                                    @else
                                        <span class="badge-draft">Draft</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="/resep/{{ $recipe->id }}/edit" class="btn btn-sm btn-action-edit py-1 px-2 me-1">Edit</a>
                                    <form action="/resep/{{ $recipe->id }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this recipe?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-action-delete py-1 px-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No recipes found. Click "Add Recipe" to create one!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="footer-text">
                Copyright &copy; Recipe App - 2026
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>