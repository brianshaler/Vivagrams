<?
$base_url = base_url();
$user_name = getUserProperty('user_name');
$profile = $this->freakauth_light->_getUserProfile(getUserProperty('id'));
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Vivagrams</title>
	<?
        if (isset($page_description)) { echo "<meta name=\"description\" content=\"$page_description\" />\n"; }
        if (isset($page_keywords)) { echo "<meta name=\"keywords\" content=\"$page_keywords\" />\n"; }
	?>
    <script src="<?=$base_url?>public/shared/js/jquery-latest.js" type="text/javascript"></script>
	<link type="text/css" rel="stylesheet" href="<?=$base_url?>public/css/style.css" />
</head>
<body>
<div id="all">
    <div id="content">
    	<div id="header">
    		<div id="logo">
    		    <img src="<?=$base_url?>public/images/logo_white.png" />
    		</div>
    		<div id="navbarholder">
        		<div id="navbar">
    			    <ul class="navbar-left navlinks">
			            <li><a href="/">Dashboard</a></li>
			            <li><a href="/user/settings">Settings</a></li>
    			    </ul>
    			    <div class="navbar-right">
                		<? if (isValidUser()) { ?>
            			    Signed in as 
            			    <a href="/profile/<?=$user_name?>"><? echo (strlen($profile['display_name']) > 0 ? $profile['display_name'] : $user_name); ?></a> | 
            			    <a href="/user/settings">Settings</a> | 
            			    <a href="/sessions/logout">Log out</a>
                		<? } else { ?>
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

                                <script type="text/javascript">
                                                		$("#user_name").focus(function () { if (this.value == "phone") {this.value = "";} });
                                                		$("#password").focus(function () { if (this.value == "password") {this.value = "";} });
                                </script>
                			<?=form_close()?>
                        <? } ?>
        			</div>
        		</div>
        	</div>
    	</div>
    	<div id="body">
		
