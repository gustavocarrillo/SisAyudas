<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index()
    {
        return view('admin.panel.index');
    }
}
