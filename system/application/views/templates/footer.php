  </div>
</div>


<!-- FOOTER -->
<div id="footer">
  <div class="wrapper">
    <div class="medium-column">
      <h2 class="CronosProBold">Contact</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      <form action="#">
        <textarea rows="5" cols="40"></textarea>
        <input type="submit" value="Send" />
      </form>
    </div>
    <div class="small-column">
      <h2 class="CronosProBold">Connect</h2>
      <p><a href="#" id="twitter" class="ir">Follow Vivagrams on Twitter</a></p>
      <p><a href="#" id="facebook" class="ir">Follow Vivagrams on Facebook</a></p>
    </div>
    <div id="iphone-app" class="small-column">
      <p><a href="#" class="ir">Download iPhone app</a></p>
    </div>
  </div>
</div>

<div class="wrapper CronosPro" id="copyright">
  <p>&copy; 2010 Vivagrams</p>
</div>

<? if (!isValidUser()) { ?>
<div id="popover">
          <div class="jQClick">
        <?=form_open("sessions/login", array('id' => 'login_form'))?>

		<?=form_input(array('name'=>'user_name', 
                                    'id'=>'user_name',
                                    'maxlength'=>'30', 
                                    'size'=>'30',
                                    'value'=>'phone',
                                    'style'=>'width:130px; position: absolute; left: 85px; top: 24px;',
                                    'class'=>'textfield'))?>

		<?=form_password(array('name'=>'password', 
                                    'id'=>'password',
                                    'maxlength'=>'30', 
                                    'size'=>'30',
                                    'value'=>'password',
                                    'style'=>'width:130px; position: absolute; left: 85px; top: 58px;',
                                    'class'=>'textfield'))?>

        	<?=form_submit(array('name'=>'login', 
                                    'id'=>'login', 
                                    'style'=>'position: absolute; top: 54px; left: 240px;',
                                    'value'=>$this->lang->line('FAL_login_label')))?>&nbsp;&nbsp;
              </div>

            <script type="text/javascript">
                            		$("#user_name").focus(function () { if (this.value == "phone") {this.value = "";} });
                            		$("#password").focus(function () { if (this.value == "password") {this.value = "";} });
            </script>
	<?=form_close()?>
	    <a style="position: absolute; top: 110px; left: 85px;" href="<?=oauth_url()?>"><img src="/public/images/twitter_connect.png" border=0 /></a>
</div>
<script>
function UpdatePopoverPosition()
{
  w = $(window).width() > 960 ? ($(window).width()-960)/2 : 0;
  console.log("offset = "+(w + xvals[popoverfollowing]) + ", " + $("#popover").offset().top);
  $("#popover").css({"left": w + xvals[popoverfollowing]});
  $("#popover").offset({top: $("#popover").offset().top, left: w + xvals[popoverfollowing]});
}
$(window).resize(function () {
  UpdatePopoverPosition();
});
UpdatePopoverPosition();
</script>
    <? } ?>

</body>
</html>
<!-- FOOTER -->


