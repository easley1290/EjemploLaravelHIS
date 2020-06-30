<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $valID
 * @property int $subID_fk
 * @property string $valDes
 * @property float $valValor1
 * @property string $valValor2
 * @property string $valEst
 * @property string $valUsuCrea
 * @property string $valFecCrea
 * @property string $valUsuMod
 * @property string $valFecMod
 * @property Subdominio $subdominio
 */
class ValoresSubdominios extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ValoresSubdominios';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'valID';

    /**
     * @var array
     */
    protected $fillable = ['subID_fk', 'valDes', 'valValor1', 'valValor2', 'valEst', 'valUsuCrea', 'valFecCrea', 'valUsuMod', 'valFecMod'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subdominio()
    {
        return $this->belongsTo('App\Subdominio', 'subID_fk', 'subID');
    }
}
