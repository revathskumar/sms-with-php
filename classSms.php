<?php
/*Sms
 *used to send sms using web service
 *@ $uid       String:  username to authenticate the way2sms website
 *@ $pwd       String:  password for way2sms website
 *@ $phone     String:  phone numbers of recipients
 *@ $msg       String:  the message to be send
 *
 *@Author : Aswin Anand
 *@edited by Revath S Kumar
 *
 *
 */
class Sms
{
      var $uid,$pwd,$phone,$msg;
      /*
      *@ constructor of Sms class
      *
      *@ $id     String :  username to authenticate the way2sms website
      *@ $pass   String :  password for way2sms website
      *
      */
      function Sms($id,$pass)
      {
						$this->uid=$id;
						$this->pwd=$pass;
      }
	/*
	*sendSMSToMany
	*@description : to send the sms
	*
	*@ $phone    String :  phone numbers of recipients
	*@ $msg      String :  the message to be send
	*
	*@return     String :  error message or success message
	*/		
      function sendSMSToMany($phone, $msg)
      {
            $curl = curl_init();
            $timeout = 30;
            $ret = "";
            
            // $uid = urlencode($uid);
            // $pwd = urlencode($pwd);
            
            curl_setopt ($curl, CURLOPT_URL, "http://site6.way2sms.com/Login1.action");
            curl_setopt ($curl, CURLOPT_POST, 1);
            curl_setopt ($curl, CURLOPT_POSTFIELDS, "username=" . $this->uid . "&password=" . $this->pwd);
            curl_setopt ($curl, CURLOPT_COOKIESESSION, 1);
            curl_setopt ($curl, CURLOPT_COOKIEFILE, "cookie_way2sms");
            curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt ($curl, CURLOPT_MAXREDIRS, 20);
            curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5");
            curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt ($curl, CURLOPT_REFERER, "http://site6.way2sms.com/");
            $text = curl_exec($curl);
            // Check for proper login
            $pos = stripos(curl_getinfo($curl, CURLINFO_EFFECTIVE_URL), "main.action");
            // echo $pos;
            // exit();
            if ($pos === "FALSE" || $pos == 0 || $pos == "")
            			return "invalid login";
            
            if (trim($msg) == "" || strlen($msg) == 0) return "invalid message";
            		$msg = urlencode($msg);
                
            $pharr = explode(";", $phone);
            $refurl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
            curl_setopt ($curl, CURLOPT_REFERER, $refurl);
            curl_setopt ($curl, CURLOPT_URL, "http://site6.way2sms.com/jsp/InstantSMS.jsp");
            $text = curl_exec($curl);
            $dom = new DOMDocument();
            $dom->loadHTML($text);
            $action = $dom->getElementById("Action")->getAttribute('value');

            foreach ($pharr as $p)
            {
            
            		
                  if (strlen($p) != 10 || !is_numeric($p) || strpos($p, ".") != false)
                  {
                        $ret .= "invalid number;" . $p . "\n";
                        continue;
            			}
            
                  $p = urlencode($p);
                  
                  // Send SMS
                  curl_setopt ($curl, CURLOPT_URL, "http://site6.way2sms.com/quicksms.action?custid=\"+custid+\"&sponserid=\"+sponserid+\"");
                  curl_setopt ($curl, CURLOPT_REFERER, curl_getinfo($curl, CURLINFO_EFFECTIVE_URL));
                  curl_setopt ($curl, CURLOPT_POST, 1);
                  
                  
                  curl_setopt ($curl, CURLOPT_POSTFIELDS, "MobNo=$p&textArea=$msg&HiddenAction=instantsms&login=&pass=&Action=$action");
                  $text = curl_exec($curl);
                  $sendError = curl_error($curl);
            }
            
            // Logout :P
            curl_setopt ($curl, CURLOPT_URL, "http://site6.way2sms.com/jsp/logout.jsp");
            curl_setopt ($curl, CURLOPT_REFERER, $refurl);
            $text = curl_exec($curl);	
            
            curl_close($curl);
            if ("" != $sendError){
                  return $sendError;
            }
            return "done" . $ret;
        }

}

?>
