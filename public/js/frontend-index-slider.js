var slideIndex = 0;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("customSlides");
  var dots = document.getElementsByClassName("customSlidesDot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" customSlidesActive", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " customSlidesActive";
}

autoShowSlides(slideIndex);
function autoShowSlides() {
    var i;
    var slides = document.getElementsByClassName("customSlides");
    var dots = document.getElementsByClassName("customSlidesDot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" customSlidesActive", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " customSlidesActive";
    setTimeout(autoShowSlides, 7000);
}