<?php
// Core file for CGB-005 server.
// Path to your folder with /01/ etc
$dir = "/var/www/cgb/html/";

function generate_UUID() {
	return str_replace(
		array('+','/','='),
		array('-','_',''),
		base64_encode(file_get_contents('/dev/urandom', 0, null, -1, 8))
	);
}