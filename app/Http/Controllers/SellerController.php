<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreated;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sellers = Seller::with('user')->paginate(10);
        return view('sellers.index', compact('sellers'));
    }

    public function show($id)
    {
        $seller = Seller::with('user')->find($id);

        if (is_null($seller)) {
            return redirect()->route('sellers.index')->with('error', 'Seller not found');
        }

        return view('sellers.show', compact('seller'));
    }

    public function create()
    {
        return view('sellers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $seller = Seller::create($request->only('name', 'phone', 'address'));

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'seller_id'     => $seller->id,
            'role'          => 'seller'
        ]);

        // Enviar correo de notificación al usuario
        Mail::to($user->email)->send(new AccountCreated($user->name, $user->email, $request->password, 1));

        return redirect()->route('sellers.index')->with('success', 'Seller created successfully');
    }

    public function edit($id)
    {
        $seller = Seller::find($id);

        if (is_null($seller)) {
            return redirect()->route('sellers.index')->with('error', 'Seller not found');
        }

        return view('sellers.edit', compact('seller'));
    }

    public function update(Request $request, $id)
    {
        $seller = Seller::find($id);

        if (is_null($seller)) {
            return redirect()->route('sellers.index')->with('error', 'Seller not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $seller->user->id,
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $seller->update($request->only('name', 'phone', 'address'));

        $user = $seller->user;
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('sellers.index')->with('success', 'Seller updated successfully');
    }

    public function destroy($id)
    {
        $seller = Seller::find($id);

        if (is_null($seller)) {
            return redirect()->route('sellers.index')->with('error', 'Seller not found');
        }

        $seller->user()->delete();
        $seller->delete();

        return redirect()->route('sellers.index')->with('success', 'Seller deleted successfully');
    }
}
