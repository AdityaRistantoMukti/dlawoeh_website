let slideIndex = 1;
function currentDiv(n) {
    showDivs(slideIndex = n);
    slideIndex = n;
  }

  function nextDiv(){
    slideIndex = (slideIndex + 1) % 3;
    showDivs(slideIndex);
  }

  function prevDiv(){
    slideIndex = (slideIndex - 1 + 3) % 3;
    showDivs(slideIndex );
  }
  
  function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    if (n > x.length) {slideIndex = 1}
    if (n < 0) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
    }
    x[slideIndex].style.display = "block";
    dots[slideIndex].className += " w3-opacity-off";
  }



setInterval(nextDiv, 3000);