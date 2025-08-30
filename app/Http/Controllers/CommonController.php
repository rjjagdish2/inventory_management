<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\ProductProfile;
use App\Models\Grade;
use App\Models\Order;

class CommonController extends Controller
{
    public function index(){
        $totalProducts = ProductProfile::count();
        $totalCustomers = Customer::count();
        $totalOrders = Order::count();
        $totalGrades = Grade::count();

        return view('dashboard',compact('totalProducts','totalCustomers','totalOrders','totalGrades'));
    }
}
