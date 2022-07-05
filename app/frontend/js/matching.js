document.querySelector(".matchingFilter").style.display = "none";

function showFilter() {
    var matchingFilter = document.querySelector(".matchingFilter");
    if (matchingFilter.style.display === "none") {
        matchingFilter.style.display = "block";
    } else {
        matchingFilter.style.display = "none";
    }
}

function closeAndSetFilter() {
    document.querySelector(".matchingFilter").style.display = "none"
}
