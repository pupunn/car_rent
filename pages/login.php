<?php
if (defined("GELANG") === false) {
    die("Anda tidak boleh membuka halaman ini secara langsung");
}
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
        
            <div class="login">
                <h3 class="text-center">Mob Rent Login</h3>
                <form action="?page=login_proses" method="post">
                    <!-- <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
                    <!-- <h1 class="h3 mb-3 fw-normal">Silahkan Login Terlebih Dahulu</h1> -->
        
        
        
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($_GET['err'])) {
                                $err = $_GET['err'];
                                if ($err == 1) {
                                    echo "<div class='alert alert-danger'>Username atau password Anda salah</div>";
                                } elseif ($err == 2) {
                                    echo "<div class='alert alert-danger'>Anda harus login sebelum mengakses halaman tersebut!</div>";
                                }
                            }
                            if (isset($_GET['msg'])) {
                                $msg = $_GET['msg'];
                                if ($msg == 1) {
                                    echo "<div class='alert alert-success'>Logout berhasil! Good bye!</div>";
                                }
                            }
                            ?>
                            <div class="form-floating mb-2">
                                <label for="floatingInput">Username</label>
                                <input type="text" class="form-control" id="floatingInput" placeholder="masukkan username" name="username">
                            </div>
                            <div class="form-floating mb-4">
                                <label for="floatingPassword">Password</label>
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                            </div>
                            <button class="btn btn-primary w-100" type="submit">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        
        </div>
    </div>
</div>