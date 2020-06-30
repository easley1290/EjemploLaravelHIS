<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $bajID
 * @property string $bajDoc
 * @property string $bajFec
 * @property string $bajFecSer
 * @property int $cotID_fk
 * @property string $bajTip
 * @property CotCotizante $cotCotizante
 */
class Bajas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cot_Baja';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'bajID';

    /**
     * @var array
     */
    protected $fillable = ['bajDoc', 'bajFec', 'bajFecSer', 'cotID_fk', 'bajTip'];

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
}
