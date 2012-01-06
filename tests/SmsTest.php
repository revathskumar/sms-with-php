<?php
require("../classSms.php");
class SmsTest extends PHPUnit_Framework_TestCase
{
    public function testInvalidLogin(){
        $ob = new Sms('9995123456','123456');
        $message=$ob->sendSMSToMany("9995436867","Testing!!!");
        $this->assertEquals("invalid login",$message);
    }

    public function testLogin(){
        
    }

    public function testSendSms(){
        
    }

    public function testBulkSms(){
        
    }

    public function testLogout(){
        
    }
}
?>