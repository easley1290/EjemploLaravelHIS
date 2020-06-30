<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cotizante;
use App\Models\PlanillaCotizante;
use App\Models\Empresa;
use App\Models\CotizanteIncapacidad;

use DB;
use Auth;
use Crypt;

use Carbon\Carbon;
class IncapacidadesCotizanteController extends Controller
{

    public function index()
    {
        $datos = DB::table('cot_Cotizante-Incapacidad')
                ->select('cot_Cotizante.cotID',
                        'cot_Cotizante.cotCi',
                        'cot_Cotizante.cotNom',
                        'cot_Cotizante.cotApePat',
                        'cot_Cotizante.cotApeMat',
                        'cot_Cotizante-Incapacidad.cotIncDiaIni',
                        'cot_Cotizante-Incapacidad.cotIncSal',
                        'cot_Cotizante-Incapacidad.cotIncFecIni',
                        'cot_Cotizante-Incapacidad.cotIncFecFin',
                        'cot_IncapacidadesTemporales.incDes')
                ->join('cot_Cotizante', 'cot_Cotizante-Incapacidad.cotID_fk', '=', 'cot_Cotizante.cotID')
                ->join('cot_IncapacidadesTemporales', 'cot_Cotizante-Incapacidad.incID_fk', '=', 'cot_IncapacidadesTemporales.incID')
                ->get();
        return view('incapacidades-cotizantes.home-inccot', compact('datos'));
    }

    public function create(Request $request)
    {
        $cotizantes = DB::table('cot_Cotizante')
                    ->get();
        if($request->get('buscar-cot') != ""){
            $seleccion = DB::table('cot_Cotizante')
                        ->select('cot_Cotizante.cotID',
                                'cot_Cotizante.cotCi',
                                'cot_Cotizante.cotNom',
                                'cot_Cotizante.cotApePat',
                                'cot_Cotizante.cotApeMat',
                                'Empresa.empNom')
                        ->join('cot_alta', 'cot_alta.cotID_fk', '=', 'cot_Cotizante.cotID')
                        ->join('Empresa', 'cot_Cotizante.empID', '=', 'Empresa.empID')
                        ->where('cot_Cotizante.cotID', $request->get('buscar-cot'))
                        ->get();
        }
        else{
            $seleccion = DB::table('cot_Cotizante')
                        ->select('cot_Cotizante.cotID',
                                'cot_Cotizante.cotCi',
                                'cot_Cotizante.cotNom',
                                'cot_Cotizante.cotApePat',
                                'cot_Cotizante.cotApeMat',
                                'Empresa.empNom')
                        ->join('cot_alta', 'cot_alta.cotID_fk', '=', 'cot_Cotizante.cotID')
                        ->join('Empresa', 'cot_Cotizante.empID', '=', 'Empresa.empID')
                        ->get();
        }
        return view('incapacidades-cotizantes.anadir-inccot', compact(['cotizantes', 'seleccion']));
    }

    public function show($id)
    {

        try {
            $codigo = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('incapacidadCotizante')->with('status', 'Hubo un error inesperado');
        }

        $mes = strtoupper(date('F'));
        if($mes == 'JANUARY') $mes = 'ENERO';
        if($mes == 'FEBRUARY') $mes = 'FEBRERO';
        if($mes == 'MARCH') $mes = 'MARZO';
        if($mes == 'APRIL') $mes = 'ABRIL';
        if($mes == 'MAY') $mes = 'MAYO';
        if($mes == 'JUNE') $mes = 'JUNIO';
        if($mes == 'JULY') $mes = 'JULIO';
        if($mes == 'AUGUST') $mes = 'AGOSTO';
        if($mes == 'SEPTEMBER') $mes = 'SEPTIEMBRE';
        if($mes == 'OCTOBER') $mes = 'OCTUBRE';
        if($mes == 'NOVEMBER') $mes = 'NOVIEMBRE';
        if($mes == 'DECEMBER') $mes = 'DICIEMBRE';

        $ultimaPlanilla = DB::table('cot_PlanillaCotizante')
                    ->select(DB::raw('MAX(plaID_fk) as maximo'))
                    ->where('cotID_fk', $codigo)
                    ->get();

        $mesAporte = DB::table('cot_Planillas')
                    ->select('plaMesApo')
                    ->where('plaID', $ultimaPlanilla[0]->maximo)
                    ->get();

        if($mes == $mesAporte[0]->plaMesApo){
            $cotizante = Cotizante::where('cotID', $codigo)->firstOrFail();
            $datosPlanilla = DB::table('cot_Planillas')
                    ->where('plaID', $ultimaPlanilla[0]->maximo)
                    ->get();
            $empresa = Empresa::where('empID', $cotizante->empID)->firstOrFail();
            $incapacidades = DB::table('cot_IncapacidadesTemporales')
                            ->where('incEst', '1')
                            ->get();

            return view('incapacidades-cotizantes.anadir-inc', compact('cotizante', 'datosPlanilla', 'empresa', 'incapacidades'));
        }else{

            return redirect()->route('incapacidadCotizante')->with('status', 'Hubo un error inesperado');
        }
    }

    public function show2(Request $request, $id)
    {
        //obtener la ultima planilla en la que figuro el cotizante
        $ultimaPlanilla = DB::table('cot_PlanillaCotizante')
                    ->select(DB::raw('MAX(plaID_fk) as maximo'))
                    ->where('cotID_fk', $id)
                    ->get();
        //seleccionar el cotizante que tendra baja
        $cotizante = Cotizante::where('cotID', $id)->firstOrFail();

        //datos de la planilla del cotizante
        $datosPlanilla = DB::table('cot_Planillas')
                        ->where('plaID', $ultimaPlanilla[0]->maximo)
                        ->get();
        //empresa del cotizante
        $empresa = Empresa::where('empID', $cotizante->empID)->firstOrFail();

        //incapacidad seleccionada en un paso anterior
        $incapacidades = DB::table('cot_IncapacidadesTemporales')
                        ->where('incEst', '1')
                        ->where('incID', $request->get('incapacidad'))
                        ->get();

        $fechaIni = $request->get('finicio');
        $fechaFin = $request->get('ffin');
        $fi = Carbon::parse($fechaIni);
        $ff = Carbon::parse($fechaFin);

        $numeroDias  = $fi->diffInDays($ff);

        $salario = $cotizante->cotTotGan;
        $cont = 0;

        $salarioAux = 0;
        $numeroDiasReconocidos = $numeroDias - $incapacidades[0]->incDiaVal;
        if($numeroDiasReconocidos < 0){
            $numeroDiasReconocidos = 0;
        }

        if ($numeroDiasReconocidos > 30) {
            $aux = $numeroDiasReconocidos;
            while ($aux >=0) {
                if ($aux>=30) {
                    $salario = $salario;
                    $salarioAux = $salarioAux + $salario;
                    $aux = $aux - 30;
                }
                if($aux<30){
                    $salario =(($salario/30)*$aux);
                    $salarioAux = $salarioAux + $salario;
                    $aux = $aux - 30;
                }
            }
            $montoReconocido = $salarioAux*((float)$incapacidades[0]->incPor*0.01);
        }
        elseif ($numeroDiasReconocidos <= 30)
        {
            $salario =(($salario/30)*$numeroDiasReconocidos);
            $montoReconocido = $salario*((float)$incapacidades[0]->incPor*0.01);
        }

        return view('incapacidades-cotizantes.anadir-inc2',
                    compact('cotizante', 'datosPlanilla', 'empresa', 'incapacidades', 'fechaIni', 'fechaFin', 'numeroDias',
                            'numeroDiasReconocidos', 'montoReconocido'));

    }

    public function store(Request $request)
    {
        $incapacidad = request('incapacidad');
        $cotizante = request('codigo');
        $fechaBaja = Carbon::now()->format('d/m/Y');
        $fechaIni = request('finicio');
        $fechaFin = request('ffin');
        $fi = Carbon::parse($fechaIni)->format('d/m/Y');
        $ff = Carbon::parse($fechaFin)->format('d/m/Y');

        $diasRec = request('diasrec');
        $montoRec = request('montorec');
        $continuidad = '0';

        CotizanteIncapacidad::create([
            'cotID_fk' => $cotizante,
            'incID_fk' => $incapacidad,
            'cotIncFec' => $fechaBaja,
            'cotIncDiaIni' => $diasRec,
            'cotIncCon' => $continuidad,
            'cotIncSal' =>$montoRec,
            'cotIncFecIni' => $fi,
            'cotIncFecFin' => $ff
        ]);
        return redirect()->route('incapacidadCotizante')->with('status', 'Los datos han sido guardados.');
    }



    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
