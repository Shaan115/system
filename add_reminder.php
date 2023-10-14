<?php 
	session_start();
	require("config.php");
	
	if(!isset($_SESSION["login_info"])){
		header("location:index.php");
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
					<h3 class='text-muted text-center'>ADD DETAILS</h3>
					<?php 
						if(isset($_POST["reg"])){
							$_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
							$name=mysqli_real_escape_string($con,$_POST["name"]);
							$email=mysqli_real_escape_string($con,$_POST["email"]);
							$dob=date("Y-m-d",strtotime($_POST["date"]));
							
							$sql="insert into users (NAME,EMAIL,DATE,YEAR) values ('{$name}','{$email}','{$date}','-')";
							if($con->query($sql)){
								echo"<div class='alert alert-success'>Added Success</div>";
							}else{
								echo"<div class='alert alert-danger'>Failed Try Again</div>";
							}
						}
					?>
					<form action='add_reminder.php' method='post' autocomplete='off'>
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control"  name='name' placeholder="Name" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name='email' placeholder="Email" required >
						</div>
						<div class="form-group">
							<label>DATE</label>
							<input type="text" class="form-control datepicker" name='date' placeholder="dd-mm-yyyy" required>
						</div>
						<div class="form-group">
							<input type='submit' name='reg' value='Submit' class='btn btn-primary'>
						</div>
					</form>
				</div>
				<div class='col-md-8'>
					<table class='table table-bordered mt-5'>
						<thead>
							<tr>
								<td>S.No</td>
								<td>Name</td>
								<td>Email</td>
								<td>Date</td>
								<td>Delete</td>
							</tr>
						</thead>
						<tbody>
							<?php 
								$sql="select * from users order by ID desc";
								$res=$con->query($sql);
								if($res->num_rows>0){
									$i=0;
									while($row=$res->fetch_assoc()){
										$i++;
										echo "
										<tr>
											<td>{$i}</td>
											<td>{$row["NAME"]}</td>
											<td>{$row["EMAIL"]}</td>
											<td>".date("d-m-Y",strtotime($row["DATE"]))."</td>
											<td><a href='delete_reminder.php?id={$row["ID"]}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are You Sure ?\")'>Delete</a></td>
										</tr>";
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>