<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductPriceHistory;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductPriceController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(Product $product)
    {
        $states = State::all();
        $prices = ProductPrice::where('product_id', $product->id)->get()->keyBy('state_id');

        return view('products.prices.edit', compact('product', 'states', 'prices'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'prices' => 'array',
            'prices.*.state_id' => 'exists:states,id',
            'prices.*.price' => 'nullable|numeric',
        ]);

        foreach ($request->prices as $stateId => $priceData) {
            $price = $priceData['price'];
            $stateId = $priceData['state_id'];

            $productPrice = ProductPrice::updateOrCreate(
                ['product_id' => $product->id, 'state_id' => $stateId],
                ['price' => $price]
            );

            ProductPriceHistory::create([
                'product_id' => $product->id,
                'state_id' => $stateId,
                'price' => $price,
                'changed_by' => Auth::id(),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product prices updated successfully.');
    }
}
