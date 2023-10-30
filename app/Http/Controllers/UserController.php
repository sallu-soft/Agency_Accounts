<?php

namespace App\Http\Controllers;
use App\Models\Candidates;
use App\Models\Visa;
use App\Models\User;
use App\Models\Agent;
use App\Models\Passenger;
use App\Models\Company;
use App\Models\VisaSell;
use App\Models\Purchase;
use App\Models\ThirdParty;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
   public function index(Request $request){

    if(Session::get('user')){
        if($request->isMethod('GET')){
            $agent = Agent::where('user', session('user_id'))->get();
            $passengers = Passenger::where('user', session('user_id'))->get();
            $companys = Company::where('user', session('user_id'))->get();
            $visas = Visa::where('user', session('user_id'))->get();
            $visa_sell = VisaSell::where('user', session('user_id'))->get();
            foreach($passengers as $passenger){
                $passenger->agent = (Agent::where('id', $passenger->agent)->value('name'));
            }
            foreach($visas as $visa){
                $visa->company = (Company::where('id', $visa->company)->value('name'));
            }
            return view('user.index', compact('agent', 'passengers', 'companys', 'visas', 'visa_sell'));
        }
        else {
            DB::beginTransaction();
            $response = [
                'redirect_url' => 'user/index',
            ];
        
            try {
                // dd($request->all());
                $agent = new Agent();
                $agent->name = $request['pname'];
                $agent->phone = $request['pnumber'];
                $agent->address = $request['address'];
                $agent->user = session('user_id');
                if ($request->hasFile('image_file')) {
                    $imageName = uniqid() . '.' . $request->file('image_file')->getClientOriginalExtension();
                    $request->file('image_file')->move(public_path('images'), $imageName);
                    $agent->photo = $imageName;
                }
                
                if ($request->hasFile('id_card')) {
                    $imageName2 = uniqid() . '.' . $request->file('id_card')->getClientOriginalExtension();
                    $request->file('id_card')->move(public_path('images'), $imageName2);
                    $agent->id_card = $imageName2;
                }
        
                // Save the agent
                if ($agent->save()) {
                    DB::commit();
                    $response['title'] = 'Success';
                    $response['success'] = true;
                    $response['icon'] = 'success';
                    $response['message'] = 'Successfully created';
                } else {
                    $response['title'] = 'Error';
                    $response['success'] = false;
                    $response['icon'] = 'error';
                    $response['message'] = 'Cannot add';
                }
            } catch (\Exception $e) {
                DB::rollback();
                $response['title'] = 'Error';
                $response['success'] = false;
                $response['icon'] = 'error';
                $response['message'] = $e->getMessage(); // Get the actual error message
            }
        
            return response()->json($response);
        }
        
    }
    else{
        // return view('welcome');
        return response()->json([
            'title'=> 'Error',
            'success' => false,
            'icon' => 'error',
            'message' => 'Login Required',
            'redirect_url' => '/'
        ]);
    }
       
   }

   public function logout(){
        session()->flush();
        return redirect(url('/'));
   }
   public function view($id)
   {
      
   }

   public function delete($id)
   {
      
   }

   public function visa_add(Request $request, $id)
   {
        if(Session::get('user')){
            if($request->isMethod('GET')){

                return view('user.addvisa', ['id' => $id]);
                }
                else{
        
                $visa = new Visa();
        
                $visa->visa_no = strtoupper($request->input('visa_no'));
                $visa->candidate_id = $id;
                $visa->visa_date2 = strtoupper($request->input('visa_date'));
                $visa->spon_id = strtoupper($request->input('spon_id'));
                $visa->spon_name_arabic = strtoupper($request->input('spon_name_arabic'));
                $visa->salary = strtoupper($request->input('salary'));
                $visa->spon_name_english = strtoupper($request->input('spon_name_english'));
                $visa->prof_name_arabic = strtoupper($request->input('prof_name_arabic'));
                $visa->prof_name_english = strtoupper($request->input('prof_name_english'));
                $visa->mofa_no = strtoupper($request->input('mofa_no'));
                $visa->mofa_date = strtoupper($request->input('mofa_date'));
                $visa->okala_no = strtoupper($request->input('okala_no'));
                $visa->musaned_no = strtoupper($request->input('musaned_no'));
        
                $candidate = Candidates::find($id);
                $flag = Visa::where('candidate_id', $id)->exists();
                // dd(1,$request->all(), 2, $id, 3, $flag);
                if ($flag == false){
                    if($visa->save()){
                        return response()->json([
                            'title'=> 'Success',
                            'success' => true,
                            'icon' => 'success',
                            'message' => 'added succesfully',
                            'redirect_url' => 'user/index'
                        ]);
                    }
                    else{
                        return response()->json([
                            'title'=> 'Error',
                            'success' => false,
                            'icon' => 'error',
                            'message' => 'Cannot add',
                            'redirect_url' => 'user/index'
                        ]);
                    }
                }
                else{
                    return response()->json([
                        'title'=> 'Error',
                        'success' => false,
                        'icon' => 'error',
                        'message' => 'This candidate have a visa',
                        'redirect_url' => 'user/index'
                    ]);
                }
            }
        
            }
            else{
                return view('welcome');
            }

   }  
    
    public function embassy_list(){
        if(Session::get('user')){
            $candidates = DB::table('candidates')
                    ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                    ->select('candidates.*', 'visas.*')
                    ->where('candidates.agency', '=', Session::get('user'))
                    ->get();
        // dd($candidates);
            return view('user.embassy_list', compact('candidates'));
        }
        else{
            return view('welcome');
        }
        
    }

    public function edit($id, Request $request){
        if(Session::get('user')){
            if($request->isMethod('GET')){
                $candidates = Agent::where('id', $id)->get();
                // dd($candidates);        
                return view('user.edit', compact('id', 'candidates'));
            }
        }
        else{
            return view('welcome');
        }
        
    }

    public function personal_edit($id, Request $request){
        // dd(1, $id, 2, $request->all());
        if(Session::get('user')){
            $candidate = Agent::where('id', $id)->first();
            if($candidate){
            $candidate->name = strtoupper($request->pname);
            $candidate->phone = strtoupper($request->pnumber);
            $candidate->address = strtoupper($request->address);

            if ($request->hasFile('image_file')) {
                $imageName = uniqid() . '.' . $request->file('image_file')->getClientOriginalExtension();
                $request->file('image_file')->move(public_path('images'), $imageName);
                $candidate->photo = $imageName;
            }
            
            if ($request->hasFile('id_card')) {
                $imageName2 = uniqid() . '.' . $request->file('id_card')->getClientOriginalExtension();
                $request->file('id_card')->move(public_path('images'), $imageName2);
                $candidate->id_card = $imageName2;
            }
            // dd($candidate->save());
            if($candidate->save()){
                return response()->json([
                    'title'=> 'Success',
                    'success' => true,
                    'icon' => 'success',
                    'message' => 'Edited succesfully',
                    'redirect_url' => 'user/index'
                ]);
            }
            else{
                return response()->json([
                    'title'=> 'Error',
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'Cannot edit',
                    'redirect_url' => 'user/index'
                    
                ]);
            }
        }
            else{
                return response()->json([
                    'title'=> 'Error',
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'Candidate does not exist',
                    'redirect_url' => 'user/index'
                ]);
            }
        }
        else{
            return view('welcome');
        }
        
    }

    public function visa_edit($id, Request $request){
        if(Session::get('user')){
            $visa = Visa::where('candidate_id', $id)->first();
            // dd($visa,2, $id);
            if($visa){
                $visa->visa_no = $request->input('visa_no');
                $visa->candidate_id = $id;
                $visa->visa_date2 = $request->input('visa_date');
                $visa->spon_id = $request->input('spon_id');
                $visa->spon_name_arabic = $request->input('spon_name_arabic');
                $visa->salary = $request->input('salary');
                $visa->spon_name_english = $request->input('spon_name_english');
                $visa->prof_name_arabic = $request->input('prof_name_arabic');
                $visa->prof_name_english = $request->input('prof_name_english');
                $visa->mofa_no = $request->input('mofa_no');
                $visa->mofa_date = $request->input('mofa_date');
                $visa->okala_no = $request->input('okala_no');
                $visa->musaned_no = $request->input('musaned_no');
                // dd($visa->save());
                if($visa->save()){
                    return response()->json([
                        'title'=> 'Success',
                        'success' => true,
                        'icon' => 'success',
                        'message' => 'Successfully Updated Visa',
                        'redirect_url' => 'user/index'
                    ]);
                }
                else{
                    return response()->json([
                        'title'=> 'Error',
                        'success' => false,
                        'icon' => 'error',
                        'message' => 'Cannot edit',
                        'redirect_url' => 'user/index'
                    ]);
                }
            }
            else{
               
                    return response()->json([
                        'title'=> 'Error',
                        'success' => false,
                        'icon' => 'error',
                        'message' => 'Visa Not Found ',
                        'redirect_url' => 'user/index'
                    ]);
               
            }
        }
        else{
            return view('welcome');
        }
        
    }

    public function update(Request $request){
        if(Session::get('user')){
            $name = request('uname');
            $phn = request('wsphn');
            $arabic_name = request('arabic_name');
            $agphn = request('phone');
            $email = session('user');
            $user = User::where('email', $email)->first();
            if($user){

                if(!empty($arabic_name) && !empty($agphn)){
                    $user->embassy_man_name = $name;
                    $user->embassy_man_phone = $phn;
                    $user->phone = $agphn;
                    $user->arabic_name = $arabic_name;
                }
                else{
                    $user->embassy_man_name = $name;
                    $user->embassy_man_phone = $phn;
                }
                
                if($user->save()){
                    return redirect()->route('user/index')->with('success', 'User created successfully');
    
                }
                else{
                    return response()->json([
                        'title'=> 'Error',
                        'success' => false,
                        'icon' => 'error',
                        'message' => 'Internal error',
                        
                    ]);
                }
            }
            else{
                return response()->json([
                    'title'=> 'Error',
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'User Not Found ',
                    
                ]);
            }
        }
        else{
            return view('welcome');
        }
        // dd($request->all());
        
    }  

    public function printer($id){
        if(Session::get('user')){
            $candidates = DB::table('candidates')
            ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
            ->select('candidates.*', 'visas.*')->where('candidates.id', '=', $id)
            ->get();
    
    
            $agencyemail = Session::get('user');
            $agency = User::select('*')->where('email', '=', $agencyemail)->get();
            // dd(1,$candidates, $agency);        
            return view('user.print', compact('id', 'candidates', 'agency'));
        }
        else{
            return view('welcome');
        }
        
    }

    public function get(){
        $candidates = DB::table('candidates')
            ->where('is_delete', '=', 0)
            ->pluck('agency', 'passport_number');
        
        $users = DB::table('user')
            ->where('is_delete', '=', 0)
            ->select('licence_name', 'rl_no', 'email')
            ->get();
        
        $userData = [];
        
        foreach ($users as $user) {
            $userData[$user->email] = [
                'licence_name' => $user->licence_name,
                'rl_no' => $user->rl_no,
            ];
        }
        // dd($candidates);
        $data = [
            'candidates' => $candidates,
            'users' => $userData
        ];

        // Return the combined data as a JSON response
        return response()->json($data);
    }

    public function checkPassport($passport)
    {
        $exists = false;
        $exists = Passenger::where('passport', $passport)->exists();
        return response()->json(['exists' => $exists]);
    }
    public function passenger(Request $request)
    {
        if ($request->isMethod('POST')) {
            // dd($request->all());
            $validatedData = $request->validate([
                'passenger_name' => 'required|string|max:255',
                'pnumber' => 'required|string|max:225',
                'address' => 'nullable|string|max:255',
                'agent' => 'required|string|max:255',
                'passport' => 'required|string|max:9',
                'passport_issue' => 'required|string',
                'passport_expire' => 'required|string',
                'dob' => 'required|string',
                'gender' => 'required|string',
            ]);
            if($validatedData){
                $passenger = new Passenger();
                $passenger->passenger_name = $request['passenger_name'];
                $passenger->pnumber = $request['pnumber'];
                $passenger->address = $request['address'];
                $passenger->gender = $request['gender'];
                $passenger->dob = $request['dob'];
                $passenger->passport_issue = $request['passport_issue'];
                $passenger->passport_expire = $request['passport_expire'];
                $passenger->agent = $request['agent'];
                $passenger->passport = $request['passport'];
                $passenger->user = session('user_id');
                if ($request->hasFile('image_file')) {
                    $imageName = uniqid() . '.' . $request->file('image_file')->getClientOriginalExtension();
                    $request->file('image_file')->move(public_path('images'), $imageName);
                    $passenger->image_file = $imageName;
                }
                
                if ($request->hasFile('passport_pic')) {
                    $imageName2 = uniqid() . '.' . $request->file('passport_pic')->getClientOriginalExtension();
                    $request->file('passport_pic')->move(public_path('images'), $imageName2);
                    $passenger->passport_pic = $imageName2;
                }

                if ($passenger->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Passenger has been added successfully.'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to add the passenger.'
                    ]);
                }
            }
            
            // return redirect()->route('success.page');
        }

    // Handle other HTTP methods (GET, etc.) here if needed
    }

    public function company(Request $request){
        // dd(session('user_id')   );
        if ($request->isMethod('POST')) {
            $validatedData = $request->validate([
                'company_name' => 'required|string|max:255',
            ]);
            if($validatedData){
                $company = new Company();
                $company->name = $request['company_name'];
                $company->type = $request['company_type'];
                $company->description = $request['description'];
                $company->user = session('user_id');
                if ($company->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'company has been added successfully.'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to add the company.'
                    ]);
                }
            }
            else{
                return redirect()->route('user/index')->with('error', 'Fill the input field properly.');
            }
        }
    }

    public function visa(Request $request){
        if ($request->isMethod('POST')) {
            // dd($request->all());
            $validatedData = $request->validate([
                'buy_form' => 'required|string|max:255',
                'company' => 'required',
                'country' => 'required|string|max:255',
                'total_tk' => 'required|string|max:255',
                'quantity' => 'required|string|max:255',
                'invoice' => 'required|string|max:255',
            ]);
            if($validatedData){

                $visa = new Visa();
                $visa->buy_form = $request['buy_form'];
                $visa->company = $request['company'];
                $visa->country = $request['country'];
                $visa->worker_salary = $request['salary'];
                $visa->prof_name = $request['prof_name'];
                $visa->purchase_tk = $request['total_tk'];
                $visa->quantity = $request['quantity'];
                $purchase_tk = (float) $request['total_tk'];
                $quantity = (float) $request['quantity'];
                $per_visa = $purchase_tk / $quantity;
                $per_visa = round($per_visa, 4);
                $visa->user = session('user_id');
                $visa->per_visa = $per_visa;
                $visa->invoice = $request['invoice'];
                if ($visa->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Visa has been added successfully.'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to add the Visa.'
                    ]);
                }
            }
            else{
                return redirect()->route('user/index')->with('error', 'Fill the input field properly.');
            }
        }
    }

    public function loadinvoice($company)
    {
        $invoices = Visa::where([['user', session('user_id')],['company', $company]])->get();
        return response()->json($invoices);
    }
    public function loadpassanger($agent)
    {
        $passengers = Passenger::where([['user', session('user_id')], ['agent', $agent]])->where('get_visa', 0)->get();
        return response()->json($passengers);
    }
    public function loadumra($agent)
    {
        $passengers = Passenger::where('agent', $agent)
            ->where('get_urma', 0)
            ->where('user', session('user_id'))
            ->get();
        return response()->json($passengers);
    }
    public function loadhajj($agent)
    {
        // $passengers = Passenger::where([['agent', $agent],['get_hajj'],0],['user', session('user_id')],)->get();
        $passengers = Passenger::where('agent', $agent)
            ->where('get_hajj', 0)
            ->where('user', session('user_id'))
            ->get();
        return response()->json($passengers);
    }
    public function loadvisadetails($id)
    {
        $visa = Visa::where('id', $id)->get();
        return response()->json($visa);
    }
    public function visa_sell(Request $request){
        // dd($request->all(), session('user_id'));

        if($request['available_visa'] >= $request['sellquantity']){
            $flag = false;

            $visa_sell = new VisaSell();
            $visa_sell->user = session('user_id');
            $visa_sell->company = $request['company'];
            $visa_sell->visa    = $request['invoiceoption'];
            $visa_sell->agent   = $request['agent'];
            $visa_sell->passanger = $request['sellpassenger'];
            $visa_sell->sell_price = $request['price'];
            $visa_sell->quantity = $request['sellquatity'];
            $visa_sell->total    = $request['total'];
    
            $per_visa_price      = $request['price_per_visa'];
            $actualcost          = $per_visa_price*$request['sellquatity'];
            // dd($actualcost, $request['price_per_visa'],$request['total'] );
            $profit              = $request['total']-$actualcost;
            $visa_sell->profit   = $profit;

            $company             = Company::find($request['company']);
            $company_profit      = $company->profit + $profit;
            $company->profit     = $company_profit;
            $company->save();

            $flag = $visa_sell->save();
            if($flag){
                $visa = Visa::find($request['invoiceoption']);
                $new_quantity  = $request['available_visa'] - $request['sellquatity'];
                $visa->quantity = $new_quantity;
                $new_profit    = $visa->profit + $profit;
                $visa->profit  = $new_profit;
                // dd($new_quantity, $request['available_visa'], $request['sellquatity']);
                $flag = $visa->save();

                $passenger = Passenger::find($request['sellpassenger']);
                $passenger->get_visa = 1;
                $passenger->save();
            }
            if($flag){
                return redirect()->route('user/index')->with('success', 'Visa has been selled successfully.');
            }
            else{
                return redirect()->route('user/index')->with('error', 'Error occured.');
            }
           
        }
        else{
            return redirect()->route('user/index')->with('error', 'Please give e valid quantity, not available visa');
        }
       
    }

    public function purchase(Request $request){
        // dd($request->all());
        if($request){
            $purchase = new Purchase();
            $purchase->type = $request['type'];
            $purchase->agent = $request['agentpurchase'];
            $purchase->passanger = $request['sellpassengerpurchase'];
            $purchase->deal_price = $request['deal_price_umra'];
            $purchase->order_id = $request['order_id'];
            $purchase->user  = (session('user_id'));
            $flag = $purchase->save();
            if ($flag) {
                if ($request['type'] == 'umra') {
                    $passenger = Passenger::find($request['sellpassengerpurchase']);
                    if ($passenger) {
                        $passenger->get_urma = 1;
                        $flag = $passenger->save();
                    } else {
                        // Handle the case where the passenger was not found.
                        return redirect()->route('user/index')->with('error', 'Passenger not found.');
                    }
                } elseif ($request['type'] == 'hajj') {
                    $passenger = Passenger::find($request['sellpassengerpurchase']);
                    if ($passenger) {
                        $passenger->get_hajj = 1;
                        $flag = $passenger->save();
                    } else {
                        // Handle the case where the passenger was not found.
                        return redirect()->route('user/index')->with('error', 'Passenger not found.');
                    }
                } else {
                    // Handle the case where the 'type' is neither 'umra' nor 'hajj'.
                    return redirect()->route('user/index')->with('error', 'Invalid type.');
                }
            
                if ($flag) {
                    return redirect()->route('user/index')->with('success', 'Order taken successfully.');
                } else {
                    return redirect()->route('user/index')->with('error', 'Error occurred.');
                }
            } else {
                return redirect()->route('user/index')->with('error', 'Error occurred.');
            }
            
        }
    
    }

    public function searchOrder(Request $request) {
        $order_id = $request->input('order_id');
        
        $order = Purchase::where('order_id', $order_id)->first();
    
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        $passenger = Passenger::find($order->passanger);
        $agent = Agent::find($passenger->agent);
        $agents = Agent::where('user', session('user_id'))->get();
        $companys = Company::where('type', $order->type)->get();

        $thirdparty = ThirdParty::where('order_id', $order_id)->get();
        $data = [
            'order' => $order,
            'passenger' => $passenger->passenger_name . " [" . $passenger->passport . "]",
            'agent' => $agent->name,
        ];
        if (!$thirdparty->isEmpty()) {
            return view('user/order', compact('data', 'agents', 'companys', 'thirdparty'));
        } else {
            return view('user/order', compact('data', 'agents', 'companys'));
        }
    }
    
    public function confirmOrder(Request $request)
    {
        $dealPrice = $request->input('dealPrice');
        $finalPrice = $request->input('finalPrice');
        
        if ($finalPrice) {
            $agentName = $request->input('agentName');
            $passengerName = $request->input('passengerName');
            $travelType = $request->input('travelType');
            $purchaseOrder = $request->input('purchaseOrder');
            $orderID = $request->input('order_id');

            $order = Purchase::find($orderID);
            $prev_given = $order->deal_after;
            $prev_given = $prev_given + $finalPrice;
            $profit =  $prev_given - $dealPrice;
            $order->deal_after = $prev_given;
            $order->profit = $profit;
            $order_id = $order->order_id;

            $temp = ThirdParty::where('order_id', $order_id)->first();
            $given = $temp->given;
            $total_given = $given + $finalPrice;
            $profit = $total_given - $temp->deal;
            $temp->given = $total_given;
            $temp->profit = $profit;

            $order->save();
            $temp->save();

            // Redirect with a success message
            return redirect()->route('user/index')->with('success', 'Order confirmed successfully');
        } else {
            // dd('as');
            return redirect()->route('user/index')->with('error', 'Final price must be greater than the deal price');
        }
    }

    public function thirdpartypurchase(Request $request){
        // dd(ThirdParty::where('order_id', $request['order_id_third']))->first();
        if (ThirdParty::where('order_id', $request['order_id_third'])->first()) {
            $temp = ThirdParty::where('order_id', $request['order_id_third'])->first();
            $temp->company = $request['thirdcompany'];
            $temp->deal    = $request['deal_price_third'];
            $given   = $request['deal_price_given'];
            $prev_given = $request['prev_given'];
            $total_given = $prev_given+$given;
            $temp->given = $total_given;
            $temp->order_id = $request['order_id_third'];
            $temp->agent    = $request['agentNamethird'];
            $temp->user  = (session('user_id'));

            if (!empty($request['deal_price_given'])) {
                $profit = $total_given - $request['deal_price_third'];
                $temp->profit = $profit;
            } else {
                $temp->profit = null; // or a default value
            }
            if ($temp->save()) {
                return redirect()->route('user/index')->with('success', 'Order saved successfully');
            } else {
                return redirect()->route('user/index')->with('error', 'Failed to save data');
            }
        }
        else{
            $thirdparty = new ThirdParty();
            $thirdparty->company = $request['thirdcompany'];
            $thirdparty->deal    = $request['deal_price_third'];
            $given   = $request['deal_price_given'];
            $prev_given = $request['prev_given'];
            $total_given = $prev_given+$given;
            $thirdparty->given = $total_given;
            $thirdparty->order_id = $request['order_id_third'];
            $thirdparty->agent    = $request['agentNamethird'];
            $thirdparty->user  = (session('user_id'));

            $order = Purchase::where('order_id', $request['order_id_third'])->first();
            $order->deal_after = $request['deal_price_given'];
            $dealPrice = $order->deal_price;
            $profit =  $request['deal_price_given'] - $dealPrice;
            $order->profit = $profit;
            $order->save();
    
            if (!empty($request['deal_price_given'])) {
                $profit = $total_given - $request['deal_price_third'];
                $thirdparty->profit = $profit;
            } else {
                $thirdparty->profit = null; // or a default value
            }
            
            if ($thirdparty->save()) {
                return redirect()->route('user/index')->with('success', 'Order saved successfully');
            } else {
                return redirect()->route('user/index')->with('error', 'Failed to save data');
            }
        }
    }

}
