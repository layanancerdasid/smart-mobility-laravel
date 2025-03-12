<div class="container-fluid tutorial-section">
    <div class="tutorial-box">
        <h2 class="text-center">Tutorial</h2>
        <div class="tutorial-tabs">
            <button class="tab-btn active" id="tab-1" onclick="changeContent(1)">1<br><span>Goal</span></button>
            <button class="tab-btn" id="tab-2" onclick="changeContent(2)">2<br><span>Parameter</span></button>
            <button class="tab-btn" id="tab-3" onclick="changeContent(3)">3<br><span>Impact</span></button>
        </div>

        <div class="tutorial-content" id='tutorial-content'>
            <div id="tutorial-text">
                <p>Intersections are a vital part of traffic as a meeting point for vehicles between roads to move from one road to another. ATCS (Traffic lights) plays an important role in moving and directing vehicles with minimal conflict with other vehicles and avoiding accidents.</p>
                <br/>
                <p>In this simulation, we will try to design ATCS at an city intersection and its impact!</p>
            </div>
            <div id="parameter-image" style="display: none;">
                <img src="{{ asset('images/Matric-no-bg.png') }}" alt="Matrix Image">
            </div>
            <div class="tutorial-image">
                <img id="tutorial-image" src="{{ asset('images/tutorial-page1.png') }}" alt="Tutorial Image">
            </div>
        </div>

        <div class="tutorial-navigation">
            <button class="nav-btn" onclick="prevPage()">Previous</button>
            <span id="page-number">1/3</span>
            <button class="start-btn" id="start-button" style="display: none;" onclick="startSimulation()">Start <i class="fa fa-plus"></i></button>
            <button class="nav-btn" id="next-button" onclick="nextPage()">Next</button>
        </div>
    </div>
</div>

<script> 
document.addEventListener("DOMContentLoaded", function () {
    let currentPage = 1; // Main section (1, 2, or 3)
    let subPage = 1; // Sub-pages for section 2
    let savedContent = ""; // Temporary storage for tutorial-content in step 3


    let contentText = document.getElementById("tutorial-text");
    let tutorialImage = document.getElementById("tutorial-image");
    let pageNumber = document.getElementById("page-number");
    let contentDiv = document.getElementById("tutorial-content");
    let nextButton = document.getElementById("next-button");
    let startButton = document.getElementById("start-button");
    
    function updatePageUI() {
        contentText = document.getElementById("tutorial-text");
        tutorialImage = document.getElementById("tutorial-image");
        pageNumber = document.getElementById("page-number");
        contentDiv = document.getElementById("tutorial-content");
        nextButton = document.getElementById("next-button");
        startButton = document.getElementById("start-button");

        if (!tutorialImage) {
            console.error("Error: 'tutorial-image' not found in DOM!");
            return;
        }

        // Reset all tabs
        document.querySelectorAll(".tab-btn").forEach(btn => btn.classList.remove("active"));
        document.getElementById(`tab-${currentPage}`).classList.add("active");

        if (currentPage === 1) {
            tutorialImage.src = "/images/tutorial-page1.png";
            contentText.innerHTML = `
                <p>Intersections are a vital part of traffic as a meeting point for vehicles between roads to move from one road to another. ATCS (Traffic lights) plays an important role in moving and directing vehicles with minimal conflict with other vehicles and avoiding accidents.</p>
                <br/>
                <p>In this simulation, we will try to design ATCS at a city intersection and its impact!</p>
            `;
            pageNumber.innerText = "1/3";
            tutorialImage.style.display = "block";
            nextButton.style.display = "block";
            startButton.style.display = "none";
        } 
        else if (currentPage === 2) {
            pageNumber.innerText = `2.${subPage}/3`;

            if (subPage === 1) {
                tutorialImage.src = "/images/tutorial-page2.png";
                contentText.innerHTML = `
                    <h4>2.1 Saturation Degree</h4>
                    <p>Evaluation parameter that compares the 
                    <span class="highlight-red">traffic flow</span> to its 
                    <span class="highlight-green">capacity</span>.</p>
                `;
                tutorialImage.style.display = "block";
                nextButton.style.display = "block";
                startButton.style.display = "none";
            } else if (subPage === 2) {
                tutorialImage.src = "/images/tutorial-page-2-2.png";
                contentText.innerHTML = `
                    <h4>2.2 Queue Length</h4>
                    <p>How long is the queue of vehicles on each arm. Evaluation parameters of the multiplication of number of vehicles remaining at a red light by the average area used by one passenger car (20 square meters), divided by the entry width (m).</p>
                    <br/>
                    <p>The smaller the queue length, the more ideal the intersection performance.</p>
                `;
                tutorialImage.style.display = "block";
                nextButton.style.display = "block";
                startButton.style.display = "none";
            } else if (subPage === 3) {
                console.log("ke hit pas back")
                console.log(`#{contentDiv}`)
                tutorialImage.src = "/images/tutorial-page-2-3.png";
                contentText.innerHTML = `
                    <h4>2.3 Number of Stopped Vehicles</h4>
                    <p>How many vehicles are stopped and stuck at the intersection. Evaluation parameter calculated by multiplying the traffic flow by the stop ratio, which is the ratio of the number of remaining vehicles to the cycle time.</p>
                    <br/>
                    <p>The smaller Number of Stopped Vehicles, the more ideal the intersection performance.</p>
                `;
                tutorialImage.style.display = "block";
                nextButton.style.display = "block";
                startButton.style.display = "none";
            } else if (subPage === 4) {
                tutorialImage.src = "/images/tutorial-page-2-4.png";
                contentText.innerHTML = `
                    <h4>2.4 Delay</h4>
                    <p>The average time it takes for each vehicle to pass through an intersection.</p>
                `;
                tutorialImage.style.display = "block";
                nextButton.style.display = "block";
                startButton.style.display = "none";
            }

            tutorialImage.style.display = "block";
            nextButton.style.display = "block";
            startButton.style.display = "none";
        } 
        else if (currentPage === 3) {
            if (savedContent === "") {
                savedContent = contentDiv.innerHTML; // Simpan konten sebelumnya agar bisa dikembalikan
                console.log(`${savedContent}`)
            }

            tutorialImage.style.display = "none";
            contentDiv.innerHTML = `
            <div class="impact-content">
                <div class="impact-card">
                    <i class="fa fa-eye"></i>
                    <p>A study published by the International Online Medical Council (IOMC) shows that spending more than 3 hours and 10 minutes per day driving can increase the risk of stress by up to 80.4%.</p>
                </div>

                <div class="impact-card">
                    <i class="fa fa-dollar-sign"></i>
                    <p>C. P. Muneera and K. Krishnamurthy's research underscores the staggering economic toll of traffic congestion at intersections. Their findings reveal that even a single intersection can incur $297 in delay costs per hour. This figure escalates to a staggering $7,127 per day and $2.6 million annually.</p>
                </div>

                <div class="impact-card">
                    <i class="fa fa-cloud"></i>
                    <p>Syahbudin's research indicates that premium fuel emits slightly higher levels of CO and HC compared to pertalite and pertamax. Specifically, premium fuel's average emissions were 2.77% for CO and 1233 ppm for HC, while pertalite and pertamax registered lower figures: 2.62% and 837 ppm for CO, and 2.53% and 749 ppm for HC, respectively.</p>
                </div>
            </div>
            `;
            pageNumber.innerText = "3/3";
            nextButton.style.display = "none";
            startButton.style.display = "block";
        }
    }

    window.changeContent = function (section) {
        if (section === 2) {
            currentPage = 2;
            subPage = 1;
        } else {
            currentPage = section;
        }
        updatePageUI();
    };

    window.nextPage = function () {
        if (currentPage === 2 && subPage < 4) {
            subPage++;
        } else if (currentPage < 3) {
            currentPage++;
        }
        updatePageUI();
    };

    window.prevPage = function () {
        if (currentPage === 3) {
            contentDiv.innerHTML = savedContent; // Kembalikan layout sebelumnya
            savedContent = ""; // Reset setelah kembali
            currentPage = 2;
            subPage = 4; // Pastikan kembali ke halaman terakhir di step 2
        } else if (currentPage === 2 && subPage > 1) {
            subPage--;
        } else if (currentPage > 1) {
            currentPage--;
        }
        updatePageUI();
    };

    window.startSimulation = function () {
        window.location.href = "{{ route('simulator') }}";
}   ;

    updatePageUI();
});

</script>