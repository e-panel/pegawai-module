<?php

namespace Modules\Pegawai\Entities;

use Illuminate\Database\Eloquent\Model;

class Personil extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personil';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'uuid', 
		'foto', 
		'nama', 
		'nip', 
		'telepon', 
		'email', 
		'golongan', 
		'alamat', 
		'tupoksi', 
		'username', 
		'password', 
		'plain', 
		'id_bidang', 
		'id_jabatan'
    ];

    /**
     *  Setup model event hooks
     * 
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = uuid();
        });
    }

    /**
     * Scope a query for UUID.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query, $uuid
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUuid($query, $uuid) 
    {
        return $query->whereUuid($uuid);
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bidang() 
    {
        return $this->belongsTo('Modules\Pegawai\Entities\Satker', 'id_bidang');
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jabatan() 
    {
        return $this->belongsTo('Modules\Pegawai\Entities\Satker', 'id_jabatan');
    }
}
