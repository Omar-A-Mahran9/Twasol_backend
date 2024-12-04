<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBookingRequest;
use App\Http\Resources\Api\carspriceResources;
use App\Http\Resources\Api\packagesResources;
use App\Models\Booking;
use App\Models\CarPrice;
use App\Models\Customer;
use App\Models\Packages;
use App\Models\PaymentData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $this->authorize('view_booking');

        $data=Booking::get();
        return $this->success('', Booking::collection($data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();
        if($data['type']==='per_trip'){

            if ($request->has('ticket_image	'))
            $data['ticket_image	'] = uploadImageToDirectory($request->file('ticket_image'), "Tickets_booking");
        
            $customer = Customer::where('email', $data['email'])->first();

            if (!$customer) {
                $names = explode(' ', trim($data['name']), 2);
                $customer_data = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'first_name' => $names[0], // First word as first_name
                    'last_name' => isset($names[1]) ? $names[1] : '', // Remaining words as last_name or empty string if not provided
                ];
                // Create new customer
                $customer = Customer::create($customer_data);
            }
            
            $carPrice=CarPrice::find($data['car_prices_id']);
            $amount=$carPrice->price;
            
            $payment_data=[
                'payment_way_id'=>$data['payment_way_id'],
                'payment_method_id'=>$data['payment_method_id'],
                'amount'=>  $amount,
                'discount'=>10,
                'total'=>$amount-($amount*(10/100)),
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'card_number'=>$data['card_number'],
                'security_code'=>$data['security_code'],
                'end_date_month'=>$data['end_date_month'],
                'end_date_year'=>$data['end_date_year'],
            ];
            $payment=PaymentData::create($payment_data);
            $formattedDate = Carbon::createFromFormat('d-m-Y', $data['date'])->format('Y-m-d');

            $book_data=[
                'type'=>$data['type'],
                'customer_id'=>$customer->id,
                'car_prices_id'=>$data['car_prices_id'],
                'payment_way_id'=>$data['payment_way_id'],
                'payment_method_id'=>$data['payment_method_id'],
                'payment_data_id'=>$payment->id,
                'go_only'=>$data['go_only'],
                'go_and_return'=>$data['go_and_return'],
                'notes'=>$data['note'],
                'status'=>'pending',
                'amount'=>  $amount,
                'time'=> $data['time'],
                'date'=>$formattedDate ,
                'discount'=>10,
                'total'=>$amount-($amount*(10/100)),
            ];

            $book=Booking::create($book_data);
            
            //---------
        

        }

      if($data['type']==='per_hour'){
        if ($request->has('ticket_image	'))
        $data['ticket_image	'] = uploadImageToDirectory($request->file('ticket_image'), "Tickets_booking");
      
        $customer = Customer::where('email', $data['email'])->first();

        if (!$customer) {
            $names = explode(' ', trim($data['name']), 2);
            $customer_data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'first_name' => $names[0], // First word as first_name
                'last_name' => isset($names[1]) ? $names[1] : '', // Remaining words as last_name or empty string if not provided
            ];
            // Create new customer
            $customer = Customer::create($customer_data);
        }
        
        $carPrice=CarPrice::find($data['car_prices_id']);
        $amount=$carPrice->price;
        
        $payment_data=[
            'payment_way_id'=>$data['payment_way_id'],
            'payment_method_id'=>$data['payment_method_id'],
            'amount'=>  $amount,
            'discount'=>10,
            'total'=>$amount-($amount*(10/100)),
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'card_number'=>$data['card_number'],
            'security_code'=>$data['security_code'],
            'end_date_month'=>$data['end_date_month'],
            'end_date_year'=>$data['end_date_year'],
        ];
        $payment=PaymentData::create($payment_data);
        $formattedDate = Carbon::createFromFormat('d-m-Y', $data['date'])->format('Y-m-d');
        $book_data=[
            'type'=>$data['type'],
            'customer_id'=>$customer->id,
            'car_prices_id'=>$data['car_prices_id'],
            'payment_way_id'=>$data['payment_way_id'],
            'payment_method_id'=>$data['payment_method_id'],
            'payment_data_id'=>$payment->id,
            'notes'=>$data['note'],
            'status'=>'pending',
            'amount'=>  $amount,
            'time'=> $data['time'],
            'time_hours'=> $data['time_hours'],

            'date'=>$formattedDate ,
            'discount'=>10,
            'total'=>$amount-($amount*(10/100)),
        ];

        $book=Booking::create($book_data);
        
        //---------
    

    }

    if($data['type']==='per_package'){

      
        $customer = Customer::where('email', $data['email'])->first();

        if (!$customer) {
            $names = explode(' ', trim($data['name']), 2);
            $customer_data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'first_name' => $names[0], // First word as first_name
                'last_name' => isset($names[1]) ? $names[1] : '', // Remaining words as last_name or empty string if not provided
            ];
            // Create new customer
            $customer = Customer::create($customer_data);
        }
        
        $package=Packages::find($data['package_id']);
        $amount=$package->price;
        
        $payment_data=[
            'payment_way_id'=>$data['payment_way_id'],
            'payment_method_id'=>$data['payment_method_id'],
            'amount'=>  $amount,
            'discount'=>10,
            'total'=>$amount-($amount*(10/100)),
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'card_number'=>$data['card_number'],
            'security_code'=>$data['security_code'],
            'end_date_month'=>$data['end_date_month'],
            'end_date_year'=>$data['end_date_year'],
        ];
        $payment=PaymentData::create($payment_data);
        $formattedDate = Carbon::createFromFormat('d-m-Y', $data['date'])->format('Y-m-d');

        $book_data=[
            'type'=>$data['type'],
            'customer_id'=>$customer->id,
            'package_id'=>$data['package_id'],
            'payment_way_id'=>$data['payment_way_id'],
            'payment_method_id'=>$data['payment_method_id'],
            'payment_data_id'=>$payment->id,
            'status'=>'pending',
            'amount'=>  $amount,
            'time'=> $data['time'],
            'date'=>$formattedDate ,
            'discount'=>10,
            'total'=>$amount-($amount*(10/100)),
        ];

        $book=Booking::create($book_data);
        
        //---------
    

    }
}

    public function filterPertrip(Request $request)
    {
 
        $data=$request->validate([
            'type' => ['required', 'in:per_trip,per_hour,per_package,booking_start'],
            'go_only' => ['sometimes', 'boolean'],
            'go_and_return' => ['sometimes', 'boolean'],
            'from' => ['required_if:type,per_trip'],
            'city' => ['required_if:type,per_hour'],
            'to' => ['required_if:type,per_trip'],
            'date' => ['required_if:type,per_trip,required_if:type,per_hour'],
            'time' => ['required_if:type,per_trip,required_if:type,per_hour'],
            'Passenger_count' => ['required_if:type,per_trip,required_if:type,per_hour'],
            'time_hours' => ['required_if:type,per_hour'],

        ]);

        $carPriceQuery=CarPrice::query();
         // Apply filters based on the request data
         $carPriceQuery->where('statue', 1);

        if ($data['type'] === 'per_trip') {
            $carPriceQuery->where('statue', 1);

            $carPriceQuery->where('type', 'per_trip');

            if (!empty($data['from'])) {
                $carPriceQuery->where('from', $data['from']);
            }

            if (!empty($data['to'])) {
                $carPriceQuery->where('to', $data['to']);
            }

            if (!empty($data['Passenger_count'])) {
                $carPriceQuery->join('cars', 'cars.id', '=', 'car_prices.car_id')
                ->where('cars.passengers_counts', '>=', $data['Passenger_count'])
                ->orderBy('car_prices.created_at', 'desc')
                ->select('car_prices.*', 'cars.passengers_counts'); // Select specific columns from both tables
        }
        }
        
        if ($data['type'] === 'per_hour') {
            $carPriceQuery->where('statue', 1);
            $carPriceQuery->where('type', 'per_hour');
            if (!empty($data['city'])) {
                $carPriceQuery->where('city', $data['city']);
            }

            if (!empty($data['Passenger_count'])) {
                $carPriceQuery->join('cars', 'cars.id', '=', 'car_prices.car_id')
                ->where('cars.passengers_counts', '>=', $data['Passenger_count'])
                ->orderBy('car_prices.created_at', 'desc')
                ->select('car_prices.*', 'cars.passengers_counts'); // Select specific columns from both tables
        }
        }
    // Retrieve the filtered results
          $carPrices = $carPriceQuery->with('cars')->get();

         return $this->success('',  carspriceResources::collection($carPrices));
    }

    public function filterPackages(Request $request)
    {
       $data= $request->validate([
            'package_categories_id' => 'required',
            'packagesub_categories_id' => 'nullable',

        ]);
        $packages=Packages::query();
        $packages->where('statue', 1);
 
        $currentDate = now()->format('Y-m-d');  // Get the current date in 'YYYY-MM-DD' format
         $packages->whereDate('from_time', '<=', $currentDate)
                 ->whereDate('to_time', '>=', $currentDate);
   
        if ($data['package_categories_id'] !== null) {

         $packages->where('package_categories_id',$data['package_categories_id']);
        }
        // Conditionally filter by 'packagesub_categories_id' if it's provided
        if ($data['packagesub_categories_id'] !== null) {
            $packages->where('packagesub_categories_id', $data['packagesub_categories_id']);
        }


        $filterpackages = $packages->get();
        return $this->success('', packagesResources::collection($filterpackages));
    }
    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
