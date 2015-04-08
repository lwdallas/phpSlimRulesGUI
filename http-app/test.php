<?php
require 'vendor/autoload.php';

// And you're ready to go!
$response = \Httpful\Request::get('http://127.0.0.1:3000/rule/'.$_REQUEST['id'])->send();

print_r($response);

foreach ($response->body as $rule) {
	foreach ($rule as $key => $val) {
		echo "$key: $val\n";
	}
}
?>
