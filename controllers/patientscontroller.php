<?php
include('../../Clinicmanagement/controllers/dbcon.php');

class patients
{

	function getusertypes(){

		$dbcon=new dbcon;
		$db=$dbcon->db();
		$select=$db->query("CALL `getusertypes`");
		return $select;
	}
	
	function addpatient($name,$address,$contactno,$email,$password,$usertype)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		
		
		$query="CALL `addpatients`(:name,:address,:contactno,:email,:password,:usertypeid)";
		$select=$db->prepare($query);
		$select->bindParam(":name",$name);
		$select->bindParam(":address",$address);
		$select->bindParam(":contactno",$contactno);
		$select->bindParam(":email",$email);
		$select->bindParam(":password",$password);
		$select->bindParam(":usertypeid",$usertype);
		$select->execute();
		
	
	}

	function getpatients()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$select1=$db->query("CALL `getpatients`();");
		return $select1;
	}


	function updatepatients($id,$name,$address,$email,$password,$contactno,$usertypeid)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query="UPDATE users SET Name='".$name."',Address='".$address."',Email='".$email."',Password='".$password."',Contactno='".$contactno."',Usertypeid='".$usertypeid."' WHERE Id=".$id;
		$update=$db->prepare($query);
		$update->execute();
	}

	function deletepatients()
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$id=$_GET['id'];
		$query="DELETE FROM users WHERE Id=".$id;
    	$del=$db->query($query);
    	return $del;
	}

	
}

?>