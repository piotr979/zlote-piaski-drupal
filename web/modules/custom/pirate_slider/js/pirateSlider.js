(function () {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.pirate-slider .slide');
    const totalSlides = slides.length;

    // Ensure slides exist before running the script
    if (totalSlides === 0) return;

    // Show only the first slide
    slides.forEach((slide, index) => {
        slide.style.opacity = index === 0 ? 1 : 0;
    });

    function showSlide(index) {
        slides.forEach((slide) => {
            slide.style.opacity = 0; // Hide all slides
            slide.querySelector('.slide-caption').classList.remove('animate__slideInUp'); // Remove animation
        });

        // Show the new active slide
        slides[index].style.opacity = 1;

        // Restart animation on text
        const caption = slides[index].querySelector('.slide-caption');
        void caption.offsetWidth; // Force reflow (restarts animation)
        caption.classList.add('animate__slideInUp');
    }

    function showNextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides; // Move to next slide
        showSlide(currentSlide);
    }

    // Auto-slide every 5 seconds
    setInterval(showNextSlide, 5000);
})();
