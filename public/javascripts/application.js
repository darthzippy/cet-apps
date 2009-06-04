// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults

jQuery.noConflict();



jQuery(document).ready(function($){
  $("#add_os,#add_office,#hub_checkout,#computer_show_comments_add,#computer_show_user_info_vax,#computer_show_purchase_info_vax,#twitter-balloon").hide();
  
  $("#computer_show_user_info_vax_link").click(function () {
    $("#computer_show_user_info_vax").toggle("slow");
    return false;
  });

  $("#computer_show_purchase_info_vax_link").click(function () {
    $("#computer_show_purchase_info_vax").toggle("slow");
    return false;
  });

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

  $('.new_dvd,.edit_dvd').validate();

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
	
});