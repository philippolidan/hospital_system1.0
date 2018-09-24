<?php
session_start();
if(!isset($_SESSION['user_id'])){
	echo "<script>window.location='index.php'</script>";
}
?>