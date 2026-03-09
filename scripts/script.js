document.addEventListener("DOMContentLoaded", function () {

    // Auto-scroll after 3 seconds
    setTimeout(function() {
        document.querySelector("#about").scrollIntoView({
            behavior: "smooth"
        });
    }, 3000);

    // Display current year in its own line
    const yearElement = document.getElementById("current-year");
    const year = new Date().getFullYear();
    yearElement.textContent = "© " + year + " Hakima Chabane";

    // Ensure it is displayed on its own line and centered
    yearElement.style.display = "block";
    yearElement.style.textAlign = "center";
    yearElement.style.marginTop = "0.5rem";
});