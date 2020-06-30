<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dominios;
use DB;
use Carbon\Carbon;
use Crypt;
use Illuminate\Support\Facades\Auth;
class DominiosController extends Controller
{

    public function index(Request $request)
    {

        if($request->get('filtroEstado') == ""){
            $dominios = DB::table('Dominios')
                    ->select('domID', 'domNom', 'domDes', 'domEst')
                    ->paginate(5);
        }elseif($request->get('filtroEstado') == "activo"){
            $dominios = DB::table('Dominios')
                    ->select('domID', 'domNom', 'domDes', 'domEst')
                    ->where('domEst', '1')
                    ->paginate(5);
        }elseif($request->get('filtroEstado') == "noactivo"){
            $dominios = DB::table('Dominios')
                    ->select('domID', 'domNom', 'domDes', 'domEst')
                    ->where('domEst', '0')
                    ->paginate(5);
        }
        $cantidad = DB::table('Dominios')
                    ->select('domID', 'domNom', 'domDes', 'domEst')
                    ->get();

        return view('parametros-sistema.dominios.home-dominios', compact(['dominios', 'cantidad']));
    }


    public function create()
    {
        return view('parametros-sistema.dominios.anadir-dominios');
    }


    public function store(Request $request)
    {
        //echo "hola";
        $nombre = request('anadir-nombre-dom');
        $descripcion = request('anadir-descripcion-dom');

        if($request->get('anadir-estado-dom')==NULL){
            $estado = '0';
        }else{
            $estado = '1';
        }
        Dominios::create([
            'domNom' => strtoupper(trim($nombre)),
            'domDes' => strtoupper(trim($descripcion)),
            'domEst' => trim($estado),
            'domUsuCrea' => Auth::id(),
            'domFecCrea'=> date(Carbon::now())
        ]);

        return redirect()->route('dominios')->with('status', 'Los datos han sido guardados.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('dominios')->with('status', 'Hubo un error desconocido');
        }
        return view('parametros-sistema.dominios.editar-dominios', [
            'domEdit' => $codigo
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('dominios')->with('status', 'Hubo un error desconocido');
        }
        $domN = Dominios::where('domID', $codigo)->firstOrFail();
        $domN->domNom = (string) strtoupper($request->get('anadir-nombre-dom'));
        $domN->domDes = (string) strtoupper($request->get('anadir-descripcion-dom'));
        $domN->domUsuMod = Auth::id();
        $domN->domFecMod = date(Carbon::now());

        if($request->get('anadir-estado-dom')==NULL){
            $domN->domEst = trim('0');
        }else{
            $domN->domEst = trim('1');
        }

        $domN->save();
        return redirect()->route('dominios');
    }


    public function destroy($id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('dominios')->with('status', 'Hubo un error desconocido');
        }
        $domD = Dominios::where('domID', $codigo)->firstOrFail();
        $domD->delete();
        return redirect('dominios')->with('status', 'El dato ha sido borrado');
    }
}
