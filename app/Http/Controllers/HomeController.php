<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Bisa tambahkan data tambahan jika diperlukan
        $welcomeMessage = "Welcome to the Gallery Web Application!";
        
        // Tampilkan view 'home'
        return view('home.index', compact('welcomeMessage'));
    }
}
