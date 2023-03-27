<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    // public function __construct(){
    //     $this->middleware(['auth']);
    // }

public function create(){
    return view('contents.dashboard');
}
public function index(){

}
}
