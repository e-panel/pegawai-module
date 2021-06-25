<?php

Route::prefix('epanel/plugin')->as('epanel.')->middleware(['auth', 'check.permission:Pegawai'])->group(function() 
{
    Route::resources([
        'pegawai' => 'PegawaiController',
        'satker' => 'SatkerController',
        
        'pimpinan' => 'PimpinanController',
        'pimpinan.profile' => 'ProfileController',
    ]);
});