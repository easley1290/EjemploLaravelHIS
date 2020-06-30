<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $plaCotID
 * @property int $plaID_fk
 * @property int $cotID_fk
 * @property float $cotApo
 * @property string $plaMesApo
 * @property string $cotCi
 * @property CotCotizante $cotCotizante
 * @property CotPlanilla $cotPlanilla
 */
class PlanillaCotizante extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cot_PlanillaCotizante';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'plaCotID';

    /**
     * @var array
     */
    protected $fillable = ['plaID_fk', 'cotID_fk', 'cotApo', 'plaMesApo', 'cotCi'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cotCotizante()
    {
        return $this->belongsTo('App\Models\Cotizante', 'cotID_fk', 'cotID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cotPlanilla()
    {
        return $this->belongsTo('App\Models\Planillas', 'plaID_fk', 'plaID');
    }
}
