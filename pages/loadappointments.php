<?php 
header('content-type:application/json');
$db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');
	
			         $data=array();
                  $query="Select users.Id,users.Name,appointments.Date,appointments.Time,appointmentstatus.Status from appointments INNER JOIN users ON appointments.Patientid=users.Id INNER JOIN appointmentstatus ON appointments.Statusid=appointmentstatus.Id";
                  $run=$db->prepare($query);
                  $run->execute();
                  $result=$run->fetchAll();
                  $today = date("Y-m-d"); 
                         foreach ($result as $row) {
                           if($today < $row["Date"])
                           {
                        $data[]=array(
                        'Id'=>$row['Id'],
                        'title'=>'Patient '.$row['Name'].' '.$row['Status'],
                        'start'=>$row['Date'],
                        'time'=>$row["Time"],
                        );
                       
                       }

                        
                     }

        echo json_encode($data);