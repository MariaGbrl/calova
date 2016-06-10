    var x = "Total Width: " + screen.width + "px";
    console.log(x);

$(document).ready(function(){

$(window).scroll(function()
{ 
  if($(document).scrollTop() > 50)
    {

          $('#navbar-container').css("background-color", "#424242");
     


    }
      if($(document).scrollTop() < 50)
    {

          $('#navbar-container').css("background-color", "transparent");
    }
  });

  $("#home").on('click', function() {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      $('html, body').animate({
        scrollTop: 0
      }, 800);
    } // End if
  });


 $("#features").on('click', function() {

    // Make sure this.hash has a value before overriding default behavior
    
      // Prevent default anchor click behavior
    
      $('html, body').animate({
        scrollTop: 1000
      }, 800);
    
  });

  $("#how").on('click', function() {

      $('html, body').animate({
        scrollTop: 2800
      }, 1000);
   
  });

});


function scrolltofeatures() {
    window.scrollTo(500, 900);
};