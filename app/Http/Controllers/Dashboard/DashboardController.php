<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Enums\OrderStatus;
use App\Models\CityVendor;
use Illuminate\Http\Request;
use App\Enums\VendorStatusEnum;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        //  count orders based status and prices
        $orders               = Order::query();
        $orderPlaced          = $orders->clone()->where('status', OrderStatus::OrderPlaced->value)->count();
        $orderPlacedPrice     = $orders->clone()->where('status', OrderStatus::OrderPlaced->value)->sum('total_price');
        $orderProcessing      = $orders->clone()->whereIn('status', [OrderStatus::PaymentConfirmed->value, OrderStatus::Processing->value, OrderStatus::Shipped->value])->count();
        $orderProcessingPrice = $orders->clone()->whereIn('status', [OrderStatus::PaymentConfirmed->value, OrderStatus::Processing->value, OrderStatus::Shipped->value])->sum('total_price');
        $orderDelivered       = $orders->clone()->where('status', OrderStatus::Delivered->value)->count();
        $orderDeliveredPrice  = $orders->clone()->where('status', OrderStatus::Delivered->value)->sum('total_price');
        $orderRejected        = $orders->clone()->where('status', OrderStatus::Rejected->value)->count();
        $orderRejectedPrice   = $orders->clone()->where('status', operator: OrderStatus::Rejected->value)->sum('total_price');
        $orderPlaced          = $this->formatNumber($orderPlaced);
        $orderProcessing      = $this->formatNumber($orderProcessing);
        $orderDelivered       = $this->formatNumber($orderDelivered);
        $orderRejected        = $this->formatNumber($orderRejected);
        $orderPlacedPrice     = $this->formatNumber($orderPlacedPrice);
        $orderProcessingPrice = $this->formatNumber($orderProcessingPrice);
        $orderDeliveredPrice  = $this->formatNumber($orderDeliveredPrice);
        $orderRejectedPrice   = $this->formatNumber($orderRejectedPrice);

        // Total count of customers
        $users           = Customer::query();
        $userCount       = $users->clone()->count();
        $userCountActive = $users->clone()->where('block_flag', false)->count();
        $userCountOrder  = $users->has('orders')->count();
        $userCountOrder  = $this->formatNumber($userCountOrder);
        $userCountActive = $this->formatNumber($userCountActive);
        $userCount       = $this->formatNumber($userCount);

        $topUsers = Customer::clone()->withSum([
            'orders' => function ($query) {
                $query->where('status', OrderStatus::Delivered->value);
            }
        ], 'total_price')
            ->withCount([
                'orders' => function ($query) {
                    $query->where('status', OrderStatus::Delivered->value);
                }
            ])
            ->having('orders_count', '>', 0)
            ->orderByDesc('orders_count')
            ->take(5)
            ->get();

        // Total count of vendors
        $vendors            = Vendor::query();
        $vendorCount            = 4;

            
         $vendorCount = $this->formatNumber($vendorCount);

        // Total count of cities
        $cities          = City::query();
        $citiesCount     = $cities->clone()->count();
        $topCities       = $cities->clone()->take(5)->get();
        $topNameCities   = $topCities->pluck('name');
        $topBranchCities = $topCities->pluck('branches_count');
        $citiesCount     = $this->formatNumber($citiesCount);

        // Total count of branches
        $branches      = CityVendor::query();
        $branchesCount = 220;

        // categories
        $categories            = Category::query()->where('parent_id', null);
        $allCategories         = $categories->clone()->get();
        $categoryCountProducts = $categories->get();
        $categoryCount         = $categoryCountProducts->pluck('products_count');
        $categoryCountOrders   = [];

        // Products
        $products                  = Product::query();
        $topSellingAllProducts     = 0;
        $topSellingGoldProducts    = 0;
        $topSellingSilverProducts  = 0;
        $topSellingWatchesProducts = 0;
        //
        return view('welcome', compact(
            'orderPlaced',
            'orderPlacedPrice',
            'orderProcessing',
            'orderProcessingPrice',
            'orderDelivered',
            'orderDeliveredPrice',
            'orderRejected',
            'orderRejectedPrice',
            'userCount',
            'userCountActive',
            'userCountOrder',
            'vendorCount',
             'citiesCount',
            'branchesCount',
            'allCategories',
            'topUsers',
            'topSellingAllProducts',
            'topSellingGoldProducts',
            'topSellingSilverProducts',
             'topSellingWatchesProducts',
             'categoryCountProducts',
            'categoryCount',
            'categoryCountOrders',
            'topCities',
            'topNameCities',
            'topBranchCities',
        ));
    }

    public function ordersTransaction(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate   = Carbon::parse($request->input('end_date'));

        $endDate->endOfDay();
        $data = [];
        if ($startDate->isToday() && $endDate->isToday()) {
            $startOfDay = $startDate->copy()->startOfDay();
            for ($hour = 0; $hour < 24; $hour++) {
                $startOfHour = $startOfDay->copy()->addHours($hour);
                $endOfHour = $startOfHour->copy()->endOfHour();
                $orderCount = Order::whereBetween('created_at', [$startOfHour, $endOfHour])
                    ->where('status', OrderStatus::Delivered->value)
                    ->count();
                $orderSum = Order::whereBetween('created_at', [$startOfHour, $endOfHour])
                    ->where('status', OrderStatus::Delivered->value)
                    ->sum('total_price');
                $formattedHour = $startOfHour->format('h ') . __($startOfHour->format('A'));

                $data[$formattedHour] = [
                    'order_count' => $orderCount,
                    'order_sum' => $orderSum
                ];
            }
        }
        if ($startDate->diffInDays($endDate) <= 7 && !$startDate->isToday()) {
            // Case for last 7 days or when the range is within 7 days
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $orderCount    = Order::whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->count();
                $orderSum      = Order::whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->sum('total_price');
                $formattedDate = $date->format('d');
                $data[$formattedDate] = [
                    'order_count' => $orderCount,
                    'order_sum' => $orderSum
                ];
            }
        }
        if ($startDate->format('Y') != $endDate->format('Y') || $startDate->diffInDays($endDate) >= 364) {
            for ($date = $startDate; $date->lte($endDate); $date->addMonth()) {
                $orderCount    = Order::whereBetween('created_at', [$date->startOfMonth()->toDateString(), $date->endOfMonth()->toDateString()])->where('status', OrderStatus::Delivered->value)->count();
                $orderSum      = Order::whereBetween('created_at', [$date->startOfMonth()->toDateString(), $date->endOfMonth()->toDateString()])->where('status', OrderStatus::Delivered->value)->sum('total_price');
                $formattedDate = $date->month;
                $data[$formattedDate] = [
                    'order_count' => $orderCount,
                    'order_sum' => $orderSum
                ];
            }
        }
        if ($startDate->isCurrentMonth() && $endDate->isCurrentMonth() && !$startDate->isToday()) {
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $orderCount = Order::whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->count();
                $orderSum = Order::whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->sum('total_price');
                $formattedDate = $date->day; // Format as day (e.g., 2024-09-18)

                $data[$formattedDate] = [
                    'order_count' => $orderCount,
                    'order_sum' => $orderSum
                ];
            }
        }
        //     // Case for the last month (day-by-day)
        if ($startDate->isLastMonth() && $endDate->isLastMonth()) {
            // Case for the last month (day-by-day)
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $orderCount = Order::whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->count();
                $orderSum = Order::whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->sum('total_price');
                $formattedDate = $date->day; // Format as day (e.g., 2024-08-25 for last month)

                $data[$formattedDate] = [
                    'order_count' => $orderCount,
                    'order_sum' => $orderSum
                ];
            }
        }
        return response()->json($data);
    }
    function formatNumber($number)
    {
        if ($number >= 1000 && $number < 1000000) {
            return number_format($number / 1000, 3);
        } elseif ($number >= 1000000) {
            return number_format($number / 1000000, 3);
        } else {
            return $number;
        }
    }
}
