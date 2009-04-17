// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults

jQuery.noConflict();

jQuery(document).ready(function($){
  $("#add_os,#add_office,#hub_checkout,#computer_show_comments_add,#computer_show_user_info_vax,#computer_show_purchase_info_vax").hide();
  
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

  $('.new_dvd,.edit_dvd').validate();

  var var_name = $('#paid_checkbox').attr('checked')?1:0;
  if (var_name == 1) {
    $('#paid_date').show();	
  }
  if (var_name == 0) {
    $('#paid_date').hide();
  }

  $("#paid_checkbox").change(function () {
	var var_name = $('#paid_checkbox').attr('checked')?1:0;
	if (var_name == 1) {
	  $('#paid_date').show("slow");	
	}
	if (var_name == 0) {
	  $('#paid_date').hide("slow");	
	}
  });

 

  $('#date').datepicker({ dateFormat: 'yy-mm-dd' });

  $('.end_shift_form').submit(function (){
    alert('It Works!');	
  });
	
});