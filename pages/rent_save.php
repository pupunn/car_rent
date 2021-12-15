<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }

    $now = date("Y-m-d H:i:s");
    $data = [
        'id_kendaraan'      => $_POST['id_kendaraan'],
        'nama_peminjam'     => clean_data($_POST['nama_peminjam']),
        'alamat'            => clean_data($_POST['alamat'       ]),
        'telp'              => clean_data($_POST['telp']),
        'sewa_awal'         => clean_data($_POST['sewa_awal']),
        'sewa_akhir'        => clean_data($_POST['sewa_akhir']),
        'biaya'             => clean_data($_POST['biaya']),
        'status'            => clean_data($_POST['status']),
        'created_at'        => $now,
        'updated_at'        => $now,
    ];

    #insert into
    save_data($koneksi, "pinjam", $data);

    #redirect
    redirect("?page=rent_list");
