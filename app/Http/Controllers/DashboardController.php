<?php

namespace App\Http\Controllers;

use App\Models\Ftp;
use App\Models\Package;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_packages = Package::count();
        $total_ftps = Ftp::count();
        return view('admin.dashboard', compact('total_packages', 'total_ftps'));
    }
}
