<?php
if (defined("GELANG") === false) {
    die("Anda tidak boleh membuka halaman ini secara langsung");
}

$sql = "SELECT * FROM pinjam AS p JOIN kendaraan AS k ON k.id_kendaraan=p.id_kendaraan WHERE p.deleted_at IS NULL AND k.deleted_at IS NULL";

$result = mysqli_query($koneksi, $sql);

$is_boleh_create = cek_akses($koneksi, 2, $_SESSION['id_role'], "create");
$is_boleh_read = cek_akses($koneksi, 2, $_SESSION['id_role'], "read");
$is_boleh_edit = cek_akses($koneksi, 2, $_SESSION['id_role'], "update");
$is_boleh_hapus = cek_akses($koneksi, 2, $_SESSION['id_role'], "delete");
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h4 class="card-title">Daftar Peminjaman</h4>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group me-2">
                                    <?php if ($is_boleh_create) : ?>
                                        <a href="?page=rent_create" class="btn btn-primary btn-fill pull-right">Tambah Peminjaman</a>
                                    <?php endif; ?>
                                    <?php if ($is_boleh_read) : ?>
                                        <a href="?page=rent_excel" class="btn btn-secondary btn-fill pull-right">Export XLSX</a>
                                        <a href="?page=rent_pdf" class="btn btn-danger btn-fill pull-right">Export PDF</a>
                                        <a href="?page=rent_chart" class="btn btn-success btn-fill pull-right">Chart</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kendaraan</th>
                                    <th>Nama Peminjam</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Sewa Awal</th>
                                    <th>Sewa Akhir</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $no++;
                                    $btn = array();
                                    if ($is_boleh_read == true)
                                        $btn[] = "<a href='?page=rent_word&id=" . $row['id'] . "' class='btn btn-sm btn-fill btn-warning mr-1'>Docx</a>";
                                    if ($is_boleh_edit == true)
                                        $btn[] = "<a href='?page=rent_edit&id=" . $row['id'] . "' class='btn btn-sm btn-fill btn-info mr-1'>Edit</a>";
                                    if ($is_boleh_hapus == true)
                                        $btn[] = "<a href='?page=rent_delete&id=" . $row['id'] . "' class='btn btn-sm btn-fill btn-danger'>Hapus</a>";
                                    $status = $row['status'] == 0 ? "Sedang Dipinjam" : "Sudah Dikembalikan";
                                    echo "<tr>
                                            <td class='text-center'>" . $no . "</td>
                                            <td>" . $row['nama_kendaraan'] . "<br><b>". $row['plat_nomer'] ."</b></td>
                                            <td>" . $row['nama_peminjam'] . "</td>
                                            <td>" . $row['alamat'] . "</td>
                                            <td>" . $row['telp'] . "</td>
                                            <td>" . date("j/n/y G:i", strtotime($row['sewa_awal'])) . "</td>
                                            <td>" . date("j/n/y G:i", strtotime($row['sewa_akhir'])) . "</td>
                                            <td> Rp. " . number_format($row['biaya'],0,',','.') . ",-</td>
                                            <td>" . $status . "</td>
                                            <td>
                                            " . implode(" ", $btn) . "
                                            </td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>