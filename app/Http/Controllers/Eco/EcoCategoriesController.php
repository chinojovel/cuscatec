<?php

namespace App\Http\Controllers\Eco;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\State;
use Illuminate\Http\Request;

class EcoCategoriesController extends Controller
{
    public function index()
    {
        $states = State::all();
        if (!session()->has('selected_state')) {
            
            return view('ecommerce.products.categories', ['showModal' => true, 'states' => $states, 'categories' => []]);
        }

        $categories =  Category::all();
        return view('ecommerce.products.categories', ['showModal' => false, 'categories' => $categories, 'states' => $states]);
    }
}
