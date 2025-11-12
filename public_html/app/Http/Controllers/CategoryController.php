<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
        ]);

        // Manejar la carga de archivo
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/categories', $filename); // Guardar en public/categories
            $imageUrl = 'storage/categories/' . $filename;
        }

        // Crear la categoría
        Category::create(array_merge($request->all(), ['image' => $imageUrl]));

        return redirect()->route('categories.index')
                         ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
        ]);

        // Manejar la carga de archivo
        $imageUrl = $category->image; // Mantener la imagen existente
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($category->image) {
                Storage::delete('public/categories/' . basename($category->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/categories', $filename);
            $imageUrl = 'storage/categories/' . $filename;
        }

        // Actualizar la categoría
        $category->update(array_merge($request->all(), ['image' => $imageUrl]));

        return redirect()->route('categories.index')
                         ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Eliminar la imagen si existe
        if ($category->image) {
            Storage::delete('public/categories/' . basename($category->image));
        }

        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }

    public function indexApi()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
}
