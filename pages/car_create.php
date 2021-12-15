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
                        <h4 class="card-title">Form Input Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <form action="?page=car_save" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Plat Nomer Kendaraan</label>
                                        <input type="text" class="form-control" name="plat_nomer" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Kendaraan</label>
                                        <input type="text" class="form-control" name="nama_kendaraan">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Kendaraan</label>
                                        <input type="text" class="form-control" name="jenis_kendaraan">
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