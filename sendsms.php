<?php
if(isset($_POST["btn_submit"])){
	require_once('classSms.php');
	$ob = new Sms($_POST["txt_username"],$_POST["txt_password"]);
    $message=$ob->sendSMSToMany($_POST["txt_mobno"],$_POST["ta_msg"]);
    echo "<div style=\"color:red;\">$message</div>";
    }
?>
<div>Note:for groupSms seperate each number using ;(semicolon)</div>
<form method="post" name="InstantSMS" style="" action="sendsms.php">
<table>
	<tr>
		<td>Username : </td>
		<td><input type="text" name="txt_username"/></td>
	</tr>
	<tr>
		<td>Password : </ts>
		<td><input type="password" name="txt_password"/></td>
	</tr>
	<tr>
		<td>Phone Numbers : </td>
		<td><input type="text" name="txt_mobno"/></td>
	</tr>
	<tr>
		<td>Message : </td>
		<td><textarea name="ta_msg"></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="send sms" name="btn_submit"/></td>
	</tr>
</table>
</form>
