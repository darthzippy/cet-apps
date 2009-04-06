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

  $("#dvd_paid").change(function () {
    $("#paid_date").html('<p><label for="dvd_paid_date">Paid date</label><br /><select id="dvd_paid_date_1i" name="dvd[paid_date(1i)]"><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option selected="selected" value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option></select><select id="dvd_paid_date_2i" name="dvd[paid_date(2i)]"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option selected="selected" value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select><select id="dvd_paid_date_3i" name="dvd[paid_date(3i)]"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option selected="selected" value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select></p>');
  });

  $('.end_shift_form').submit(function (){
    alert('It Works!');	
  });
	
});