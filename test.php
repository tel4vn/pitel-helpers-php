<?php
use Firebase\JWT\JWT;
require('./index.php');


$TEST_API_KEY = '81EdYnwrvimH';
$TEST_SECRET_KEY = 'Ib19uY8v';
$TEST_USERID = '1001';


$pitelHelper = new PitelHelpers($TEST_API_KEY, $TEST_SECRET_KEY, $TEST_USERID);
$token = $pitelHelper->getAccessToken();

$decoded = JWT::decode($token, $TEST_SECRET_KEY, array('RS256'));

echo $decoded;
?>