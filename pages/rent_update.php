<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }

    $now = date("Y-m-d H:i:s");
    $data   = [
        'nama_peminjam'     => clean_data($_POST['nama_peminjam']),
        'alamat'            => clean_data($_POST['alamat']),
        'telp'              => clean_data($_POST['telp']),
        'sewa_awal'         => clean_data($_POST['sewa_awal']),
        'sewa_akhir'        => clean_data($_POST['sewa_akhir']),
        'biaya'             => clean_data($_POST['biaya']),
        'status'            => clean_data($_POST['status']),
        'updated_at'        => $now,
    ];
    $id = clean_data($_POST['id']);

    update_data($koneksi, "pinjam", $data, $id, "id");

    #redirect
    redirect("?page=rent_list");

?>

