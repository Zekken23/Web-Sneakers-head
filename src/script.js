document.addEventListener('DOMContentLoaded', () => {

    // --- ScrollReveal Animation ---
    const sr = ScrollReveal({
        origin: 'bottom',
        distance: '60px',
        duration: 1000,
        delay: 200,
        reset: false, // Animations repeat only once
    });

    sr.reveal('.reveal-up', { origin: 'bottom' });
    sr.reveal('.reveal-left', { origin: 'left', distance: '100px' });
    sr.reveal('.reveal-right', { origin: 'right' });
    
    // Staggered animation for cards
    sr.reveal('.reveal-card', {
        interval: 100, // Reveal cards one by one
        origin: 'bottom',
        distance: '50px',
        delay: (el) => el.style.getPropertyValue('--delay') || 0
    });


    // --- Auto-Scrolling Logic for Collections ---
    const scrollers = document.querySelectorAll(".scroller");

    if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        addAnimation();
    }

    function addAnimation() {
        scrollers.forEach((scroller) => {
            scroller.setAttribute("data-animated", true);

            const scrollerInner = scroller.querySelector(".scroller__inner");
            const scrollerContent = Array.from(scrollerInner.children);

            scrollerContent.forEach((item) => {
                const duplicatedItem = item.cloneNode(true);
                duplicatedItem.setAttribute("aria-hidden", true);
                scrollerInner.appendChild(duplicatedItem);
            });
        });
    }

    // --- Efek Hover Dinamis pada New Arrivals ---
    const newArrivalsCards = document.querySelectorAll('#new-arrivals .reveal-card');

    newArrivalsCards.forEach(card => {
        card.addEventListener('mouseover', () => {
            const currentCardIndex = Array.from(newArrivalsCards).indexOf(card);
            
            // Gambar yang di-hover membesar
            const img = card.querySelector('img');
            if (img) {
                img.classList.add('scale-110');
                img.style.zIndex = 10; // Pastikan gambar yang di-hover di atas yang lain
            }

            // Geser kartu di sebelah kiri ke kiri
            if (currentCardIndex > 0) {
                newArrivalsCards[currentCardIndex - 1].classList.add('translate-left');
            }
            // Geser kartu di sebelah kanan ke kanan
            if (currentCardIndex < newArrivalsCards.length - 1) {
                newArrivalsCards[currentCardIndex + 1].classList.add('translate-right');
            }
        });

        card.addEventListener('mouseout', () => {
            // Hapus efek scale pada gambar
            const img = card.querySelector('img');
            if (img) {
                img.classList.remove('scale-110');
                img.style.zIndex = ''; // Reset z-index
            }

            // Hapus efek geser pada semua kartu tetangga
            newArrivalsCards.forEach(otherCard => {
                otherCard.classList.remove('translate-left', 'translate-right');
            });
        });
    });
});