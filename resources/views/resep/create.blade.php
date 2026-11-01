<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe - Recipe App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #fdf7f9; 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #3e3238;
        }
        .card-soft-pink {
            background-color: #ffffff;
            border: 1px solid #fce4ec;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(244, 143, 177, 0.08);
        }
        .card-header-pink {
            background: linear-gradient(135deg, #f7a8c4, #f48fb1);
            color: white;
            font-weight: 700;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            padding: 16px 22px;
        }
        .btn-soft-pink {
            background-color: #f06292;
            color: white;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 9px 20px;
            transition: all 0.2s;
        }
        .btn-soft-pink:hover {
            background-color: #e91e63;
            color: white;
        }
        .form-control:focus, .form-select:focus {
            border-color: #f48fb1;
            box-shadow: 0 0 0 0.25rem rgba(244, 143, 177, 0.25);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card card-soft-pink">
                    <div class="card-header card-header-pink">
                        <h5 class="m-0">Add New Recipe Data</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('resep.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Recipe Title</label>
                                <input type="text" name="title" class="form-control" placeholder="e.g. Strawberry Shortcake" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select Category...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Cook Time (Minutes)</label>
                                    <input type="number" name="cook_time_minutes" class="form-control" placeholder="25" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Difficulty</label>
                                    <select name="difficulty" class="form-select">
                                        <option value="easy">Easy</option>
                                        <option value="medium">Medium</option>
                                        <option value="hard">Hard</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Description & Instructions</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Enter ingredients summary or cooking steps..." required></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="/" class="btn btn-light border" style="color: #6c757d;">Back to Dashboard</a>
                                <button type="submit" class="btn btn-soft-pink">Save Recipe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>