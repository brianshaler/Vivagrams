
<div class="formColumn halfColumn">
	<h2>Register</h2>
    <? $attributes = array('class' => 'register', 'id' => 'register');
        echo form_open('sessions/register', $attributes); ?>
		<h4>User name:</h4>
    	<?=form_input(array('name'=>'user_name', 
    	                       'id'=>'user_name',
    	                       'maxlength'=>'45', 
    	                       'size'=>'45',
    	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'user_name'} : '')))?>
		<?=(isset($this->fal_validation) ? $this->fal_validation->{'user_name'.'_error'} : '')?><br />
		<h4>Email:</h4>
        	<?=form_input(array('name'=>'email', 
        	                       'id'=>'email',
        	                       'maxlength'=>'120', 
        	                       'size'=>'45',
        	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'email'} : '')))?>
            <?=(isset($this->fal_validation) ? $this->fal_validation->{'email'.'_error'} : '')?><br />
		<h4>Password:</h4>
    	<?=form_password(array('name'=>'password', 
    	                       'id'=>'password',
    	                       'maxlength'=>'16', 
    	                       'size'=>'16',
    	                       'value'=>''))?>
        <?=(isset($this->fal_validation) ? $this->fal_validation->{'password'.'_error'} : '')?><br />
		<h4>Confirm Password:</h4>
        	<?=form_password(array('name'=>'password_confirm', 
        	                       'id'=>'password_confirm',
        	                       'maxlength'=>'16', 
        	                       'size'=>'16',
        	                       'value'=>''))?>
            <?=(isset($this->fal_validation) ? $this->fal_validation->{'password_confirm'.'_error'} : '')?><br />
		<div style="text-align: right; margin-top: 15px;">
			<input type="submit" value="Submit" />
		</div>
	</form>
</div>
<div class="formColumn halfColumn">
	<h2>Log In</h2>
    <? $attributes = array('class' => 'login', 'id' => 'login');
        echo form_open('sessions/login', $attributes); ?>
		<h4>User name:</h4>
		<input type="text" class="textfield" name="user_name" /><br />
		<h4>Password:</h4>
		<input type="password" class="textfield" name="password" /><br />
		<div style="text-align: right; margin-top: 15px;">
			<input type="submit" value="Log In" />
		</div>
	</form>
</div>