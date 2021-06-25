<?php

namespace Modules\Pegawai\Entities\Pimpinan;

use Illuminate\Database\Eloquent\Model;

class Karir extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pimpinan_karir';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'periode', 
		'label', 
		'pimpinan_id'
    ];

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pimpinan() 
    {
        return $this->belongsTo('Modules\Pegawai\Entities\Pimpinan', 'pimpinan_id');
    }
}