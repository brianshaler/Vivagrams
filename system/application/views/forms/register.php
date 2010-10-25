
<div class="formColumn halfColumn">
	<h2>Register</h2>
    <? $attributes = array('class' => 'register', 'id' => 'register');
        echo form_open('sessions/register', $attributes); ?>
		<h4>Phone number:</h4>
    	<?=form_input(array('name'=>'user_name', 
    	                       'id'=>'user_name',
    	                       'maxlength'=>'45', 
    	                       'size'=>'45',
    	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'user_name'} : '')))?>
		<?=(isset($this->fal_validation) ? $this->fal_validation->{'user_name'.'_error'} : '')?><br />
		<h4>Password:</h4>
    	<?=form_password(array('name'=>'password', 
    	                       'id'=>'password',
    	                       'maxlength'=>'16', 
    	                       'size'=>'16',
    	                       'value'=>''))?>
        <?=(isset($this->fal_validation) ? $this->fal_validation->{'password'.'_error'} : '')?><br />
		<div style="text-align: right; margin-top: 15px;">
			<input type="submit" value="Submit" />
		</div>
	</form>
</div>
<a href="<?=oauth_url()?>">Twitter oauth</a>
