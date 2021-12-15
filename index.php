<?php
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Aplikasi Penyewaan Kendaraan</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- Canonical SEO  -->
    <link rel="canonical" href="https://www.creative-tim.com/product/light-bootstrap-dashboard">
    <!-- Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <?php
    ini_set("display_errors", 1);

    define("GELANG", true);

    require_once "libraries/koneksi.php";
    require_once "libraries/fungsi.php";

    //ambil data menu/modul
    if (isset($_SESSION['is_logged_in'])) {
        $sql    = "select m.* 
            from modul_role as mr 
            join modul as m on m.id_modul=mr.id_modul
            where mr.id_role=" . $_SESSION['id_role'] . " and mr.deleted_at is null and m.deleted_at is null";
        $menu   = mysqli_query($koneksi, $sql);
    };
    // die($menu);
    ?>

    <div class="wrapper">
        <?php if (isset($_SESSION['is_logged_in'])) : ?>
            <div class="sidebar" data-image="assets/img/sidebar-5.jpg">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="/creative_tim" class="simple-text">
                            Mob Rent
                        </a>
                    </div>
                    <ul class="nav">
                        <li>
                            <a class="nav-link" href="?page=home">
                                <i class="nc-icon nc-chart-pie-35"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <?php
                        while ($row = mysqli_fetch_assoc($menu)) :
                        ?>
                            <li>
                                <a class="nav-link" href="?page=<?= $row['nm_modul'] ?>">
                                    <i class="nc-icon <?= $row['icon_modul']; ?>"></i>
                                    <p><?= $row['judul_modul'] ?></p>
                                </a>
                            </li>
                        <?php endwhile; ?>
                        <li class="nav-item active active-pro">
                            <a class="nav-link active" href="?page=logout">
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <?php
                            if (isset($_GET['page']) == false) {
                                // tidak ada variabel GET "page"
                                $halaman = "login";
                            } else {
                                // ada "page"
                                $halaman = $_GET['page'];

                                // cek apakah ada halaman yang diminta
                                if (file_exists("pages/" . $halaman . ".php") == false) {
                                    //tidak ada file ini
                                    $halaman = "404";
                                }
                            }

                            $page_public = ['login', 'login_proses'];

                            if (in_array($halaman, $page_public) == false) {
                                //harus diproteksi (harus login)
                                if (isset($_SESSION['is_logged_in']) == false) {
                                    //belum login nih
                                    redirect('?page=login&err=2');
                                }
                            }

                            if (strpos($halaman, "_") !== false && in_array($halaman, $page_public) == false) {
                                // pengecekan otorisasi
                                // action di database: create, read, update, delete, save
                                $map_action_modul = [
                                    'create'    => 'create',
                                    'delete'    => 'delete',
                                    'edit'      => 'update',
                                    'update'    => 'update',
                                    'list'      => 'read',
                                    'pdf'       => 'read',
                                    'excel'     => 'read',
                                    'word'      => 'read',
                                    'save'      => 'save',
                                    'chart'     => 'read'
                                ];

                                $exp_halaman = explode("_", $halaman);
                                $action = $exp_halaman[1];
                                $modul = $exp_halaman[0];

                                if (in_array($action, ['pdf', 'excel', 'word'])) {
                                    ob_clean();
                                }

                                $action_modul = $map_action_modul[$action];
                                $id_role = $_SESSION['id_role'];

                                //cek data modul
                                $sql = "select * from modul where nm_modul like '$modul%' and deleted_at is null";
                                $data_modul = mysqli_query($koneksi, $sql);
                                $row_modul = mysqli_fetch_assoc($data_modul);
                                $id_modul = $row_modul['id_modul'];

                                //cek di database
                                $sql = "select * from modul_role where id_modul=$id_modul and id_role=$id_role and is_$action_modul=1 and deleted_at is null";
                                $data_modul_role = mysqli_query($koneksi, $sql);

                                if (mysqli_num_rows($data_modul_role) == 0) {
                                    //tidak punya kewenangan ini
                                    redirect('?page=403');
                                    exit;
                                }
                            }

                            require_once "pages/" . $halaman . ".php";
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="https://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: https://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
    <!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>
</body>

</html>