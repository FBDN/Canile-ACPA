;(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 54)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 56
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

    $(window).scroll(function () {
        if ($(window).scrollTop() > 280) {
            $(".navbar").css({
                'border-bottom': '1px solid #ccc',
                'position': 'fixed',
                'top': '0px',
                'width': '100%',
                'z-index': '99'
            });
        } else {
            $(".navbar").css({
                'position': 'relative',
            })
        }
    });

    $('.btnModal').on("click", function (e) {
        e.preventDefault();
        var corsoid = $(this).data("id");
        $("#corsi .modal-body").load("include/getModalContent.php", { idcorso: corsoid }, function (response) {
            $('#corsi').modal("show");
        });
    })

    $('#sendMessageButton').on('click', function (e) {
        e.preventDefault();
        var form = document.getElementById('contactForm');
        var formData = new FormData(form);
        $.ajax({
            url: 'ajax/sendEmail.php',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                alert(data);
            }

        })
    });

})(jQuery); // End of use strict
  

 
