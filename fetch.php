<?php

//fetch.php
//including neccessary files
include("db.php");
session_start();
//fetch all query
$query = "SELECT * FROM contacts WHERE user_email= '".$_SESSION['email']."' ORDER BY contact_name ASC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();//row count
$output = '
<!-- <div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"> -->
	  <form name="frmUser" method="post" action="">
		<table class="table table-striped table-bordered table-auto sm:shadow-2xl border-collapse w-fullxx min-w-full divide-y divide-gray-200">
	<tr>
		<th class="text-center text-gray-700 capitalize px-4 py-4">Check</th>
		<th class="text-center text-gray-700 capitalize px-4 py-4">Contact Name</th>
		<th class="text-center text-gray-700 capitalize px-4 py-4">Contact Phone</th>
		<th class="text-center text-gray-700 capitalize px-4 py-4">Contact Email</th>
		<th class="text-center text-gray-700 capitalize px-4 py-4">Contact Address</th>
		<th class="text-center text-gray-700 capitalize px-4 py-4">Edit</th>
		<th class="text-center text-gray-700 capitalize px-4 py-4">Delete</th>
	</tr>
';
if($total_row > 0)// putput data
{

	foreach($result as $row)
	{
		$output .= '
		
		<tr>
			<td class="border border-green-600">
			<center>
				<input type="checkbox" name="users[]" value=" '.$row["id"].'">
			</center>
			</td>
			<td width="20%" class="border border-green-600">'.$row["contact_name"].'</td>
			<td width="15%" class="border border-green-600">'.$row["contact_number"].'</td>
			<td width="20%" class="border border-green-600">'.$row["contact_email"].'</td>
			<td width="40%" class="border border-green-600">'.$row["contact_address"].'</td>
			<td width="10%" class="border border-green-600">
			<center>
				<button type="button" name="edit" class="bg-blue-500 hover:bg-blue-700 edit text-white h-8 px-6 m-2" id="'.$row["id"].'">Edit</button>
			</center>
			</td>
			<td width="10%" class="border border-green-600">
			<center>
				<button type="button" name="delete" class="bg-red-500 hover:bg-red-700 delete text-white h-8 px-6 m-2" id="'.$row["id"].'">Delete</button>
			</center>
			</td>
		</tr>
		';
	}

	
}
else
{
	$output .= '
	<tr>
		<td colspan="12" align="center">Data not found</td>
	</tr>
	';
}
$output .= '
<tr class="listheader" align="center">
        <td colspan="12"><input class="h-8 px-6 m-1 text-lg text-white transition-colors duration-150 bg-red-700 rounded-lg focus:shadow-outline hover:bg-red-800" style="margin-left:650px" type="button" name="deleteselection" value="Delete Selection"  onClick="setDeleteAction();" /></td>
</tr>
</table>
</form>
<!--
</div>
</div>
</div>
</div> -->

';

echo $output;

?>
<script type="text/javascript">
	function setDeleteAction() {
    if(confirm("Are you sure want to delete these rows?")) {
    document.frmUser.action = "delete_user.php";
    document.frmUser.submit();
    }
  }
</script>