<?
$base_url = base_url();
$user_name = getUserProperty('user_name');
$profile = $this->freakauth_light->_getUserProfile(getUserProperty('id'));

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Vivagrams :: Healthy Habits for Happiness</title>
		
		<style type="text/css">
		#popover { position: absolute; top: 50px; width: 321px; height: 149px; background-image: url('/public/images/popover.png'); display: none; }
		#popover .jQClick {width: 321px; height: 149px;}
		</style>
		
		
		<link type="text/css" href="<?=$base_url?>public/css/style.css" rel="stylesheet" />
		<?
	        if (isset($page_description)) { echo "<meta name=\"description\" content=\"$page_description\" />\n"; }
	        if (isset($page_keywords)) { echo "<meta name=\"keywords\" content=\"$page_keywords\" />\n"; }
		?>
	    <script src="<?=$base_url?>public/shared/js/jquery-latest.js" type="text/javascript"></script>
		
		
    <? if (!isValidUser()) { ?>
		<script type="text/javascript">
      var xvals = [590, 660];
      var popoverfollowing = 0;
      
		  $(document).ready(function(){
			$('.headerLogin').click(function(e) {
			  e.preventDefault();
			  popoverfollowing = 0;
			  UpdatePopoverPosition();
				$('#popover').show();
			});
			$('.headerRegister').click(function(e) {
			  e.preventDefault();
			  popoverfollowing = 1;
			  UpdatePopoverPosition();
				$('#popover').show();
			});
		});
		</script>
    <? } ?>
		
	</head>

	<body>

	<!-- HEADER, LOGIN, and REGISTRATION -->
	<div id="head" class="wrapper">
	  <div class="logo">
	    <h1 class="ir">Vivagrams</h1>
	  </div>
	  <div class="right">
	    <a href="#" class="CronosProBold headerLogin">Log in</a> | 
		<a href="#" class="CronosProBold headerRegister">Get started</a>
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





