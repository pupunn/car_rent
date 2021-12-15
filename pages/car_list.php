<?php
if (defined("GELANG") === false) {
    die("Anda tidak boleh membuka halaman ini secara langsung");
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h4 class="card-title">Daftar Kendaraan</h4>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group me-2">
                                    <a href="?page=car_create" type="submit" class="btn btn-primary btn-fill pull-right">Tambah Kendaraan</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-full-width table-responsive">

                        <?php
                        $sql = "SELECT * FROM kendaraan WHERE deleted_at IS NULL";

                        $result = mysqli_query($koneksi, $sql);

                        $is_boleh_edit = cek_akses($koneksi, 1, $_SESSION['id_role'], "update");
                        $is_boleh_hapus = cek_akses($koneksi, 1, $_SESSION['id_role'], "delete");
                        ?>

                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Plat Nomer</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $no++;
                                    $btn = array();
                                    if ($is_boleh_edit == true)
                                        $btn[] = "<a href='?page=car_edit&id_kendaraan=" . $row['id_kendaraan'] . "' class='btn btn-sm btn-fill btn-info mr-1'>Edit</a>";
                                    if ($is_boleh_hapus == true)
                                        $btn[] = "<a href='?page=car_delete&id_kendaraan=" . $row['id_kendaraan'] . "' class='btn btn-sm btn-fill btn-danger'>Hapus</a>";
                                    echo "<tr>
                                                        <td class='text-center'>" . $no . "</td>
                                                        <td>" . $row['plat_nomer'] . "</td>
                                                        <td>" . $row['nama_kendaraan'] . "</td>
                                                        <td>" . $row['jenis_kendaraan'] . "</td>
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
