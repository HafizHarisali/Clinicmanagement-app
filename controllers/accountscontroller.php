<?php
session_start();
include('../../Clinicmanagement/controllers/dbcon.php');
class accounts
{
	
	function login($email,$password)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$adminquery="SELECT * FROM users WHERE Email='".$email."' AND Password='".$password."' AND Usertypeid=1";
		$patientquery="SELECT * FROM users WHERE Email='".$email."' AND Password='".$password."' AND Usertypeid=2";
		$doctorquery="SELECT * FROM doctors WHERE Email='".$email."' AND Password='".$password."'";

		$checkadmin=$db->query($adminquery);
		$adminrow=$checkadmin->fetch();

		$checkpatient=$db->query($patientquery);
		$patientrow=$checkpatient->fetch();

		$checkdoctor=$db->query($doctorquery);
		$doctorrow=$checkdoctor->fetch();

		if($adminrow['Usertypeid']!=null)
		{
			$_SESSION["Usertypeid"]=$adminrow["Usertypeid"];
			$_SESSION["Id"]=$adminrow["Id"];
			$_SESSION["Name"]=$adminrow["Name"];
			$_SESSION["Email"]=$adminrow["Email"];
			$_SESSION["Address"]=$adminrow["Address"];
			$_SESSION["Contactno"]=$adminrow["Contactno"];
			$_SESSION["Password"]=$adminrow["Password"];
			header('location:index.php');
		}
		

		else if($patientrow['Usertypeid']!=null)
		{
			$_SESSION["Id"]=$patientrow["Id"];
			$_SESSION["Usertypeid"]=$patientrow["Usertypeid"];
			$_SESSION["Name"]=$patientrow["Name"];
			$_SESSION["Email"]=$patientrow["Email"];
			header('location:index.php');
		}

		else if($doctorrow['Email']!=null)
		{
			$_SESSION["Id"]=$doctorrow["Id"];
			$_SESSION["Name"]=$doctorrow["Name"];
			$_SESSION["Email"]=$doctorrow["Email"];
			$_SESSION["Days"]=$doctorrow["Days"];
			header('location:index.php');
		}

		else{
			echo "<script>swal('Invalid Username Or Password!','warning');</script>";
		}
	
	}


	function updateprofile($id,$name,$address,$contactno,$email,$password)
	{
		$dbcon=new dbcon;
		$db=$dbcon->db();
		$query="Update users SET `Name`='".$name."',`Address`='".$address."',`Contactno`='".$contactno."',`Email`='".$email."',`Password`='".$password."' Where Id='".$id."'";

		$update=$db->prepare($query);
		$update->execute();
		
	}

	
}


?>