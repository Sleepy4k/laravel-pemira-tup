document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector("header");
    const endTime = new Date(header.getAttribute("data-end-time")).getTime();
    const countdownElement = document.getElementById("countdownTimer");

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance < 0) {
            countdownElement.innerHTML = "Waktu voting telah berakhir.";
            clearInterval(countdownInterval);
            return;
        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // follow format DD : HH : MM : SS like in view
        countdownElement.innerHTML = `
            <span id="days">${String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0')}</span>d :
            <span id="hours">${String(hours).padStart(2, '0')}</span>h :
            <span id="minutes">${String(minutes).padStart(2, '0')}</span>m :
            <span id="seconds">${String(seconds).padStart(2, '0')}</span>s
        `
    }

    updateCountdown();
    const countdownInterval = setInterval(updateCountdown, 1000);
});
