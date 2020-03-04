<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    /**
      * Display the administration page
      *
      * @return \Illuminate\Http\Response
      *
      * @author Butticaz Yvann
      */

      public function index(){
        return view('administrations.index');
    }

}
