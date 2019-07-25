<?php 
$db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');
if ($_GET['id'] != null) {
	$id = $_GET['id'];
 	$querymatch="SELECT * FROM doctors WHERE Id=".$id;
            $select=$db->query($querymatch);
   //          $arr=[];
            $row=$select->fetch(PDO::FETCH_ASSOC);
 
			$duration    = 30;
			$strttime    = $row["Starttime"];
			$endtime     = $row["Endtime"];
			
		    $strttime = new DateTime($strttime);
		    $endtime = new DateTime($endtime);
		    $interval = new DateInterval("PT" . $duration . "M");
		   
		    $periods = array();
		    for ($intStart = $strttime; $intStart < $endtime; $intStart->add($interval)) {
		        $endPeriod = clone $intStart;
		        $endPeriod->add($interval);
		        if ($endPeriod > $endtime) {
		            break;
		        }
		        $periods[] = $intStart->format('h:i A') . ' - ' . $endPeriod->format('h:i A');
		    }
		   
		}

		
				
			$arr=[];
                  $query=$db->query("Select Date,Time from appointments Where Doctorid='".$id."'");

                  $check=$query->fetchAll(PDO::FETCH_ASSOC);
                  
                  // foreach ($check as $var) {
                  //       $date = $var["Date"];

                      
                  //       $time = $var["Time"];

                         foreach ($periods as $data) {

                        $row=[
                        'Id'=>$row['Id'],
                        'Name'=>$row['Name'],
                        'Days'=>$row['Days'],
                        'Starttime'=>$strttime,
                        'Endtime'=>$endtime,
                        'Slots' => $data
                        ];
                        // if($date!=$row["Days"] && $time!=$data)
                        // {
                        $array[]= $row;

                        // }
                     }
                  



                 
                  // print_r($array); die();

            	
            	//array_push($arr,$row);
            
            
        
        echo json_encode($array);
    
            // if($row==true)
            // {
            //   $name=$row["Name"];
            //   $days=$row["Days"];
            //   // $array=array($days);
            //   $exp=explode(",",$days);

            //   $date1=date('l', strtotime($date));
            //   foreach($exp as $key) {
              
            //   $strttime=$row["DATE_FORMAT(Starttime,'%r')"];
            //   $endtime=$row["DATE_FORMAT(Endtime,'%r')"];
            //   $strttime1 = date('H:i:s A',strtotime($strttime));
            //   $endtime1 = date('H:i:s A',strtotime($endtime));
            //    if($date1==$key && $time >= $strttime1 && $time < $endtime1)
            //    {
            //   $appointment->addappointments($_POST["patientname"],$doctorid,$_POST["date"],$_POST["time"]);
 
            //     //Mail Sending Code
            //     require('../../Clinicmanagement/vendor/autoload.php');
            //     $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            //     ->setUsername('harisalihafiz123@gmail.com')
            //     ->setPassword('urbanlife!@#$%');
            //     $mailer = new Swift_Mailer($transport);
            //     $body = "Your Appointment is fixed at ".$_POST["date"]. " " .$_POST["time"];
            //     $message = (new Swift_Message('Email Through Dental Clinic'))
            //     ->setFrom(['harisalihafiz123@gmail.com' => 'Haris Ali'])
            //     ->setTo($rows["Email"])
            //     ->setBody($body)
            //     ->setContentType('text/html');
            //     $mailer->send($message);
            //     echo "Appointment set at".$_POST["date"]. " ".$_POST["time"];
            //    }

            //    else{
            //     $time_error = "error";
                
            //    }

            //   }

             
             
             

?>