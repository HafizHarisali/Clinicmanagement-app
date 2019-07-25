<?php
include('../../Clinicmanagement/controllers/dbcon.php');

class doctors
{

	
	
	function adddoctor($name,$address,$contactno,$email,$password,$gender,$days,$starttime,$endtime)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();

		$query="CALL `adddoctors`(:name,:address,:contactno,:email,:password,:gender,:days,:starttime,:endtime)";
		$select=$db->prepare($query);
		$select->bindParam(":name",$name);
		$select->bindParam(":address",$address);
		$select->bindParam(":contactno",$contactno);
		$select->bindParam(":email",$email);
		$select->bindParam(":password",$password);
		$select->bindParam(":gender",$gender);
		$select->bindParam(":days",$days);
		$select->bindParam(":starttime",$starttime);
		$select->bindParam(":endtime",$endtime);
		$select->execute();
	}

	function getdoctors()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$select1=$db->query("CALL `getdoctors`();");
		return $select1;
	}


	function updatedoctors($id,$name,$address,$email,$password,$contactno,$gender,$days,$starttime,$endtime)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query="UPDATE doctors SET Name='".$name."',Address='".$address."',Email='".$email."',Password='".$password."',Contactno='".$contactno."',Gender='".$gender."',Days='".$days."',Starttime='".$starttime."',Endtime='".$endtime."' WHERE Id=".$id;
		$update=$db->prepare($query);
		$update->execute();
	}

	function deletedoctors()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$id=$_GET['id'];
		$query="DELETE FROM doctors WHERE Id=".$id;
    	$del=$db->query($query);
    	return $del;
	}
}

?>