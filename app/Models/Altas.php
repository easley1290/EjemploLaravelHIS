<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $altID
 * @property string $altDoc
 * @property string $altFec
 * @property string $altFecSer
 * @property string $altTip
 * @property int $cotID_fk
 * @property CotCotizante $cotCotizante
 */
class Altas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cot_alta';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'altID';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['altID', 'altDoc', 'altFec', 'altFecSer', 'altTip', 'cotID_fk'];

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
