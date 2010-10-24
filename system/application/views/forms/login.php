
			<div class="formColumn halfColumn">
				<h2>Log In</h2>
				<?=isset($message) ? "<span style=\"font-size: 12px;\">$message</span>" : ""?>
                <?=isset($this->fal_validation->login_error_message) ? $this->fal_validation->login_error_message : ''?>
                <?=form_open($this->uri->uri_string(), array('id' => 'login_form'))?>
                    <h4>User name:</h4>
					<?=form_input(array('name'=>'user_name', 
                	                       'id'=>'user_name',
                	                       'maxlength'=>'30', 
                	                       'size'=>'30',
                	                       'value'=>'',
                      	                   'class'=>'textfield'))?>
                    <?=(isset($this->fal_validation) ? $this->fal_validation->{'user_name'.'_error'} : '')?>
                    <br />
					<h4>Password:</h4>
					<?=form_password(array('name'=>'password', 
                	                       'id'=>'password',
                	                       'maxlength'=>'30', 
                	                       'size'=>'30',
                	                       'value'=>'',
                  	                       'class'=>'textfield'))?>
                    <?=(isset($this->fal_validation) ? $this->fal_validation->{'password'.'_error'} : '')?>
                    <br />
					<div style="text-align: right; margin-top: 15px;">
                    	<?=form_submit(array('name'=>'login', 
                    	                     'id'=>'login', 
                    	                     'value'=>$this->lang->line('FAL_login_label')))?>
					</div>
				<?=form_close()?>
			</div>