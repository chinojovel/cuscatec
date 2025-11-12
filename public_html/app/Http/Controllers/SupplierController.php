<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "edit", "show"]);
    }
    // Mostrar una lista de proveedores
    public function index()
    {
        $suppliers = Supplier::paginate(20);
        return view('suppliers.index', compact('suppliers'));
    }

    // Mostrar el formulario para crear un nuevo proveedor
    public function create()
    {
        return view('suppliers.create');
    }

    // Guardar un nuevo proveedor en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255|unique:suppliers,email',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    // Mostrar un proveedor específico
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    // Mostrar el formulario para editar un proveedor existente
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    // Actualizar un proveedor existente en la base de datos
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255|unique:suppliers,email,' . $supplier->id,
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    
}
