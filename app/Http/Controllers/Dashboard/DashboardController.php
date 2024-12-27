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
        

        
  
        //
        return view('welcome',  );
    }
 
}
