<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe - Recipe App</title>
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .card-header-pink {
            background-color: #ff6b9e !important;
            color: white !important;
        }
        .btn-pink {
            background-color: #ff69b4 !important;
            border-color: #ff69b4 !important;
            color: white;
        }
        .btn-pink:hover {
            background-color: #e0559e !important;
            border-color: #e0559e !important;
            color: white;
        }
    </style>
</head>
<body class="bg-gradient-light">
    <div class="container mt-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 card-header-pink">
                <h6 class="m-0 font-weight-bold">Add New Recipe Data</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('resep.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Recipe Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Category ID (Example: 1)</label>
                        <input type="number" name="category_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Cook Time (Minutes)</label>
                        <input type="number" name="cook_time_minutes" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-pink">Save Recipe</button>
                    <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>