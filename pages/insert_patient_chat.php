<?php


$db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');

$data = array(
 
 ':to_treat_id' => $_POST["to_treat_id"],
 ':ask_query'  => $_POST["ask_query"]
);

$query = "INSERT INTO queries (`ask_query`,`treatmentid`) VALUES (:ask_query,:to_treat_id)";

$statement = $db->prepare($query);
if($statement->execute($data)){
	session_start();
	echo fetch_user_chat_history($_SESSION["Id"],$_POST['to_treat_id'], $db);
}

function fetch_user_chat_history($from_patient_id, $to_treat_id, $db)
{
 $query = "
 SELECT queries.Id AS Queriesid,queries.ask_query AS chat_message,treatments.Id,users.Id AS Patientid,users.Name AS Patientname,doctors.Id AS Doctorid,doctors.Name AS Doctorname FROM queries INNER JOIN treatments ON queries.treatmentid=treatments.Id INNER JOIN users ON treatments.Patientid=users.Id INNER JOIN doctors ON treatments.Doctorid=doctors.Id 
	 WHERE (Patientid = '".$from_patient_id."' AND treatments.Id = '".$to_treat_id."') OR (Patientid = '".$to_treat_id."' AND treatments.Id = '".$from_patient_id."')" ;
	 $statement = $db->prepare($query);
	 $statement->execute();
	 $result = $statement->fetchAll();
	 
	 $output = '<ul class="list-unstyled">';
	 foreach($result as $row)
	 {
	  $user_name = '';
	  if($row["Patientid"] == $from_patient_id)
	  {
	   $user_name = '<b class="text-success"></b>';
	  }
	  else
	  {
	   $user_name = '<b class="text-danger">'.get_user_name($row['Name'], $db).'</b>';
	  }
	  $output .= '
	  <li style="background-color:#edeff0e6;margin-top:10px;color:#185479;border-radius:0px;">
	   <p>'.$user_name.' - '.$row["chat_message"].'
	   
	   </p>
	  </li>
	  ';
	 }
	 $output .= '</ul>';
	 return $output;
}

function get_user_name($user_id, $db)
{
 $query = "SELECT Name FROM doctors WHERE Id = '".$user_id."'";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['Name'];
 }
}


?>