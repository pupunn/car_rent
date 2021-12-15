<?php
if (defined("GELANG") === false) {
    die("Anda tidak boleh membuka halaman ini secara langsung");
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Edit Peminjaman</h4>
                    </div>
                    <?php
                        $id = clean_data($_GET['id']);
                        $sql = "SELECT * FROM pinjam AS p JOIN kendaraan AS k ON k.id_kendaraan=p.id_kendaraan WHERE p.id=". $id;

                        $result = mysqli_query($koneksi, $sql);
                        $row = mysqli_fetch_assoc($result);
                        // print_r($row);
                    ?>
                    <div class="card-body">
                        <form action="?page=rent_update" method="POST">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Peminjam</label>
                                        <input type="text" class="form-control" name="nama_peminjam" value="<?= $row['nama_peminjam'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat" value="<?= $row['alamat'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" class="form-control" name="telp" value="<?= $row['telp'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sewa Awal</label>
                                        <input type="datetime-local" class="form-control" name="sewa_awal" value="<?= date('Y-m-d\TH:i', strtotime($row['sewa_awal']));  ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sewa Akhir</label>
                                        <input type="datetime-local" class="form-control" name="sewa_akhir" value="<?= date('Y-m-d\TH:i', strtotime($row['sewa_akhir'])); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Biaya</label>
                                        <input type="text" class="form-control" name="biaya" value="<?= $row['biaya'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="kendaraan">Kendaraan yang Dipinjam</label>
                                        <select class="form-control" id="kendaraan" name="id_kendaraan" disabled>
                                            <option value="<?= $row['id_kendaraan'] ?>"><?= $row['nama_kendaraan'] ?> - <?= $row['plat_nomer'] ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kendaraan">Status Pinjaman</label>
                                        <select class="form-control" id="kendaraan" name="status">
                                            <option value="0" <?= $row['status'] == 0 ? "selected" : "" ?>>Sedang Dipinjam</option>
                                            <option value="1" <?= $row['status'] == 1 ? "selected" : "" ?>>Sudah Dikembalikan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" value="Simpan Data" class="btn btn-info btn-fill pull-right">Simpan</button>
                        <div class="clearfix"></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>