// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults

jQuery.noConflict();



jQuery(document).ready(function($){
	
  function hasAutofocus() {
	var element = document.createElement('input');
	return 'autofocus in element;'
  }

  $(function(){
    if(!hasAutofocus()){
	  $('input[autofocus=true]').focus();
    }	
  });

  $("#add_os,#add_office,#hub_checkout,#computer_show_comments_add,#twitter-balloon,#intel,#ip_address").hide();

  $("#os_add").click(function () {
    $("#add_os").toggle("slow");
    return false;
  });

  $("#add_comment").click(function () {
    $("#computer_show_comments_add").toggle("slow");
    return false;
  });

  $("#comment_cancel").click(function () {
    $("#computer_show_comments_add").toggle("slow");
    return false;
  });

  $("#tweets").hover(function () {
    $("#twitter-balloon").show();
  },
  function () {
	$("#twitter-balloon").hide();
    return false;
  });

  $('.new_dvd,.edit_dvd,.new_course,.edit_course,.new_computer,.edit_computer,.new_cet_user,.edit_cet_user').validate();

  var var_name = $('#paid_checkbox').attr('checked')?1:0;
  if (var_name == 1) {
    $('#paid_date,#paid_with').show();
  }
  if (var_name == 0) {
    $('#paid_date,#paid_with').hide();
  }

  $("#paid_checkbox").click(function () {
	var var_name = $('#paid_checkbox').attr('checked')?1:0;
	if (var_name == 1) {
	  $('#paid_date,#paid_with').show("slow");
	}
	if (var_name == 0) {
	  $('#paid_date,#paid_with').hide("slow");
	}
  });

  $('.date_entry_field').datepicker({ dateFormat: 'yy-mm-dd' });

  $('.search-date').datepicker({ 
	dateFormat: 'yy-mm-dd',
	changeMonth: true,
	changeYear: true
  });			

  $('.end_shift_form').submit(function () {
	$.post(this.action, $(this).serialize(), null, "script");
    return false;	
  });

  $('.new_shift_link').click(function () {
	$.post(this.action, $(this).serialize(), null, "script");
    return false;	
  });	

  var siteName = 'cetapps';
  $.getJSON(
	'http://search.twitter.com/search.json?callback=?&rpp=3&q=from:' + siteName,
	function(data) {
		$.each(data, function(i, tweets) {
			for(var num = 0; num < tweets.length; num++) {
				if(tweets[num].text !== undefined) {
					var tweetnum = num
					$('#tweet-' + tweetnum).append('<p>' + tweets[num].text + '<br /><span class="created_at">Created at ' + tweets[num].created_at + ' via</span> ' + tweets[num].source + '</p>');
				}
			}
		});
	}
  
  );

	var cpu_type = $("#computer_computer_type").val();
	  if (cpu_type == 'Mac Laptop') {
	    $("#intel").show();	
	  }
	  if (cpu_type == 'Mac Desktop') {
	    $("#intel").show();	
	  }
	  if (cpu_type == 'Printer - B&W') {
	    $("#ip_address").show();	
	  }
	if (cpu_type == 'Printer - Color') {
	    $("#ip_address").show();	
	  }
	
	$("#computer_computer_type").change(function()
	{
		switch($(this).val())
		{
			case 'Mac Laptop':
				$("#intel").show("slow");
			break;
		
			case 'Mac Desktop':
				$("#intel").show("slow");
			break;
			
			case 'Printer - B&W':
				$("#ip_address").show("slow");
			break;
			
			case 'Printer - Color':
				$("#ip_address").show("slow");
			break;
			
			default:
					$("#intel,#ip_address").hide();
		}

	});
	
});