<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $subID
 * @property int $domID_fk
 * @property string $subNom
 * @property string $subDes
 * @property string $subCodAnt
 * @property string $subEst
 * @property string $subUsuCrea
 * @property string $subFecCrea
 * @property string $subUsuMod
 * @property string $subFecMod
 * @property Dominio $dominio
 * @property ValoresSubdominio[] $valoresSubdominios
 */
class Subdominios extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Subdominios';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'subID';

    /**
     * @var array
     */
    protected $fillable = ['domID_fk', 'subNom', 'subDes', 'subCodAnt', 'subEst', 'subUsuCrea', 'subFecCrea', 'subUsuMod', 'subFecMod'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dominio()
    {
        return $this->belongsTo('App\Dominio', 'domID_fk', 'domID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function valoresSubdominios()
    {
        return $this->hasMany('App\ValoresSubdominio', 'subID_fk', 'subID');
    }
}
