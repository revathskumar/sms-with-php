# How to use
================
    require_once('/path/to/classSms.php');
	$ob = new Sms('way2sms_username','way2sms_password');
    $message=$ob->sendSMSToMany('mobile_no','message_to_send');
