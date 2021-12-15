<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }

    $now = date("Y-m-d H:i:s");
    $data   = [
        'plat_nomer'        => clean_data($_POST['plat_nomer']),
        'nama_kendaraan'    => clean_data($_POST['nama_kendaraan']),
        'jenis_kendaraan'   => clean_data($_POST['jenis_kendaraan']),
        'updated_at'        => $now,
    ];
    $id_kendaraan = clean_data($_POST['id_kendaraan']);

    update_data($koneksi, "kendaraan", $data, $id_kendaraan, "id_kendaraan");

    #redirect
    redirect("?page=car_list");

?>

