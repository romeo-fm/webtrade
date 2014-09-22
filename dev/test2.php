<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Example</title>
    </head>
    <body>

<?php

// Provide the Host Information.
$tHost = 'gateway.sandbox.push.apple.com';
#$tHost = 'gateway.push.apple.com';

$tPort = 2195;

// Provide the Certificate and Key Data.
$tCert = 'News4SalePush.pem';
#$tCert = 'apns-prod.pem';

// Provide the Private Key Passphrase (alternatively you can keep this secrete
// and enter the key manually on the terminal -> remove relevant line from code).
// Replace XXXXX with your Passphrase
$tPassphrase = 'qwer12';
// Provide the Device Identifier (Ensure that the Identifier does not have spaces in it).
// Replace this token with the token of the iOS device that is to receive the notification.
$tTokens = array(
	'8924dc2f09ddc61bb1365b2264c0882fe55721278d257433c8e9000d7b80a75b');

// The message that is to appear on the dialog.
$tAlert = 'You have a LiveCode APNS Message';

// The Badge Number for the Application Icon (integer >=0).
$tBadge = 2;

// Audible Notification Option.
$tSound = 'default';
#$tSound = 'none';

// The content that is returned by the LiveCode "pushNotificationReceived" message.
$tPayload = 'APNS Message Handled by LiveCode';

// Create the message content that is to be sent to the device.
$tBody['aps'] = array (

'alert' => $tAlert,
'badge' => $tBadge,
'sound' => $tSound,
);

$tBody ['payload'] = $tPayload;

// Encode the body to JSON.
$tBody = json_encode ($tBody);
$tBody = '{"aps":{"badge":1,"sound":"sound.caf"},"MessageID":121}'; 

echo $tBody;
echo "<br>";

// Create the Socket Stream.

$tContext = stream_context_create ();
stream_context_set_option ($tContext, 'ssl', 'local_cert', $tCert);

// Remove this line if you would like to enter the Private Key Passphrase manually.
stream_context_set_option ($tContext, 'ssl', 'passphrase', $tPassphrase);

// Open the Connection to the APNS Server.
$tSocket = stream_socket_client ('ssl://'.$tHost.':'.$tPort, $error, $errstr, 30, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $tContext);

// Check if we were able to open a socket.
if (!$tSocket)
	exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);

foreach ($tTokens as $i => $tToken)  {
	//$tToken = $tTokens[$i];
	// Build the Binary Notification.
	$tMsg = chr (0) . chr (0) . chr (32) . pack ('H*', $tToken) . pack ('n', strlen ($tBody)) . $tBody;

	// Send the Notification to the Server.
	$tResult = fwrite ($tSocket, $tMsg, strlen ($tMsg));

	if ($tResult)
		echo $tToken . ' Delivered  Message to APNS' . PHP_EOL;
	else
		echo $tToken . ' Could not Deliver Message to APNS' . PHP_EOL;
}

// Close the Connection to the Server.
fclose ($tSocket);

?>

    </body>
</html>
