<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    //
    function index()
    {
        return '<h1>SAYA SISWA dari controller </h1>';
    }
    function detail($id) 
    {
        return "<h1>SAYA SISWA dari controller dengan ID $id</h1>";
    }
}
