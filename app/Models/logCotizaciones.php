<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $logCotID
 * @property int $apoID
 * @property int $mulID
 * @property int $cobID
 * @property int $mulPlaID
 * @property int $plaID
 * @property string $cotID
 * @property string $logUsuCre
 * @property string $logFecCre
 * @property string $logUsuMod
 * @property string $logFecMod
 * @property string $logUsuDel
 * @property string $logFecDel
 * @property string $incID
 */
class logCotizaciones extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Log_Cotizaciones';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'logCotID';

    /**
     * @var array
     */
    protected $fillable = ['apoID', 'mulID', 'cobID', 'mulPlaID', 'plaID', 'cotID', 'logUsuCre', 'logFecCre', 'logUsuMod', 'logFecMod', 'logUsuDel', 'logFecDel', 'incID'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
