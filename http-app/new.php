<?php
include ('head.php');
include ('nav.php');
include ('content-wrapper-begin.php');

require 'vendor/autoload.php';

?>
<table>
<form name="frm" action="http:create.php">
<tr>
	<td>Rule Set</td>
	<td>
			<input name="ruleset" type="text" value="<?php
				echo $rule->ruleset;?>" >
	</td>
</tr>
<tr>
	<td>Rule Logic</td>
	<td>
			<input name="rule" type="text" value="<?php
				echo $rule->rule;?>" >
	</td>
</tr>
<tr>
	<td>Active</td>
	<td>
			<input name="rule_active" type="text" value="<?php
				echo $rule->rule_active;?>" >
	</td>
</tr>
<tr>
	<td>Comment</td>
	<td>
			<input name="rule_comment" type="text" disavalue="<?php
				echo $rule->rule_comment;?>" >
	</td>
</tr>
<td><a href="#" onclick="document.frm.submit()" class="btn btn-success glyphicon glyphicon-ok">&nbsp;save</a></td>
</tr>
</form>
</table>
<?php
include ('content-wrapper-end.php');
include ('foot.php');
?>
