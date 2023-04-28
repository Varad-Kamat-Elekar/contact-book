<?php

//action.php

include('db.php');
session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO contacts (contact_name, contact_number,contact_email,contact_address,user_email) VALUES ('".$_POST["contact_name"]."', '".$_POST["contact_number"]."', '".$_POST["contact_email"]."', '".$_POST["contact_address"]."','".$_SESSION['email']."')
		";
		
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "
		SELECT * FROM contacts WHERE id = ".$_POST['id']." AND user_email= '".$_SESSION['email']."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['contact_name'] = $row['contact_name'];
			$output['contact_number'] = $row['contact_number'];
			$output['contact_email'] = $row['contact_email'];
			$output['contact_address'] = $row['contact_address'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE contacts 
		SET contact_name = '".$_POST["contact_name"]."', 
		contact_number = '".$_POST["contact_number"]."',
		contact_email = '".$_POST["contact_email"]."', 
		contact_address = '".$_POST["contact_address"]."'
		WHERE id = ".$_POST['hidden_id']." AND user_email= '".$_SESSION['email']."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM contacts WHERE id = ".$_POST['id']." AND user_email= '".$_SESSION['email']."' ";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}

?>