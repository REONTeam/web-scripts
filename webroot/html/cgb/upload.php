<?php
// This is a very small script that asks the GBC to send an Authentication header along with the data.
define('CORE_PATH', dirname(dirname(__DIR__)) . '/core');
require_once(CORE_PATH.'/core.php');

// Probably will be abstracted into a function.
if(!isset($_SERVER["HTTP_GB_AUTH_ID"])) { // is the Auth ID set?
    if(!isset($_SERVER["HTTP_AUTHORIZATION"])) { // If Auth ID isnt set but there's an Auth header, that means they've sent us something to check.
        http_response_code(401);
        $randomid = base64_encode(random_bytes(36));
        header('WWW-Authenticate: GB00 name="'.$randomid.'"');
        exit();
    } else {
        header("Gb-Auth-ID: theauthworked");
		exit();
    }
}
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $valid = true;
    $file = "";
    
    if (isset($_GET["name"]))
    {
        if ($_GET["name"] == "")
        {
            $valid = false;
        }
        else
        {
            $file = test_input($_GET["name"]);
            $file = ltrim($file, '/');
        }
    }
    else
    {
        $valid = false;
    }
    
    if ($valid)
    {
        if (file_exists($dir.$file))
        {
            include($dir.$file);
            exit;
        }
        else
        {
            #else 404 not found.
            http_response_code(404);
            die();
        }
    }
    else
    {
        #page string isn't valid, we'll just 404 to cover our butts.
        http_response_code(404);
        die();
    }


/* (These docs credited to Háčky from Glitch City)
An authentication attempt begins by sending an HTTP GET request, to which the server responds with 401 Unauthorized and a WWW-Authenticate: GB00 name="…" header, where the name is an arbitrary 36-byte value encoded in Base64.

The game then sends another GET request, this time with the header Authorization: GB00 name="…", where the name is a concatenation of two separate Base64-encoded values: the first is the first 32 bytes from the WWW-Authenticate name, and the second is a 36-byte value determined by a byzantine procedure:

    The login password is appended to the 48-character Base64-encoded WWW-Authenticate name, and then this string is hashed with MD5.
    The 36-byte WWW-Authenticate value is split into two 18-byte values, the first containing all of the even-numbered bits of the original and the second containing all of the odd-numbered bits. The first byte of each two-byte pair fills the most significant bits of each output byte, and the second byte fills the least significant bits. These values are concatenated into a new 36-byte string.
    The login ID is appended to the MD5 hash from step 1. This string is padded with $FF until it is 35 bytes long, then a $00 is added to make it 36 bytes.
    The 36-byte strings produced in steps 2 and 3 are xor’d.
    But that would have been too simple, so then each byte has bits 0, 3, and 6 rotated into bits 3, 6, and 0.

The first step necessitates that the server retains users’ plaintext passwords in order to calculate arbitrary MD5 hashes from them—unless the value in the WWW-Authenticate header is predetermined, which would allow the hash to be precalculated, but would make the rest of this shell game even more pointless as a successful authentication attempt could be replayed.

If the Authorization header is valid, the server responds with 200 OK and a Gb-Auth-ID header which contains an arbitrary string. The game then sends its POST request and includes the same Gb-Auth-ID header.
*/
