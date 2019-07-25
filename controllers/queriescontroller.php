<?php 

require_once('../../ClinicManagement/controllers/dbcon.php');
/**
 * 
 */
class feedback extends dbcon
{
	
	function sendfeedback($name,$email,$message)
	{
		$db=$this->db();
		$query=$db->prepare("INSERT into feedback (Name,Email,Message) Values (?,?,?)");
		$query->execute([$name,$email,$message]);
	}

	function getfeedback()
	{
		$db=$this->db();
		$query=$db->query("SELECT * FROM feedback");
		return $query;
	}
}
?>