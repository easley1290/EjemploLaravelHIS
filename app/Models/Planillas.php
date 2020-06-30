<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $plaID
 * @property int $empID_fk
 * @property int $plaGesApo
 * @property string $plaFec
 * @property string $plaCie
 * @property string $plaFecEnt
 * @property int $plaSigEnt
 * @property string $plaFecSigEnt
 * @property string $plaNroTrab
 * @property string $plaTip
 * @property string $plaEst
 * @property int $plaNro
 * @property int $plaCod
 * @property float $plaApoTot
 * @property Empresa $empresa
 * @property CotMultasPlanilla[] $cotMultasPlanillas
 * @property CotPlanillaCotizante[] $cotPlanillaCotizantes
 */
class Planillas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cot_Planillas';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'plaID';

    /**
     * @var array
     */
    protected $fillable = ['empID_fk', 'plaGesApo', 'plaFec', 'plaCie', 'plaFecEnt', 'plaSigEnt', 'plaFecSigEnt', 'plaNroTrab', 'plaTip', 'plaEst', 'plaNro', 'plaCod', 'plaApoTot', 'plaInd', 'plaMesApo'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empID_fk', 'empID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotMultasPlanillas()
    {
        return $this->hasMany('App\Models\CotMultasPlanilla', 'plaID_fk', 'plaID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotPlanillaCotizantes()
    {
        return $this->hasMany('App\Models\CotPlanillaCotizante', 'plaID_fk', 'plaID');
    }
}
