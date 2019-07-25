<?php
include('../../Clinicmanagement/controllers/dbcon.php');

class appointment
{

	function getappointments(){

		$dbcon=new dbcon;
		$db=$dbcon->db();
		$select2=$db->query("CALL getallappointments");
		return $select2;
	}

	function getpatientforappointments(){

		$dbcon=new dbcon;
		$db=$dbcon->db();
		$select=$db->query("CALL `getpatientsfortreat`()");
		return $select;
	}

	function getdoctorsforappointments(){

		$dbcon=new dbcon;
		$db=$dbcon->db();
		$select=$db->query("CALL `getdoctors`()");
		return $select;
	}

	function getstatus(){

		$dbcon=new dbcon;
		$db=$dbcon->db();
		$select=$db->query("SELECT * FROM appointmentstatus");
		return $select;
	}
	
	function addappointments($patientname,$doctorname,$date,$time,$treatmentid,$statusid)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$seltreat=$db->query("SELECT Id FROM treatments WHERE Patientid='".$patientid."'");
		$row=$seltreat->fetch();
		$query="INSERT INTO appointments (Patientid,Doctorid,Date,Time,Treatmentid,Statusid) VALUES (?,?,?,?,?,?)";
		$select=$db->prepare($query);
		$select->execute([$patientname,$doctorname,$date,$time,$treatmentid,$statusid]);
	}

	function addappointments1($patientname,$doctorname,$date,$time,$statusid)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$seltreat=$db->query("SELECT Id FROM treatments WHERE Patientid='".$patientid."'");
		$row=$seltreat->fetch();
		$query="INSERT INTO appointments (Patientid,Doctorid,Date,Time,Statusid) VALUES (?,?,?,?,?)";
		$select=$db->prepare($query);
		$select->execute([$patientname,$doctorname,$date,$time,$statusid]);
	}

	function updateappointments1($id,$patientname,$doctorname,$date,$time,$statusid)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$seltreat=$db->query("SELECT Id FROM treatments WHERE Patientid='".$patientid."'");
		$row=$seltreat->fetch();
		$query="UPDATE appointments Set Patientid='".$patientname."', Doctorid='".$doctorname."',Date='".$date."',Time='".$time."',Statusid='".$statusid."' WHERE Id='".$id."'";
		$select=$db->prepare($query);
		$select->execute();
	}

	function getpatientappoint()
	{	
		$email=$_SESSION["Email"];
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query="CALL `getpatientappoint`(:email)";
		$check=$db->prepare($query);
		$check->bindParam(":email",$email);
		$check->execute();
		return $check;
	}

	function getdoctorappoint()
	{	
		$email=$_SESSION["Email"];
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query="CALL `getdoctorappoint`(:email)";
		$check=$db->prepare($query);
		$check->bindParam(":email",$email);
		$check->execute();
		return $check;
	}

	function deleteappointments()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$id=$_GET['id'];
		$query="DELETE FROM appointments WHERE Id=".$id;
    	$del=$db->query($query);
    	return $del;
	}

	function updateappointments($id,$patientid,$doctorid,$date,$time)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		date_default_timezone_set('Asia/Karachi');
		
		$query="UPDATE appointments SET Patientid='".$patientid."',Doctorid='".$doctorid."',Date='".$date."',Time='".$time."' WHERE Id=".$id;
		$update=$db->prepare($query);
		$update->execute();
	}

	function get_patients_against_treat()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$querymatch="SELECT users.Name AS Patientname,users.Email,treatments.Id AS Treatid,treatments.Patientid,treatments.Doctorid,doctors.Name AS Doctorname,treatments.Startdate,treatments.Enddate FROM treatments INNER JOIN users ON treatments.Patientid=users.Id INNER JOIN doctors ON treatments.Doctorid=doctors.Id";
            $select=$db->query($querymatch);
            return $select;
	}

	function get_appointments_against_treatments()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query=$db->query("CALL `getappointagainsttreat`()");
		return $query;
	}
	
}

?>