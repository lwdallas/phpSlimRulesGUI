<?php
include ('head.php');
include ('nav.php');
include ('content-wrapper-begin.php');

require 'vendor/autoload.php';

// curl -X PUT -d "ruleset=1" -d "rule_active=0" -d "rule_comment=ignore this one" -d "rule=something = 1 and another < 10 or unfinished idea" http://127.0.0.1:3000/rule/3
$post_array = array(
	'rule_active' => $_REQUEST['rule_active'],
	'rule' => $_REQUEST['rule'],
	'ruleset' => $_REQUEST['ruleset'],
	'rule_comment' => $_REQUEST['rule_comment']
	);

$postText = http_build_query($post_array);

$ch = curl_init("http://127.0.0.1:3000/rule/".$_REQUEST['id']);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,"http://127.0.0.1:3000/rule/".$_REQUEST['id']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postText);

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);
?>
<table><tr>
<?php
		if ($server_output != false){
		?><td class="alert-success"><?php
		echo "rule updated"
		?></td><?php
		}else{
		?><td class="alert-warning"><?php
		echo "$server_output - error updating rule ";
		?></td><?php
		}
		
if ($server_output != false){
?>
	<tr><td><a href="http:list.php" class="btn btn-primary">ok</a></td>
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

