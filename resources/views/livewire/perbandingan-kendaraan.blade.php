<div class="container">
    <div class="card p-3 mt-3" style="background-color: #e0e4f0; border-radius: 10px;">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <div class="row">
            <!-- Keterangan Masuk -->
            <div class="col-md-2 text-start">
                <h6 class="text-success fw-bold">MASUK</h6>
                <h2 class="text-success fw-bold">{{ number_format(abs(array_sum(array_column($jenisKendaraan, 'masuk'))), 2) }}</h2>
                <p class="text-success">Kendaraan</p>
                <h6 class="text-success fw-bold">
                    {{ round(abs(array_sum(array_column($jenisKendaraan, 'masuk'))) / 
                    (abs(array_sum(array_column($jenisKendaraan, 'masuk'))) + 
                    array_sum(array_column($jenisKendaraan, 'keluar'))) * 100, 1) }}%
                </h6>
            </div>

            <!-- Grafik Highcharts -->
            <div class="col-md-8">
                <figure class="highcharts-figure">
                    <div id="chartPerbandingan" aria-label="Total Kendaraan"></div>
                </figure>
            </div>

            <!-- Keterangan Keluar -->
            <div class="col-md-2 text-end">
                <h6 class="text-danger fw-bold">KELUAR</h6>
                <h2 class="text-danger fw-bold">{{ number_format(array_sum(array_column($jenisKendaraan, 'keluar')), 2) }}</h2>
                <p class="text-danger">Kendaraan</p>
                <h6 class="text-danger fw-bold">
                    {{ round(array_sum(array_column($jenisKendaraan, 'keluar')) / 
                    (abs(array_sum(array_column($jenisKendaraan, 'masuk'))) + 
                    array_sum(array_column($jenisKendaraan, 'keluar'))) * 100, 1) }}%
                </h6>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h4 class="text-center fw-bold">Titik Pantau</h4>
                <figure class="highcharts-figure">
                    <div id="chartDistribusi" aria-label="Distribusi Kendaraan"></div>
                </figure>
            </div>
        </div>

        <!-- Legenda -->
        <div class="row text-center mt-3">
            <div class="col">
                <span style="color: #F39C12; font-size: 20px;">&#x1F6F5;</span> Motor
                <span style="color: #2ECC71; font-size: 20px;">&#x1F697;</span> Mobil
                <span style="color: #34495E; font-size: 20px;">&#x1F68C;</span> Bus
                <span style="color: #E74C3C; font-size: 20px;">&#x1F69A;</span> Truk
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var seriesData = @json($jenisKendaraan);

    var totalMasuk = Math.abs(seriesData.reduce((acc, item) => acc + item.masuk, 0));
    var totalKeluar = seriesData.reduce((acc, item) => acc + item.keluar, 0);
    var totalKendaraan = totalMasuk + totalKeluar;

    var formattedSeries = seriesData.map(item => [
        {
            name: item.name + ' Keluar',
            data: [item.keluar],
            color: '#D9534F',
            percentage: (item.keluar / totalKeluar * 100).toFixed(1) // Persentase dari total keluar
        },
        {
            name: item.name + ' Masuk',
            data: [item.masuk],
            color: '#4CAF50',
            percentage: (Math.abs(item.masuk) / totalMasuk * 100).toFixed(1) // Persentase dari total masuk
        }
    ]).flat();

    Highcharts.chart('chartPerbandingan', {
        chart: { type: 'bar', height: 200, backgroundColor: 'transparent' },
        title: { text: '' },
        xAxis: { visible: false, title: '' },
        yAxis: {
            reversedStacks: false,
            opposite: true,
            labels: { enabled: false },
            title: '',
            startOnTick: false,
            endOnTick: false
        },
        legend: { enabled: false },
        plotOptions: {
            bar: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    formatter: function () {
                        return this.percentage + '%';
                    }
                }
            }
        },
        tooltip: {
            formatter: function () {
                return '<span style="color:' + this.color + '">\u25CF</span> ' +
                    '<b>' + this.series.name + ': ' + Math.abs(this.y) +
                    ' (' + this.series.options.percentage + '%)</b>';
            }
        },
        series: formattedSeries
    });

    var dataArah = @json($dataArah);

    var categories = dataArah.map(item => item.arah + ' (' + item.lokasi + ')');

    var seriesMasuk = [];
    var seriesKeluar = [];

    dataArah[0].jenis.forEach(jenis => {
        seriesMasuk.push({ name: jenis.name + ' Masuk', data: [], color: jenis.color });
        seriesKeluar.push({ name: jenis.name + ' Keluar', data: [], color: jenis.color });
    });

    dataArah.forEach(arah => {
        arah.jenis.forEach((jenis, index) => {
            seriesMasuk[index].data.push(-jenis.masuk); // Masuk bernilai negatif
            seriesKeluar[index].data.push(jenis.keluar); // Keluar bernilai positif
        });
    });

    var formattedSeries2 = [...seriesMasuk, ...seriesKeluar];

    Highcharts.chart('chartDistribusi', {
        chart: { type: 'bar', height: 200, backgroundColor: 'transparent' },
        title: { text: '' },
        xAxis: { categories: categories },
        yAxis: { title: { text: 'Jumlah Kendaraan' }, labels: { enabled: false } },
        legend: { enabled: false },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    formatter: function () {
                        return Math.abs(this.y);
                    }
                }
            }
        },
        tooltip: {
            formatter: function () {
                let totalMasuk = dataArah.find(d => d.arah + ' (' + d.lokasi + ')' === this.x.totalMasuk);
                let totalKeluar = dataArah.find(d => d.arah + ' (' + d.lokasi + ')' === this.x.totalKeluar);
                let totalArah = totalMasuk + totalKeluar;
                let persentaseArah = ((Math.abs(this.y) / totalArah) * 100).toFixed(1);
                return `<span style="color:${this.color}">\u25CF</span> 
                        <b>${this.series.name}: ${Math.abs(this.y)}</b> 
                        (${persentaseArah}%)`;
            }
        },
        series: formattedSeries2
    });
});
</script>
