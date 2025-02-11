<div class="container mt-5">
    <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-data-source-tab" data-bs-toggle="pill" data-bs-target="#pills-data-source" type="button" role="tab" aria-controls="pills-data-source" aria-selected="true">Data Source</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Setting Parameter</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Preview</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-ulala-tab" data-bs-toggle="pill" data-bs-target="#pills-ulala" type="button" role="tab" aria-controls="pills-ulala" aria-selected="false">Result</button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-data-source" role="tabpanel" aria-labelledby="pills-data-source-tab">
            <div id="sub-page-1-1" class="sub-page">
                <h6>Select Data Source</h6>
                <div class="d-flex justify-content-left mt-3">
                    <button class="btn custom-btn me-3">
                        <i class="bi bi-plus-lg"></i> Data Dummy
                    </button>
                    <button class="btn custom-btn">
                        <i class="bi bi-plus-lg"></i> Data Real
                    </button>
                </div>
            </div>
            <div id="sub-page-1-2" class="sub-page" style="display: none;">
                <h6> Design intersection conditions to accommodate dynamic input traffic flows </h6>
                <div class="simulator-box shadow-lg">
                    <div class="row">
                        <!-- City Demographics Section -->
                        <div class="col-md-6">
                            <h4><strong>a. City Demographics</strong></h4>
                            <p>Demographics such as population size influence evaluation assessment standards.</p>
                            <button class="btn choose-city-btn">Choose City</button>
                        </div>
            
                        <!-- Intersection Condition Section -->
                        <div class="col-md-6">
                            <h4><strong>b. Intersection Condition</strong></h4>
                            <p>Generally, the width of the intersection arm ranges from 4-5 m</p>
            
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('images/simulator-page-1-2.png') }}" alt="Intersection Diagram" class="intersection-img">
                            </div>
            
                            <div class="input-group-box mt-3">
                                <label for="north-arm">North Arm Road Width</label>
                                <input type="text" class="form-control" id="north-arm" placeholder="Input">
            
                                <label for="west-arm">West Arm Road Width</label>
                                <input type="text" class="form-control" id="west-arm" placeholder="Input">
            
                                <label for="south-arm">South Arm Road Width</label>
                                <input type="text" class="form-control" id="south-arm" placeholder="Input">
            
                                <label for="east-arm">East Arm Road Width</label>
                                <input type="text" class="form-control" id="east-arm" placeholder="Input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <h6 class="text-white">Design an ATCS to manage traffic flow!</h6>

            <div class="simulator-box shadow-lg">
                <div class="row">
                    <!-- Traffic Light Time Section -->
                    <div class="col-md-6">
                        <h4><strong>a. Traffic Light Time</strong></h4>
                        <p>The total sum of traffic light time is called cycle time which is used as one of the bases for evaluating intersection performance.</p>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/simulator-page-2-traffic-light.png') }}" alt="Traffic Light" class="traffic-light-img">
                            
                            <div class="input-group-box ms-3">
                                <label for="red-light">Red Light</label>
                                <input type="text" class="form-control" id="red-light" placeholder="Input">
        
                                <label for="yellow-light">Yellow Light</label>
                                <input type="text" class="form-control" id="yellow-light" placeholder="Input">
        
                                <label for="red-light-2">Green Light</label>
                                <input type="text" class="form-control" id="red-light-2" placeholder="Input">
        
                                <label for="all-red-light">All Red Light</label>
                                <input type="text" class="form-control" id="all-red-light" placeholder="Input">
                            </div>
                        </div>
                    </div>
        
                    <!-- Intersection Condition Section -->
                    <div class="col-md-6">
                        <h4><strong>b. Intersection Condition</strong></h4>
                        <p>Sets each phase of which arm moves in which direction of the turn</p>
        
                        <div class="phase-container">
                            <div class="phase-card">
                                <img src="{{ asset('images/simulator-page-2-phase.png') }}" alt="Phase 1" class="phase-img phase-1">
                                <p>Phase 1</p>
                            </div>
                            <div class="phase-card">
                                <img src="{{ asset('images/simulator-page-2-phase.png') }}" alt="Phase 2" class="phase-img phase-2">
                                <p>Phase 2</p>
                            </div>
                            <div class="phase-card">
                                <img src="{{ asset('images/simulator-page-2-phase.png') }}" alt="Phase 3" class="phase-img phase-3">
                                <p>Phase 3</p>
                            </div>
                            <div class="phase-card">
                                <img src="{{ asset('images/simulator-page-2-phase.png') }}" alt="Phase 4" class="phase-img phase-4">
                                <p>Phase 4</p>
                            </div>
                        </div>
        
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn custom-btn">Set Default Phase</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <h3 class="text-white">Here are the analysis insights from the intersection design you crafted!</h3>

            <div class="simulator-box shadow-lg">
                <div class="row">
                    <!-- Traffic Analysis Section -->
                    <div class="col-md-6">
                        <h4><strong>a. Traffic Analysis</strong></h4>
                        <p>Traffic analysis results per intersection’s arm at certain time intervals.</p>
                        <div id="traffic-chart" class="traffic-chart"></div>
                    </div>
        
                    <!-- Intersection Analysis Section -->
                    <div class="col-md-6">
                        <h4><strong>b. Intersection Analysis</strong></h4>
                        <p>Show Intersection’s arm analysis</p>
                        <div class="analysis-table-wrapper">
                            <table class="table table-bordered analysis-table">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>Time</th>
                                        <th>Arm</th>
                                        <th>Saturation (vehicle/hour)</th>
                                        <th>Flow Ratio</th>
                                        <th>Cycle time(s)</th>
                                        <th>Green Time(s)</th>
                                        <th>Capacity (vehicle/hour)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Morning -->
                                    <tr><td rowspan="4" class="align-middle">Morning (07.00-08.00)</td><td>North</td><td>2,156</td><td>0.017</td><td>120</td><td>25</td><td>449</td></tr>
                                    <tr><td>East</td><td>3,590</td><td>0.122</td><td>120</td><td>25</td><td>748</td></tr>
                                    <tr><td>South</td><td>3,072</td><td>0.040</td><td>120</td><td>25</td><td>640</td></tr>
                                    <tr class="highlight"><td>West</td><td>3,612</td><td>0.110</td><td>120</td><td>25</td><td>753</td></tr>
            
                                    <!-- Day -->
                                    <tr><td rowspan="4" class="align-middle">Day (12.00-13.00)</td><td>North</td><td>2,238</td><td>0.034</td><td>120</td><td>25</td><td>466</td></tr>
                                    <tr><td>East</td><td>3,558</td><td>0.194</td><td>120</td><td>25</td><td>741</td></tr>
                                    <tr><td>South</td><td>3,058</td><td>0.041</td><td>120</td><td>25</td><td>637</td></tr>
                                    <tr class="highlight"><td>West</td><td>3,613</td><td>0.177</td><td>120</td><td>25</td><td>753</td></tr>
            
                                    <!-- Evening -->
                                    <tr><td rowspan="4" class="align-middle">Evening (16.45-17.45)</td><td>North</td><td>2,177</td><td>0.031</td><td>120</td><td>25</td><td>454</td></tr>
                                    <tr><td>East</td><td>3,517</td><td>0.159</td><td>120</td><td>25</td><td>733</td></tr>
                                    <tr><td>South</td><td>3,096</td><td>0.037</td><td>120</td><td>25</td><td>645</td></tr>
                                    <tr class="highlight"><td>West</td><td>3,618</td><td>0.167</td><td>120</td><td>25</td><td>754</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-ulala" role="tabpanel" aria-labelledby="pills-ulala-tab">
            {{-- This part is Page 4 --}}
            <h3 class="text-white">Intersection Evaluation Insights</h3>
            <div class="simulator-box shadow-lg">
                @foreach($evaluationData as $timeSlot)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4>{{ $timeSlot['time'] }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Arm</th>
                                    <th>Saturation Degree</th>
                                    <th>Queue Length (m)</th>
                                    <th>Stopped Vehicles (vehicle/hours)</th>
                                    <th>Delay (s/vehicle)</th>
                                    <th>LoS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timeSlot['data'] as $data)
                                <tr class="{{ $data['saturation'] > 0.8 ? 'danger' : '' }}">
                                    <td>{{ $data['arm'] }}</td>
                                    <td class="{{ $data['saturation'] > 0.8 ? 'highlight' : '' }}">{{ $data['saturation'] }}</td>
                                    <td>{{ $data['queue_length'] }}</td>
                                    <td>{{ $data['stopped_vehicles'] }}</td>
                                    <td>{{ $data['delay'] }}</td>
                                    <td>{{ $data['los'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="card p-3 text-white" style="background: linear-gradient(#CC0001, #BA0001, #CC0001)">
                            <h5>Peak Traffic Time</h5>
                            <p><strong>12.00 - 13.00</strong></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-white" style="background: linear-gradient(#CC0001, #BA0001, #CC0001)">
                            <h5>CO Pollution</h5>
                            <p><strong>30 µg/m³</strong></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-white" style="background: linear-gradient(#CC0001, #BA0001, #CC0001)">
                            <h5>Lost Estimation</h5>
                            <p><strong>$100</strong></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-white" style="background: linear-gradient(#CC0001, #BA0001, #CC0001)">
                            <h5>Vehicles Queued</h5>
                            <p><strong>49</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <button class="nav-btn btn btn-secondary" onclick="prevTab()">Previous</button>
            <span id="tab-page-number">1.1/4</span>
            <button class="nav-btn btn btn-primary" onclick="nextTab()">Next</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        Highcharts.chart('traffic-chart', {
            chart: { type: 'line' },
            title: { text: '' },
            xAxis: { categories: ['Morning', 'Day', 'Evening'] },
            yAxis: { title: { text: 'vehicles per day time ' } },
            series: [
                { name: 'North', data: [2156, 2238, 2177], color: 'blue' },
                { name: 'East', data: [3590, 3558, 3517], color: 'red' },
                { name: 'South', data: [3072, 3058, 3096], color: 'orange' },
                { name: 'West', data: [3612, 3613, 3618], color: 'yellow' }
            ]
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        let tabs = ["pills-data-source-tab", "pills-profile-tab", "pills-contact-tab", "pills-ulala-tab"];
        let currentTab = 0;
        let currentSubPage = 1; // Mulai dari sub-page 1.1

        function updateTabUI() {
            if (currentTab === 0) { // Jika masih di "Data Source"
                document.querySelectorAll(".sub-page").forEach((page, index) => {
                    page.style.display = (index + 1 === currentSubPage) ? "block" : "none";
                });
                document.getElementById("tab-page-number").innerText = `1.${currentSubPage}/4`;

            } else {
                document.getElementById(tabs[currentTab]).click(); // Aktifkan tab sesuai index
                document.getElementById("tab-page-number").innerText = `${currentTab + 1}/4`;
            }

            // Sembunyikan tombol jika di awal atau akhir
            document.querySelector(".nav-btn:first-of-type").style.display = (currentTab === 0 && currentSubPage === 1) ? "none" : "inline-block";
            document.querySelector(".nav-btn:last-of-type").style.display = (currentTab === tabs.length - 1) ? "none" : "inline-block";
        }

        window.nextTab = function () {
            if (currentTab === 0 && currentSubPage < 2) {
                currentSubPage++;
            } else if (currentTab < tabs.length - 1) {
                currentTab++;
                currentSubPage = 1; // Reset sub-page saat berpindah tab
            }
            updateTabUI();
        };

        window.prevTab = function () {
            if (currentTab === 0 && currentSubPage > 1) {
                currentSubPage--;
            } else if (currentTab > 0) {
                currentTab--;
                currentSubPage = 1; // Reset sub-page saat kembali tab
            }
            updateTabUI();
        };

        updateTabUI(); // Set awal agar tombol pertama tidak muncul
    });
</script>