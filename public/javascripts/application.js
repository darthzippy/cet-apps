// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults

$(document).ready(function (){
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

  $('.end_shift_form').submit(function (){
    alert('It Works!');	
  });
	
});

Event.addBehavior({

  '#os_add:click' : function() {
    $('add_os').toggle();
    return false;
  },
  '#office_add:click' : function() {
    $('add_office').toggle();
    return false;
  },
  '#hub_checkout_link:click' : function() {
    $('hub_checkout').toggle();
    return false;
  },
  '#add_comment:click' : function() {
    $('computer_show_comments_add').toggle();
    return false;
  }
});