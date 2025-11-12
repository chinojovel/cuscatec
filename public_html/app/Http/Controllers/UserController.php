<?php

namespace App\Http\Controllers;

use App\Helper\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(["register"]);
    }

    public function register(Request $request)
    {
        $response = (new UserService($request->email, $request->password))->register($request->devicename);
        return response()->json($response);
    }


    public function loginCostumer(Request $request)
    {
        $user = User::where('email', $request->email)
            ->with(['customer.state']) // Cargar el estado a través del cliente
            ->first();

        if ($user && Hash::check($request->password, $user->password) && isset($user->customer_id)) {
            $token = $user->createToken($request->devicename)->plainTextToken;
            $tokenApi = $user->createToken('API Token')->plainTextToken;

            return [
                'success'   => true,
                'token'     => $token,
                'user'      => $user,
                'tokenApi'  => $tokenApi,
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid email or password.'
        ];
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        Log::info($request);
        if ($user && Hash::check($request->password, $user->password) && isset($user->seller_id)) {
            $token = $user->createToken($request->devicename)->plainTextToken;
            $tokenApi = $user->createToken('API Token')->plainTextToken;

            return [
                'success'   => true,
                'token'     => $token,
                'user'      => $user,
                'tokenApi'  => $tokenApi,
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid email or password.'
        ];
    }


    public function loginToken(Request $request)
    {
        // Validate the request data
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function index()
    {
        $users = User::with('roles')->where('customer_id', null)->where('seller_id', null)->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'nullable|string|exists:roles,name'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->role) {
            $role = Role::where('name', $request->role)->first();
            if ($role) {
                $user->assignRole($role);
            }
        }

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:191',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6',
            'role' => 'nullable|string|exists:roles,name'
        ]);

        $user->update($request->only(['name', 'email']));

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if ($request->role) {
            $role = Role::where('name', $request->role)->first();
            if ($role) {
                $user->syncRoles([$role]);
            }
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
