<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncapacidadesTemporales;
use App\Models\logCotizaciones;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IncTemporalesController extends Controller
{

    public function index()
    {
        $incTemp = IncapacidadesTemporales::All();
        return view('incapacidades-temporales.home-incapacidades', compact('incTemp'));
    }


    public function create()
    {
        return view('incapacidades-temporales.anadir-incapacidades');
    }

    public function store(Request $request)
    {
        $this->validate( request() , [
            'anadir-codigo-inc'   => 'required|min:2',
            'anadir-nombre-inc' => 'required|min:4',
            'anadir-dia-inc'      => 'required|min:1',
            'anadir-porcentaje-inc'       => 'required|min:1'
        ]);

        $codigo = request('anadir-codigo-inc');
        //return ($codigo);
        $nombre = request('anadir-nombre-inc');
        $dia = request('anadir-dia-inc');
        $porcentaje = request('anadir-porcentaje-inc');

        if($request->get('anadir-estado-inc')==NULL){
            $estado = '0';
        }else{
            $estado = '1';
        }

        IncapacidadesTemporales::create([
            'incID' => strtoupper(trim($codigo)),
            'incDes' => strtoupper(trim($nombre)),
            'incDiaVal' => trim($dia),
            'incPor' => trim($porcentaje),
            'incEst' => trim($estado)
        ]);
        logCotizaciones::create([
            'incID' => strtoupper(trim($codigo)),
            'logUsuCre' => Auth::id(),
            'logFecCre' => date(Carbon::now())
        ]);

        return redirect()->route('incTemporal')->with('status', 'Los datos han sido guardados.');
    }


    public function show($id)
    {
        //
    }


    public function edit(IncapacidadesTemporales $id)
    {
        //return($id);

        return view('incapacidades-temporales.editar-incapacidades', [
            'incEdit' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        //return ($id);
        try{
            $incN = IncapacidadesTemporales::where('incID', $id)->firstOrFail();
            $incN->incID = (string) $request->get('anadir-codigo-inc');
            $incN->incDes = $request->get('anadir-nombre-inc');
            $incN->incDiaVal = (string)$request->get('anadir-dia-inc');

            $incN->incPor = $request->get('anadir-porcentaje-inc');

            if($request->get('anadir-estado-inc')==NULL){
                $incN->incEst = trim('0');
            }else{
                $incN->incEst = trim('1');
            }

            $logMod = logCotizaciones::where('incID', $id)->firstOrFail();
            $logMod->logUsuMod = Auth::id();
            $logMod->logFecMod = date(Carbon::now());
            $logMod->save();

            $incN->save();
            return redirect()->route('incTemporal');

        }catch(Exception $en){
            return($this->reportException($en));
        }
    }

    public function destroy($inc)
    {
        $incD = IncapacidadesTemporales::where('incID', $inc)->firstOrFail();


        $logMod = logCotizaciones::where('incID', $inc)->firstOrFail();
        $logMod->logUsuDel = Auth::id();
        $logMod->logFecDel = date(Carbon::now());
        $logMod->save();
        $incD->delete();

        return redirect()->route('incTemporal')->with('status', 'El dato ha sido borrado');
    }
}
