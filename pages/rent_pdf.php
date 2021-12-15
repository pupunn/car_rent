<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require 'vendor/autoload.php';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Mob Rent');
$pdf->SetTitle('Laporan Peminjaman');
$pdf->SetSubject('Laporan Peminjaman');
$pdf->SetKeywords('PDF, Rent');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->setPrintHeader(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage("L");

$sql = "SELECT * FROM pinjam AS p JOIN kendaraan AS k ON k.id_kendaraan=p.id_kendaraan WHERE p.deleted_at IS NULL AND k.deleted_at IS NULL";

$result = mysqli_query($koneksi, $sql);

$html = '<h3>Laporan Data Peminjaman</h3><table border="1" cellpadding="5">
    <tr>
        <th width="40">No.</th>
        <th width="120">Kendaraan</th>
        <th>Nama Peminjam</th>
        <th>Alamat</th>
        <th width="120">Telepon</th>
        <th>Sewa Awal</th>
        <th width="120">Sewa Akhir</th>
        <th width="130">Biaya</th>
        <th>Status</th>
    </tr>
';
$no = 0;
while($row = mysqli_fetch_assoc($result)) {
    $no++;
    $status = $row['status'] == 0 ? "Sedang Dipinjam" : "Sudah Dikembalikan";
    $html .= "<tr>
        <td class='text-center'>" . $no . "</td>
        <td>" . $row['nama_kendaraan'] . "<br><b>". $row['plat_nomer'] ."</b></td>
        <td>" . $row['nama_peminjam'] . "</td>
        <td>" . $row['alamat'] . "</td>
        <td>" . $row['telp'] . "</td>
        <td>" . date("j/n/y G:i", strtotime($row['sewa_awal'])) . "</td>
        <td>" . date("j/n/y G:i", strtotime($row['sewa_akhir'])) . "</td>
        <td> Rp. " . number_format($row['biaya'],0,',','.') . ",-</td>
        <td>" . $status . "</td>
    </tr>";
}



$html .= "</table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('rent.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+