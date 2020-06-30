<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cotIncID
 * @property int $cotID_fk
 * @property string $incID_fk
 * @property string $cotIncFec
 * @property int $docIncID_fk
 * @property int $cotIncDiaIni
 * @property string $cotIncCon
 * @property int $cotIncPerFin
 * @property float $cotIncSal
 * @property string $cotIncFecIni
 * @property string $cotIncFecFin
 * @property CotCertIncapacidadTemporal $cotCertIncapacidadTemporal
 * @property CotCotizante $cotCotizante
 * @property CotIncapacidadesTemporale $cotIncapacidadesTemporale
 */
class CotizanteIncapacidad extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cot_Cotizante-Incapacidad';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'cotIncID';

    /**
     * @var array
     */
    protected $fillable = ['cotID_fk', 'incID_fk', 'cotIncFec', 'docIncID_fk', 'cotIncDiaIni', 'cotIncCon', 'cotIncPerFin', 'cotIncSal', 'cotIncFecIni', 'cotIncFecFin'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cotCertIncapacidadTemporal()
    {
        return $this->belongsTo('App\CotCertIncapacidadTemporal', 'docIncID_fk', 'docIncID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cotCotizante()
    {
        return $this->belongsTo('App\CotCotizante', 'cotID_fk', 'cotID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cotIncapacidadesTemporale()
    {
        return $this->belongsTo('App\CotIncapacidadesTemporale', 'incID_fk', 'incID');
    }
}
