// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults

Event.addBehavior({
  '#add_os' : function() {
    this.hide();
  },
  '#add_office' : function() {
    this.hide();
  },
  '#hub_checkout' : function() {
    this.hide();
  },
  '#computer_show_comments_add' : function() {
    this.hide();
  },
  '#computer_show_user_info_vax' : function() {
    this.hide();
  },
  '#computer_show_user_info_vax_link:click' : function() {
    $('computer_show_user_info_vax').toggle();
    return false;
  },
  '#computer_show_purchase_info_vax' : function() {
    this.hide();
  },
  '#computer_show_purchase_info_vax_link:click' : function() {
    $('computer_show_purchase_info_vax').toggle();
    return false;
  },
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