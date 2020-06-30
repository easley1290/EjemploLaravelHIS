<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subdominios;
use App\Models\Dominios;
use DB;
use Carbon\Carbon;
use Crypt;
use Illuminate\Support\Facades\Auth;

class SubdominiosController extends Controller
{
    public function index(Request $request)
    {
        $dominios = DB::table('Dominios')
                    ->select('domID','domNom')
                    ->where('domEst', '1')
                    ->get();

        if($request->get('filtroDominio') == ""){
            if($request->get('filtroEstado') == ""){
                $sdominios = DB::table('Subdominios')
                        ->select('Dominios.domNom', 'Subdominios.subID', 'Subdominios.subNom', 'Subdominios.subDes', 'Subdominios.subEst')
                        ->join('Dominios', 'Dominios.domID', '=', 'Subdominios.domID_fk')
                        ->paginate(5);
            }elseif($request->get('filtroEstado') == "activo"){
                $sdominios = DB::table('Subdominios')
                        ->select('Dominios.domNom', 'Subdominios.subID', 'Subdominios.subNom', 'Subdominios.subDes', 'Subdominios.subEst')
                        ->join('Dominios', 'Dominios.domID', '=', 'Subdominios.domID_fk')
                        ->where('subEst', '1')
                        ->paginate(5);
            }elseif($request->get('filtroEstado') == "noactivo"){
                $sdominios = DB::table('Subdominios')
                        ->select('Dominios.domNom', 'Subdominios.subID', 'Subdominios.subNom', 'Subdominios.subDes', 'Subdominios.subEst')
                        ->join('Dominios', 'Dominios.domID', '=', 'Subdominios.domID_fk')
                        ->where('subEst', '0')
                        ->paginate(5);
            }
        }elseif ($request->get('filtroDominio') != "") {
            try {
                $codigo = Crypt::decrypt($request->get('filtroDominio'));
            } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                echo "error";
            }
            if($request->get('filtroEstado') == ""){
                $sdominios = DB::table('Subdominios')
                        ->select('Dominios.domNom', 'Subdominios.subID', 'Subdominios.subNom', 'Subdominios.subDes', 'Subdominios.subEst')
                        ->join('Dominios', 'Dominios.domID', '=', 'Subdominios.domID_fk')
                        ->where('domID_fk', $codigo)
                        ->paginate(5);
            }elseif($request->get('filtroEstado') == "activo"){
                $sdominios = DB::table('Subdominios')
                        ->select('Dominios.domNom', 'Subdominios.subID', 'Subdominios.subNom', 'Subdominios.subDes', 'Subdominios.subEst')
                        ->join('Dominios', 'Dominios.domID', '=', 'Subdominios.domID_fk')
                        ->where('subEst', '1')
                        ->where('domID_fk', $codigo)
                        ->paginate(5);
            }elseif($request->get('filtroEstado') == "noactivo"){
                $sdominios = DB::table('Subdominios')
                        ->select('Dominios.domNom', 'Subdominios.subID', 'Subdominios.subNom', 'Subdominios.subDes', 'Subdominios.subEst')
                        ->join('Dominios', 'Dominios.domID', '=', 'Subdominios.domID_fk')
                        ->where('subEst', '0')
                        ->where('domID_fk', $codigo)
                        ->paginate(5);
            }
        }

        $cantidad = DB::table('Subdominios')
                    ->select('subID', 'subNom', 'subDes', 'subEst')
                    ->get();

        return view('parametros-sistema.subdominios.home-subdominios', compact(['sdominios', 'cantidad', 'dominios']));
    }


    public function create()
    {
        $dominios = DB::table('Dominios')
                    ->select('domID','domNom')
                    ->where('domEst', '1')
                    ->get();

        return view('parametros-sistema.subdominios.anadir-subdominios', compact('dominios'));
    }


    public function store(Request $request)
    {
        //echo "hola";
        $nombre = request('anadir-nombre-sdom');
        $descripcion = request('anadir-descripcion-sdom');
        $dominio = request('anadir-dominio-sdom');
        $codigoAnterior = request('anadir-codanterior-sdom');
        if($request->get('anadir-estado-sdom')==NULL){
            $estado = '0';
        }else{
            $estado = '1';
        }
        Subdominios::create([
            'domID_fk' => (int) $dominio,
            'subNom' => strtoupper(trim($nombre)),
            'subDes' => strtoupper(trim($descripcion)),
            'subEst' => trim($estado),
            'subCodAnt' => $codigoAnterior,
            'subUsuCrea' => Auth::id(),
            'subFecCrea'=> date(Carbon::now())
        ]);

        return redirect()->route('subdominios')->with('status', 'Los datos han sido guardados.');
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
            return redirect()->route('subdominios')->with('status', 'Hubo un error desconocido');
        }

        $sdominios = DB::table('Subdominios')
                        ->select('Dominios.domNom', 'Subdominios.subID', 'Subdominios.domID_fk', 'Subdominios.subNom', 'Subdominios.subDes', 'Subdominios.subEst')
                        ->join('Dominios', 'Dominios.domID', '=', 'Subdominios.domID_fk')
                        ->where('subID', $codigo)
                        ->get();

        $dominios = DB::table('Dominios')
        ->select('domID','domNom')
        ->where('domEst', '1')
        ->get();
        //dd( $sdominios[0]);
        return view('parametros-sistema.subdominios.editar-subdominios', [
            'subEdit' => $sdominios[0],
            'dominios' => $dominios
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('dominios')->with('status', 'Hubo un error desconocido');
        }
        $subN = Subdominios::where('subID', $codigo)->firstOrFail();
        $subN->subNom = (string) strtoupper($request->get('anadir-nombre-sdom'));
        $subN->subDes = (string) strtoupper($request->get('anadir-descripcion-sdom'));
        $subN->domID_fk = (int) $request->get('anadir-dominio-sdom');
        $subN->subUsuMod = Auth::id();
        $subN->subFecMod = date(Carbon::now());

        if($request->get('anadir-estado-dom')==NULL){
            $subN->subEst = trim('0');
        }else{
            $subN->subEst = trim('1');
        }

        $subN->save();
        return redirect()->route('subdominios');
    }


    public function destroy($id)
    {

    }
}
