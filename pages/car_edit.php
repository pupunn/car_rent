<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Edit Kendaraan</h4>
                    </div>
                    <?php
                        $id_kendaraan = clean_data($_GET['id_kendaraan']);
                        $sql = "select * from kendaraan where id_kendaraan=". $id_kendaraan;

                        $result = mysqli_query($koneksi, $sql);
                        $row = mysqli_fetch_assoc($result);
                        // print_r($row);
                    ?>
                    <div class="card-body">
                        <form action="?page=car_update" method="POST">
                            <input type="hidden" name="id_kendaraan" value="<?= $row['id_kendaraan'] ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Plat Nomer Kendaraan</label>
                                        <input type="text" class="form-control" name="plat_nomer" value="<?= $row['plat_nomer'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Kendaraan</label>
                                        <input type="text" class="form-control" name="nama_kendaraan" value="<?= $row['nama_kendaraan'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Kendaraan</label>
                                        <input type="text" class="form-control" name="jenis_kendaraan" value="<?= $row['jenis_kendaraan'] ?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" value="Simpan Data" class="btn btn-info btn-fill pull-right">Simpan</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
