<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Info;
use App\Models\Agenda;
use App\Models\ActivityLog; // Tambahkan model ActivityLog jika Anda punya

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total pengguna, galeri, info, dan agenda
        $userCount = User::count();
        $galleryCount = Gallery::count();
        $infoCount = Info::count();
        $agendaCount = Agenda::count();

        // Ambil log aktivitas terbaru, dibatasi 5 terakhir
        $activities = ActivityLog::latest()->take(5)->get(); // Ganti dengan model log aktivitas yang ada

        return view('admin.dashboard', compact('userCount', 'galleryCount', 'infoCount', 'agendaCount', 'activities'));
    }
}
