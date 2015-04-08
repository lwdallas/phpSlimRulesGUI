<?php
include ('head.php');
include ('nav.php');
include ('content-wrapper-begin.php');

require 'vendor/autoload.php';

// And you're ready to go!
$response = \Httpful\Request::get('http://127.0.0.1:3000/rule')->send();
?>
	<ul class="nav navbar-nav navbar-right">
            <li style="background-color:#00FF00; margin: 3px;"><a href="http:ruleset_new.php" class="btn-small success glyphicon glyphicon-plus">&nbsp;<span <span style="font-family: verdana, arial;">Add Ruleset</span></a></li>
            <li>&nbsp;</li>
          </ul>
    </td>
<table callspacing=1>
<tr>
<td>&nbsp;ID </td>
<td>&nbsp;Test </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp;ACTIONS </td>
</tr>
<?php
$c=0;
foreach ($response->body as $rule) {
$c++;
?>
<tr>
<?php
	foreach ($rule as $key => $val) {
		?><td><?php
		echo '<a href="http:test_result.php?id='.$rule->id.'">'.$val.'</a>';
		?></td><?php
	}
?>
<td>
&nbsp;<a href="test_delete.php?test_id=<?php echo $rule->id; ?>" class="btn btn-danger glyphicon glyphicon-minus-sign">&nbsp;<span <span style="font-family: verdana, arial;">del</span></a>
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
