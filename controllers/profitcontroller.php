<?php
include('../../Clinicmanagement/controllers/dbcon.php');

/**
 * 
 */
class profit_loss
{
	
	function overall_profit()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query=$db->query("Select Cost From expenses");
		$query1=$db->query("Select Cost From treatments");
		
		while ($row=$query->fetch()) {

			$cost+=$row["Cost"];

		}

		while ($rows=$query1->fetch()) {
			$cost1+=$rows["Cost"];
		}

		return $cost1-$cost;
		

	}

	function get_current_month_profit()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		
		
		$now=new Datetime();
		$date=$now->format('m');
		$profit_exp=0;
		$profit_treat=0;
		$query_exp=$db->query("SELECT * From expenses");
		$query_treat=$db->query("SELECT * FROM treatments");
		while ($row_exp=$query_exp->fetch()) {
			$month=$row_exp["Datetime"];
			$m=strtotime($month);
			$month=date('m',$m);

			if($date==$month)
			{
			$profit_exp+=$row_exp["Cost"];
			}
		}

		

		while($row_treat=$query_treat->fetch())
		{	
			$strtmonth=$row_treat["Startdate"];
			$mm=strtotime($strtmonth);
			$month_treat=date('m',$mm);
			
			if($date==$month_treat)
			{
			$profit_treat+=$row_treat["Cost"];
			}
		}

		return $profit_treat-$profit_exp;
	}

	function get_patients_count()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query=$db->query("SELECT COUNT(*)  FROM `users` WHERE Usertypeid=2")->fetchColumn();
		
		return $query;
	}

	function get_doctors_count()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query=$db->query("SELECT COUNT(*)  FROM `doctors`")->fetchColumn();
		
		return $query;
	}

	function get_patient_treatments_count()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$id=$_SESSION["Id"];
		$query=$db->query("SELECT COUNT(*) FROM `treatments` WHERE Patientid='".$id."'")->fetchColumn();

		return $query;
	}

	function get_patient_appointments_count()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$id=$_SESSION["Id"];
		$query=$db->query("SELECT COUNT(*) FROM `appointments` WHERE Patientid='".$id."'")->fetchColumn();

		return $query;
	}

	function get_doctor_treatments_count()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$id=$_SESSION["Id"];
		$query=$db->query("SELECT COUNT(*) FROM `treatments` WHERE Doctorid='".$id."'")->fetchColumn();

		return $query;
	}

	function get_doctor_appointments_count()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$id=$_SESSION["Id"];
		$query=$db->query("SELECT COUNT(*) FROM `appointments` WHERE Doctorid='".$id."'")->fetchColumn();

		return $query;
	}

	function get_month_profit($sel_month)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$sel_month=$_GET["month"];
		
		$sel_month=strtotime($sel_month);
		$format=date('m',$sel_month);
		
		$profit_exp=0;
		$profit_treat=0;
		$query_exp=$db->query("SELECT * From expenses Where DATE_FORMAT(Datetime,'%m %Y')=".$format);
		$query_treat=$db->query("SELECT * From treatments Where DATE_FORMAT(Startdate,'%m %Y')=".$format);
		while ($row_exp=$query_exp->fetch()) {
			$month=$row_exp["DATE_FORMAT(Datetime,'%m %Y')"];
			$m=strtotime($month);
			$month=date('m',$m);
			
			$format_month=strtotime($sel_month);
			$selected_month=date('m',$format_month);
			if($selected_month==$month)
			{
			$profit_exp+=$row_exp["Cost"];
			}
		}

		while ($row_treat=$query_treat->fetch()) {
			$month=$row_treat["DATE_FORMAT(Startdate,'%m %Y')"];
			$m=strtotime($month);
			$month=date('m',$m);
			
			$format_month=strtotime($sel_month);
			$selected_month=date('m',$format_month);
			if($selected_month==$month)
			{
			$profit_treat+=$row_treat["Cost"];
			}
		}
		if(!empty($profit_treat - $profit_exp))
		{
		return $profit_treat - $profit_exp;
		}

		else{
			echo "No record found of this month";
		}

		

		
	}


}


?>