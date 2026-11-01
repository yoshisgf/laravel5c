<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Review;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function index()
    {
        // 1. Data counts untuk 4 Card Statistik di atas
        $categoriesCount  = Category::count();
        $recipesCount     = Recipe::count();
        $ingredientsCount = Ingredient::count();
        $reviewsCount     = Review::count();

        // 2. Data recent recipes beserta relasi category dan author
        $recentRecipes = Recipe::with(['category', 'user'])
                                ->latest()
                                ->take(5)
                                ->get();

        // 3. Semua resep untuk tabel lengkap
        $recipes = Recipe::with(['category', 'user'])->latest()->get();

        return view('resep.index', compact(
            'categoriesCount',
            'recipesCount',
            'ingredientsCount',
            'reviewsCount',
            'recentRecipes',
            'recipes'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        return view('resep.create', compact('categories'));
    }

    public function store(Request $request)
    { 
        $request->validate([ 
            'title'             => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'cook_time_minutes' => 'required|integer',
            'prep_time_minutes' => 'nullable|integer',
            'difficulty'        => 'required|in:easy,medium,hard',
            'description'       => 'required',
        ]);

        // Pastikan user admin default selalu ada
        $user = User::firstOrCreate(
            ['email' => 'nazelaisha@gmail.com'],
            ['name' => 'Aisha Nazela', 'password' => bcrypt('password')]
        );

        Recipe::create([
            'user_id'           => $user->id,
            'category_id'       => $request->category_id,
            'title'             => $request->title,
            'slug'              => Str::slug($request->title) . '-' . time(),
            'description'       => $request->description,
            'prep_time_minutes' => $request->prep_time_minutes ?? 10,
            'cook_time_minutes' => $request->cook_time_minutes,
            'difficulty'        => $request->difficulty,
            'is_published'      => true,
        ]);

        return redirect('/')->with('success', 'Recipe successfully added!');
    }

    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        return view('resep.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe)
    { 
        $request->validate([
            'title'             => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'cook_time_minutes' => 'required|integer',
            'description'       => 'required',
        ]);

        $recipe->update([
            'category_id'       => $request->category_id,
            'title'             => $request->title,
            'slug'              => Str::slug($request->title) . '-' . $recipe->id,
            'description'       => $request->description,
            'cook_time_minutes' => $request->cook_time_minutes,
            'difficulty'        => $request->difficulty ?? $recipe->difficulty,
        ]);

        return redirect('/')->with('success', 'Recipe successfully updated!');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect('/')->with('success', 'Recipe successfully deleted!');
    }
}