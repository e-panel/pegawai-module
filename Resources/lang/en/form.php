<?php

return [
    'satker' => [
    	'label' => [
    		'label' => 'Label', 
    		'placeholder' => 'Contoh : Bagian Umum', 
    	], 
        'jabatan' => [
            'label' => 'Pimpinan Jabatan', 
            'placeholder' => 'Contoh : Kepala Bagian Umum', 
        ], 
        'atasan' => [
            'label' => 'Atasan Langsung', 
            'placeholder' => '- Pimpinan Utama -', 
        ], 
        'tupoksi' => [
            'label' => 'Tupoksi',  
            'active' => 'Tampilkan di Menu Bidang', 
            'note' => 'Dengan mengaktifkan <b>"Tampilkan di Menu Bidang"</b>, artinya Satuan Kerja ini akan ditampilkan dalam daftar menu bidang pada Frontend.'
        ], 
        'sotk' => [
            'label' => 'Pilih File SOTK', 
            'active' => 'Struktur Organisasi', 
            'note' => 'Aktifkan <b>"Struktur Organisasi"</b> apabila ingin menampilkan dalam bentuk Gambar.', 
            'notif' => 'Hanya menerima file dengan format <b>.jpg</b>, <b>.jpeg</b> dan <b>.png</b>.', 
        ],
    ], 

    'personil' => [
        'nip' => [
            'label' => 'NIP', 
            'placeholder' => 'Contoh : 196603071986011001', 
        ], 
        'name' => [
            'label' => 'NAMA PEGAWAI', 
            'placeholder' => 'Contoh : Dr. H. Asli Nuryadin', 
        ], 
        'phone' => [
            'label' => 'TELEPON', 
            'placeholder' => 'Contoh : 0811XXXXXXX', 
        ], 
        'email' => [
            'label' => 'EMAIL', 
            'placeholder' => 'Contoh : admin@domain.com', 
        ], 
        'golongan' => [
            'label' => 'GOLONGAN', 
            'placeholder' => 'Contoh : IV/A', 
        ], 
        'field' => [
            'label' => 'PILIH BIDANG', 
            'placeholder' => '', 
        ], 
        'address' => [
            'label' => 'ALAMAT', 
            'placeholder' => '', 
        ], 
        'photo' => [
            'label' => 'PILIH FOTO', 
            'placeholder' => '', 
            'select' => 'Pilih Foto', 
            'change' => 'Ganti', 
            'remove' => 'Remove', 
        ], 
    ], 

    'pimpinan' => [
        'nama' => [
            'label' => 'NAMA', 
            'placeholder' => 'Contoh : Noviyanto Rahmadi', 
        ], 
        'periode' => [
            'label' => 'PERIODE', 
            'placeholder' => 'Contoh : Kepala ' . env('EP_INSTANSI') . ' 1979-1981', 
        ], 
        'mulai' => [
            'label' => 'MULAI JABATAN', 
            'placeholder' => 'Contoh : 5 Januari 1979', 
        ], 
        'akhir' => [
            'label' => 'AKHIR JABATAN', 
            'placeholder' => 'Contoh : 3 Januari 1981', 
        ], 
        'aktif' => [
            'label' => 'PIMPINAN SEKARANG', 
            'placeholder' => 'Dengan mengaktifkan <b>"Pimpinan Sekarang"</b>, artinya pemimpin yang dimaksud akan ditampilkan di halaman <b>Profil Pimpinan</b>.', 
        ], 
        'photo' => [
            'label' => 'PILIH FOTO', 
            'placeholder' => '', 
            'select' => 'Pilih Foto', 
            'change' => 'Ganti', 
            'remove' => 'Remove', 
        ], 
    ], 
];