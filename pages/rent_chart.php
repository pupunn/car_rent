<?php
if (defined("GELANG") === false) {
    die("Anda tidak boleh membuka halaman ini secara langsung");
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.1/dist/chart.min.js"></script>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Chart Peminjaman</h1>
</div>

<?php
$sql = "select date_format(sewa_awal, '%M') as month,count(*) as num
            from pinjam
            group by 1
            order by 1 desc;";
$hasil = mysqli_query($koneksi, $sql);

$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($hasil)) {
    $labels[] = $row['month'];
    $data[] = $row['num'];
}
?>

<div class="row">
    <div class="col-6">
        <canvas id="myChart" width="400" height="300"></canvas>
    </div>
</div>

<script>
    const labels = [<?= '"'.implode('","', $labels).'"' ?>];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Jumlah Pinjaman Kendaraan per Bulan',
            data: [<?= implode(',', $data) ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
            ],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>