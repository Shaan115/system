<?php 
	session_start();
	require("config.php");
	
	if(!isset($_SESSION["login_info"])){
		header("location:index.php");
	}
	
	$users=[];
	$current_month_day=date("m-d");
	$current_year=date("Y");
	$sql="select * from users where DATE_FORMAT(DATE, '%m-%d')='{$current_month_day}' and YEAR<>'{$current_year}'";
	$res=$con->query($sql);
	if($res->num_rows>0){
		while($row=$res->fetch_assoc()){
			$users[]=$row;
		}
	}
	
	foreach($users as $user){
		
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<?php include "header.php";?>
	<body>
		<?php include "navbar.php"; ?>
		<div class='container mt-4'>
			<div class='row'>
				
				<div class='col-md-4'>
					<?php foreach($notifications as $row):?>
					  <div class="alert alert-primary mb-3 pt-4 pb-4" href="#"><?php echo $row; ?></div>
					<?php endforeach;?>
				</div>
				<div class='col-md-8'>
					<div class="jumbotron">
						<h1 class="display-4"> Reminder system</h1>
						<hr class="my-4">
						<p class="lead">welcome to the reminder system , here you can set an reminder which reminds you your important days</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>