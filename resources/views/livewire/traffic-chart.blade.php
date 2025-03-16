<div class="container">
    <!-- Filter Data: Asal Kendaraan -->
    <div class="d-flex gap-2 mt-4 mb-4">
        <button 
            class="btn btn-light fw-bold {{ $selectedOrigin === 'all' ? 'active' : '' }}" 
            wire:click="setOrigin('all')">
            Semua
        </button>
    
        <button 
            class="btn btn-light fw-bold {{ $selectedOrigin === 'utara' ? 'active' : '' }}" 
            wire:click="setOrigin('utara')">
            Utara (Tempel)
        </button>
    
        <button 
            class="btn btn-light fw-bold {{ $selectedOrigin === 'timur' ? 'active' : '' }}" 
            wire:click="setOrigin('timur')">
            Timur (Prambanan)
        </button>
    
        <button 
            class="btn btn-light fw-bold {{ $selectedOrigin === 'selatan' ? 'active' : '' }}" 
            wire:click="setOrigin('selatan')">
            Selatan (Piyungan)
        </button>
    
        <button 
            class="btn btn-light fw-bold {{ $selectedOrigin === 'barat' ? 'active' : '' }}" 
            wire:click="setOrigin('barat')">
            Barat (Glagah)
        </button>
    
        <style>
            .btn.active {
                background-color: #e0e4f0;
                color: #212529;
            }
        </style>
    </div>

    <div class="card p-3 mt-3" style="background-color: #e0e4f0; border-radius: 10px;">
        <div class="row">
            <!-- Chart Utama (Lebar 12) -->
            <div class="col-12 mb-4">
                <div id="trafficChart" style="height: 400px;"></div>
            </div>
    
            <!-- Dua Chart di Bawah (Masing-masing Lebar 6) -->
            <div class="col-md-6">
                <div id="designVolumeChart1" style="height: 300px;"></div>
            </div>
            <div class="col-md-6">
                <div id="designVolumeChart2" style="height: 300px;"></div>
            </div>
        </div>    

        <!-- Script Highcharts -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                console.log("Highcharts script loaded");
        
                // Data dummy awal (0-23 jam, semua data 0)
                let initialCategories = Array.from({length: 24}, (_, i) => i);
                let initialData = Array(24).fill(0);
                let randomData = initialCategories.map(() => Math.floor(Math.random() * (500 - 50 + 1)) + 50);
                let highPeakData = randomData.map(val => Math.round(val * 1.2));
                let design1Data = randomData.map(val => Math.round(val * 0.8));
                let design2Data = randomData.map(val => Math.round(val * 0.9));
        
                let trafficChart = Highcharts.chart('trafficChart', {
                    chart: { type: 'area' },
                    title: { text: 'Lalu Lintas Jam-Jaman Rata-Rata' },
                    xAxis: { categories: initialCategories },
                    yAxis: { title: { text: 'Kendaraan/Jam' } },
                    series: [
                        { name: 'LJR', data: randomData },
                        { name: '4 x 15 Menit Tertinggi', data: highPeakData, dashStyle: 'ShortDash' }
                    ]
                });
        
                let designVolumeChart1 = Highcharts.chart('designVolumeChart1', {
                    chart: { type: 'area' },
                    title: { text: 'Volume Jam Perancangan' },
                    xAxis: { categories: initialCategories },
                    yAxis: { title: { text: 'Kendaraan/Jam' } },
                    series: [{ name: 'Pemeriksaan', data: design1Data }]
                });
        
                let designVolumeChart2 = Highcharts.chart('designVolumeChart2', {
                    chart: { type: 'area' },
                    title: { text: 'Volume Jam Perancangan' },
                    xAxis: { categories: initialCategories },
                    yAxis: { title: { text: 'Kendaraan/Jam' } },
                    series: [{ name: 'Pemeriksaan', data: design2Data }]
                });
        
                Livewire.on('updateCharts', (selectedOrigin) => {
                    console.log("Fetching data for:", selectedOrigin);
                    
                    fetch(`/api/traffic-data?origin=${selectedOrigin}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log("Data received:", data);
        
                            if (!data.categories || !data.ljr_values || !data.high_peak_values) {
                                console.error("Data format error:", data);
                                return;
                            }
        
                            // Update data jika ada perubahan
                            trafficChart.xAxis[0].setCategories(data.categories.length ? data.categories : initialCategories);
                            trafficChart.series[0].setData(data.ljr_values.length ? data.ljr_values : initialData);
                            trafficChart.series[1].setData(data.high_peak_values.length ? data.high_peak_values : initialData);
        
                            designVolumeChart1.xAxis[0].setCategories(data.categories.length ? data.categories : initialCategories);
                            designVolumeChart1.series[0].setData(data.design1_values.length ? data.design1_values : initialData);
        
                            designVolumeChart2.xAxis[0].setCategories(data.categories.length ? data.categories : initialCategories);
                            designVolumeChart2.series[0].setData(data.design2_values.length ? data.design2_values : initialData);
                        })
                        .catch(error => console.error("Error fetching data:", error));
                });
            });
        </script>        
    </div>
</div>
