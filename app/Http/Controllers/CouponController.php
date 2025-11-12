<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CouponController extends Controller
{
    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate(20);
        return view('coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new coupon.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store a newly created coupon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons',
            'discount_amount' => 'nullable|numeric',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'type' => 'required|in:a,p',
            'status' => 'required|in:active,inactive',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($request->type == "a") {
            $request["discount_percentage"] = null;
        } else {
            $request["discount_amount"] = null;
        }
        Coupon::create($request->all());

        return redirect()->route('coupons.index')
            ->with('success', 'Coupon created successfully.');
    }

    /**
     * Display the specified coupon.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified coupon.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified coupon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $coupon->id,
            'discount_amount' => 'nullable|numeric',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'type' => 'required|in:a,p',
            'status' => 'required|in:active,inactive',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($request->type == "a") {
            $request["discount_percentage"] = null;
        } else {
            $request["discount_amount"] = null;
        }

        $coupon->update($request->all());

        return redirect()->route('coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    /**
     * Remove the specified coupon from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }

    /**
     * Valida el cupón.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateCoupon(Request $request)
    {
        Log::info($request);
        if (!isset($request["code"])) {
            return response()->json([
                'success' => false,
                'message' => 'Cupón inválido o expirado',
            ], 404);
        }
        Log::info("pase validación");

        $coupon = Coupon::where('code', $request->code)
            ->where('status', 'active')
            ->where('start_date', "<=", Carbon::now()->format('Y-m-d'))
            ->where('end_date', ">=",Carbon::now()->format('Y-m-d') )
            ->first();
            Log::info(Carbon::now());
            Log::info($coupon);

        if ($coupon) {
            return response()->json([
                'success' => true,
                'message' => 'Cupón válido',
                'coupon' => $coupon,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Cupón inválido o expirado',
        ], 201);
    }
}
