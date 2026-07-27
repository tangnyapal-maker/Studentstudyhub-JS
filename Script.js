let userName = prompt("Welcome! Please enter your name:");

if (userName != null && userName.trim() !== "") {
    document.getElementById("welcome").textContent =
        "Welcome, " + userName + "!";
}
const form = document.getElementById("contactForm");

if (form) {

    form.addEventListener("submit", function(event) {

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const message = document.getElementById("message").value.trim();

        if (name === "" || email === "" || message === "") {

            alert("Please fill in all required fields.");

            event.preventDefault();

        }

    });

}
function changeColour() {
    document.getElementById("mainHeading").style.color = "blue";
}
function toggleTips() {
    const tips = document.getElementById("tips");

    if (tips.style.display === "none") {
        tips.style.display = "block";
    } else {
        tips.style.display = "none";
    }
}