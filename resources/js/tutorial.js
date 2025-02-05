function changeContent(section) {
    let contentText = document.getElementById("content-text");
    let simulationText = document.getElementById("simulation-text");

    if (section === 1) {
        contentText.innerHTML = "Intersections are a vital part of traffic as a meeting point for vehicles...";
        simulationText.innerHTML = "In this simulation, we will try to design ATCS...";
    } else if (section === 2) {
        contentText.innerHTML = "Parameters help define how ATCS should be configured...";
        simulationText.innerHTML = "You will adjust settings like traffic light timing...";
    } else if (section === 3) {
        contentText.innerHTML = "The impact of ATCS can be seen in reduced congestion...";
        simulationText.innerHTML = "This simulation will show how traffic patterns change...";
    }

    let buttons = document.querySelectorAll(".tab-btn");
    buttons.forEach(btn => btn.classList.remove("active"));
    buttons[section - 1].classList.add("active");
}
