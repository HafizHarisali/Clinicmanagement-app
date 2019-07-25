<?php

include('../../Clinicmanagement/controllers/dbcon.php');
require('../../Clinicmanagement/vendor/autoload.php');
/**
 * 
 */
class mail 
{
	
	function sendemail($message)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query=$db->query('SELECT Email FROM users WHERE Usertypeid=2');
		while($row=$query->fetch())
		{
			$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
			->setUsername('harisalihafiz123@gmail.com')
			->setPassword('urbanlife!@#$%');
			$mailer = new Swift_Mailer($transport);
			$body = $_POST["message"];
			$message = (new Swift_Message('Email Through Dental Clinic'))
			->setFrom(['harisalihafiz123@gmail.com' => 'Haris Ali'])
			->setTo($row["Email"])
			->setBody($body)
			->setContentType('text/html');
			$mailer->send($message);
		}

		if($mailer==true)
		{
		echo "Sent";
		}
		else{
		echo "fail";
		}
	}
}


?>