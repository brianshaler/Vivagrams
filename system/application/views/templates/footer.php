  </div>
</div>


<div id="floating-div">
<? if (isValidUser()) { ?>
            			    Signed in as 
            			    <a href="/profile/<?=$user_name?>"><? echo (strlen($profile['display_name']) > 0 ? $profile['display_name'] : $user_name); ?></a> | 
            			    <a href="/user/settings">Settings</a> | 
            			    <a href="/sessions/logout">Log out</a>
                		<? } else { ?>
                              <div class="jQClick" style="display: none">
                            <?=form_open("sessions/login", array('id' => 'login_form'))?>
                		        Log in:
                				<?=form_input(array('name'=>'user_name', 
                                                        'id'=>'user_name',
                                                        'maxlength'=>'30', 
                                                        'size'=>'30',
                                                        'value'=>'phone',
                                                        'style'=>'width:130px',
                                                        'class'=>'textfield'))?>

                				<?=form_password(array('name'=>'password', 
                                                        'id'=>'password',
                                                        'maxlength'=>'30', 
                                                        'size'=>'30',
                                                        'value'=>'password',
                                                        'style'=>'width:130px',
                                                        'class'=>'textfield'))?>

                            	<?=form_submit(array('name'=>'login', 
                                                        'id'=>'login', 
                                                        'value'=>$this->lang->line('FAL_login_label')))?>&nbsp;&nbsp;
                                  </div>

                                <script type="text/javascript">
                                                		$("#user_name").focus(function () { if (this.value == "phone") {this.value = "";} });
                                                		$("#password").focus(function () { if (this.value == "password") {this.value = "";} });
                                </script>
                			<?=form_close()?>
                        <? } ?>

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

</html>
<!-- FOOTER -->


