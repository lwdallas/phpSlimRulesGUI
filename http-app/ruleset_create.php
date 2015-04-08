<?php
include ('head.php');
include ('nav.php');
include ('content-wrapper-begin.php');

require 'vendor/autoload.php';

$post_array = array(
	'ruleset_active' => $_REQUEST['ruleset_active'],
	'ruleset_id' => $_REQUEST['ruleset_id'],
	'ruleset' => $_REQUEST['ruleset'],
	'ruleset_comment' => $_REQUEST['ruleset_comment']
	);

$postText = http_build_query($post_array);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://127.0.0.1:3000/ruleset");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postText);

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

// further processing ....
?>
<table><tr>
<?php
		if ($server_output != false){
		?><td class="alert-success"><?php
		echo "ruleset created";
		}else{
		?><td class="alert-warning"><?php
		echo "$server_output - error creating ruleset";
		}
		?></td><?php
if ($server_output != false){
?>
	<tr><td><a href="http:ruleset_list.php" class="btn btn-primary">ok</a></td>
<?php
		}else{
?>
	<td><a href="void(0);" class="btn btn-primary" onclick="window.history.back();">back</a></td>
<?php
}
?>
</tr>
</table>
<?php
include ('content-wrapper-end.php');
include ('foot.php');
?>

