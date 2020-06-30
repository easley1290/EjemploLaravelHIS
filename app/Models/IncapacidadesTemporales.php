<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $incID
 * @property string $incDes
 * @property int $incDiaVal
 * @property int $incPor
 * @property string $incEst
 * @property CotCotizanteIncapacidad[] $cotCotizanteIncapacidads
 */
class IncapacidadesTemporales extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cot_IncapacidadesTemporales';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'incID';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['incID', 'incDes', 'incDiaVal', 'incPor', 'incEst'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotCotizanteIncapacidads()
    {
        return $this->hasMany('App\CotCotizanteIncapacidad', 'incID_fk', 'incID');
    }
}
