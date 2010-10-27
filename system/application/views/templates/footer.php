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
      <p><a href="http://twitter.com/vivagrams" id="twitter" class="ir">Follow Vivagrams on Twitter</a></p>
      <p><a href="http://www.facebook.com/pages/Vivagrams/154350017940772" id="facebook" class="ir">Follow Vivagrams on Facebook</a></p>
    </div>
    <div id="iphone-app" class="small-column">
      <p><a href="<?=base_url()?>comingsoon/iphone_app" class="ir">Download iPhone app</a></p>
    </div>
  </div>
</div>

<div class="wrapper CronosPro" id="copyright">
  <p>&copy; 2010 Vivagrams</p>
</div>

<? if (!isValidUser()) { ?>
<div id="popover">
          <div class="jQClick">
   <form action="#" method="POST" id="SubmitPopoverForm">

		<?=form_input(array('name'=>'user_name', 
                                    'id'=>'popover_user_name',
                                    'maxlength'=>'30', 
                                    'size'=>'30',
                                    'style'=>'width:130px; position: absolute; left: 85px; top: 26px;',
                                    'class'=>'textfield'))?>

		<?=form_password(array('name'=>'password', 
                                    'id'=>'popover_password',
                                    'maxlength'=>'30', 
                                    'size'=>'30',
                                    'style'=>'width:130px; position: absolute; left: 85px; top: 59px;',
                                    'class'=>'textfield'))?>

  	<?=form_submit(array('name'=>'login', 
                                    'id'=>'popover_login', 
                                    'style'=>'position: absolute; top: 56px; left: 230px;',
                                    'value'=>$this->lang->line('FAL_login_label')))?>&nbsp;&nbsp;
              </div>
	</form>
	    <a style="position: absolute; top: 110px; left: 85px;" href="<?=base_url()?>twitter_oauth/redirect"><img src="/public/images/twitter_connect.png" /></a>
</div>
<div id="tooltip" style="position: absolute; display: none;">
<?
$str = <<<endpopup
<div id="tooltip_text"><!-- --></div>
endpopup;
echo $this->load->view('widgets/tooltip', array("content"=>$str), true);
?>
</div>
<script>

//popoverfollowing
</script>
    <? } ?>

</body>
</html>
<!-- FOOTER -->


