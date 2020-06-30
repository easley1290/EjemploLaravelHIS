<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function index()
    {
        $emp = Empresa::All();
        return view('empresa.home-empresa', compact('emp'));
    }
}
