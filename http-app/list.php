<?php
include ('head.php');
include ('nav.php');
include ('content-wrapper-begin.php');

require 'vendor/autoload.php';

// And you're ready to go!
$response = \Httpful\Request::get('http://127.0.0.1:3000/rule')->send();
?>
<table callspacing=1>
<tr>
<td>&nbsp;ID </td>
<td>&nbsp;RULESET </td>
<td>&nbsp;RULE </td>
<td>&nbsp;ACTIVE </td>
<td>&nbsp;COMMENT </td>
<td>&nbsp;ACTIONS </td>
</tr>
<?php
foreach ($response->body as $rule) {
?>
<tr>
<?php
	foreach ($rule as $key => $val) {
		?><td><?php
		echo '<a href="http:edit.php?id='.$rule->id.'">'.$val.'</a>';
		?></td><?php
	}
?>
<td>
&nbsp;<a href="delete.php?id=<?php echo $rule->id; ?>" class="btn btn-danger glyphicon glyphicon-minus-sign">&nbsp;<span <span style="font-family: verdana, arial;">del</span></a>
&nbsp;<a href="test_result.php?id=<?php echo $rule->id; ?>" class="btn btn-primary glyphicon glyphicon-ice-lolly">&nbsp;<span <span style="font-family: verdana, arial;">test</span></a>
</td>
</tr>
<?php
}
?>
</table>
<?php
include ('content-wrapper-end.php');
include ('foot.php');
?>
