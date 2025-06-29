const opening = document.getElementById("opening");
const slidesWrapper = document.getElementById("slides");
const slides = document.querySelectorAll(".slide");

let currentSlide = 0;
const openingDuration = 4000;
const slideDuration = 7000;
const transitionDelay = 1000;
let slideTimer = null;

document.addEventListener(
    "touchmove",
    function (e) {
        e.preventDefault();
    },
    { passive: false }
);

window.addEventListener(
    "wheel",
    function (e) {
        e.preventDefault();
    },
    { passive: false }
);

function showOpening() {
    clearTimeout(slideTimer); // pastikan tidak ada tumpang tindih
    slidesWrapper.classList.remove("active");

    // FIX: Hanya remove .active jika currentSlide valid
    if (currentSlide < slides.length) {
        slides[currentSlide].classList.remove("active");
    }

    opening.classList.add("active");

    setTimeout(() => {
        opening.classList.remove("active");
        startSlides();
    }, openingDuration);
}

function startSlides() {
    slidesWrapper.classList.add("active");
    currentSlide = 0;
    slides[currentSlide].classList.add("active");
    slideTimer = setTimeout(nextSlide, slideDuration);
}

function nextSlide() {
    slides[currentSlide].classList.remove("active");
    currentSlide++;

    if (currentSlide < slides.length) {
        slides[currentSlide].classList.add("active");
        slideTimer = setTimeout(nextSlide, slideDuration);
    } else {
        // Kembali ke opening setelah slide terakhir
        setTimeout(showOpening, transitionDelay);
    }
}

window.addEventListener("DOMContentLoaded", () => {
    // Pertama kali: mulai dari opening
    showOpening();
    startVersionPolling();
});

function startVersionPolling(interval = 3000) {
    const versionElement = document.getElementById("version");
    if (!versionElement) return;

    const currentVersion = versionElement.textContent.trim();

    setInterval(async () => {
        try {
            const response = await fetch("/api/portrait/version", {
                cache: "no-store",
            });
            if (!response.ok) throw new Error("Failed to fetch version");

            const data = await response.json(); // anggap respons berupa JSON { version: "..." }
            const latestVersion = data.version?.trim();

            if (latestVersion && latestVersion !== currentVersion) {
                console.warn("Version mismatch detected. Reloading page...");
                location.reload();
            }
        } catch (error) {
            console.error("Version polling failed:", error);
        }
    }, interval);
}
