<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KontributorController extends Controller
{
    public function index()
    {
        return view('admin.master.contributor.index');
    }
}
