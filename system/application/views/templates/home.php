
<div class="left-column bigform">
<h1>Register</h1>
    <? $attributes = array('class' => 'register', 'id' => 'register');
        echo form_open('/', $attributes); ?>
		<h4>User name:</h4>
    	<?=form_input(array('name'=>'user_name', 
    	                       'id'=>'user_name',
    	                       'maxlength'=>'45', 
    	                       'size'=>'45',
    	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'user_name'} : ''),
    	                       'class'=>'textfield'))?>
		<?=(isset($this->fal_validation) ? $this->fal_validation->{'user_name'.'_error'} : '')?><br />
		<h4>Email:</h4>
        	<?=form_input(array('name'=>'email', 
        	                       'id'=>'email',
        	                       'maxlength'=>'120', 
        	                       'size'=>'45',
        	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'email'} : ''),
           	                       'class'=>'textfield'))?>
            <?=(isset($this->fal_validation) ? $this->fal_validation->{'email'.'_error'} : '')?><br />
		<h4>Password:</h4>
    	<?=form_password(array('name'=>'password', 
    	                       'id'=>'password',
    	                       'maxlength'=>'16', 
    	                       'size'=>'16',
    	                       'value'=>'',
       	                       'class'=>'textfield'))?>
        <?=(isset($this->fal_validation) ? $this->fal_validation->{'password'.'_error'} : '')?><br />
		<h4>Confirm Password:</h4>
        	<?=form_password(array('name'=>'password_confirm', 
        	                       'id'=>'password_confirm',
        	                       'maxlength'=>'16', 
        	                       'size'=>'16',
        	                       'value'=>'',
           	                       'class'=>'textfield'))?>
            <?=(isset($this->fal_validation) ? $this->fal_validation->{'password_confirm'.'_error'} : '')?><br />
		<div style="text-align: right; margin-top: 12px;">
			<input type="submit" value="Submit" class="button" />
		</div>
	</form>
</div>
<div class="right-column bigform">
<h1>Log In</h1>
<?=form_open("sessions/login", array('id' => 'login_form'))?>
    <h4>User name:</h4>
	<?=form_input(array('name'=>'user_name', 
                            'id'=>'user_name',
                            'maxlength'=>'30', 
                            'size'=>'30',
                            'class'=>'textfield'))?>
    <br />
    <h4>Password:</h4>
	<?=form_password(array('name'=>'password', 
                            'id'=>'password',
                            'maxlength'=>'30', 
                            'size'=>'30',
                            'class'=>'textfield'))?>
    <br />
	<div style="text-align: right; margin-top: 12px;">
		<input type="submit" value="Login" class="button" />
	</div>

    <script type="text/javascript">
        $("#user_name").focus(function () { if (this.value == "user name") {this.value = "";} });
        $("#password").focus(function () { if (this.value == "password") {this.value = "";} });
    </script>
<?=form_close()?>

</div>