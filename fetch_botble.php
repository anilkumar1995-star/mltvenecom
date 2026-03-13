<?php
$username = 'admin';
$password = '12345678';
$loginUrl = 'https://shofy-grocery.botble.com/admin/login';
$slidersUrl = 'https://shofy-grocery.botble.com/admin/simple-sliders';
$cookieFile = __DIR__ . '/bcookie.txt';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $loginUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$html = curl_exec($ch);

preg_match('/name="_token" type="hidden" value="(.*?)"/', $html, $matches);
$token = $matches[1] ?? '';

curl_setopt($ch, CURLOPT_URL, $loginUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['_token' => $token, 'username' => $username, 'password' => $password]));
curl_exec($ch);

curl_setopt($ch, CURLOPT_URL, $slidersUrl);
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
$slidersHtml = curl_exec($ch);
file_put_contents('botble_sliders_index.html', $slidersHtml);

curl_setopt($ch, CURLOPT_URL, "https://shofy-grocery.botble.com/admin/simple-sliders/edit/1");
$editHtml = curl_exec($ch);
file_put_contents('botble_sliders_edit.html', $editHtml);

curl_close($ch);
echo "Done fetching HTML\n";
