<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }

    $id_kendaraan = $_GET['id_kendaraan'];

    $data = [
        'deleted_at' => date("Y-m-d H:i:s")
    ];

    update_data($koneksi, "kendaraan", $data, $id_kendaraan, "id_kendaraan");

    #redirect
    redirect("?page=car_list");

?>

