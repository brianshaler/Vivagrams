<?
include 'twitter-async/EpiCurl.php';
include 'twitter-async/EpiOAuth.php';
include 'twitter-async/EpiTwitter.php';

define('TWITTER_CONSUMER_KEY', 'pFRqOM0WsNQlo6duvheL5A');  
define('TWITTER_CONSUMER_SECRET', 'pjLeSmOL2tD4P7a4mclwI8K8MPJfksicZTOLKWinc1k');

//$twitter_name
$twitterObj = new EpiTwitter(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);

function complete_oauth ()
{
  
}

$oauth_url = "";
function oauth_url ()
{
  global $oauth_url;
    try {
        $twitterObj = new EpiTwitter(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
        $oauth_url = $twitterObj->getAuthenticateUrl();
        return $oauth_url;
    } catch(EpiOAuthException $e) {
        return $e;
    }
}

function get_oauth_token ()
{
  global $twitterObj;
  
  $twitterObj = new EpiTwitter(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, getvar('oauth_token', ''));
//  $twitterObj->setToken(getvar('oauth_token', ''));
  $token = $twitterObj->getAccessToken();
  //$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);
  
  return $token;
}

function set_oauth_usertoken ($token, $tokensecret)
{
  global $twitterObj;
  
  if (!$twitterObj) { $twitterObj = new EpiTwitter(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET); }
  $twitterObj->setToken($token, $tokensecret);
}

function get_screen_name ()
{
  global $twitterObj;
  $creds = $twitterObj->get('/account/verify_credentials.json');
  //echo $creds->responseText;
  $obj = json_decode($creds->responseText, true);
  return $obj["screen_name"];
}

?>
