<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Company;
use App\Models\Passenger;
use App\Models\Visa;
class FixController extends Controller
{
    
   
    public function agency()
    {
        
        $user_id = session('user_id');
        $agent = Agent::where('user', $user_id)->get();
        return view('layout.agency', compact('agent'));
    }

    public function company()
    {
        
        $user_id = session('user_id');
        $company = Company::where('user', $user_id)->get();

        return view('layout.company', compact('company'));
    }

    public function passenger()
    {
        
$user_id = session('user_id');
        $agent = Agent::where('user', $user_id)->get();
        $passengers = Passenger::where('user', $user_id)->get();
        return view('layout.passenger', compact('agent', 'passengers'));
    }

    public function visaPurchase()
    {
        
$user_id = session('user_id');
        $company = Company::where('user', $user_id)->get();
        $visa = Visa::where('user', $user_id)->get();
        $agent = Agent::where('user', $user_id)->get();
        return view('layout.visa_purchase', compact('company', 'visa', 'agent'));
    }
    public function visaSell()
    {
        
$user_id = session('user_id');
        $company = Company::where('user', $user_id)->get();
        $visa = Visa::where('user', $user_id)->get();
        $agent = Agent::where('user', $user_id)->get();
        return view('layout.visa_sell', compact('company', 'visa', 'agent'));
    }
    public function hajjSell()
    {
        
$user_id = session('user_id');
        $company = Company::where('user', $user_id)->get();
        $visa = Visa::where('user', $user_id)->get();
        $agent = Agent::where('user', $user_id)->get();
        return view('layout.hajj_sell', compact('company', 'visa', 'agent'));
    }

}
