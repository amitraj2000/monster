/*!
 * Start Bootstrap - SB Admin 2 v3.3.7+1 (http://startbootstrap.com/template-overviews/sb-admin-2)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */
$(function() {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }	
	
});
//**=======================**//
$(document).ready(function(){
	//Login form submission
	$(document).on('submit','form#login',function(){
		$('.form-group').removeClass('has-warning');
		var email=$.trim($('#email').val());
		var password=$.trim($('#password').val());
		if(email==''){
			$('#email').closest('.form-group').addClass('has-warning');
			return false;
		}
		else if(password==''){
			$('#password').closest('.form-group').addClass('has-warning');
			return false;
		}
		
	});
	
	//Delete icon
	$(document).on('click','.delete-confirm',function(){
		var txt;
		var r = confirm("Are you sure to delete this!");
		if (r == true) {
			return true;
		} else {
			return false;
		}
	});
	
	$(document).on('change','select[name=category_id][data-populate-model=true]',function(){
		var fieldToUpdate=$(this).attr('data-field-to-update');
		var category_id=$(this).val();
		$.ajax({
		  method: "POST",
		  url: monsterObj.base_url+"ajax/category_based_model_drop_down",
		  data: { category_id: category_id},
		  success:function(response){
			  if(response!='')
				  $('select[name='+fieldToUpdate+']').html(response);
		  }
		})
	});
	$(document).on('click','.has-variation',function(){
		var css_class=$(this).attr('data-class');
		 $("."+css_class).slideToggle();
	});
	$('.editor').each(function(){
		$(this).richText();
	}); 
	
	$(".numberinput").forceNumeric();
	
	/*drag and drop menu*/
	var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');			
        if (window.JSON) {	
			if(typeof output !== 'undefined')
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));			
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
	
	 $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);
	$('#nestable2').nestable({
        group: 1
    })
    .on('change', updateOutput);
    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#menu_arr')));
	updateOutput($('#nestable2').data('output', $('#product_menu_arr')));
	
	$(document).on('click','#add_to_menu',function(){
		var key=$("#menu_select option:selected").val();
		var text=$("#menu_select option:selected").text();
		var html='<li class="dd-item" data-id="'+key+'"><div class="dd-handle">'+text+'</div><a href="javascript:void(0);" class="delete_menu">X</a></li>';
		$('#nestable ol').append(html);
		updateOutput($('#nestable').data('output', $('#menu_arr')));
	});
	$(document).on('click','#product_add_to_menu',function(){
		var key=$("#product_menu_select option:selected").val();
		var text=$("#product_menu_select option:selected").text();
		var html='<li class="dd-item" data-id="'+key+'"><div class="dd-handle">'+text+'</div><a href="javascript:void(0);" class="delete_menu">X</a></li>';
		$('#nestable2 ol').append(html);
		updateOutput($('#nestable2').data('output', $('#product_menu_arr')));
	});
	$(document).on('click','.delete_menu',function(){
		$(this).closest('li').remove();
		updateOutput($('#nestable').data('output', $('#menu_arr')));
		updateOutput($('#nestable2').data('output', $('#product_menu_arr')));
	});
    /*drag and drop menu*/
	
});

// forceNumeric() plug-in implementation
 jQuery.fn.forceNumeric = function () {
     return this.each(function () {
         $(this).keydown(function (e) {
             var key = e.which || e.keyCode;

             if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
             // numbers   
                 key >= 48 && key <= 57 ||
             // Numeric keypad
                 key >= 96 && key <= 105 ||
             // comma, period and minus, . on keypad
                key == 190 || key == 188 || key == 109 || key == 110 ||
             // Backspace and Tab and Enter
                key == 8 || key == 9 || key == 13 ||
             // Home and End
                key == 35 || key == 36 ||
             // left and right arrows
                key == 37 || key == 39 ||
             // Del and Ins
                key == 46 || key == 45)
                 return true;

             return false;
         });
     });
 }
