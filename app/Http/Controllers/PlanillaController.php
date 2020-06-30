<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Planillas;
use App\Models\PlanillaCotizante;
use App\Models\Subdominios;
use App\Models\Cotizante;
use App\Models\Altas;
use App\Models\Bajas;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use DB;
use Crypt;


class PlanillaController extends Controller
{

    public function index()
    {
        $planilla = DB::table('cot_Planillas')
                    ->select('cot_Planillas.plaID',
                            'cot_Planillas.plaNro',
                            'cot_Planillas.plaGesApo',
                            'cot_Planillas.plaMesApo',
                            'cot_Planillas.plaTip',
                            'Empresa.empNom',
                            'cot_Planillas.plaNroTrab',
                            'cot_Planillas.plaApoTot',
                            'cot_Planillas.plaEst')
                    ->join('Empresa', 'cot_Planillas.empID_fk', '=', 'Empresa.empID')
                    ->orderBy('cot_Planillas.plaID', 'ASC')
                    ->get();

        return view('planilla.home-planilla', compact('planilla'));
    }


    public function baja($id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('planilla.anadir')->with('status', 'Ocurrio un error inesperado');
        }

        $altD = Altas::where('cotID_fk', $codigo)->firstOrFail();

        $estado = 'BAJA COTIZANTE PENDIENTE';

        Bajas::create([
            'bajFecSer' => date(Carbon::now()),
            'cotID_fk' => $codigo,
            'bajTip' => $estado
        ]);

        $altD->delete();

        return redirect()->route('planilla.anadir')->with('status', 'El cotizante ha sido dado de baja');
    }


    public function create()
    {
        $empresa = '1'; //codigo de empresa que debe ser extraido de las credenciales de login

        $listaCotizantes = DB::table('cot_Cotizante')
                            ->join('cot_alta', 'cot_Cotizante.cotID', '=', 'cot_alta.cotID_fk')
                            ->where('empID', $empresa)
                            ->get();

        $empresas = DB::table('Empresa')
                    ->select('empID', 'empNom')
                    ->get();

        $tipo = DB::table('Subdominios')
                ->select('subID', 'domID_fk', 'subNom')
                ->where('domID_fk', '2')
                ->get();

        $nroPlanilla = DB::table('cot_Planillas')
                        ->where('empID_fk', $empresa)
                        ->max('plaNro');

        $nroPlanilla = $nroPlanilla +1;

        return view('planilla.anadir-planilla', compact(['empresas', 'tipo', 'nroPlanilla', 'listaCotizantes']));
    }
    public function store(Request $request)
    {
        $mes = request('anadir-mes-pla');
        $gestion = request('anadir-ges-pla');
        $empresa = request('anadir-empresa-pla');
        $tipo = request('anadir-tipo-pla');
        $estado = 'PLANILLA PENDIENTE';
        $numero = request('anadir-nro-pla');

        if(request('altaBaja') == '1'){
            $tipoCotizante = 'alta';
        }elseif(request('altaBaja') == '0'){
            $tipoCotizante = 'baja';
        }

        if($tipoCotizante == 'alta'){
            $nroTrabajadores = DB::table('cot_Cotizante')
                          ->select(DB::raw('count(cot_Cotizante.cotID) as nro'))
                          ->where('empID', $empresa)
                          ->join('cot_alta', 'cot_alta.cotID_fk', '=', 'cot_Cotizante.cotID')
                          ->get();

            $cotizante = DB::table('cot_Cotizante')
                    ->select('cot_Cotizante.cotID', 'cot_Cotizante.cotHabBas', 'cot_Cotizante.cotCi')
                    ->join('cot_alta', 'cot_alta.cotID_fk', '=', 'cot_Cotizante.cotID')
                    ->where('cot_Cotizante.empID', $empresa)->get();
            $ind = 'CO';
        }
        if($tipoCotizante == 'baja'){
            $nroTrabajadores = DB::table('cot_Cotizante')
                            ->select(DB::raw('count(cot_Cotizante.cotID) as nro'))
                            ->where('empID', $empresa)
                            ->join('cot_Baja', 'cot_Baja.cotID_fk', '=', 'cot_Cotizante.cotID')
                            ->get();

            $cotizante = DB::table('cot_Cotizante')
                            ->select('cot_Cotizante.cotID', 'cot_Cotizante.cotHabBas', 'cot_Cotizante.cotCi')
                            ->join('cot_Baja', 'cot_Baja.cotID_fk', '=', 'cot_Cotizante.cotID')
                            ->where('cot_Cotizante.empID', $empresa)->get();
            $ind = 'NCO';

        }
        $fecha = date_create();
        $aux = date_timestamp_get($fecha);

        Planillas::create([
            'empID_fk' => (int) $empresa,
            'plaGesApo' => $gestion,
            'plaFec' => date(Carbon::now()),
            'plaNroTrab' => (int) $nroTrabajadores[0]->nro,
            'plaTip' => (string) $tipo,
            'plaEst' => (string) $estado,
            'plaNro' => (int) $numero,
            'plaCod' => $aux,
            'plaInd' =>$ind,
            'plaMesApo' =>$mes
        ]);

        $planilla = DB::table('cot_Planillas')
                ->where('empID_fk', $empresa)->get();

        $contador = 0;

        foreach($planilla as $item){
            foreach($cotizante as $cot){
                if($item->plaCod == $aux){
                    PlanillaCotizante::create([
                        'plaID_fk' => $item->plaID,
                        'cotID_fk' => $cotizante[$contador]->cotID,
                        'cotApo' => ((float) $cotizante[$contador]->cotHabBas) * 0.1,
                        'plaMesApo' => $mes,
                        'cotCi' => $cotizante[$contador]->cotCi
                    ]);

                    $cotN = Cotizante::where('cotID', $cotizante[$contador]->cotID)->firstOrFail();
                    $valorActual = $cotN->cotNumCot;

                    if($valorActual == null){
                        $valorActual = 0;
                    }

                    $cotN->cotNumCot = $valorActual+1;
                    $cotN->save();

                    $contador = $contador + 1;

                }
            }
        }

        $contador = 0;
        $plaN = Planillas::where('plaCod', $aux)->firstOrFail();

        $aporteTotalPlanilla = DB::table('cot_PlanillaCotizante')
                            ->where('plaID_fk', $plaN->plaID)
                            ->sum('cotApo');

        $plaN->plaApoTot = round((float) $aporteTotalPlanilla, 2);
        $plaN->save();



        $contador = 0;
        return redirect()->route('planilla')->with('status', 'Los datos han sido guardados.');
    }

    public function show($id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('planilla')->with('status', 'Hubo un error desconocido');
        }

        $plaCot = DB::table('cot_PlanillaCotizante')
                ->select('cotID_fk', 'cotCi', 'plaMesApo', 'cotApo')
                ->where('plaID_fk', $codigo)
                ->get();
        $idCot = DB::table('cot_PlanillaCotizante')
                ->select('cotID_fk')
                ->where('plaID_fk', $codigo)
                ->get();
        $x = 0;
        foreach($idCot as $item){
            $array[$x] = DB::table('cot_Cotizante')
                        ->select('cot_Cotizante.cotCi',
                                'cot_Cotizante.cotNom',
                                'cot_Cotizante.cotApePat',
                                'cot_Cotizante.cotApeMat',
                                'cot_Cotizante.cotCargo',
                                'cot_PlanillaCotizante.cotApo')
                        ->join('cot_PlanillaCotizante', 'cot_Cotizante.cotID', '=', 'cot_PlanillaCotizante.cotID_fk')
                        ->where('cot_Cotizante.cotID', $item->cotID_fk)
                        ->where('cot_PlanillaCotizante.plaID_fk', $codigo)
                        ->get();
            $x = $x + 1;
        }
        $x = 0;
        $cont=0;
        for($a = 0; $a<count($array); $a++){
            $cotizantes[$cont] = $array[$a][0];
            $cont++;
        }
        $cont=0;

        $empresa = DB::table('Empresa')
                    ->select('Empresa.empNom')
                    ->join('cot_Planillas', 'Empresa.empID', '=', 'cot_Planillas.empID_fk')
                    ->where('cot_Planillas.plaID', $codigo)
                    ->get();
        $datosPlanilla = DB::table('cot_Planillas')
                        ->select('cot_Planillas.plaNro',
                                'cot_Planillas.plaGesApo',
                                'cot_Planillas.plaInd',
                                'cot_PlanillaCotizante.plaMesApo')
                        ->join('cot_PlanillaCotizante', 'cot_Planillas.plaID', '=', 'cot_PlanillaCotizante.plaID_fk')
                        ->where('cot_Planillas.plaID', $codigo)
                        ->get();
        $aporteTotal = DB::table('cot_PlanillaCotizante')
                        ->select(DB::raw('SUM (cotApo) as suma'))
                        ->where('plaID_fk', $codigo)
                        ->get();
        return view('planilla.detalle-planilla', compact(['cotizantes', 'empresa', 'datosPlanilla', 'aporteTotal']));
    }

    public function edit($id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('planilla')->with('status', 'Hubo un error desconocido');
        }
        $detalle=DB::table('cot_Planillas')
                ->select('cot_Planillas.plaID',
                        'cot_Planillas.plaNro',
                        'cot_Planillas.plaTip',
                        'cot_Planillas.plaEst',
                        'cot_PlanillaCotizante.plaMesApo',
                        'cot_Planillas.plaGesApo',
                        'cot_Planillas.empID_fk',
                        'cot_Planillas.plaInd')
                ->join('cot_PlanillaCotizante', 'cot_Planillas.plaID', '=', 'cot_PlanillaCotizante.plaID_fk')
                ->where('cot_Planillas.plaID', $codigo)
                ->get();
        $empID = $detalle[0]->empID_fk;

        $empresa = DB::table('Empresa')
                ->select('empNom')
                ->where('empID', $empID)
                ->get();

        $subdominios = DB::table('Subdominios')
                        ->select('subNom')
                        ->where('domID_fk', '1')->get();
        //dd($subdominios);
        return view('planilla.editar-planilla', compact(['detalle', 'subdominios', 'empresa']));
    }

    public function update(Request $request, $id)
    {
        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('planilla')->with('status', 'Hubo un error desconocido');
        }

        $plaN = Planillas::where('plaID', $codigo)->firstOrFail();

        $plaCotN = PlanillaCotizante::where('plaID_fk', $codigo)->firstOrFail();

        $plaN->plaNro = (int) $request->get('anadir-numero-pla');
        $plaN->plaTip = request('anadir-tipo-pla');
        $plaN->plaEst = request('anadir-estado-pla');
        $plaN->plaGesApo = request('anadir-ges-pla');

        $plaCotN->plaMesApo = request('anadir-mes-pla');

        $plaN->save();
        $plaCotN->save();
        return redirect()->route('planilla')->with('status', 'Los cambios han sido efectuados');
    }


    public function destroy($id)
    {
        //
    }
}
