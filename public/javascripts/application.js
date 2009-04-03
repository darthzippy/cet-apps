// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults

jQuery.noConflict();

jQuery(document).ready(function($){
  $("#add_os,#add_office,#hub_checkout,#computer_show_comments_add,#computer_show_user_info_vax,#computer_show_purchase_info_vax,#paid_date").hide();
  
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

  $("#dvd_paid").change(function () {
    $("#paid_date").toggle("slow");
    return false; 	
  });

  $('.end_shift_form').submit(function (){
    alert('It Works!');	
  });
	
});