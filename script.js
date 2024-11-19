let slideIndex = 0;

function showSlides() {
    let i;
    const slides = document.getElementsByClassName("mySlides");
    const dots = document.getElementsByClassName("dot");
    
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  // Hide all slides
    }
    
    slideIndex++;
    
    if (slideIndex > slides.length) {
        slideIndex = 1;  // Reset to the first slide
    }
    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    slides[slideIndex - 1].style.display = "block";  // Show the current slide
    dots[slideIndex - 1].className += " active";  // Highlight the current dot
    
    setTimeout(showSlides, 5000);  // Change slide every 5 seconds
}

function currentSlide(n) {
    slideIndex = n - 1;
    showSlides();
}

showSlides();  // Initialize the slideshow
