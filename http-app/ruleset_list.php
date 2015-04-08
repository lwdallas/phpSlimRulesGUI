<?php
include ('head.php');
include ('nav.php');
include ('content-wrapper-begin.php');

require 'vendor/autoload.php';

// And you're ready to go!
$response = \Httpful\Request::get('http://127.0.0.1:3000/ruleset')->send();
?>
	<ul class="nav navbar-nav navbar-right">
            <li style="background-color:#00FF00; margin: 3px;"><a href="http:ruleset_new.php" class="btn-small success glyphicon glyphicon-plus">&nbsp;<span <span style="font-family: verdana, arial;">Add Ruleset</span></a></li>
            <li>&nbsp;</li>
          </ul>
    </td>
<table callspacing=1>
<tr>
<td>&nbsp;ID </td>
<td>&nbsp;RULESET </td>
<td>&nbsp;ACTIVE </td>
<td>&nbsp;COMMENT </td>
<td>&nbsp;ACTIONS </td>
</tr>
<?php
$c=0;
foreach ($response->body as $ruleset) {
$c++;
?>
<tr>
<?php
	foreach ($ruleset as $key => $val) {
		?><td><?php
		echo '<a href="http:ruleset_edit.php?ruleset_id='.$ruleset->ruleset_id.'">'.$val.'</a>';
		?></td><?php
	}
?>
<td>
&nbsp;<a href="ruleset_delete.php?ruleset_id=<?php echo $ruleset->ruleset_id; ?>" class="btn btn-danger glyphicon glyphicon-minus-sign">&nbsp;<span <span style="font-family: verdana, arial;">del</span></a>
&nbsp;<a href="ruleset_test_result.php?ruleset_id=<?php echo $ruleset->ruleset_id; ?>" class="btn btn-primary glyphicon glyphicon-ice-lolly">&nbsp;<span <span style="font-family: verdana, arial;">test</span></a>
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
