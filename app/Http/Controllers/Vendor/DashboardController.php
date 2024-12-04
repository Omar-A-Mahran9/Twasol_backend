<?php

namespace App\Http\Controllers\Vendor;

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
        // Total count of branches
        $branches    = CityVendor::query()->whereHas('vendor.products.productCities')->where('vendor_id', auth()->user()->id);
        $topBranches = $branches->clone()->with('city')
            ->withCount([
                'products as product_count' => function ($query) {
                    $query->whereHas('productCities'); // Count products associated with cities
                },
                'orderItems as order_count_rejected' => function ($query) {
                    $query->where('vendor_id', auth()->user()->id)->whereHas('order', function ($orderQuery) {
                        $orderQuery->where('status', OrderStatus::Rejected->value)->whereColumn('city_id', 'city_vendor.city_id');
                    });
                },
                'orderItems as order_count_delivered' => function ($query) {
                    $query->where('vendor_id', auth()->user()->id)->whereHas('order', function ($orderQuery) {
                        $orderQuery->where('status', OrderStatus::Delivered->value)
                            ->whereColumn('city_id', 'city_vendor.city_id');
                    });
                }
            ])
            ->get();

        //  count orders based status and prices
        $orders               = Order::query();
        $orderPlaced          = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->where('status', OrderStatus::OrderPlaced->value)->count();
        $orderPlacedPrice     = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->where('status', OrderStatus::OrderPlaced->value)->sum('total_price');
        $orderProcessing      = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->whereIn('status', [OrderStatus::PaymentConfirmed->value, OrderStatus::Processing->value, OrderStatus::Shipped->value])->count();
        $orderProcessingPrice = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->whereIn('status', [OrderStatus::PaymentConfirmed->value, OrderStatus::Processing->value, OrderStatus::Shipped->value])->sum('total_price');
        $orderDelivered       = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->where('status', OrderStatus::Delivered->value)->count();
        $orderDeliveredPrice  = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->where('status', OrderStatus::Delivered->value)->sum('total_price');
        $orderRejected        = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->where('status', OrderStatus::Rejected->value)->count();
        $orderRejectedPrice   = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->where('status', operator: OrderStatus::Rejected->value)->sum('total_price');
        $ordersFastShipping   = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->where('has_fast_shipping', true)->count();
        $ordersNormalShipping = $orders->clone()->whereHas('orderItems', function ($query) {
            $query->where('vendor_id', auth()->user()->id);
        })->where('has_fast_shipping', false)->count();
        $orderPlaced          = $this->formatNumber($orderPlaced);
        $orderProcessing      = $this->formatNumber($orderProcessing);
        $orderDelivered       = $this->formatNumber($orderDelivered);
        $orderRejected        = $this->formatNumber($orderRejected);
        $orderPlacedPrice     = $this->formatNumber($orderPlacedPrice);
        $orderProcessingPrice = $this->formatNumber($orderProcessingPrice);
        $orderDeliveredPrice  = $this->formatNumber($orderDeliveredPrice);
        $orderRejectedPrice   = $this->formatNumber($orderRejectedPrice);

        // categories
        $categories            = Category::query()->where('parent_id', null);
        $categoryCountProducts = $categories->clone()->whereHas('products', function ($query) {
            $query->where('vendor_id', auth()->id());
        })
            ->withCount('products')->get();
        $categoryCount         = $categoryCountProducts->pluck('products_count');
        $categoryCountOrders   = $categories->clone()->whereHas('products', function ($query) {
            $query->where('vendor_id', auth()->id());
        })
            ->with('products', function ($query) {

                $query->withCount([
                    'orderItems as order_count' => function ($query) {
                        $query->join('orders', 'order_items.order_id', '=', 'orders.id')
                            ->selectRaw('count(distinct orders.id)');
                    }
                ]);
            })->get();
        $categoryCountOrders   = $categoryCountOrders->pluck('products')->map(function ($productCollection) {
            return $productCollection->sum('order_count');
        });

        // Products
        $products                  = Product::query()->where('vendor_id', '=', auth()->user()->id);
        $topSellingAllProducts     = $products->clone()->with('images', 'vendor')->withCount([
            'orderItems as orders_count' => function ($query) {
                $query->selectRaw('COUNT(DISTINCT order_id)');
            }
        ])->having('orders_count', '>', 0)
            ->orderByDesc('orders_count')
            ->take(5)->get();
        $topSellingGoldProducts    = $products->clone()->with('images', 'vendor')
            ->whereHas('categories', function ($query) {
                $query->where('categories.id', '=', 1);
            })->withCount([
                'orderItems as orders_count' => function ($query) {
                    $query->selectRaw('COUNT(DISTINCT order_id)');
                }
            ])->having('orders_count', '>', 0)->orderByDesc('orders_count')
            ->take(5)->get();
        $topSellingSilverProducts  = $products->clone()->with('images', 'vendor')
            ->whereHas('categories', function ($query) {
                $query->where('categories.id', '=', 2);
            })->withCount([
                'orderItems as orders_count' => function ($query) {
                    $query->selectRaw('COUNT(DISTINCT order_id)');
                }
            ])->having('orders_count', '>', 0)->orderByDesc('orders_count')
            ->take(5)->get();
        $topSellingDiamondProducts = $products->clone()->with('images', 'vendor')
            ->whereHas('categories', function ($query) {
                $query->where('categories.id', '=', 3);
            })->withCount([
                'orderItems as orders_count' => function ($query) {
                    $query->selectRaw('COUNT(DISTINCT order_id)');
                }
            ])->having('orders_count', '>', 0)->orderByDesc('orders_count')
            ->take(5)->get();
        $topSellingWatchesProducts = $products->clone()->with('images', 'vendor')
            ->whereHas('categories', function ($query) {
                $query->where('categories.id', '=', 4);
            })->withCount([
                'orderItems as orders_count' => function ($query) {
                    $query->selectRaw('COUNT(DISTINCT order_id)');
                }
            ])->having('orders_count', '>', 0)->orderByDesc('orders_count')
            ->take(5)->get();
        $topSellingAlloysProducts  = $products->clone()->with('images', 'vendor')
            ->whereHas('categories', function ($query) {
                $query->where('categories.id', '=', 5);
            })
            ->withCount([
                'orderItems as orders_count' => function ($query) {
                    $query->selectRaw('COUNT(DISTINCT order_id)');
                }
            ])->having('orders_count', '>', 0)
            ->orderByDesc('orders_count')
            ->take(5)
            ->get();

        //
        return view('vendor-dashboard.home', compact(
            'orderPlaced',
            'orderPlacedPrice',
            'orderProcessing',
            'orderProcessingPrice',
            'orderDelivered',
            'orderDeliveredPrice',
            'orderRejected',
            'orderRejectedPrice',
            'topSellingAllProducts',
            'topSellingGoldProducts',
            'topSellingSilverProducts',
            'topSellingDiamondProducts',
            'topSellingWatchesProducts',
            'topSellingAlloysProducts',
            'categoryCountProducts',
            'categoryCount',
            'categoryCountOrders',
            'topBranches',
            'ordersFastShipping',
            'ordersNormalShipping',
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
                $orderCount = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereBetween('created_at', [$startOfHour, $endOfHour])
                    ->where('status', OrderStatus::Delivered->value)
                    ->count();
                $orderSum = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereBetween('created_at', [$startOfHour, $endOfHour])
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
                $orderCount    = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->count();
                $orderSum      = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->sum('total_price');
                $formattedDate = $date->day; // Format as day (e.g., 2024-09-18)

                $data[$formattedDate] = [
                    'order_count' => $orderCount,
                    'order_sum' => $orderSum
                ];
            }
        }

        if ($startDate->format('Y') != $endDate->format('Y') || $startDate->diffInDays($endDate) >= 364) {
            for ($date = $startDate; $date->lte($endDate); $date->addMonth()) {
                $orderCount    = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereBetween('created_at', [$date->startOfMonth()->toDateString(), $date->endOfMonth()->toDateString()])->where('status', OrderStatus::Delivered->value)->count();
                $orderSum      = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereBetween('created_at', [$date->startOfMonth()->toDateString(), $date->endOfMonth()->toDateString()])->where('status', OrderStatus::Delivered->value)->sum('total_price');
                $formattedDate = $date->month;
                $data[$formattedDate] = [
                    'order_count' => $orderCount,
                    'order_sum' => $orderSum
                ];
            }
        }
        if ($startDate->isCurrentMonth() && $endDate->isCurrentMonth() && !$startDate->isToday()) {
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $orderCount = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->count();
                $orderSum = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->sum('total_price');
                $formattedDate = $date->day; // Format as day (e.g., 2024-09-18)

                $data[$formattedDate] = [
                    'order_count' => $orderCount,
                    'order_sum' => $orderSum
                ];
            }
        }

        if ($startDate->isLastMonth() && $endDate->isLastMonth()) {
            // Case for the last month (day-by-day)
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $orderCount = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereDate('created_at', $date->toDateString())
                    ->where('status', OrderStatus::Delivered->value)
                    ->count();
                $orderSum = Order::whereHas('orderItems', function ($query) {
                    $query->where('vendor_id', auth()->user()->id);
                })->whereDate('created_at', $date->toDateString())
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