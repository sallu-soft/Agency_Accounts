<?php

namespace App\Http\Controllers;
use App\Models\Candidates;
use App\Models\Visa;
use App\Models\User;
use App\Models\Agent;
use App\Models\Passenger;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
   public function index(Request $request){

    if(Session::get('user')){
        if($request->isMethod('GET')){
            $agent = Agent::all();
            $passengers = Passenger::all();
            $companys = Company::all();
            $visas = Visa::all();
            foreach($passengers as $passenger){
                $passenger->agent = (Agent::where('id', $passenger->agent)->value('name'));
            }
            foreach($visas as $visa){
                $visa->company = (Company::where('id', $visa->company)->value('name'));
            }
            return view('user.index', compact('agent', 'passengers', 'companys', 'visas'));
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

//    public function visa_add(Request $request, $id)
//    {
//         if(Session::get('user')){
//             if($request->isMethod('GET')){

//                 return view('user.addvisa', ['id' => $id]);
//                 }
//                 else{
        
//                 $visa = new Visa();
        
//                 $visa->visa_no = strtoupper($request->input('visa_no'));
//                 $visa->candidate_id = $id;
//                 $visa->visa_date2 = strtoupper($request->input('visa_date'));
//                 $visa->spon_id = strtoupper($request->input('spon_id'));
//                 $visa->spon_name_arabic = strtoupper($request->input('spon_name_arabic'));
//                 $visa->salary = strtoupper($request->input('salary'));
//                 $visa->spon_name_english = strtoupper($request->input('spon_name_english'));
//                 $visa->prof_name_arabic = strtoupper($request->input('prof_name_arabic'));
//                 $visa->prof_name_english = strtoupper($request->input('prof_name_english'));
//                 $visa->mofa_no = strtoupper($request->input('mofa_no'));
//                 $visa->mofa_date = strtoupper($request->input('mofa_date'));
//                 $visa->okala_no = strtoupper($request->input('okala_no'));
//                 $visa->musaned_no = strtoupper($request->input('musaned_no'));
        
//                 $candidate = Candidates::find($id);
//                 $flag = Visa::where('candidate_id', $id)->exists();
//                 // dd(1,$request->all(), 2, $id, 3, $flag);
//                 if ($flag == false){
//                     if($visa->save()){
//                         return response()->json([
//                             'title'=> 'Success',
//                             'success' => true,
//                             'icon' => 'success',
//                             'message' => 'added succesfully',
//                             'redirect_url' => 'user/index'
//                         ]);
//                     }
//                     else{
//                         return response()->json([
//                             'title'=> 'Error',
//                             'success' => false,
//                             'icon' => 'error',
//                             'message' => 'Cannot add',
//                             'redirect_url' => 'user/index'
//                         ]);
//                     }
//                 }
//                 else{
//                     return response()->json([
//                         'title'=> 'Error',
//                         'success' => false,
//                         'icon' => 'error',
//                         'message' => 'This candidate have a visa',
//                         'redirect_url' => 'user/index'
//                     ]);
//                 }
//             }
        
//             }
//             else{
//                 return view('welcome');
//             }

//    }  
    
    public function embassy_list(){
        if(Session::get('user')){
            $candidates = DB::table('candidates')
                    ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                    ->select('candidates.', 'visas.')
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
            ->select('candidates.', 'visas.')->where('candidates.id', '=', $id)
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
            ]);
            if($validatedData){
                $passenger = new Passenger();
                $passenger->passenger_name = $request['passenger_name'];
                $passenger->pnumber = $request['pnumber'];
                $passenger->address = $request['address'];
                $passenger->agent = $request['agent'];
                $passenger->passport = $request['passport'];
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
        // dd($request->all());
        if ($request->isMethod('POST')) {
            $validatedData = $request->validate([
                'company_name' => 'required|string|max:255',
            ]);
            if($validatedData){
                $company = new Company();
                $company->name = $request['company_name'];
                $company->description = $request['description'];
              
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
}