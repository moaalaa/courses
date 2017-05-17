$(document).ready(function() {

	// slick carousel
  var gadgetCarousel = $(".single-item, .multiple-items, .responsive");

  gadgetCarousel.each(function() {
	if ($(this).is(".single-item")) {
		$(this).slick({
			arrows: false,
			dots: true,
			autoplay: true,
			autoplaySpeed: 5000
	  });
	}
	else if($(this).is(".multiple-items")) {
		$(this).slick({
		    infinite: true,
			autoplay: true,
			autoplaySpeed: 3000,
		    slidesToShow: 3,
		    slidesToScroll: 2
		});
	}
	else if($(this).is(".responsive")) {
		$(this).slick({
			  dots: false,
			  infinite: false,
			  speed: 300,
			  slidesToShow: 4,
			  slidesToScroll: 1,
			  responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        slidesToShow: 3,
			        slidesToScroll: 3,
			        infinite: true,
			        dots: true
			      }
			    },
			    {
			      breakpoint: 600,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 2
			      }
			    },
			    {
			      breakpoint: 480,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			    // You can unslick at a given breakpoint now by adding:
			    // settings: "unslick"
			    // instead of a settings object
			  ]
			});
	}
	else {
	  $(this).slick();
	}
  })

  // counter up
  $('.counter').counterUp({
    delay: 10,
    time: 2000
  });

 });
