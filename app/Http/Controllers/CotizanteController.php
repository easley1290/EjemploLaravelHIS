<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizante;
use App\Models\Subdominios;
use App\Models\Empresa;
use App\Models\logCotizaciones;
use App\Models\Altas;
use App\Models\Bajas;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use DB;
use Crypt;

class CotizanteController extends Controller
{

    public function index(Request $request)
    {
        if($request->get('buscarApellido') == ""){
            $cot = DB::table('cot_Cotizante')
                ->select('cot_Cotizante.cotID',
                        'cot_Cotizante.cotCi',
                        'cot_Cotizante.cotNom',
                        'cot_Cotizante.cotApePat',
                        'cot_Cotizante.cotApeMat',
                        'cot_Cotizante.cotTotGan',
                        'cot_Cotizante.cotCargo',
                        'Empresa.empNom',
                        'cot_alta.altTip')
                ->join('cot_alta', 'cot_alta.cotID_fk', '=', 'cot_Cotizante.cotID')
                ->join('Empresa', 'cot_Cotizante.empID', '=', 'Empresa.empID')
                ->orderBy('cotID', 'ASC')
                ->paginate(10);
        }else{
            try{
                $cot = DB::table('cot_Cotizante')
                ->select('cot_Cotizante.cotID',
                        'cot_Cotizante.cotCi',
                        'cot_Cotizante.cotNom',
                        'cot_Cotizante.cotApePat',
                        'cot_Cotizante.cotApeMat',
                        'cot_Cotizante.cotTotGan',
                        'cot_Cotizante.cotCargo',
                        'Empresa.empNom',
                        'cot_alta.altTip')
                ->join('cot_alta', 'cot_alta.cotID_fk', '=', 'cot_Cotizante.cotID')
                ->join('Empresa', 'cot_Cotizante.empID', '=', 'Empresa.empID')
                ->where('cot_Cotizante.cotApePat', 'like', '%'.$request->get('buscarApellido').'%')
                ->paginate(10);

            }catch(Exception $e){
                return redirect()->route('cotizante')->with('status', $e);
            }
        }


        return view('cotizantes.home-cotizante', compact(['cot']));
    }

    public function indexBaja(Request $request)
    {
        if($request->get('buscarApellido') == ""){
            $cot = DB::table('cot_Cotizante')
                ->select('cot_Cotizante.cotID',
                        'cot_Cotizante.cotCi',
                        'cot_Cotizante.cotNom',
                        'cot_Cotizante.cotApePat',
                        'cot_Cotizante.cotApeMat',
                        'cot_Cotizante.cotTotGan',
                        'cot_Cotizante.cotCargo',
                        'Empresa.empNom',
                        'cot_Baja.bajTip')
                ->join('cot_Baja', 'cot_Baja.cotID_fk', '=', 'cot_Cotizante.cotID')
                ->join('Empresa', 'cot_Cotizante.empID', '=', 'Empresa.empID')
                ->paginate(10);
            }else{
                try{
                    $cot = DB::table('cot_Cotizante')
                    ->select('cot_Cotizante.cotID',
                            'cot_Cotizante.cotCi',
                            'cot_Cotizante.cotNom',
                            'cot_Cotizante.cotApePat',
                            'cot_Cotizante.cotApeMat',
                            'cot_Cotizante.cotTotGan',
                            'cot_Cotizante.cotCargo',
                            'Empresa.empNom',
                            'cot_Baja.bajTip')
                    ->join('cot_Baja', 'cot_Baja.cotID_fk', '=', 'cot_Cotizante.cotID')
                    ->join('Empresa', 'cot_Cotizante.empID', '=', 'Empresa.empID')
                    ->where('cot_Cotizante.cotApePat', 'like', '%'.$request->get('buscarApellido').'%')
                    ->paginate(10);
                }catch(Exception $e){
                    return redirect()->route('cotizante')->with('status', $e);
                }
            }
        return view('cotizantes.home-cot-baja', compact('cot'));
    }

    public function create()
    {
        $sub = Subdominios::All()
        ->where('domID_fk', '14');

        $emp = Empresa::All();
        return view('cotizantes.anadir-cotizante', compact(['sub', 'emp']));
    }


    public function store(Request $request)
    {
        $ci = request('anadir-ci-cot')." ".request('anadir-ciext-cot');
        $nombre = request('anadir-nombre-cot');
        $paterno = request('anadir-paterno-cot');
        $materno = request('anadir-materno-cot');
        $haberBasico = request('anadir-haber-cot');
        $antiguedad = request('anadir-antiguedad-cot');
        $otros = request('anadir-otros-cot');
        $total = request('anadir-totalganado-cot');
        $cargo = request('anadir-cargo-cot');
        $empresa = request('anadir-empresa-cot');
        $estado = 'ALTA COTIZANTE PENDIENTE';

        Cotizante::create([
            'cotCi' => strtoupper(trim($ci)),
            'cotNom' => strtoupper(trim($nombre)),
            'cotApePat' => strtoupper($paterno),
            'cotApeMat' => strtoupper($materno),
            'cotHabBas' => $haberBasico,
            'cotBonAnt' => $antiguedad,
            'cotOtrBon' => $otros,
            'cotTotGan' => $total,
            'cotCargo' => $cargo,
            'empID' => (int) $empresa
        ]);


        $id = Cotizante::All()
        ->where('cotCi', $ci);

        foreach($id as $item){
            $dato = $item->cotID;
        }

        $fecha = date_create();

        Altas::create([
            'altID' => date_timestamp_get($fecha),
            'altFecSer' => date(Carbon::now()),
            'altTip' => $estado,
            'cotID_fk' => $dato
        ]);

        logCotizaciones::create([
            'cotID' => $dato,
            'logUsuCre' => Auth::id(),
            'logFecCre' => date(Carbon::now())
        ]);

        return redirect()->route('cotizante')->with('status', 'Los datos han sido guardados.');
    }



    public function edit($id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('cotizante')->with('status', 'Hubo un error desconocido');
        }
        $cotizante = DB::table('cot_Cotizante')
                        ->select('Empresa.empNom',
                                 'cot_Cotizante.cotID',
                                 'cot_Cotizante.cotCi',
                                 'cot_Cotizante.cotNom',
                                 'cot_Cotizante.cotApePat',
                                 'cot_Cotizante.cotApeMat',
                                 'cot_Cotizante.cotHabBas',
                                 'cot_Cotizante.cotBonAnt',
                                 'cot_Cotizante.cotOtrBon',
                                 'cot_Cotizante.cotTotGan',
                                 'cot_Cotizante.cotCargo',
                                 'cot_Cotizante.empID')
                        ->join('Empresa', 'Empresa.empID', '=', 'cot_Cotizante.empID')
                        ->where('cotID', $codigo)
                        ->get();

        $altaCotizante = DB::table('cot_alta')
                            ->select('altID','altTip', 'cotID_fk')
                            ->where('cotID_fk', $codigo)
                            ->get();

        $empresas = DB::table('Empresa')
                    ->select('*')
                    ->orderBy('empNom', 'ASC')
                    ->get();

        $subdominiosAlta = DB::table('Subdominios')
                        ->select('subID', 'subNom')
                        ->where('domID_fk', '9')
                        ->get();

        //dd($cotizante);
        return view('cotizantes.editar-cotizante', [
            'cotEdit' => $cotizante[0],
            'estadoCot' => $altaCotizante[0],
            'subdominiosAlta' => $subdominiosAlta,
            'empresas' => $empresas
        ]);
    }

    public function editBaja($id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('cotizante')->with('status', 'Hubo un error desconocido');
        }
        $cotizante = DB::table('cot_Cotizante')
                        ->select('Empresa.empNom',
                                 'cot_Cotizante.cotID',
                                 'cot_Cotizante.cotCi',
                                 'cot_Cotizante.cotNom',
                                 'cot_Cotizante.cotApePat',
                                 'cot_Cotizante.cotApeMat',
                                 'cot_Cotizante.cotHabBas',
                                 'cot_Cotizante.cotBonAnt',
                                 'cot_Cotizante.cotOtrBon',
                                 'cot_Cotizante.cotTotGan',
                                 'cot_Cotizante.cotCargo',
                                 'cot_Cotizante.empID')
                        ->join('Empresa', 'Empresa.empID', '=', 'cot_Cotizante.empID')
                        ->where('cotID', $codigo)
                        ->get();

        $bajaCotizante = DB::table('cot_Baja')
                            ->select('bajID','bajTip', 'cotID_fk')
                            ->where('cotID_fk', $codigo)
                            ->get();

        $empresas = DB::table('Empresa')
                    ->select('*')
                    ->orderBy('empNom', 'ASC')
                    ->get();

        $subdominiosBaja = DB::table('Subdominios')
                        ->select('subID', 'subNom')
                        ->where('domID_fk', '10')
                        ->get();

        //dd($cotizante);
        return view('cotizantes.editar-cot-baja', [
            'cotEdit' => $cotizante[0],
            'estadoCot' => $bajaCotizante[0],
            'subdominiosBaja' => $subdominiosBaja,
            'empresas' => $empresas
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('cotizante')->with('status', 'Hubo un error desconocido');
        }

        $cotN = Cotizante::where('cotID', $codigo)->firstOrFail();
        $cotN->cotCi = (string) strtoupper($request->get('anadir-ci-cot'));
        $cotN->cotNom = (string) strtoupper(request('anadir-nombre-cot'));
        $cotN->cotApePat = (string) strtoupper(request('anadir-paterno-cot'));
        $cotN->cotApeMat = (string) strtoupper(request('anadir-materno-cot'));
        $cotN->cotHabBas = (float) request('anadir-haber-cot');
        $cotN->cotBonAnt = (float) request('anadir-antiguedad-cot');
        $cotN->cotOtrBon = (float) request('anadir-otros-cot');
        $cotN->cotTotGan = (float) request('anadir-totalganado-cot');
        $cotN->cotCargo = request('anadir-cargo-cot');
        $cotN->empID = request('anadir-empresa-cot');

        $altN = Altas::where('cotID_fk', $codigo)->firstOrFAil();
        $altN->altTip = request('anadir-estado-cot');


        $logE = LogCotizaciones::where('cotID', $codigo)->firstOrFail();
        $logE->logUsuMod = Auth::id();
        $logE->logFecMod = date(Carbon::now());
        //dd($logE);
        $logE->save();
        $altN->save();

        $cotN->save();

        return redirect()->route('cotizante');
    }

    public function updateBaja(Request $request, $id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('cotizante.baja')->with('status', 'Hubo un error desconocido');
        }

        $cotN = Cotizante::where('cotID', $codigo)->firstOrFail();
        $cotN->cotCi = (string) strtoupper($request->get('anadir-ci-cot'));
        $cotN->cotNom = (string) strtoupper(request('anadir-nombre-cot'));
        $cotN->cotApePat = (string) strtoupper(request('anadir-paterno-cot'));
        $cotN->cotApeMat = (string) strtoupper(request('anadir-materno-cot'));
        $cotN->cotHabBas = (float) request('anadir-haber-cot');
        $cotN->cotBonAnt = (float) request('anadir-antiguedad-cot');
        $cotN->cotOtrBon = (float) request('anadir-otros-cot');
        $cotN->cotTotGan = (float) request('anadir-totalganado-cot');
        $cotN->cotCargo = request('anadir-cargo-cot');
        $cotN->empID = request('anadir-empresa-cot');

        $bajN = Bajas::where('cotID_fk', $codigo)->firstOrFail();
        $bajN->bajTip = request('anadir-estado-cot');

        $logE = LogCotizaciones::where('cotID', $codigo)->firstOrFail();
        $logE->logUsuMod = Auth::id();
        $logE->logFecMod = date(Carbon::now());
        //dd($logE);

        $logE->save();
        $bajN->save();

        $cotN->save();

        return redirect()->route('cotizante.baja');
    }

    public function alta($id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('cotizante')->with('status', 'Hubo un error desconocido');
        }

        $bajD = Bajas::where('cotID_fk', $codigo)->firstOrFail();

        $estado = 'ALTA COTIZANTE PENDIENTE';
        $fecha = date_create();
        Altas::create([
            'altID' => date_timestamp_get($fecha),
            'altFecSer' => date(Carbon::now()),
            'cotID_fk' => $codigo,
            'altTip' => $estado
        ]);

        $bajD->delete();
        return redirect()->route('cotizante.baja')->with('status', 'El cotizante ha sido dado de alta');
    }


    public function baja($id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('cotizante')->with('status', 'Hubo un error desconocido');
        }

        $altD = Altas::where('cotID_fk', $codigo)->firstOrFail();

        $estado = 'BAJA COTIZANTE PENDIENTE';

        Bajas::create([
            'bajFecSer' => date(Carbon::now()),
            'cotID_fk' => $codigo,
            'bajTip' => $estado
        ]);

        $altD->delete();
        return redirect()->route('cotizante')->with('status', 'El cotizante ha sido dado de baja');
    }
    public function destroy($id)
    {
        //
    }
}
