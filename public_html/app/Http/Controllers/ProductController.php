<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\State;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct()
    {
        // Protegemos las nuevas rutas también
        $this->middleware('auth')->only(["index", "create", "edit", "show", "massDestroy", "restore", "massRestore", "forceDelete"]);
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $status = $request->input('status'); // Para filtrar por activos o borrados

        // Empezamos la consulta
        $query = Product::query();

        // 1. Aplicamos el filtro de estado (borrados o no)
        if ($status === 'trashed') {
            $query->onlyTrashed(); // Solo muestra los que tienen SoftDelete
        }

        // Cargamos relaciones
        $query->with(['category', 'productStocks']);

        // 2. Aplicamos la búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        $products = $query->paginate($perPage);

        // Pasamos el status a la vista para la lógica condicional
        return view('products.index', compact('products', 'perPage', 'status'));
    }


    // ... (create, store, show, edit, update no cambian)
    public function create()
    {
        $categories = Category::all(); // Obtén todas las categorías para el dropdown
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|file|image|max:2048', // max 2MB file size
            'category_id' => 'required|exists:categories,id', // Validación de categoría
        ]);

        // Handle file upload
        $imageUrl = null;
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/products', $filename);
            $imageUrl = 'storage/products/' . $filename;
        }

        $product = Product::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'image_url'     => $imageUrl,
            'category_id'   => $request->category_id, // Guardar category_id
            'created_by'    => Auth::id(),
            'modified_by'   => Auth::id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all(); // Obtén todas las categorías para el dropdown
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|file|image|max:2048', // max 2MB file size
            'category_id' => 'required|exists:categories,id', // Validación de categoría
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id, // Actualizar category_id
            'modified_by' => Auth::id(),
        ]);

        $imageUrl = null;
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/products', $filename);
            $imageUrl = 'storage/products/' . $filename;
        }

        if (isset($imageUrl)) {
            $product->update([
                'image_url'     => $imageUrl,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }



    public function destroy(Product $product)
    {
        $product->delete(); // Esto ahora es un SoftDelete
        return redirect()->route('products.index')->with('success', 'Product moved to trash.');
    }

    public function massDestroy(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $productIds = $request->input('product_ids');
        Product::whereIn('id', $productIds)->delete(); // SoftDelete masivo

        return redirect()->route('products.index')->with('success', 'Selected products have been moved to trash.');
    }

    /**
     * Restaura un producto borrado.
     * @param int $id
     */
    public function restore($id)
    {
        // Usamos onlyTrashed() para encontrar el producto entre los borrados
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('products.index', ['status' => 'trashed'])->with('success', 'Product has been restored.');
    }

    /**
     * Restaura masivamente productos borrados.
     */
    public function massRestore(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $productIds = $request->input('product_ids');
        Product::onlyTrashed()->whereIn('id', $productIds)->restore();

        return redirect()->route('products.index')->with('success', 'Selected products have been restored.');
    }

    /**
     * Borra permanentemente un producto.
     * @param int $id
     */
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        // Aquí podrías añadir lógica para borrar archivos asociados si es necesario
        $product->forceDelete();

        return redirect()->route('products.index', ['status' => 'trashed'])->with('success', 'Product has been permanently deleted.');
    }


    public function getProductsByState($stateId)
    {
        // Find the state by its abbreviation
        $state = State::where('abbreviation', $stateId)->first();

        if (!$state) {
            return response()->json(['error' => 'State not found'], 404);
        }

        // Fetch products with their prices and category for the given state
        $products = Product::with(['prices' => function ($query) use ($state) {
            $query->where('state_id', $state->id);
        }, 'category'])->get();

        // Filter products to only include those with a price
        $response = $products->filter(function ($product) {
            return $product->prices->isNotEmpty();
        })->map(function ($product) {
            $price = $product->prices->first();
            return [
                'id' => $product->id,
                'image' => $product->image_url,
                'title' => $product->name,
                'description' => $product->description,
                'price' => $price ? (float) number_format((float)$price->price, 2, '.', '') : null,
                'category' => $product->category ? $product->category->name : null, // Include category name
            ];
        });

        return response()->json($response);
    }
}
