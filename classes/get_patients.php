<?php 
$db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');
if ($_GET['id'] != null) {
	$id = $_GET['id'];
	$data=array();
 	$querymatch="SELECT users.Name AS Patientname,users.Email,treatments.Id AS Treatid,treatments.Patientid,treatments.Doctorid,doctors.Name AS Doctorname,treatments.Startdate,treatments.Enddate FROM treatments INNER JOIN users ON treatments.Patientid=users.Id INNER JOIN doctors ON treatments.Doctorid=doctors.Id WHERE Patientid='".$id."'";
            $select=$db->prepare($querymatch);
            $select->execute();
            $fetch=$select->fetchAll();
            $today = date("Y-m-d");
                 foreach ($fetch as $row) {
                 if($today < $row["Enddate"])
                 {
                $data[]=array(
                'Treatid' => $row['Treatid'],
                'Patientid' => $row['Patientid'],
                'Doctorid' => $row['Doctorid'],
                'Patientname' => $row['Patientname'],
                'Doctorname' => $row['Doctorname'],
                'Startdate' => $row['Startdate'],
                'Enddate' => $row['Enddate']
                );

                }

             }
           }
        
        echo json_encode($data);
