<?php

namespace App\Http\Controllers;

use App\Model\Management;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    
    public function index()
    {
        return view('managements.management', [
            'module' => 'management',            
            'view' => 'index',
            'managements' => Management::paginate(20),
        ]);
    }

}
