<?php

namespace Modules\Pegawai\Entities\Pimpinan;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pimpinan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'uuid', 
		'foto', 
		'nama', 
		'periode', 
		'sambutan', 
		'mulai_jabatan', 
		'akhir_jabatan', 
		'aktif'
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
     * Scope a query for Aktif.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query, $string
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAktif($query, $string) 
    {
        return $query->whereAktif($string);
    }

    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function karir() 
    {
        return $this->hasMany('Modules\Pegawai\Entities\Pimpinan\Karir', 'pimpinan_id');
    }

    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function pendidikan() 
    {
        return $this->hasMany('Modules\Pegawai\Entities\Pimpinan\Pendidikan', 'pimpinan_id');
    }
}
