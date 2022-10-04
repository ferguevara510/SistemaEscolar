/*Abrir sitios web*/
function redirect(pageUrl, apartado){
  localStorage.setItem('apartado', apartado);
  window.open(pageUrl, '_self');
}

/*Control del Slider*/
const slider = document.querySelector("#slider .contenedor");
const nextBtn = document.querySelector("#slider .btn-next");
const prevBtn = document.querySelector("#slider .btn-prev");
const slides = document.querySelectorAll("#slider .imagen");
const slideIcons = document.querySelectorAll("#slider .icono");
const numberOfSlides = slides.length;
var slideNumber = 0;

//Siguiente
nextBtn.addEventListener("click", () => {
  slides.forEach((slide) => {
    slide.classList.remove("active");
  });
  slideIcons.forEach((slideIcon) => {
    slideIcon.classList.remove("active");
  });

  slideNumber++;

  if(slideNumber > (numberOfSlides - 1)){
    slideNumber = 0;
  }

  slides[slideNumber].classList.add("active");
  slideIcons[slideNumber].classList.add("active");
});

//Anterior
prevBtn.addEventListener("click", () => {
  slides.forEach((slide) => {
    slide.classList.remove("active");
  });
  slideIcons.forEach((slideIcon) => {
    slideIcon.classList.remove("active");
  });

  slideNumber--;

  if(slideNumber < 0){
    slideNumber = numberOfSlides - 1;
  }

  slides[slideNumber].classList.add("active");
  slideIcons[slideNumber].classList.add("active");
});

//Autoplay
var playSlider;

var repeater = () => {
  playSlider = setInterval(function(){
    slides.forEach((slide) => {
      slide.classList.remove("active");
    });
    slideIcons.forEach((slideIcon) => {
      slideIcon.classList.remove("active");
    });

    slideNumber++;

    if(slideNumber > (numberOfSlides - 1)){
      slideNumber = 0;
    }

    slides[slideNumber].classList.add("active");
    slideIcons[slideNumber].classList.add("active");
  }, 5000);
}
repeater();

//Para el autoplay al estar dentro de las imagenes
slider.addEventListener("mouseover", () => {
  clearInterval(playSlider);
});

//Inicia el autoplay al dejar el area de las imagenes
slider.addEventListener("mouseout", () => {
  repeater();
});