<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }

    $id = $_GET['id'];

    $data = [
        'deleted_at' => date("Y-m-d H:i:s")
    ];

    update_data($koneksi, "pinjam", $data, $id, "id");

    #redirect
    redirect("?page=rent_list");

?>

