<?php
include('../../Clinicmanagement/controllers/dbcon.php');

class expenses
{

	function getexpenses(){

		
		$dbcon=new dbcon;
		$db=$dbcon->db();
		if(isset($_POST["btngetmonth"]))
		{
		$month=$_POST["month"];
		$m=strtotime($month);
		$month=date('m',$m);
		
		$select=$db->query("SELECT * FROM `expenses` WHERE DATE_FORMAT(Datetime,'%m')='".$month."'");
		
		return $select;
		}

		else{

		$select=$db->query("SELECT * FROM expenses");
		return $select;
		}
		
	}

	
	function addexpenses($name,$cost)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		date_default_timezone_set('Asia/Karachi');
		$date=date('Y-m-d');
		$query="INSERT INTO expenses (Name,Cost,Datetime) VALUES (?,?,?)";
		$select=$db->prepare($query);
		/*$select->bindParam(":name",$name);
		$select->bindParam(":cost",$cost);
		$select->bindParam(":datetime",$date);*/
		$select->execute([$name,$cost,$date]);
	}

	
	function updateexpenses($id,$name,$cost)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		date_default_timezone_set('Asia/Karachi');
		$date=date('Y-m-d h:i:s A');
		$query="UPDATE expenses SET Name='".$name."',Cost='".$cost."' WHERE Id=".$id;
		$update=$db->prepare($query);
		$update->execute();
	}

	function deleteexpenses()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$id=$_GET['id'];
		$query="DELETE FROM expenses WHERE Id=".$id;
    	$del=$db->query($query);
    	return $del;
	}
}

?>