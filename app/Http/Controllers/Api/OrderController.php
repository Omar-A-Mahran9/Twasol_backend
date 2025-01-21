<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;

use App\Models\Customer;

use App\Services\OTOService;
use Illuminate\Http\Request;
use App\Services\TapPaymentService;
use App\Http\Controllers\Controller;
use App\Traits\WebNotificationsTrait;

 
use App\Http\Requests\Api\OrderRequest;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    use WebNotificationsTrait;
    private $tapPaymentService;
    private $otoService;

    public function __construct(TapPaymentService $tapPaymentService, OTOService $otoService)
    {
        $this->tapPaymentService = $tapPaymentService;
        $this->otoService        = $otoService;
    }
 

    public function createOrder(OrderRequest $request)
    {
        $data = $request->validated();
        // If no addon service ID, return an error response or success message
        if ($request->addon_service_id == null) {
            return response()->json( $data );
        }
    
        // Create customer
        $customerData = [
            'first_name' => strtok($data['name'], ' '),
            'last_name' => trim(strtok(' ')),
            'phone' => $data['phone'],
            'email' => $data['email'],
            'block_flag' => 0,
        ];
        $existingCustomer = Customer::where('email', $data['email'])->orWhere('phone', $data['phone'])->first();
        if ($existingCustomer) {


        $customer = $existingCustomer;
        } else {
            // Proceed with creating a new customer
            $customerData = [
                'first_name' => strtok($data['name'], ' '),
                'last_name' => trim(strtok(' ')),
                'phone' => $data['phone'],
                'email' => $data['email'],
                'block_flag' => 0,
            ];
            
            $customer = Customer::create($customerData);
        }
        // Create order
        $orderData = [
            'customer_id' => $customer->id,
            'city_id' => $data['city_id'],
            'address' => $data['address'],
            'date' => $data['date'] ?? "",
            'addon_service_id' => $data['addon_service_id'],
            'description' => $data['description'],
        ];
    
        $order = Order::create($orderData);
         Mail::to("info@tawasol-technology.com")->send(new OrderConfirmationMail($order));

        return $this->success(
            $order,
         );


    
     }
    

    public function checkPaymentTransaction(Request $request)
    {
        $request->validate([
            'tap_id' => ['required'],
        ]);

        return $this->tapPaymentService->retrieveCharge($request->tap_id);
    }

    
}
