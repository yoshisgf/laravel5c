<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Category;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('resep.index', compact('recipes'));
    }

    public function create()
    {
        return view('resep.create');
    }

    public function store(Request $request)
    { 
        $request->validate([ 
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'cook_time_minutes' => 'required|integer',
            'description' => 'required',
        ]);

        // 1. Pastikan User ID 1 selalu ada
        $user = User::firstOrCreate(
            ['id' => 1],
            ['name' => 'Admin', 'email' => 'admin@recipe.com', 'password' => bcrypt('password')]
        );

        // 2. Cari kategori berdasarkan ID, jika belum ada buat baru dengan mengisi 'name' dan 'slug' yang valid
        $category = Category::find($request->category_id);
        if (!$category) {
            $categoryName = 'Category ' . $request->category_id;
            $category = Category::create([
                'name' => $categoryName,
                'slug' => \Str::slug($categoryName) . '-' . time(),
            ]);
        }

        // 3. Simpan Resep
        Recipe::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => $request->title,
            'slug' => \Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'cook_time_minutes' => $request->cook_time_minutes,
            'prep_time_minutes' => 10,
            'difficulty' => 'easy',
            'is_published' => true,
        ]);

        return redirect('/')->with('success', 'Recipe successfully added!');
    }

    public function edit(Recipe $recipe)
    {
        return view('resep.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    { 
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'cook_time_minutes' => 'required|integer',
            'description' => 'required',
        ]);

        $recipe->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => \Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'cook_time_minutes' => $request->cook_time_minutes,
        ]);

        return redirect('/')->with('success', 'Recipe successfully updated!');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect('/')->with('success', 'Recipe successfully deleted!');
    }

}