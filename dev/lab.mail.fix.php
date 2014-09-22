<?php
if (!function_exists('runkit_function_copy'))
	return;
runkit_function_copy('mail', 'basemail');
runkit_function_redefine('mail',
'$to, $subject, $message, $additional_headers=null, $additional_parameters=null',
'$user=getenv("LAB_USER");
if (empty($user) && isset($_SERVER["HTTP_HOST"]))
{
	$host = explode(".", $_SERVER["HTTP_HOST"]);
	$user=next($host);
}
if (empty($user) && isset($_SERVER["SCRIPT_NAME"]))
{
  $host = explode("/", $_SERVER["SCRIPT_NAME"]);
  next($host);
  $user=next($host);
}
if (!empty($user))
{
	$additional_headers=preg_replace("/ *\r*\n*$/", "", $additional_headers);
	$additional_headers=(!empty($additional_headers)?$additional_headers.PHP_EOL:"")."X-Lab-Sender: ".$user."@miritec.com";
}
basemail($to, $subject, $message, $additional_headers, $additional_parameters);'
);