<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\models\ValoresSubdominios;

use App\Models\logCotizaciones;
use Illuminate\Support\Facades\Storage;

use File;
use DB;
use Excel;

class UfvController extends Controller
{

    public function index(Request $request)
    {

        $valores = DB::table('ValoresSubdominios')
            ->where('subID_fk', '50')
            ->orderBy('valValor1')
            ->paginate(5);

        return view('registro-ufv.home-ufv', compact('valores'));
    }

    public function create()
    {
        return view('registro-ufv.anadir-ufv');
    }


    public function store(Request $request)
    {
        $this->validate( request() , [
            'anadir-descripcion'   => 'required|min:8',
            'anadir-valor' => 'required|min:4',
            'anadir-fecha'      => 'required',
            'anadir-estado'       => 'required'
        ]);

        $fk = "50";
        $descripcion = request('anadir-descripcion');
        $valor = request('anadir-valor');
        $fechaFormateada = strtoupper(date('d - M - Y', strtotime(request('anadir-fecha'))));
        $fechaCrea = date(Carbon::now());

        if($request->get('anadir-estado')==NULL){
            $estado = '0';
        }else{
            $estado = '1';
        }
        $idUser = Auth::id();

        ValoresSubdominios::create([
            'subID_fk' => $fk,
            'valDes' => strtoupper($descripcion),
            'valValor1' => $valor,
            'valValor2' => $fechaFormateada,
            'valEst' => $estado,
            'valUsuCrea'=>$idUser,
            'valFecCrea' => $fechaCrea
        ]);

        return redirect()->route('ufv')->with('status', 'Los datos han sido guardados.');
    }


    public function show($id)
    {
        //
    }


    public function edit(ValoresSubdominios $id)
    {
        return view('registro-ufv.editar-ufv', [
            'ufvEdit' => $id
        ]);
    }


    public function update(Request $request, $ufv)
    {
        $ufvN = ValoresSubdominios::where('valID', $ufv)->firstOrFail();
        $ufvN->valDes = $request->get('anadir-descripcion');
        $ufvN->valValor1 = $request->get('anadir-valor');
        $ufvN->valValor2 = $request->get('anadir-fecha');
        if($request->get('anadir-estado')==NULL){
            $ufvN->valEst = '0';
        }else{
            $ufvN->valEst = '1';
        }
        $ufvN->valUsuMod = Auth::id();
        $ufvN->valFecMod = date(Carbon::now());

        $ufvN->save();

        return redirect()->route('ufv');
    }

    public function destroy($ufv)
    {
        $ufvD = ValoresSubdominios::where('valID', $ufv)->firstOrFail();
        $ufvD->delete();
        return redirect('ufv')->with('status', 'El dato ha sido borrado');
    }

    public function viewImport(){
        return view('registro-ufv.importar-ufv');
    }

    public function import(Request $request){

        if($request->hasFile('file'))
        {
            try
            {
                $cont = 0;
                $file = $request->file('file');
                $name = $file->getClientOriginalName();
                Storage::disk('local')->put($name,  File::get($file));

                $file2 = Excel::toArray(new ValoresSubdominios, 'cotizacion.csv');
                $cont=0;
                foreach($file2 as $item){
                    foreach($item as $aux){
                        $row[$cont] = $aux[0];
                        $cont = $cont +1;
                    }
                }
                unset($row[0]);
                unset($row[1]);
                unset($row[2]);
                unset($row[3]);

                foreach($row as $item){
                    $pos = strpos($item, ';');
                    $aux = explode(';', $item);

                    $fk = "50";
                    $descripcion = "UFV";
                    $valor = $aux[0];
                    $fechaFormateada = strtoupper(date('d - M - Y', strtotime(substr($item, $pos+1))));
                    $fechaCrea = date(Carbon::now());
                    $estado = '1';
                    $idUser = Auth::id();
                    $valor."  ".$fechaFormateada."<br><br>";

                    ValoresSubdominios::create([
                        'subID_fk' => $fk,
                        'valDes' => strtoupper($descripcion),
                        'valValor1' => (float)$valor,
                        'valValor2' => strtoupper($fechaFormateada),
                        'valEst' => $estado,
                        'valUsuCrea'=>$idUser,
                        'valFecCrea' => $fechaCrea
                    ]);
                }
                return redirect('ufv')->with('status', 'Importacion de datos exitosa');
            }catch(Exception $e){
                echo $e;
            }

        }
        else{
            return redirect('ufv')->with('status', 'No se encontraron datos');
        }
    }
}
