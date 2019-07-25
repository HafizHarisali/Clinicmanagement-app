<?php


class dbcon{

	
	public function db()
	{	

		return $db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');
		
	}
}

?>