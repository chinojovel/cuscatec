<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root(Request $request)
    {
        //QUERYS DE DASHBOARD

        // Obtenemos los filtros
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $stateId = $request->input('state');

        /*
        *   Ventas en los ultimos 7 dias
        */
        $endDate = Carbon::now(); // Día actual
        $startDate = Carbon::now()->subDays(7); // Hace 7 días
        $previousStartDate = now()->subDays(14)->startOfDay();
        $previousEndDate = now()->subDays(7)->endOfDay();
        $totalSalesLastSevenDays = DB::table('orders')
            ->select(DB::raw('DATE(order_date) as day'), DB::raw('SUM(total_price) as total_sales'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('order_date', [$startDate, $endDate]) // Últimos 7 días
            ->where('payment_status', "!=", 'P')
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('customers.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy(DB::raw('DATE(order_date)'))
            ->orderBy('day', 'ASC')
            ->get();

        // Total de ventas de los últimos 7 días
        $sumTotalSalesLastSevenDays = DB::table('orders')
            ->select(DB::raw('SUM(total_price) as total_sales'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('order_date', [$startDate, $endDate]) // Últimos 7 días
            ->where('payment_status', "!=", 'P')
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('customers.state_id', $stateId); // Filtro por estado si no es null
            })
            ->first(); // Usamos first() porque queremos el total, no una lista

        // Total de ventas de los 7 días anteriores a esos últimos 7 días
        $sumTotalSalesPreviousSevenDays = DB::table('orders')
            ->select(DB::raw('SUM(total_price) as total_sales'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('order_date', [$previousStartDate, $previousEndDate]) // 7 días anteriores
            ->where('payment_status', "!=", 'P')
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('customers.state_id', $stateId); // Filtro por estado si no es null
            })
            ->first();

        // Asegurarnos de que los totales no sean nulos
        $currentSales = $sumTotalSalesLastSevenDays->total_sales ?? 0;
        $previousSales = $sumTotalSalesPreviousSevenDays->total_sales ?? 0;

        if ($previousSales > 0) {
            $percentageChange = round((($currentSales - $previousSales) / $previousSales) * 100, 2);
        } else {
            $percentageChange = $currentSales > 0 ? 100 : 0; // Si las ventas anteriores son 0, no podemos calcular un porcentaje válido
        }


        /*
        *   Cantidad de órdenes en los últimos 7 días
        */
        $countListTotalOrdersLastSevenDays = DB::table('orders')
            ->select(DB::raw('DATE(order_date) as day'), DB::raw('COUNT(*) as total_orders'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('order_date', [$startDate, $endDate]) // Últimos 7 días
            ->where('payment_status', "!=", 'P')
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('customers.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy(DB::raw('DATE(order_date)'))
            ->orderBy('day', 'ASC')
            ->get();


        // Total de órdenes de los últimos 7 días
        $countTotalOrdersLastSevenDays = DB::table('orders')
            ->select(DB::raw('COUNT(*) as total_orders'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('order_date', [$startDate, $endDate]) // Últimos 7 días
            ->where('payment_status', "!=", 'P')
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('customers.state_id', $stateId); // Filtro por estado si no es null
            })
            ->first(); // Usamos first() porque queremos el total, no una lista

        // Total de órdenes de los 7 días anteriores a esos últimos 7 días
        $countTotalOrdersPreviousSevenDays = DB::table('orders')
            ->select(DB::raw('COUNT(*) as total_orders'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->where('payment_status', "!=", 'P')
            ->whereBetween('order_date', [$previousStartDate, $previousEndDate]) // 7 días anteriores
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('customers.state_id', $stateId); // Filtro por estado si no es null
            })
            ->first();

        // Asegurarnos de que los totales no sean nulos
        $currentOrders = $countTotalOrdersLastSevenDays->total_orders ?? 0;
        $previousOrders = $countTotalOrdersPreviousSevenDays->total_orders ?? 0;

        if ($previousOrders > 0) {
            $countPercentageChange = round((($currentOrders - $previousOrders) / $previousOrders) * 100, 2);
        } else {
            $countPercentageChange = $currentOrders > 0 ? 100 : 0; // Si las órdenes anteriores son 0, no podemos calcular un porcentaje válido
        }

        /*
        *   Cantidad de órdenes por tipo de estado de pago
        */
        $paymentStatusOrders = DB::table('orders')
            ->select('payment_status', DB::raw('COUNT(*) as total_orders'))
            ->whereBetween('order_date', [$startDate, $endDate])
            ->groupBy('payment_status')
            ->orderBy('payment_status', 'ASC')
            ->get();

        /*
        *   Ventas por categoria
        */
        $salesByCategory = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id') // LEFT JOIN para incluir productos sin categoría
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(
                DB::raw('COALESCE(categories.name, "Sin categoría") as category_name'), // Si no hay categoría, mostramos "Sin categoría"
                DB::raw('SUM(order_details.total) as total_sales'),
                DB::raw('ROUND(SUM(order_details.total) / (SELECT SUM(order_details.total)
            FROM order_details
            JOIN orders ON order_details.order_id = orders.id
            WHERE orders.payment_status IN ("C", "D")
            AND orders.order_date BETWEEN NOW() - INTERVAL 7 DAY AND NOW()) * 100, 2) as percentage_sales')
            )
            ->whereBetween('orders.order_date', [now()->subDays(7), now()]) // Últimos 7 días
            ->whereIn('orders.payment_status', ['C', 'D']) // Estado de la orden C (check) y D (paid)
            ->groupBy('category_name') // Agrupamos por nombre de categoría o "Sin categoría"
            ->orderBy('total_sales', 'DESC')
            ->get();

        $salesColors = []; // Aquí generas los colores en el servidor
        $palette = ['#3980c0', '#9b59b6', '#51af98', '#4bafe1', '#B4B4B5', '#f1f3f4', '#1abc9c', '#2ecc71'];

        foreach ($salesByCategory as $index => $category) {
            // Generar un color para cada categoría (puedes usar random o secuencial)
            $salesColors[] = $palette[$index % count($palette)];
        }


        /*
        *   Cantidad de órdenes por tipo de estado de pago
        */
        $totalSalesByPaymentStatus = DB::table('orders as o')
            ->select('o.payment_status', DB::raw('SUM(o.total_price) as total_sales'))
            ->whereBetween('o.order_date', [$startDate, $endDate])
            ->groupBy('o.payment_status')
            ->union(
                DB::table('payment_status_histories as psh')
                    ->select(
                        DB::raw("CASE 
                            WHEN psh.payment_status = 'C' THEN 'P to C' 
                            WHEN psh.payment_status = 'D' THEN 'P to D' 
                          END as status_change"),
                        DB::raw('SUM(o.total_price) as total_sales')
                    )
                    ->join('orders as o', 'psh.order_id', '=', 'o.id')
                    ->whereBetween('psh.changed_at', [$startDate, $endDate])
                    ->whereIn('psh.payment_status', ['C', 'D'])
                    ->groupBy(
                        DB::raw("CASE 
                                WHEN psh.payment_status = 'C' THEN 'P to C' 
                                WHEN psh.payment_status = 'D' THEN 'P to D' 
                              END")
                    )
            )
            ->orderBy('payment_status', 'ASC')  // Cambié para usar la columna de la unión
            ->get();


        /*
        *  Ventas por vendedor
        */
        $vendedorVentas = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id', 'left') // Hacer un LEFT JOIN con la tabla de users
            ->select(
                DB::raw('COALESCE(orders.user_id, "Sin Asignar") as user_id'), // Reemplazar NULL con 'Sin Asignar'
                DB::raw('COALESCE(users.name, "Sin Asignar") as user_name'), // Reemplazar NULL con 'Sin Asignar' para el nombre del usuario
                DB::raw('SUM(CASE WHEN payment_status IN ("C") THEN total_price ELSE 0 END) as total_check'), // Suma ventas pagadas y cheque
                DB::raw('SUM(CASE WHEN payment_status = "P" THEN total_price ELSE 0 END) as total_pending'), // Suma ventas pendientes
                DB::raw('SUM(CASE WHEN payment_status IN ("D") THEN total_price ELSE 0 END) as total_paid'),
                DB::raw('SUM(total_price) as total_sales') // Total de todas las ventas
            )
            ->whereBetween('order_date', [$startDate, $endDate]) // Filtrar por los últimos 7 días
            ->groupBy('orders.user_id', 'users.name') // Agrupar por vendedor (user_id o 'Sin Asignar') y nombre del usuario
            ->orderBy('total_sales', 'DESC') // Ordenar por el total de ventas (descendente)
            ->get();

        /*
        *  Ventas por producto
        */
        $topSellingProducts = OrderDetail::select(
            'products.id as product_id',
            'products.name as product_name',
            DB::raw('SUM(order_details.quantity) as total_quantity_sold'),
            DB::raw('SUM(order_details.total) as total_sales')
        )
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity_sold')
            ->get();

        /*
        *  Ventas por customer
        */
        $topCustomersOrders = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id', 'left') // Hacer un LEFT JOIN con la tabla de customers
            ->select(
                DB::raw('COALESCE(orders.customer_id, "Sin Asignar") as customer_id'), // Reemplazar NULL con 'Sin Asignar'
                DB::raw('COALESCE(customers.name, "Sin Asignar") as customer_name'), // Reemplazar NULL con 'Sin Asignar' para el nombre del cliente
                DB::raw('SUM(CASE WHEN payment_status IN ("C") THEN total_price ELSE 0 END) as total_check'), // Suma ventas pagadas y cheque
                DB::raw('SUM(CASE WHEN payment_status = "P" THEN total_price ELSE 0 END) as total_pending'), // Suma ventas pendientes
                DB::raw('SUM(CASE WHEN payment_status IN ("D") THEN total_price ELSE 0 END) as total_paid'), // Suma ventas pagadas
                DB::raw('SUM(total_price) as total_sales') // Total de todas las ventas
            )
            ->whereBetween('orders.order_date', [$startDate, $endDate]) // Filtrar por los últimos 7 días
            ->groupBy('orders.customer_id', 'customers.name') // Agrupar por cliente (customer_id o 'Sin Asignar') y nombre del cliente
            ->orderBy('total_sales', 'DESC') // Ordenar por el total de ventas (descendente)
            ->get();

        /*
        *  Sell by state
        */
        $currentPeriodSales = Order::select(
            'state_id',
            'states.name as state_name', // Asegúrate de seleccionar el nombre del estado
            DB::raw('SUM(total_price) as total_sales'),
            DB::raw('SUM(CASE WHEN payment_status = "P" THEN total_price ELSE 0 END) as total_pending'),
            DB::raw('SUM(CASE WHEN payment_status = "C" THEN total_price ELSE 0 END) as total_check'),
            DB::raw('SUM(CASE WHEN payment_status = "D" THEN total_price ELSE 0 END) as total_paid')
        )
            ->join('states', 'orders.state_id', '=', 'states.id') // Asegúrate de que la unión es correcta
            ->whereBetween('order_date', [$startDate, $endDate])
            ->groupBy('state_id', 'states.name') // Agrupar por state_id y name del estado
            ->get();

        $previousPeriodSales = Order::select(
            'state_id',
            'states.name as state_name', // Asegúrate de seleccionar el nombre del estado
            DB::raw('SUM(total_price) as total_sales'),
            DB::raw('SUM(CASE WHEN payment_status = "P" THEN total_price ELSE 0 END) as total_pending'),
            DB::raw('SUM(CASE WHEN payment_status = "C" THEN total_price ELSE 0 END) as total_check'),
            DB::raw('SUM(CASE WHEN payment_status = "D" THEN total_price ELSE 0 END) as total_paid')
        )
            ->join('states', 'orders.state_id', '=', 'states.id') // Asegúrate de que la unión es correcta
            ->whereBetween('order_date', [$previousStartDate, $previousEndDate])
            ->groupBy('state_id', 'states.name') // Agrupar por state_id y name del estado
            ->get();

        // Combina los resultados para calcular el porcentaje de variación
        $results = $currentPeriodSales->map(function ($current) use ($previousPeriodSales) {
            $previous = $previousPeriodSales->firstWhere('state_id', $current->state_id);

            // Accede a los valores como array
            $previousTotal = $previous ? $previous['total_sales'] : 0;

            // Calcular el porcentaje de variación
            $variation = ($previousTotal > 0)
                ? (($current->total_sales - $previousTotal) / $previousTotal) * 100
                : null; // Evitar división por cero

            return [
                'state_id' => $current->state_id,
                'state_name' => $current->state_name,
                'total_sales' => $current->total_sales,
                'previous_sales' => $previousTotal,
                'percentage_variation' => $variation,
                'total_pending' => $current->total_pending,
                'total_check' => $current->total_check,
                'total_paid' => $current->total_paid,
            ];
        });

        // Convertir el resultado a un array
        $salesByState = $results->toArray();

        return view('dashboard.index', compact(
            'totalSalesLastSevenDays',
            'sumTotalSalesLastSevenDays',
            'percentageChange',
            //
            'countListTotalOrdersLastSevenDays',
            'countTotalOrdersLastSevenDays',
            'countTotalOrdersPreviousSevenDays',
            'countPercentageChange',
            //
            'paymentStatusOrders',
            //
            'salesByCategory',
            'salesColors',
            //
            'totalSalesByPaymentStatus',
            //
            'vendedorVentas',
            'topSellingProducts',
            'topCustomersOrders',
            //
            'salesByState',
        ));
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request)
    {
        $id = ucfirst(Auth::user()->id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            if (@file_exists(public_path(Auth::user()->avatar))) {
                @unlink(public_path(Auth::user()->avatar));
            }

            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar = '/images/' . $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->back()->with('success', 'YOU HAVE SUCCESSFULLY UPDATED!');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }

    public function dynamicDashboard(Request $request)
    {
        //QUERYS DE DASHBOARD



        $stateId = $request->input('state');

        if ($request->has('start_date')) {
            $startDate = $request->input('start_date');
        } else {
            $startDate = Carbon::now()->subDays(7); // Hace 7 días
        }

        if ($request->has('end_date')) {
            $endDate = $request->input('end_date');
        } else {
            $endDate = Carbon::now(); // Hace 7 días
        }

        $statesAll = State::all();


        /*
        *   Ventas en los ultimos 7 dias
        */

        $totalSalesLastSevenDays = DB::table('orders')
            ->select(DB::raw('DATE(order_date) as day'), DB::raw('SUM(total_price) as total_sales'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('order_date', [$startDate, $endDate]) // Últimos 7 días
            ->where('payment_status', "!=", 'P')
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('orders.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy(DB::raw('DATE(order_date)'))
            ->orderBy('day', 'ASC')
            ->get();

        // Total de ventas de los últimos 7 días
        $sumTotalSalesLastSevenDays = DB::table('orders')
            ->select(DB::raw('SUM(total_price) as total_sales'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('order_date', [$startDate, $endDate]) // Últimos 7 días
            ->where('payment_status', "!=", 'P')
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('orders.state_id', $stateId); // Filtro por estado si no es null
            })
            ->first(); // Usamos first() porque queremos el total, no una lista




        /*
        *   Cantidad de órdenes en los últimos 7 días
        */
        $countListTotalOrdersLastSevenDays = DB::table('orders')
            ->select(DB::raw('DATE(order_date) as day'), DB::raw('COUNT(*) as total_orders'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('order_date', [$startDate, $endDate]) // Últimos 7 días
            ->where('payment_status', "!=", 'P')
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('customers.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy(DB::raw('DATE(order_date)'))
            ->orderBy('day', 'ASC')
            ->get();


        // Total de órdenes de los últimos 7 días
        $countTotalOrdersLastSevenDays = DB::table('orders')
            ->select(DB::raw('COUNT(*) as total_orders'))
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('order_date', [$startDate, $endDate]) // Últimos 7 días
            ->where('payment_status', "!=", 'P')
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('customers.state_id', $stateId); // Filtro por estado si no es null
            })
            ->first(); // Usamos first() porque queremos el total, no una lista


        /*
        *   Cantidad de órdenes por tipo de estado de pago
        */
        $paymentStatusOrders = DB::table('orders')
            ->select('payment_status', DB::raw('COUNT(*) as total_orders'))
            ->whereBetween('order_date', [$startDate, $endDate])
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('orders.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy('payment_status')
            ->orderBy('payment_status', 'ASC')
            ->get();

        /*
        *   Ventas por categoria
        */
        $salesByCategory = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id') // LEFT JOIN para incluir productos sin categoría
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(
                DB::raw('COALESCE(categories.name, "Sin categoría") as category_name'), // Si no hay categoría, mostramos "Sin categoría"
                DB::raw('SUM(order_details.total) as total_sales'),
                DB::raw('ROUND(SUM(order_details.total) / (SELECT SUM(order_details.total)
            FROM order_details
            JOIN orders ON order_details.order_id = orders.id
            WHERE orders.payment_status IN ("C", "D")
            AND orders.order_date BETWEEN \'' . $startDate . '\' AND \'' . $endDate . '\') * 100, 2) as percentage_sales')
            )
            ->whereBetween('orders.order_date', [$startDate, $endDate]) // Últimos 7 días
            ->whereIn('orders.payment_status', ['C', 'D']) // Estado de la orden C (check) y D (paid)
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('orders.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy('category_name') // Agrupamos por nombre de categoría o "Sin categoría"
            ->orderBy('total_sales', 'DESC')
            ->get();

        $salesColors = []; // Aquí generas los colores en el servidor
        $palette = ['#3980c0', '#9b59b6', '#51af98', '#4bafe1', '#B4B4B5', '#f1f3f4', '#1abc9c', '#2ecc71'];

        foreach ($salesByCategory as $index => $category) {
            // Generar un color para cada categoría (puedes usar random o secuencial)
            $salesColors[] = $palette[$index % count($palette)];
        }


        /*
        *   Cantidad de órdenes por tipo de estado de pago
        */
        $totalSalesByPaymentStatus = DB::table('orders as o')
            ->select('o.payment_status', DB::raw('SUM(o.total_price) as total_sales'))
            ->whereBetween('o.order_date', [$startDate, $endDate])
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('o.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy('o.payment_status')
            ->union(
                DB::table('payment_status_histories as psh')
                    ->select(
                        DB::raw("CASE 
                        WHEN psh.payment_status = 'C' THEN 'P to C' 
                        WHEN psh.payment_status = 'D' THEN 'P to D' 
                      END as status_change"),
                        DB::raw('SUM(o.total_price) as total_sales')
                    )
                    ->join('orders as o', 'psh.order_id', '=', 'o.id')
                    ->whereBetween('psh.changed_at', [$startDate, $endDate])
                    ->when($stateId !== null, function ($query) use ($stateId) {
                        return $query->where('o.state_id', $stateId); // Filtro por estado en la tabla orders si no es null
                    })
                    ->whereIn('psh.payment_status', ['C', 'D'])
                    ->groupBy(
                        DB::raw("CASE 
                        WHEN psh.payment_status = 'C' THEN 'P to C' 
                        WHEN psh.payment_status = 'D' THEN 'P to D' 
                      END")
                    )
            )
            ->orderByRaw("CASE 
                    WHEN payment_status = 'P' THEN 1
                    WHEN payment_status = 'C' THEN 2
                    WHEN payment_status = 'D' THEN 3
                    ELSE 4
                 END")
            ->get();

                    //dd($totalSalesByPaymentStatus);


        /*
        *  Ventas por vendedor
        */
        $vendedorVentas = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id', 'left') // Hacer un LEFT JOIN con la tabla de users
            ->select(
                DB::raw('COALESCE(orders.user_id, "Sin Asignar") as user_id'), // Reemplazar NULL con 'Sin Asignar'
                DB::raw('COALESCE(users.name, "Sin Asignar") as user_name'), // Reemplazar NULL con 'Sin Asignar' para el nombre del usuario
                DB::raw('SUM(CASE WHEN payment_status IN ("C") THEN total_price ELSE 0 END) as total_check'), // Suma ventas pagadas y cheque
                DB::raw('SUM(CASE WHEN payment_status = "P" THEN total_price ELSE 0 END) as total_pending'), // Suma ventas pendientes
                DB::raw('SUM(CASE WHEN payment_status IN ("D") THEN total_price ELSE 0 END) as total_paid'),
                DB::raw('SUM(total_price) as total_sales') // Total de todas las ventas
            )
            ->whereBetween('order_date', [$startDate, $endDate]) // Filtrar por los últimos 7 días
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('orders.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy('orders.user_id', 'users.name') // Agrupar por vendedor (user_id o 'Sin Asignar') y nombre del usuario
            ->orderBy('total_sales', 'DESC') // Ordenar por el total de ventas (descendente)
            ->get();

        /*
        *  Ventas por producto
        */
        $topSellingProducts = OrderDetail::select(
            'products.id as product_id',
            'products.name as product_name',
            DB::raw('SUM(order_details.quantity) as total_quantity_sold'),
            DB::raw('SUM(order_details.total) as total_sales')
        )
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('orders.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity_sold')
            ->get();

        /*
        *  Ventas por customer
        */
        $topCustomersOrders = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id', 'left') // Hacer un LEFT JOIN con la tabla de customers
            ->select(
                DB::raw('COALESCE(orders.customer_id, "Sin Asignar") as customer_id'), // Reemplazar NULL con 'Sin Asignar'
                DB::raw('COALESCE(customers.name, "Sin Asignar") as customer_name'), // Reemplazar NULL con 'Sin Asignar' para el nombre del cliente
                DB::raw('SUM(CASE WHEN payment_status IN ("C") THEN total_price ELSE 0 END) as total_check'), // Suma ventas pagadas y cheque
                DB::raw('SUM(CASE WHEN payment_status = "P" THEN total_price ELSE 0 END) as total_pending'), // Suma ventas pendientes
                DB::raw('SUM(CASE WHEN payment_status IN ("D") THEN total_price ELSE 0 END) as total_paid'), // Suma ventas pagadas
                DB::raw('SUM(total_price) as total_sales') // Total de todas las ventas
            )
            ->whereBetween('orders.order_date', [$startDate, $endDate]) // Filtrar por los últimos 7 días
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('orders.state_id', $stateId); // Filtro por estado si no es null
            })
            ->groupBy('orders.customer_id', 'customers.name') // Agrupar por cliente (customer_id o 'Sin Asignar') y nombre del cliente
            ->orderBy('total_sales', 'DESC') // Ordenar por el total de ventas (descendente)
            ->get();

        /*
        *  Sell by state
        */
        $currentPeriodSales = Order::select(
            'state_id',
            'states.name as state_name', // Asegúrate de seleccionar el nombre del estado
            DB::raw('SUM(total_price) as total_sales'),
            DB::raw('SUM(CASE WHEN payment_status = "P" THEN total_price ELSE 0 END) as total_pending'),
            DB::raw('SUM(CASE WHEN payment_status = "C" THEN total_price ELSE 0 END) as total_check'),
            DB::raw('SUM(CASE WHEN payment_status = "D" THEN total_price ELSE 0 END) as total_paid')
        )
            ->join('states', 'orders.state_id', '=', 'states.id') // Asegúrate de que la unión es correcta
            ->when($stateId !== null, function ($query) use ($stateId) {
                return $query->where('orders.state_id', $stateId); // Filtro por estado si no es null
            })
            ->whereBetween('order_date', [$startDate, $endDate])
            ->groupBy('state_id', 'states.name') // Agrupar por state_id y name del estado
            ->get();

        return view('dashboard.dynamics-dashboard', compact(
            'totalSalesLastSevenDays',
            'sumTotalSalesLastSevenDays',
            //
            'countListTotalOrdersLastSevenDays',
            'countTotalOrdersLastSevenDays',
            //
            'paymentStatusOrders',
            //
            'salesByCategory',
            'salesColors',
            //
            'totalSalesByPaymentStatus',
            //
            'vendedorVentas',
            'topSellingProducts',
            'topCustomersOrders',
            'currentPeriodSales',
            'statesAll'
        ));
    }
}
