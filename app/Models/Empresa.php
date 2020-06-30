<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $empID
 * @property int $numPat
 * @property string $empNom
 * @property string $empMatIns
 * @property string $fecInsFun
 * @property string $empNit
 * @property string $fecNit
 * @property string $fecCon
 * @property string $numConSoc
 * @property string $empDir
 * @property string $empTel
 * @property string $empTip
 * @property string $empUbi
 * @property string $fecIniAct
 * @property string $apoCi
 * @property string $apoNom
 * @property string $apoDoc
 * @property string $numIde
 * @property string $fecPod
 * @property string $codReg
 * @property string $codRub
 * @property float $salCot
 * @property int $canTra
 * @property string $fecRegAfi
 * @property int $UsrCrea
 * @property string $UsrCreaFecha
 * @property int $UsrModif
 * @property string $UsrModifFecha
 * @property string $empProNom
 * @property string $empCenTraDir
 * @property string $repLegalNom
 * @property int $empCap
 * @property string $empTipSeg
 * @property string $lugExpCar
 * @property string $fecExpCar
 * @property CotAporte[] $cotAportes
 * @property CotPlanilla[] $cotPlanillas
 * @property EmpNovedade[] $empNovedades
 * @property EmpSucursal[] $empSucursals
 * @property Paciente[] $pacientes
 */
class Empresa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Empresa';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'empID';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['numPat', 'empNom', 'empMatIns', 'fecInsFun', 'empNit', 'fecNit', 'fecCon', 'numConSoc', 'empDir', 'empTel', 'empTip', 'empUbi', 'fecIniAct', 'apoCi', 'apoNom', 'apoDoc', 'numIde', 'fecPod', 'codReg', 'codRub', 'salCot', 'canTra', 'fecRegAfi', 'UsrCrea', 'UsrCreaFecha', 'UsrModif', 'UsrModifFecha', 'empProNom', 'empCenTraDir', 'repLegalNom', 'empCap', 'empTipSeg', 'lugExpCar', 'fecExpCar'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotAportes()
    {
        return $this->hasMany('App\CotAporte', 'empID_fk', 'empID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotPlanillas()
    {
        return $this->hasMany('App\CotPlanilla', 'empID_fk', 'empID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empNovedades()
    {
        return $this->hasMany('App\EmpNovedade', 'empID', 'empID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empSucursals()
    {
        return $this->hasMany('App\EmpSucursal', 'empID', 'empID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Paciente', 'empID', 'empID');
    }
}
