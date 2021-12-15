<?php
require 'vendor/autoload.php';

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$id = $_GET['id'];
$sql = "SELECT * FROM pinjam AS p JOIN kendaraan AS k ON k.id_kendaraan=p.id_kendaraan WHERE p.id=". $id;

$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('D:\Projek\Fullstack Web Developer\mob_rent\SURAT PERJANJIAN RENTAL.docx');
$templateProcessor->setValue('nama_kendaraan', $row['nama_kendaraan']);
$templateProcessor->setValue('plat_nomer', $row['plat_nomer']);
$templateProcessor->setValue('nama_peminjam', $row['nama_peminjam']);
$templateProcessor->setValue('alamat', $row['alamat']);
$templateProcessor->setValue('telp', $row['telp']);
$templateProcessor->setValue('sewa_awal', tgl_indo(date("Y-m-d", strtotime($row['sewa_awal']))));
$templateProcessor->setValue('sewa_akhir', tgl_indo(date("Y-m-d", strtotime($row['sewa_akhir']))));
$templateProcessor->setValue('biaya', "Rp. " . number_format($row['biaya'],0,',','.') . ",-");

$templateProcessor->saveAs('rent.docx');
echo "<script>
    window.location.replace('rent.docx');
</script>";

// $objWriter = \PhpOffice\PhpWord\IDFactory::createWriter($phpWord, 'Word2007');
// $objWriter->save('movie.docx');