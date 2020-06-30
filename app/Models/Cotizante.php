<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cotID
 * @property string $cotCi
 * @property string $cotNom
 * @property string $cotApePat
 * @property string $cotApeMat
 * @property int $numHisCli
 * @property string $pacMat
 * @property float $cotHabBas
 * @property float $cotBonAnt
 * @property float $cotOtrBon
 * @property float $cotTotGan
 * @property string $cotDocTra
 * @property int $cotPerCes
 * @property int $cotNumCot
 * @property string $cotCargo
 * @property int $empID
 * @property CotAltum[] $cotAltas
 * @property CotBaja[] $cotBajas
 * @property CotCotizanteIncapacidad[] $cotCotizanteIncapacidads
 * @property CotCotizantePrestacione[] $cotCotizantePrestaciones
 * @property CotInvalidez[] $cotInvalidezs
 * @property CotPlanillaCotizante[] $cotPlanillaCotizantes
 */
class Cotizante extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cot_Cotizante';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'cotID';

    /**
     * @var array
     */
    protected $fillable = ['cotCi', 'cotNom', 'cotApePat', 'cotApeMat', 'numHisCli', 'pacMat', 'cotHabBas', 'cotBonAnt', 'cotOtrBon', 'cotTotGan', 'cotDocTra', 'cotPerCes', 'cotNumCot', 'cotCargo', 'empID'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotAltas()
    {
        return $this->hasMany('App\Models\Altas', 'cotID_fk', 'cotID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotBajas()
    {
        return $this->hasMany('App\Models\Bajas', 'cotID_fk', 'cotID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotCotizanteIncapacidads()
    {
        return $this->hasMany('App\Models\CotCotizanteIncapacidad', 'cotID_fk', 'cotID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotCotizantePrestaciones()
    {
        return $this->hasMany('App\Models\CotCotizantePrestacione', 'cotID_fk', 'cotID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotInvalidezs()
    {
        return $this->hasMany('App\Models\CotInvalidez', 'cotID_fk', 'cotID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotPlanillaCotizantes()
    {
        return $this->hasMany('App\Models\CotPlanillaCotizante', 'cotID_fk', 'cotID');
    }
}
