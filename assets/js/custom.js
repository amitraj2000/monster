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


/*******responsive_tab**************/
$('#horizontalTab').easyResponsiveTabs({
    type: 'default', //Types: default, vertical, accordion           
    width: 'auto', //auto or any width like 600px
    fit: true,   // 100% fit in a container
    closed: 'accordion', // Start closed if in accordion view
    activate: function(event) { // Callback function if tab is switched
    var $tab = $(this);
    var $info = $('#tabInfo');
    var $name = $('span', $info);
    $name.text($tab.text());
    $info.show();
    }
});

$(document).on('click','a.load-model',function(){
	var category_id=$(this).attr('data-category_id');
	$('#display_provider,#display_product').html('');
	$.ajax({
		  method: "POST",
		  url: monsterObj.base_url+"home/load_models_by_category",
		  data: { category_id: category_id},
		  success:function(response){
			  if(response!=''){
				  $('#display_model').html(response);
				  $('html, body').animate({
						scrollTop: $("#display_model").offset().top
					}, 2000);
			  }
		  }
		});
});

$(document).on('click','a.load-provider',function(){
	var model_id=$(this).attr('data-model_id');
	$('#display_product').html('');
	$.ajax({
		  method: "POST",
		  url: monsterObj.base_url+"home/load_providers_by_model",
		  data: { model_id: model_id},
		  success:function(response){
			  if(response!=''){
				  $('#display_provider').html(response);
				  $('html, body').animate({
						scrollTop: $("#display_provider").offset().top
					}, 2000);
			  }
		  }
		});
});

$(document).on('click','a.load-product',function(){
	var model_id=$(this).attr('data-model_id');
	$.ajax({
		  method: "POST",
		  url: monsterObj.base_url+"home/load_products_by_model",
		  data: { model_id: model_id},
		  success:function(response){
			  if(response!=''){
				  $('#display_product').html(response);
				  $('html, body').animate({
						scrollTop: $("#display_product").offset().top
					}, 2000);
			  }
		  }
		});
});

})
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
				url: "login/google_user_authentication", 
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
		url: "login/google_user_authentication", 
		method:'POST',
		data:{'first_name':profile.getGivenName(),'last_name':profile.getFamilyName(),'email':profile.getEmail()},
		success: function(result){
			window.location.href=result;
		}
	}); 
}
startGoogleLogin();
/*Google login*/