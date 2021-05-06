<?php
session_start();
// Include the bundled autoload from the Twilio PHP Helper Library
include("twilio-php-main/src/Twilio/autoload.php");
use Twilio\Rest\Client;

$account_sid = getenv('AC9327f443d8df42a69ba97524da115bba');
$auth_token = getenv('1de46933cf80a9c71b7184f24cb20a38');

// A Twilio number you own with SMS capabilities
$twilio_number = "+15017122661";
$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '9836608174',
    array(
        'from' => $twilio_number,
        'body' => 'I sent this message in under 10 minutes!'
    )
);
// Display a confirmation message on the screen
echo "Sent message to $name";
?>