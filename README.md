# [ Deprecated ]
> This project is deprecated.
> Way2sms has changed its UI after this and this project won't work anymore. 

# How to use    [![Build Status](https://secure.travis-ci.org/revathskumar/sms-with-php.png)](http://travis-ci.org/revathskumar/sms-with-php)
================
    require_once('/path/to/classSms.php');
	$ob = new Sms('way2sms_username','way2sms_password');
    $message=$ob->sendSMSToMany('mobile_no','message_to_send');
