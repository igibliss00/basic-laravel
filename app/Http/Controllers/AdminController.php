<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function __contruct(){
        $this->middleware('IsAdmin');
    }
    
    public function index(){
        return "You are seeing this page because you're an administrator.";
    }
}
