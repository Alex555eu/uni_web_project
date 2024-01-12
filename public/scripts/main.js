
/********* MAIN METHOD CALLER***********/

//main();

/////////////////////////////////////////

function myFunction() {
    var x = document.getElementById("myNavbar");
    if (x.className === "navbar") {
      x.className += " responsive";
    } else {
      x.className = "navbar";
    }
    console.log(x.className);
  }

/*
function main() {

    let scrollPosition = 0;
    let fade = 100;
    let solidFade = 100;

    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener("scroll", function() {
          var header = document.getElementById("nbbg");
          scrollPosition = window.scrollY;
        
          fade = (document.body.scrollHeight - scrollPosition) / (scrollPosition * 0.05);
          solidFade = fade / 3;
          
          // Ensure transparency stays between 0 and 100
          fade = Math.min(100, fade);
          fade = Math.max(0, fade);
          solidFade = Math.min(100, solidFade);
          solidFade = Math.max(0, solidFade);
                    
          // Update the background with the new transparency
          header.style.background = "linear-gradient(180deg, #FFF "+ solidFade +"%, rgba(255, 255, 255, 0.00) "+ fade +"%)";
        });
      });

}*/