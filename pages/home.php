<?php
if (defined("GELANG") === false) {
    die("Anda tidak boleh membuka halaman ini secara langsung");
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header pb-3">
                        <h4 class="card-title">Selamat Datang, <?= $_SESSION['nama'] ?></h4>
                        <p class="card-category">di Sistem Informasi Rental Mobil</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>