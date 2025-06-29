// Clock functionality
function updateClock() {
    const clockEl = document.getElementById("liveclock");
    if (!clockEl) return;

    const now = new Date();
    const hours = String(now.getHours()).padStart(2, "0");
    const minutes = String(now.getMinutes()).padStart(2, "0");
    const timeString = `<i class="far fa-clock mr-2"></i>${hours}:${minutes}`;
    clockEl.innerHTML = timeString;

    setTimeout(updateClock, 1000);
}

let floorSliderInstance = null;
let isFirstFloorInit = true;
let lastJadwalStringified = "";
let lastKehadiranStringified = "";
let lastTeksStringified = "";

// Floor slider functionality
class FloorSlider {
    constructor() {
        this.slides = document.querySelectorAll(".floor-slide");
        this.navBtns = document.querySelectorAll(".floor-nav-btn");
        this.currentSlide = 0;
        this.touchStartX = 0;
        this.touchEndX = 0;
        this.interval = null; // simpan ID interval

        if (this.slides.length > 0 && this.navBtns.length > 0) {
            this.init();
        } else {
            console.warn("FloorSlider: Tidak ada slide atau tombol navigasi.");
        }
    }

    init() {
        this.addEventListeners();
        this.startAutoSlide();
        this.showSlide(0);
    }

    destroy() {
        clearInterval(this.interval); // hentikan interval
        this.navBtns.forEach((btn) => {
            const clone = btn.cloneNode(true);
            btn.parentNode.replaceChild(clone, btn); // hapus event listener lama
        });
    }

    showSlide(index) {
        const wrapper = document.querySelector(".floor-slides");
        if (!wrapper) return;

        wrapper.style.transform = `translateX(-${index * 100}%)`;
        this.currentSlide = index;

        this.navBtns.forEach((btn) => btn.classList.remove("active"));
        if (this.navBtns[index]) this.navBtns[index].classList.add("active");
    }

    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        this.showSlide(this.currentSlide);
    }

    prevSlide() {
        this.currentSlide =
            (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        this.showSlide(this.currentSlide);
    }

    handleSwipe() {
        const swipeThreshold = 50;
        const swipeLength = this.touchEndX - this.touchStartX;

        if (Math.abs(swipeLength) > swipeThreshold) {
            swipeLength > 0 ? this.prevSlide() : this.nextSlide();
        }
    }

    addEventListeners() {
        this.navBtns.forEach((btn, index) => {
            btn.addEventListener("click", () => {
                this.currentSlide = index;
                this.showSlide(this.currentSlide);
            });
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "ArrowLeft") this.prevSlide();
            if (e.key === "ArrowRight") this.nextSlide();
        });

        document.addEventListener("touchstart", (e) => {
            this.touchStartX = e.changedTouches[0]?.screenX || 0;
        });

        document.addEventListener("touchend", (e) => {
            this.touchEndX = e.changedTouches[0]?.screenX || 0;
            this.handleSwipe();
        });
    }

    startAutoSlide() {
        if (this.slides.length < 2) return;
        this.interval = setInterval(() => this.nextSlide(), 10000);
    }
}

// Polling system
async function fetchDataAndUpdate() {
    try {
        const response = await fetch("/api/landscape-data");
        const data = await response.json();

        if (data.kehadiran) updateKehadiran(data.kehadiran);
        if (data.jadwal) updateJadwal(data.jadwal);
        if (data.lantaidanruangan)
            updateLantaiDanRuangan(data.lantaidanruangan);
        if (data.teksBerjalan) updateTeksBerjalan(data.teksBerjalan);
    } catch (error) {
        console.error("Polling error:", error);
    }
}

// buat fungsi updateTeksBerjalan
function updateTeksBerjalan(teks) {
    let html = "";
    if (Array.isArray(teks)) {
        html = teks
            .map((item, idx) => {
                const icon = item.icon || "fa-info-circle";
                const konten =
                    typeof item.konten === "string"
                        ? item.konten
                        : String(item.konten || "");
                const limitedKonten =
                    konten.length > 120 ? konten.slice(0, 117) + "..." : konten;
                const separator =
                    idx < teks.length - 1
                        ? `<span class="mx-8 text-2xl text-gray-300">|</span>`
                        : "";
                return `<i class="fas ${icon} text-yellow-400 mr-3 text-2xl"></i>
                        <span class="text-2xl font-medium">${limitedKonten}</span>${separator}`;
            })
            .join("");
    } else {
        html = typeof teks === "string" ? teks : String(teks || "");
    }

    const marquee = document.querySelector(
        ".marquee-container .animate-marquee"
    );
    if (!marquee) return;

    const clean = (s) =>
        (typeof s === "string" ? s : String(s || ""))
            .replace(/\s+/g, " ")
            .trim();
    if (clean(marquee.innerHTML) === clean(html)) return;

    marquee.innerHTML = html;
}

function updateJadwal(jadwal) {
    const scheduleCard = document.querySelector(".schedule-card");
    const sliderWrapper = scheduleCard.querySelector(".schedule-slider");
    const dotsWrapper = scheduleCard.querySelector(".schedule-dots-container");
    const emptyMsg = scheduleCard.querySelector(".schedule-empty-message");

    if (!sliderWrapper || !dotsWrapper || !emptyMsg) return;
    const currentJadwalString = JSON.stringify(jadwal);
    if (currentJadwalString === lastJadwalStringified) return;
    lastJadwalStringified = currentJadwalString;

    if (!Array.isArray(jadwal) || jadwal.length === 0) {
        sliderWrapper.innerHTML = "";
        dotsWrapper.innerHTML = "";
        emptyMsg.classList.remove("hidden");
        return;
    }

    emptyMsg.classList.add("hidden");
    sliderWrapper.innerHTML = "";
    dotsWrapper.innerHTML = "";

    const chunked = [];
    for (let i = 0; i < jadwal.length; i += 3) {
        chunked.push(jadwal.slice(i, i + 3));
    }

    chunked.forEach((group, index) => {
        const slide = document.createElement("div");
        slide.className = "schedule-slide" + (index === 0 ? " active" : "");
        slide.dataset.index = index;
        slide.innerHTML = `<div class="text-white font-poppins space-y-4">${group
            .map(
                (item) => `
            <div class="schedule-item rounded-lg p-4 transition-all duration-300 bg-white/20 backdrop-blur">
                <div class="flex items-center justify-between">
                    <div class="flex-grow">
                        <h3 class="group flex items-center mb-2">
                            <i class="fas ${
                                item.icon
                            } mr-3 text-yellow-400 text-xl group-hover:scale-110 transition-transform"></i>
                            <span class="hover:text-yellow-400 transition-colors duration-300">${
                                item.nama_kegiatan
                            }</span>
                        </h3>
                        <p class="location-text flex items-center text-sm text-gray-200">
                            <i class="fas fa-map-marker-alt mr-2 text-red-400"></i>
                            ${item?.ruangan?.nama || "-"}
                            ${
                                item?.ruangan?.lantai?.label
                                    ? `<span class="ml-2 text-xs bg-gray-800/50 px-2 py-0.5 rounded-md">${item.ruangan.lantai.label}</span>`
                                    : ""
                            }
                        </p>
                    </div>
                    <div class="text-right ml-6 text-sm text-gray-200">
                        <p class="time-text flex items-center justify-end mb-1">
                            <i class="far fa-clock mr-2 animate-pulse text-blue-300"></i>
                            <span>${dayjs(item.waktu_mulai).format(
                                "HH:mm"
                            )} WIB</span>
                        </p>
                        <p class="date-text flex items-center justify-end">
                            <i class="far fa-calendar-check mr-2 text-green-400"></i>
                            <span>${dayjs(item.waktu_mulai).format(
                                "DD MMM YYYY"
                            )}</span>
                        </p>
                    </div>
                </div>
            </div>`
            )
            .join("")}</div>`;

        sliderWrapper.appendChild(slide);

        const dot = document.createElement("button");
        dot.className = `schedule-dot w-2 h-2 rounded-full mx-1 bg-gray-400/50 transition-all duration-300 hover:bg-gray-300${
            index === 0 ? " active" : ""
        }`;
        dot.dataset.index = index;
        dotsWrapper.appendChild(dot);
    });

    requestAnimationFrame(reinitScheduleSlider);
}

function reinitScheduleSlider() {
    const slides = document.querySelectorAll(".schedule-slide");
    const dots = document.querySelectorAll(".schedule-dot");

    if (slides.length === 0 || dots.length === 0) return;
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        slides.forEach((slide) => slide.classList.remove("active"));
        dots.forEach((dot) => dot.classList.remove("active"));
        if (slides[index]) slides[index].classList.add("active");
        if (dots[index]) dots[index].classList.add("active");
        currentSlide = index;
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function startSlideShow() {
        if (slideInterval) clearInterval(slideInterval);
        if (slides.length > 1) slideInterval = setInterval(nextSlide, 5000);
    }

    showSlide(0);
    startSlideShow();

    if (slides.length > 1) {
        dots.forEach((dot, index) => {
            dot.addEventListener("click", () => {
                showSlide(index);
                startSlideShow();
            });
        });
    }
}

updateClock();
fetchDataAndUpdate();
setInterval(fetchDataAndUpdate, 10000);

function updateLantaiDanRuangan(lantaidanruangan) {
    const container = document.querySelector(".floor-slider-container");
    const navContainer = document.querySelector(".floor-nav-container");

    if (!container || !navContainer) return;

    // Kosongkan hanya saat inisialisasi pertama
    if (isFirstFloorInit) {
        container.innerHTML = "";
        navContainer.innerHTML = "";

        lantaidanruangan.forEach((lantai, index) => {
            let roomsHTML = "";
            if (lantai.ruangan && lantai.ruangan.length > 0) {
                roomsHTML = `
                    <ul class="list-decimal pl-5 space-y-2 text-left font-semibold text-lg">
                        ${lantai.ruangan
                            .map((r) => `<li>${r.nama.toUpperCase()}</li>`)
                            .join("")}
                    </ul>`;
            } else {
                roomsHTML = `<p class="text-center text-gray-500 font-semibold">Tidak ada ruangan aktif.</p>`;
            }

            const slideHTML = `
                <div class="floor-slide ${index === 0 ? "active" : ""}">
                    <div class="floor-title-container">
                        <div class="text-5xl font-bold text-red-600">
                            <i class="fas fa-building-user mr-2"></i>${
                                lantai.nama
                            }
                        </div>
                        <div class="text-lg font-semibold text-gray-600 mb-6">(${
                            lantai.label
                        })</div>
                    </div>
                    <div class="floor-content">
                        <div class="info-card rounded-xl p-6 shadow-lg transition hover:scale-105 bg-white/90">
                            <div class="text-gray-700 font-poppins">
                                <h3 class="font-bold text-4xl mb-4 text-gray-800 text-center">Informasi Ruangan</h3>
                                <div class="w-full h-1 bg-gray-200 mb-4 rounded-full"></div>
                                ${roomsHTML}
                            </div>
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML("beforeend", slideHTML);

            navContainer.insertAdjacentHTML(
                "beforeend",
                `<div class="floor-nav-btn ${
                    index === 0 ? "active" : ""
                }" data-floor="${index}"></div>`
            );
        });

        requestAnimationFrame(() => {
            floorSliderInstance = new FloorSlider();
        });

        isFirstFloorInit = false; // agar tidak reset terus
    } else {
        // Hanya update isi ruangan jika sudah ada
        const slideEls = container.querySelectorAll(".floor-slide");
        lantaidanruangan.forEach((lantai, index) => {
            const slide = slideEls[index];
            if (!slide) return;

            let roomsHTML = "";
            if (lantai.ruangan && lantai.ruangan.length > 0) {
                roomsHTML = `
                    <ul class="list-decimal pl-5 space-y-2 text-left font-semibold text-lg">
                        ${lantai.ruangan
                            .map((r) => `<li>${r.nama.toUpperCase()}</li>`)
                            .join("")}
                    </ul>`;
            } else {
                roomsHTML = `<p class="text-center text-gray-500 font-semibold">Tidak ada ruangan aktif.</p>`;
            }

            const infoCard = slide.querySelector(".info-card .text-gray-700");
            if (infoCard) {
                infoCard.innerHTML = `
                    <h3 class="font-bold text-4xl mb-4 text-gray-800 text-center">Informasi Ruangan</h3>
                    <div class="w-full h-1 bg-gray-200 mb-4 rounded-full"></div>
                    ${roomsHTML}
                `;
            }
        });
    }
}

function updateKehadiran(kehadiran) {
    const container = document.querySelector(".presence-section .grid");
    if (!container) return;

    kehadiran.forEach((item, index) => {
        let box = container.children[index];

        // Jika belum ada elemen, tambahkan baru
        if (!box) {
            box = document.createElement("div");
            box.className =
                "glass-effect rounded-xl flex flex-col items-center justify-center relative overflow-hidden kotak-hadir presence-box";
            container.appendChild(box);
        }

        const isHadir = item.status.toLowerCase() !== "tidak hadir";
        const icon = isHadir ? "check" : "times";
        const statusClass = isHadir ? "hadir" : "tidak-hadir";
        const statusLabel =
            item.status.charAt(0).toUpperCase() + item.status.slice(1);

        box.classList.remove("hadir", "tidak-hadir");
        box.classList.add(statusClass);

        box.innerHTML = `
            <i class="fas fa-user-tie presence-icon"></i>
            <div class="presence-title">${item.nama_jabatan}</div>
            <div class="text-center py-2 px-8 rounded-t-lg absolute bottom-0 left-1/2 status-hadir ${statusClass} font-semibold">
                <i class="fas ${icon}-circle presence-status-icon"></i>
                ${statusLabel}
            </div>
        `;
    });

    // Hapus elemen lebih jika data berkurang
    while (container.children.length > kehadiran.length) {
        container.removeChild(container.lastChild);
    }
}

// Initialize application
document.addEventListener("DOMContentLoaded", () => {
    const loadingState = createLoadingState();
    document.body.appendChild(loadingState);

    try {
        updateClock();
        fetchDataAndUpdate();
        setInterval(fetchDataAndUpdate, 5000);

        setTimeout(() => {
            loadingState.remove();
        }, 1000);
    } catch (error) {
        console.error("Error initializing app:", error);
        showErrorState(loadingState);
    }
});

// Helper functions
function createLoadingState() {
    const loadingState = document.createElement("div");
    loadingState.className =
        "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50";
    loadingState.innerHTML = `
        <div class="bg-white p-5 rounded-lg shadow-xl">
            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-blue-600 mx-auto"></div>
            <p class="mt-3 text-gray-700">Memuat Data...</p>
        </div>
    `;
    return loadingState;
}

function showErrorState(loadingState) {
    loadingState.innerHTML = `
        <div class="bg-white p-5 rounded-lg shadow-xl">
            <div class="text-red-600 text-center mb-3">
                <i class="fas fa-exclamation-circle text-4xl"></i>
            </div>
            <p class="text-gray-700">Terjadi kesalahan saat memuat aplikasi</p>
            <button onclick="location.reload()" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Muat Ulang
            </button>
        </div>
    `;
}
