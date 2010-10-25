<?
$base_url = base_url();
$user_name = getUserProperty('user_name');
$profile = $this->freakauth_light->_getUserProfile(getUserProperty('id'));

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Vivagrams :: Healthy Habits for Happiness</title>
		<!--<link type="text/css" href="<?=$base_url?>public/css/style.css" rel="stylesheet" />-->
		
		<style type="text/css">
		#floating-div {position: absolute; height:100px; width: 200px; background:#009900; top:  10px; right:60px;}
		</style> 
		
		
		<link type="text/css" href="<?=$base_url?>public/css/style.css" rel="stylesheet" />
		<?
	        if (isset($page_description)) { echo "<meta name=\"description\" content=\"$page_description\" />\n"; }
	        if (isset($page_keywords)) { echo "<meta name=\"keywords\" content=\"$page_keywords\" />\n"; }
		?>
	    <script src="<?=$base_url?>public/shared/js/jquery-latest.js" type="text/javascript"></script>
		
		<script type="text/javascript">
		$(document).ready(function(){
			$('.jQClick').click(function(){
				var pos = $('.jQClick').offset();
				var width = $('.jQClick').width();
				
				$('').css({"left": (pos.left+width)+"px", "top": pos.top+"px"});
				
				$('.jQClick').show();
			});
		});
		</script>
	</head>

	<body>

	<!-- HEADER, LOGIN, and REGISTRATION -->
	<div id="head" class="wrapper">
	  <div class="logo">
	    <h1 class="ir">Vivagrams</h1>
	  </div>
	  <div class="right">
	    <a href="#" class="CronosProBold jQClick">Log in</a> | 
		<a href="#" class="CronosProBold">Get started</a>
	  </div>
	</div>
	<!-- HEADER, LOGIN, and REGISTRATION -->

	<!-- NAVIGATION -->
	<div id="nav">
	  <ul class="CronosProBold wrapper">
	    <li><a href="#">Home</a></li>
	    <li><a href="#">Features</a></li>
	    <li><a href="#">About</a></li>
	    <li><a href="#">Tour</a></li>
	  </ul>
	</div>
	<!-- NAVIGATION -->

	<!-- MAIN CONTENT -->
	<div id="main">
	  <div class="wrapper">

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
	
	
	
	<!-- MAIN CONTENT -->





		
