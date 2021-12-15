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
                        <h4 class="card-title">Form Input Peminjaman</h4>
                    </div>
                    <div class="card-body">
                        <form action="?page=rent_save" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Peminjam</label>
                                        <input type="text" class="form-control" name="nama_peminjam">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" class="form-control" name="telp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sewa Awal</label>
                                        <input type="datetime-local" class="form-control" name="sewa_awal">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sewa Akhir</label>
                                        <input type="datetime-local" class="form-control" name="sewa_akhir">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Biaya</label>
                                        <input type="text" class="form-control" name="biaya">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <?php
                                        $sql    = "SELECT k.* FROM kendaraan AS k
                                        LEFT OUTER JOIN pinjam AS p ON p.id_kendaraan = k.id_kendaraan
                                        WHERE (p.id_kendaraan IS NULL OR p.status = 1) AND p.deleted_at IS NULL AND k.deleted_at IS NULL";
                                        $result = mysqli_query($koneksi, $sql);
                                    ?>
                                    <div class="form-group">
                                        <label for="kendaraan">Kendaraan yang Dipinjam</label>
                                        <select class="form-control" id="kendaraan" name="id_kendaraan">
                                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                                <option value="<?= $row['id_kendaraan'] ?>"><?= $row['nama_kendaraan'] ?> - <?= $row['plat_nomer'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kendaraan">Status Pinjaman</label>
                                        <select class="form-control" id="kendaraan" name="status">
                                            <option value="0">Sedang Dipinjam</option>
                                            <option value="1">Sudah Dikembalikan</option>
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