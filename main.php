<?php
/*
Plugin Name: Mytory Get CodeFile ShortCode
Description: Get url and print. (Using cURL)
Version: 1.0.0
Author: mytory
Author URI: http://mytory.net
License: GPL2
*/

function mgcs_get($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	if( ! $result = curl_exec($ch)){
        trigger_error(curl_error($ch));
    }
    curl_close($ch);

    return $result;
}


// [bartag foo="foo-value"]
function mgcs_shortcode( $atts ) {
	$code = mgcs_get($atts['url']);
	$code = "<pre><code>" . htmlspecialchars($code) . "</code></pre>";
	return $code;
}
add_shortcode( 'mytory-get-codefile', 'mgcs_shortcode' );