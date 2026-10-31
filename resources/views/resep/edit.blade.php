<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-pink {
            background-color: #f8b4d9 !important;
            color: #5a5c69 !important;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-pink font-weight-bold">
                        <h3>Edit Recipe</h3>
                    </div>
                    <div class="card-body">
                        <form action="/resep/{{ $recipe->id }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Recipe Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $recipe->title }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category ID</label>
                                <input type="number" name="category_id" class="form-control" value="{{ $recipe->category_id }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Cook Time (Minutes)</label>
                                <input type="number" name="cook_time_minutes" class="form-control" value="{{ $recipe->cook_time_minutes }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" value="{{ $recipe->description }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary" style="background-color: #e83e8c; border-color: #e83e8c;">Update Recipe</button>
                            <a href="/" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>