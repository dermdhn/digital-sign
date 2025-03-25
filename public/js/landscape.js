// Clock functionality
function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const timeString = `<i class="far fa-clock mr-2"></i>${hours}:${minutes}`;
    document.getElementById('liveclock').innerHTML = timeString;
    setTimeout(updateClock, 1000);
}

// Floor slider functionality
class FloorSlider {
    constructor() {
        this.slides = document.querySelectorAll('.floor-slide');
        this.navBtns = document.querySelectorAll('.floor-nav-btn');
        this.currentSlide = 0;
        this.touchStartX = 0;
        this.touchEndX = 0;
        this.init();
    }

    init() {
        this.addEventListeners();
        this.startAutoSlide();
        this.showSlide(0);
    }

    showSlide(index) {
        this.slides.forEach(slide => {
            slide.classList.remove('active');
            slide.style.transform = `translateX(-${index * 100}%)`;
        });
        this.slides[index].classList.add('active');

        this.navBtns.forEach(btn => btn.classList.remove('active'));
        this.navBtns[index].classList.add('active');
    }

    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        this.showSlide(this.currentSlide);
    }

    prevSlide() {
        this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        this.showSlide(this.currentSlide);
    }

    handleSwipe() {
        const swipeThreshold = 50;
        const swipeLength = this.touchEndX - this.touchStartX;

        if (Math.abs(swipeLength) > swipeThreshold) {
            if (swipeLength > 0) {
                this.prevSlide();
            } else {
                this.nextSlide();
            }
        }
    }

    addEventListeners() {
        // Navigation button clicks
        this.navBtns.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                this.currentSlide = index;
                this.showSlide(this.currentSlide);
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                this.prevSlide();
            } else if (e.key === 'ArrowRight') {
                this.nextSlide();
            }
        });

        // Touch events
        document.addEventListener('touchstart', (e) => {
            this.touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', (e) => {
            this.touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe();
        });
    }

    startAutoSlide() {
        setInterval(() => this.nextSlide(), 10000);
    }
}

// Initialize application
document.addEventListener('DOMContentLoaded', () => {
    const loadingState = createLoadingState();
    document.body.appendChild(loadingState);

    try {
        updateClock();
        new FloorSlider();

        // Remove loading state after initialization
        setTimeout(() => {
            loadingState.remove();
        }, 1000);
    } catch (error) {
        console.error('Error initializing app:', error);
        showErrorState(loadingState);
    }
});

// Helper functions
function createLoadingState() {
    const loadingState = document.createElement('div');
    loadingState.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
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