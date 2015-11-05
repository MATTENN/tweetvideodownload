<?php
require_once 'UltimateOAuth.php';
require_once 'token.php';

session_start();
if (!isset($_SESSION['uo'])) {
    die('Error[-1]: Session timeout.');
}
$uo = $_SESSION['uo'];
if (!isset($_GET['oauth_verifier']) || !is_string($_GET['oauth_verifier'])) {
    die('Error[-1]: No oauth_verifier');
}
$res = $uo->post('oauth/access_token', array(
    'oauth_verifier' => $_GET['oauth_verifier']
));
if (isset($res->errors)) {
    die(sprintf('Error[%d]: %s',
        $res->errors[0]->code,
        $res->errors[0]->message
    ));
}

$user_statues = $uo->get('account/verify_credentials');
setcookie("screen_name", $user_statues->screen_name);
header('Location: index.php');
exit();
