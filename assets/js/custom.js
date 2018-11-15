$(document).ready(function(){
	
/*-------------------------------------GO_TO_TOP-------------------------------------*/
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 300);
        return false;
    });


/*-------------------------------------STICKY_NAV-------------------------------------*/
	if ($('.header_main').length) {
		var stickyNavTop = $('.header_main').offset().top,
            stickyNav = function () {
                var scrollTop = $(window).scrollTop();
				if($(window).width() > 599){
                if (scrollTop > stickyNavTop) {
                    $('body').addClass('sticky');
                } else {
                    $('body').removeClass('sticky');
                };
				}
            };
        stickyNav();

        $(window).scroll(function () {
            stickyNav();
        });
	}
	
/*-------------------------------------banner slider-------------------------------------*/
	$(".banner_slider").owlCarousel({
    	items: 1,
    	loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
      	smartSpeed: 3000,
		margin: 1,
		dots: false,
		nav: true,
		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			480: {
				items: 1
			},
			600: {
				items: 1
			},
			768: {
				items: 1
			},
			1024: {
				items: 1
			},
			1600: {
				items: 1
			}
		},
	});
	
/*-------------------------------------RESPONSIVE_MENU-------------------------------------*/
   var ht = $(".nav_menu").html();
    $(".responsive_nav").append(ht);

    $('.responsive_btn').click(function () {
        $('html').addClass('responsive');
    });
    $('.bodyOverlay').click(function () {
        
        if ($('html.responsive').length)
            $('html').removeClass('responsive');
    });

    $(document).on('click', '.subarrow', function () {
        $(this).parent().siblings().find('.sub-menu').slideUp();
        $(this).parent().siblings().removeClass('opened');

        $(this).siblings('.sub-menu').slideToggle();
        $(this).parent().toggleClass('opened');
    });
	



/*-------------------------------------our_best_services scroller-------------------------------------*/	
	/*$(".block_scroll").mCustomScrollbar({
        scrollbarPosition: "inside"
    });*/


});
/*Google login*/
  var googleUser = {};
  var startGoogleLogin = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '238911531242-4rmmaae3i9lg4vbu2rdbqkr087v14gic.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
	   if($('#google_btn_1').length){attachSignin(document.getElementById('google_btn_1'));}
	   if($('#google_btn_2').length){attachSignin(document.getElementById('google_btn_2'));}
	   if($('#google_btn_3').length){attachSignin(document.getElementById('google_btn_3'));}
	   if($('#google_btn_4').length){attachSignin(document.getElementById('google_btn_4'));}
     
	});
  };

  function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
         // document.getElementById('name').innerText = "Signed in: " +
              var profile = googleUser.getBasicProfile();

			$.ajax({
				url: monsterObj.base_url+"login/google_user_authentication", 
				method:'POST',
				data:{'first_name':profile.getGivenName(),'last_name':profile.getFamilyName(),'email':profile.getEmail()},
				success: function(result){
					window.location.href=result;
				}
			});
        }, function(error) {
          //alert(JSON.stringify(error, undefined, 2));
        });
  }
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  
  $.ajax({
		url: monsterObj.base_url+"login/google_user_authentication", 
		method:'POST',
		data:{'first_name':profile.getGivenName(),'last_name':profile.getFamilyName(),'email':profile.getEmail()},
		success: function(result){
			window.location.href=result;
		}
	}); 
}
startGoogleLogin();
/*Google login*/