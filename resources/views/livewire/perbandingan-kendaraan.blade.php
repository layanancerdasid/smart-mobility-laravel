<div class="container" x-data="chartPerbandingan()" x-init="initChart()">
    <div class="card p-3 mt-3" style="background-color: #e0e4f0; border-radius: 10px;">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script src="https://rawgithub.com/highslide-software/crossing-specific-value/master/crossing-specific-value.js"></script>
        <div class="row">
            <!-- Keterangan Masuk -->
            <div class="col-md-2 text-start">
                <h6 class="text-success fw-bold">MASUK</h6>
                <h2 class="text-success fw-bold">{{ number_format(abs(array_sum(array_column($jenisKendaraan, 'masuk')))) }}</h2>
                <p class="text-success">Kendaraan</p>
                <h6 class="text-success fw-bold">
                    {{ (abs(array_sum(array_column($jenisKendaraan, 'masuk'))) + array_sum(array_column($jenisKendaraan, 'keluar'))) > 0 ? round(abs(array_sum(array_column($jenisKendaraan, 'masuk'))) / (abs(array_sum(array_column($jenisKendaraan, 'masuk'))) + array_sum(array_column($jenisKendaraan, 'keluar'))) * 100, 1) : 0 }}%
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
                <h2 class="text-danger fw-bold">{{ number_format(array_sum(array_column($jenisKendaraan, 'keluar'))) }}</h2>
                <p class="text-danger">Kendaraan</p>
                <h6 class="text-danger fw-bold">
                    {{ ((abs(array_sum(array_column($jenisKendaraan, 'masuk'))) + array_sum(array_column($jenisKendaraan, 'keluar'))) > 0) ? round(array_sum(array_column($jenisKendaraan, 'keluar')) / (abs(array_sum(array_column($jenisKendaraan, 'masuk'))) + array_sum(array_column($jenisKendaraan, 'keluar'))) * 100, 1) : 0 }}%
                </h6>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                
                <figure class="highcharts-figure">
                    <div id="chartDistribusi" aria-label="Distribusi Kendaraan"></div>
                </figure>
            </div>
        </div>
    </div>
</div>

<script>
    function chartPerbandingan() {
        return {
            chart: null,

            initChart() {
                // 🔥 Ambil data awal dari Livewire
                var seriesData = @json($jenisKendaraan);
                var dataArah = @json($dataArah);

                // 🔹 Buat chart perbandingan kendaraan masuk vs keluar
                this.populateChartPerbandingan(seriesData);

                // 🔹 Buat chart distribusi kendaraan berdasarkan arah
                this.populateChartDistribusi(dataArah);

                // 🔥 Event listener untuk update grafik dari Livewire
                document.addEventListener('updateChartData', (event) => {
                    let data = event.detail.detail;
                    // this.updateChartPerbandingan(data);
                    setTimeout(() => {
                        this.updateChartPerbandingan(data);
                    }, 1000);
                });

                document.addEventListener('updateChartDistribusi', (event) => {
                    let data = event.detail.detail;
                    // this.updateChartDistribusi(data);
                    setTimeout(() => {
                        this.updateChartDistribusi(data);
                    }, 1000);
                });
            },

            populateChartPerbandingan(seriesData) {
                var totalMasuk = Math.abs(seriesData.reduce((acc, item) => acc + item.masuk, 0));
                var totalKeluar = seriesData.reduce((acc, item) => acc + parseInt(item.keluar), 0);

                var formattedSeries = seriesData.map(item => [
                    {
                        name: item.name + ' Keluar',
                        data: [parseInt(item.keluar)],
                        color: '#D9534F',
                        percentage: (item.keluar / totalKeluar * 100).toFixed(1)
                    },
                    {
                        name: item.name + ' Masuk',
                        data: [item.masuk],
                        color: '#4CAF50',
                        percentage: (Math.abs(item.masuk) / totalMasuk * 100).toFixed(1)
                    }
                ]).flat();

                window.chartPerbandingan = Highcharts.chart('chartPerbandingan', {
                    chart: { type: 'bar', height: 200, backgroundColor: 'transparent' },
                    title: { text: '' },
                    xAxis: { visible: false },
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
                            dataLabels: { enabled: false }
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return `<span style="color:${this.color}">\u25CF</span> 
                                    <b>${this.series.name}: ${Math.abs(this.y)} (${this.series.options.percentage}%)</b>`;
                        }
                    },
                    series: formattedSeries
                });
            },
            populateChartDistribusi(dataArah) {
                const categories = dataArah.map(item => item.arah + ' (' + item.lokasi + ')');

                // Total masuk dan keluar per arah (tanpa breakdown jenis)
                const dataMasuk = dataArah.map(item =>
                    -Math.abs(item.totalMasuk || 0)
                );
                const dataKeluar = dataArah.map(item =>
                    Math.abs(item.totalKeluar || 0)
                );

                const series = [
                    {
                        name: 'Masuk',
                        color: '#4CAF50',
                        data: dataMasuk
                    },
                    {
                        name: 'Keluar',
                        color: '#D9534F',
                        data: dataKeluar
                    }
                ];

                window.chartDistribusi = Highcharts.chart('chartDistribusi', {
                    chart: {
                        type: 'bar',
                        height: 400,
                        backgroundColor: 'transparent'
                    },
                    title: {
                        text: 'Distribusi Kendaraan per Arah'
                    },
                    xAxis: {
                        categories: categories,
                        title: { text: null },
                        labels: {
                            align: 'center',
                            style: {
                                fontWeight: 'bold'
                            },
                            x: 0, // geser horizontal, kamu bisa sesuaikan (misal x: -10, 10)
                        }
                    },

                    yAxis: {
                        title: { text: 'Jumlah Kendaraan' },
                        labels: {
                            formatter: function () {
                                return Math.abs(this.value);
                            }
                        }
                    },
                    legend: {
                        reversed: true
                    },
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
                            return `<span style="color:${this.color}">\u25CF</span> 
                                    <b>${this.series.name}: ${Math.abs(this.y)}</b>`;
                        }
                    },
                    series: series
                });
            },
            updateChartPerbandingan(seriesData) {
                let totalMasukNew = Math.abs(seriesData.reduce((acc, item) => acc + (item.masuk || 0), 0));
                let totalKeluarNew = seriesData.reduce((acc, item) => acc + parseInt(item.keluar || 0), 0);

                let formattedSeriesNew = seriesData.map(item => [
                    {
                        name: item.name + ' Keluar',
                        data: [parseInt(item.keluar || 0)],
                        color: '#D9534F',
                        percentage: totalKeluarNew > 0 ? ((item.keluar / totalKeluarNew) * 100).toFixed(1) : 0
                    },
                    {
                        name: item.name + ' Masuk',
                        data: [item.masuk || 0],
                        color: '#4CAF50',
                        percentage: totalMasukNew > 0 ? ((Math.abs(item.masuk) / totalMasukNew) * 100).toFixed(1) : 0
                    }
                ]).flat();

                if (window.chartPerbandingan) {
                    window.chartPerbandingan.destroy();
                }

                this.populateChartPerbandingan(seriesData);
            },

            updateChartDistribusi(dataArah) {
                if (window.chartDistribusi) {
                    window.chartDistribusi.destroy();
                }

                this.populateChartDistribusi(dataArah);
            }
        };
    }
</script>
