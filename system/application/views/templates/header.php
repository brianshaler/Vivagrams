<?
$base_url = base_url();
$user = array();
if (isValidUser())
{
  $user = $this->freakauth_light->_getUserProfile(getUserProperty("id"));
  $user["id"] = getUserProperty("id");
  $user["user_name"] = getUserProperty("user_name");
  $user = prep_user($user);
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Vivagrams :: Healthy Habits for Happiness</title>
		<link id="page_favicon" href="<?=$base_url?>/public/images/favicon.ico" rel="icon" type="image/x-icon" />
		
		<script>
		var base_url = "<?=$base_url?>";
		</script>
		
		<link type="text/css" href="<?=$base_url?>public/css/style.css" rel="stylesheet" />
		<?
	        if (isset($page_description)) { echo "<meta name=\"description\" content=\"$page_description\" />\n"; }
	        if (isset($page_keywords)) { echo "<meta name=\"keywords\" content=\"$page_keywords\" />\n"; }
		?>
    <script src="<?=$base_url?>public/shared/js/jquery-latest.js" type="text/javascript"></script>
		
    <? if (!isValidUser()) { ?>
		<script src="<?=$base_url?>public/shared/js/login.js"></script>
    <? } ?>
		
	</head>

	<body>

	<!-- HEADER, LOGIN, and REGISTRATION -->
	<div id="head" class="wrapper">
	  <div class="logo">
	    <h1 class="ir">Vivagrams</h1>
	  </div>
	  <div class="right">
      <? if (!isValidUser()) { ?>
  	    <a href="#" class="CronosProBold headerLogin">Log in</a> | 
  		  <a href="#" class="CronosProBold headerRegister">Get started</a>
	    <? } else { ?>
  	    Logged in as <a href="<?=$base_url?>profile" class="CronosProBold"><?=$user["display_name"]?></a> | 
  		  <a href="<?=$base_url?>sessions/logout" class="CronosProBold">Log out</a>
	    <? } ?>
	  </div>
	</div>
	<!-- HEADER, LOGIN, and REGISTRATION -->

	<!-- NAVIGATION -->
	<div id="nav">
	  <ul class="CronosProBold wrapper">
      <? if (!isValidUser()) { ?>
	    <li><a href="<?=$base_url?>">Home</a></li>
	    <li><a href="<?=$base_url?>features">Features</a></li>
	    <li><a href="<?=$base_url?>about">About</a></li>
	    <li><a href="<?=$base_url?>tour">Tour</a></li>
	    <? } else { ?>
  	  <li><a href="<?=$base_url?>">Dashboard</a></li>
  	  <!-- <li><a href="<?=$base_url?>friends">Friends</a></li> -->
  	  <li><a href="<?=$base_url?>stats">Reports</a></li>
  	  <li><a href="<?=$base_url?>profile">My Account</a></li>
	    <? } ?>
	  </ul>
	</div>
	<!-- NAVIGATION -->

	<!-- MAIN CONTENT -->
	<div id="main">





