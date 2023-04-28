<?php
require_once "db.php";
if(isset($_POST["users"])){
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($con, "DELETE FROM contacts WHERE id='" . $_POST["users"][$i] . "'");
}
header("Location:index.php");
}
else{
    header("Location:index.php");
}
?>