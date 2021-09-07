<?php
    require_once(dirname(__FILE__).'../../../../wp-config.php'); 

    header('Content-Type: image/png');
    echo base64_decode('R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs');	
    
    $userIp = $_SERVER['REMOTE_ADDR'];

    $url = 'https://www.google-analytics.com/collect?';
    
    //$content = utf8_encode(http_build_query($params));
    $user_agent = ''; //htmlspecialchars ($_SERVER['HTTP_USER_AGENT']);
    
    $content = $_SERVER['QUERY_STRING'] . '&tid='. sanitize_text_field( get_option( 'uaId' ));

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-type: application/x-www-form-urlencoded'));
    curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
    curl_setopt($ch,CURLOPT_POST, TRUE);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $content);
    curl_exec($ch);
    curl_close($ch);

?>