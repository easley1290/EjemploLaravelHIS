<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $domID
 * @property string $domNom
 * @property string $domDes
 * @property string $domEst
 * @property string $domUsuCrea
 * @property string $domFecCrea
 * @property string $domUsuMod
 * @property string $domFecMod
 * @property Subdominio[] $subdominios
 */
class Dominios extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Dominios';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'domID';

    /**
     * @var array
     */
    protected $fillable = ['domNom', 'domDes', 'domEst', 'domUsuCrea', 'domFecCrea', 'domUsuMod', 'domFecMod'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subdominios()
    {
        return $this->hasMany('App\Subdominio', 'domID_fk', 'domID');
    }
}
