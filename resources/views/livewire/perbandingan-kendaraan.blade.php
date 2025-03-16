{{-- <div class="container">
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
                <figure class="highcharts-figure">
                    <div id="chartDistribusi" aria-label="Distribusi Jenis Kendaraan"></div>
                </figure>
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


    // CHART DETAIL KENDARAAN PER ARAH DATANG
    // Custom template helper
    // Highcharts.Templating.helpers.abs = value => Math.abs(value);

    // // Age categories
    // const categories = [
    //     '0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-40', '40-45',
    //     '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', '75-79', '80-84',
    //     '80+'
    // ];

    // Highcharts.chart('chartDistribusi', {
    //     chart: {
    //         type: 'bar'
    //     },
    //     title: {
    //         text: 'Population pyramid for Andorra, 2023'
    //     },
    //     subtitle: {
    //         text: 'Source: <a ' +
    //             'href="https://countryeconomy.com/demography/population-structure/andorra"' +
    //             'target="_blank">countryeconomy.com</a>'
    //     },
    //     accessibility: {
    //         point: {
    //             valueDescriptionFormat: '{index}. Age {xDescription}, {value}%.'
    //         }
    //     },
    //     xAxis: [{
    //         categories: categories,
    //         reversed: false,
    //         labels: {
    //             step: 1
    //         },
    //         accessibility: {
    //             description: 'Age (male)'
    //         }
    //     }, { // mirror axis on right side
    //         opposite: true,
    //         reversed: false,
    //         categories: categories,
    //         linkedTo: 0,
    //         labels: {
    //             step: 1
    //         },
    //         accessibility: {
    //             description: 'Age (female)'
    //         }
    //     }],
    //     yAxis: {
    //         title: {
    //             text: null
    //         },
    //         labels: {
    //             format: '{abs value}%'
    //         },
    //         accessibility: {
    //             description: 'Percentage population',
    //             rangeDescription: 'Range: 0 to 5%'
    //         }
    //     },

    //     plotOptions: {
    //         series: {
    //             stacking: 'normal',
    //             borderRadius: '50%'
    //         }
    //     },

    //     tooltip: {
    //         format: '<b>{series.name}, age {point.category}</b><br/>' +
    //             'Population: {(abs point.y):.2f}%'
    //     },

    //     series: [{
    //         name: 'Male',
    //         data: [
    //             -1.38, -2.09, -2.45, -2.71, -2.97,
    //             -3.69, -4.04, -3.81, -4.19, -4.61,
    //             -4.56, -4.21, -3.53, -2.55, -1.82,
    //             -1.46, -0.78, -0.71
    //         ]
    //     }, {
    //         name: 'Female',
    //         data: [
    //             1.35, 1.98, 2.43, 2.39, 2.71,
    //             3.02, 3.50, 3.52, 4.03, 4.40,
    //             4.17, 3.88, 3.29, 2.42, 1.80,
    //             1.39, 0.99, 1.15
    //         ]
    //     }]
    // });
});
</script>
 --}}


 {{-- <div class="container">
    <div class="card p-3 mt-3" style="background-color: #4C5C9A; border-radius: 10px; color: white;">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

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

    var formattedSeries = [...seriesMasuk, ...seriesKeluar];

    Highcharts.chart('chartDistribusi', {
        chart: { type: 'bar', height: 400, backgroundColor: 'transparent' },
        title: { text: '' },
        xAxis: { categories: categories, title: { text: 'Arah Pantauan' } },
        yAxis: { title: { text: 'Jumlah Kendaraan' }, labels: { enabled: false } },
        legend: { enabled: true },
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
                let totalMasuk = dataArah.find(d => d.arah + ' (' + d.lokasi + ')' === this.x).totalMasuk;
                let totalKeluar = dataArah.find(d => d.arah + ' (' + d.lokasi + ')' === this.x).totalKeluar;
                let totalArah = totalMasuk + totalKeluar;
                let persentaseArah = ((Math.abs(this.y) / totalArah) * 100).toFixed(1);
                return `<span style="color:${this.color}">\u25CF</span> 
                        <b>${this.series.name}: ${Math.abs(this.y)}</b> 
                        (${persentaseArah}%)`;
            }
        },
        series: formattedSeries
    });
});
</script> --}}


{{-- asdasdasd --}}


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
// document.addEventListener('DOMContentLoaded', function () {
//     var seriesData = @json($jenisKendaraan);

//     var totalMasuk = Math.abs(seriesData.reduce((acc, item) => acc + item.masuk, 0));
//     var totalKeluar = seriesData.reduce((acc, item) => acc + item.keluar, 0);
//     var totalKendaraan = totalMasuk + totalKeluar;

//     var formattedSeries = seriesData.map(item => [
//         {
//             name: item.name + ' Keluar',
//             data: [item.keluar],
//             color: '#D9534F',
//             percentage: (item.keluar / totalKeluar * 100).toFixed(1) // Persentase dari total keluar
//         },
//         {
//             name: item.name + ' Masuk',
//             data: [item.masuk],
//             color: '#4CAF50',
//             percentage: (Math.abs(item.masuk) / totalMasuk * 100).toFixed(1) // Persentase dari total masuk
//         }
//     ]).flat();

//     Highcharts.chart('chartPerbandingan', {
//         chart: { type: 'bar', height: 200, backgroundColor: 'transparent' },
//         title: { text: '' },
//         xAxis: { visible: false, title: '' },
//         yAxis: {
//             reversedStacks: false,
//             opposite: true,
//             labels: { enabled: false },
//             title: '',
//             startOnTick: false,
//             endOnTick: false
//         },
//         legend: { enabled: false },
//         plotOptions: {
//             bar: {
//                 stacking: 'normal',
//                 dataLabels: {
//                     enabled: false,
//                     formatter: function () {
//                         return this.percentage + '%';
//                     }
//                 }
//             }
//         },
//         tooltip: {
//             formatter: function () {
//                 return '<span style="color:' + this.color + '">\u25CF</span> ' +
//                     '<b>' + this.series.name + ': ' + Math.abs(this.y) +
//                     ' (' + this.series.options.percentage + '%)</b>';
//             }
//         },
//         series: formattedSeries
//     });


//     // CHART DETAIL KENDARAAN PER ARAH DATANG
//     // Custom template helper
//     // Highcharts.Templating.helpers.abs = value => Math.abs(value);

//     // // Age categories
//     // const categories = [
//     //     '0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-40', '40-45',
//     //     '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', '75-79', '80-84',
//     //     '80+'
//     // ];

//     // Highcharts.chart('chartDistribusi', {
//     //     chart: {
//     //         type: 'bar'
//     //     },
//     //     title: {
//     //         text: 'Population pyramid for Andorra, 2023'
//     //     },
//     //     subtitle: {
//     //         text: 'Source: <a ' +
//     //             'href="https://countryeconomy.com/demography/population-structure/andorra"' +
//     //             'target="_blank">countryeconomy.com</a>'
//     //     },
//     //     accessibility: {
//     //         point: {
//     //             valueDescriptionFormat: '{index}. Age {xDescription}, {value}%.'
//     //         }
//     //     },
//     //     xAxis: [{
//     //         categories: categories,
//     //         reversed: false,
//     //         labels: {
//     //             step: 1
//     //         },
//     //         accessibility: {
//     //             description: 'Age (male)'
//     //         }
//     //     }, { // mirror axis on right side
//     //         opposite: true,
//     //         reversed: false,
//     //         categories: categories,
//     //         linkedTo: 0,
//     //         labels: {
//     //             step: 1
//     //         },
//     //         accessibility: {
//     //             description: 'Age (female)'
//     //         }
//     //     }],
//     //     yAxis: {
//     //         title: {
//     //             text: null
//     //         },
//     //         labels: {
//     //             format: '{abs value}%'
//     //         },
//     //         accessibility: {
//     //             description: 'Percentage population',
//     //             rangeDescription: 'Range: 0 to 5%'
//     //         }
//     //     },

//     //     plotOptions: {
//     //         series: {
//     //             stacking: 'normal',
//     //             borderRadius: '50%'
//     //         }
//     //     },

//     //     tooltip: {
//     //         format: '<b>{series.name}, age {point.category}</b><br/>' +
//     //             'Population: {(abs point.y):.2f}%'
//     //     },

//     //     series: [{
//     //         name: 'Male',
//     //         data: [
//     //             -1.38, -2.09, -2.45, -2.71, -2.97,
//     //             -3.69, -4.04, -3.81, -4.19, -4.61,
//     //             -4.56, -4.21, -3.53, -2.55, -1.82,
//     //             -1.46, -0.78, -0.71
//     //         ]
//     //     }, {
//     //         name: 'Female',
//     //         data: [
//     //             1.35, 1.98, 2.43, 2.39, 2.71,
//     //             3.02, 3.50, 3.52, 4.03, 4.40,
//     //             4.17, 3.88, 3.29, 2.42, 1.80,
//     //             1.39, 0.99, 1.15
//     //         ]
//     //     }]
//     // });
// });
</script>


{{-- 
 <div class="container">
    <div class="card p-3 mt-3" style="background-color: #4C5C9A; border-radius: 10px; color: white;">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
</div> --}}

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
