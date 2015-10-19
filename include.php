<?php
ini_set('max_execution_time', 300);
/**
 * it sets the application id and application secret id
 *
 */
$fb_app_id = '885946594787141';//Please specify app id
$fb_secret_id = '5f30c4ed634384b694f09258284fab21';//Please specify app secret

$fb_login_url = 'http://localhost:9090/facebook-rtCamp-challenge/index.php';

require_once ('lib/Facebook/autoload.php');
/**
 *
 * define the namespace alies
 * for the use of facebook namespace
 * easy to use
 */
session_start();
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
/*setting application configuration
 and session
  */
FacebookSession::setDefaultApplication($fb_app_id, $fb_secret_id);
$helper = new FacebookRedirectLoginHelper($fb_login_url);

if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
	$session = new FacebookSession($_SESSION['fb_token']);
	try {
		if (!$session -> validate()) {
			$session = null;
		}
	} catch ( Exception $e ) {
		$session = null;
	}
}
if (!isset($session) || $session === null) {
	try {
		$session = $helper -> getSessionFromRedirect();

	} catch( FacebookRequestException $ex ) {
		print_r($ex);
	} catch( Exception $ex ) {
		print_r($ex);
	}
}
function getdatafromfaceboook($url) {
   
	$session = new FacebookSession($_SESSION['fb_token']);
	$request_userinfo = new FacebookRequest($session, 'GET', $url);
	$response_userinfo = $request_userinfo -> execute();
	$userinfo = $response_userinfo -> getGraphObject() -> asArray();

	return $userinfo;
}
?>
