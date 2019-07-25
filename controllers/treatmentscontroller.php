<?php
include('../../Clinicmanagement/controllers/dbcon.php');

class treatments
{

	function getpatientfortreat(){

		$dbcon=new dbcon;
		$db=$dbcon->db();
		$select=$db->query("CALL `getpatientsfortreat`()");
		return $select;
	}

	function getdoctorsfortreat(){

		$dbcon=new dbcon;
		$db=$dbcon->db();
		$select=$db->query("CALL `getdoctors`()");
		return $select;
	}
	
	function addtreatments($patientname,$doctorname,$prescription,$cost,$startdate,$enddate)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query="CALL `addtreatments`(:patientid,:doctorid,:prescription,:cost,:startdate,:enddate)";
		$select=$db->prepare($query);
		$select->bindParam(":patientid",$patientname);
		$select->bindParam(":doctorid",$doctorname);
		$select->bindParam(":prescription",$prescription);
		$select->bindParam(":cost",$cost);
		$select->bindParam(":startdate",$startdate);
		$select->bindParam(":enddate",$enddate);
		$select->execute();
	}

	function gettreatments()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$totaltreatments=$db->query("CALL `gettreatmentsbypd`()");
		return $totaltreatments;
	}


	function updatetreatments($id,$patientid,$doctorid,$prescription,$cost,$startdate,$enddate)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		date_default_timezone_set('Asia/Karachi');
		
		$query="UPDATE treatments SET Patientid='".$patientid."',Doctorid='".$doctorid."',Prescription='".$prescription."',Cost='".$cost."',Startdate='".$startdate."',Enddate='".$enddate."' WHERE Id=".$id;
		$update=$db->prepare($query);
		$update->execute();
	}

	function deletetreatments()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$id=$_GET['id'];
		$query="DELETE FROM treatments WHERE Id=".$id;
    	$del=$db->query($query);
    	return $del;
	}

	function getpatienttreat()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query="SELECT treatments.Id,treatments.Prescription,treatments.Cost,treatments.Startdate,treatments.Enddate,users.Name AS Patientname,users.Id AS Patientid,users.Email,users.Password, doctors.Name AS Doctorname,doctors.Email AS DoctorEmail FROM treatments INNER JOIN users ON treatments.Patientid=users.Id INNER JOIN doctors ON treatments.Doctorid=doctors.Id WHERE users.Email='".$_SESSION["Email"]."'";
		$check=$db->query($query);
		return $check;
	}

	function getdoctortreat()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query="SELECT treatments.Id,treatments.Prescription,treatments.Cost,treatments.Startdate,treatments.Enddate,users.Name AS Patientname,users.Id AS Patientid,users.Email AS PatientEmail,users.Password, doctors.Name AS Doctorname,doctors.Email FROM treatments INNER JOIN users ON treatments.Patientid=users.Id INNER JOIN doctors ON treatments.Doctorid=doctors.Id WHERE doctors.Email='".$_SESSION["Email"]."'";
		$check=$db->query($query);
		return $check;
	}

	function gettreatmentreport($id)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query=$db->query("SELECT appointments.Id,appointments.Date,appointments.Time,users.Name AS Patientname,doctors.Name AS Doctorname FROM appointments INNER JOIN users ON appointments.Patientid=users.Id INNER JOIN doctors ON appointments.doctorid=doctors.Id WHERE Treatmentid='".$id."'");
		return $query;
	}
}

?>