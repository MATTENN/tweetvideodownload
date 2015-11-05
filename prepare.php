<?php
require_once 'UltimateOAuth.php';
require_once 'token.php';

session_start();
$_SESSION['uo'] = new UltimateOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$uo = $_SESSION['uo'];
$res = $uo->post('oauth/request_token');
if (isset($res->errors)) {
    die(sprintf('Error[%d]: %s',
        $res->errors[0]->code,
        $res->errors[0]->message
    ));
}
$url = $uo->getAuthorizeURL();
header('Location: '.$url);
exit();
