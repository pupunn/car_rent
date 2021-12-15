<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sql = "SELECT * FROM pinjam AS p JOIN kendaraan AS k ON k.id_kendaraan=p.id_kendaraan WHERE p.deleted_at IS NULL AND k.deleted_at IS NULL";

$result = mysqli_query($koneksi, $sql);

$sheet->setCellValue('A1', 'No.'); 
$sheet->setCellValue('B1', 'Kendaraan'); 
$sheet->setCellValue('C1', 'Nama Peminjam'); 
$sheet->setCellValue('D1', 'Alamat'); 
$sheet->setCellValue('E1', 'Telepon'); 
$sheet->setCellValue('F1', 'Sewa Awal'); 
$sheet->setCellValue('G1', 'Sewa Akhir'); 
$sheet->setCellValue('H1', 'Biaya'); 
$sheet->setCellValue('I1', 'Status'); 

$no = 0;
$baris = 2;
while($row = mysqli_fetch_assoc($result))
{
    $no++;
    $status = $row['status'] == 0 ? "Sedang Dipinjam" : "Sudah Dikembalikan";
    $sheet->setCellValue("A".$baris, $no);
    $sheet->setCellValue("B".$baris, $row['nama_kendaraan'].' - '.$row['plat_nomer']);
    $sheet->setCellValue("C".$baris, $row['nama_peminjam']);
    $sheet->setCellValue("D".$baris, $row['alamat']);
    $sheet->setCellValue("E".$baris, $row['telp']);
    $sheet->setCellValue("F".$baris, date("j/n/y G:i", strtotime($row['sewa_awal'])));
    $sheet->setCellValue("G".$baris, date("j/n/y G:i", strtotime($row['sewa_akhir'])));
    $sheet->setCellValue("H".$baris, "Rp. " . number_format($row['biaya'],0,',','.') . ",-");
    $sheet->setCellValue("I".$baris, $status);
    
    $baris++;
}
$writer = new Xlsx($spreadsheet);
$writer->save('rent.xlsx');

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment; filename="rent.xlsx"');
// $writer->save('php://output');

echo "<script>
    window.location.replace('rent.xlsx');
</script>";