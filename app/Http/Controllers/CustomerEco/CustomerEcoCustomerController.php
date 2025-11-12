<?php

namespace App\Http\Controllers\CustomerEco;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use App\Models\Customer;
use App\Models\User;
use App\Models\State; // Importa el modelo State
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerEcoCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "edit", "show"]);
    }

    public function index(Request $request)
    {
        $query = Customer::with(['user', 'state']); // Relación con 'user' y 'state'

        if ($request->has('search') && $request->input('search') !== '' && $request->input('search') != null) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', '%' . $search . '%'); // Filtro por nombre
        }

        if ($request->has('state') && $request->input('state') !== '' && $request->input('state') != null) {
            $stateId = $request->input('state');
            $query->where('state_id', $stateId); // Filtro por estado
        }

        $customers = $query->paginate(10); // Paginación
        $states = State::all(); // Obtener todos los estados para el select
        return view('customers_ecommerce.customers.index', compact('customers', 'states'));
    }

    public function show($id)
    {
        // Carga la relación 'state' para el cliente especificado
        $customer = Customer::with(['user', 'state'])->find($id);
        $states = State::all();
        if (is_null($customer)) {
            return redirect()->route('customer.ecommerce.customers.index')->with('error', 'Customer not found');
        }

        return view('customers_ecommerce.customers.show', compact('customer', 'states'));
    }

    public function create()
    {
        // Obtiene todos los estados para llenar un desplegable en la vista
        $states = State::all();
        return view('customers_ecommerce.customers.create', compact('states'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string|max:255',
            'phone'      => 'nullable|string|max:255',
            'address'    => 'nullable|string|max:255',
            'state_id'   => 'required|exists:states,id', // Valida que el state_id exista en la tabla states
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Incluye 'state_id' al crear el cliente
        $customer = Customer::create($request->only('name', 'phone', 'address', 'state_id'));

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'customer_id'  => $customer->id,
        ]);
        // Enviar correo de notificación al usuario
        Mail::to($user->email)->send(new AccountCreated($user->name, $user->email, $request->password, 0));


        return redirect()->route('customer.ecommerce.customers.index')->with('success', 'Customer created successfully');
    }

    public function edit($id)
    {
        $customer = Customer::with(['user', 'state'])->find($id);

        if (is_null($customer)) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        // Obtiene todos los estados para llenar un desplegable en la vista
        $states = State::all();
        return view('customers_ecommerce.customers.edit', compact('customer', 'states'));
    }

    
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
    
        if (is_null($customer)) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }
    
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string|max:255',
            'phone'      => 'nullable|string|max:255',
            'address'    => 'nullable|string|max:255',
            'state_id'   => 'required|exists:states,id', // Valida que el state_id exista en la tabla states
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(optional($customer->user)->id), // Ignora el email del usuario actual si existe
            ],
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Verificar si el cliente tiene un usuario asociado
        if (is_null($customer->user)) {
            // Crear un nuevo usuario si no está asociado
            $user = $customer->user()->create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make('default_password'), // Usar un password por defecto (cambiar según tu lógica)
            ]);
        } else {
            // Actualizar el usuario asociado
            $customer->user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
        }
    
        // Actualizar los datos del cliente
        $customer->update([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'state_id' => $request->state_id,
        ]);
    
        return redirect()->back()->with('success', 'Customer updated successfully');
    }
    

    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return redirect()->route('customer.ecommerce.customers.index')->with('error', 'Customer not found');
        }

        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully');
    }

    /**
     * Métodos para API
     */
    public function getCustomersApi()
    {
        // Carga la relación 'state' para incluirla en la respuesta JSON
        $customers = Customer::with('state')->get();
        return response()->json($customers);
    }
}
