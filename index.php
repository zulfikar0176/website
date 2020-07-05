<?php 
	require_once "function.php";
	require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">



	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	
</head>
<body>
	
	<?php
		$connection = new mysqli('localhost', 'root', '', 'students'); 
		if (isset($_POST['sign_up'])) {
			$name= $_POST['name'];
			$email= $_POST['email'];
			$roll= $_POST['roll'];
			$contact= $_POST['contact'];
			$location= $_POST['location'];
			
			
			if (empty($name) || empty($email) || empty($roll) || empty($contact) || empty($location)) {
				$mess= "<p class='alert alert-danger'>All filed are requird<button class='close' data-dismiss='alert'>&times;</button></p>";
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL)== false){
				$mess= "<p class='alert alert-info'>Invalide Email<button class='close' data-dismiss='alert'>&times;</button></p>";
			}
			else{
				

				
				$data = fileUpload($_FILES['photo'],'photos/');
				$photo_name = $data['file_name'];

				if ($data ['status'] = 'yes') {

					$sql = "INSERT INTO student_info (name, email, roll, contact, location, photo) VALUES ('$name','$email','$roll','$contact','$location', '$photo_name')";
					$connection -> query($sql);

					$mess= "<p class='alert alert-success'>Data Recived<button class='close' data-dismiss='alert'>&times;</button></p>";
				}else{
					$mess= "<p class='alert alert-danger'>Invailid File Format<button class='close' data-dismiss='alert'>&times;</button></p>";
				}
			}
		}

	?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
		
		<div class="card" style="margin: 300px; margin-top: 50px">
			<a class="btn btn-success btn-sm" style="margin-right : 500px" href="allstudent.php">All Student</a>
			<?php 
				

				if (isset($mess)) {
					echo $mess;
				}
			 ?>
			<div class="card-header">
				<h1>Sign Up Now</h1>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="">Name</label>
					<input name="name" class="form-control" value="<?php old('name'); ?>" type="text" >
				</div>

				<div class="form-group">
					<label for="">E-mail</label>
					<input name="email" class="form-control" value="<?php old('email'); ?>" type="text" >
				</div>

				<div class="form-group">
					<label for="">Roll</label>
					<input name="roll" class="form-control" value="<?php old('roll'); ?>" type="text" >
				</div>

				<div class="form-group">
					<label for="">Contact Number</label>
					<input name="contact" class="form-control" value="<?php old('contact'); ?>" type="text" >
				</div>

				<div class="form-group">
					<label for="">Location</label>
					<input name="location" class="form-control" value="<?php old('location'); ?>" type="text">
				</div>

				<div class="form-group">
					<label for="">Photo</label>
					<input name="photo" class="form-control" type="file">
				</div>

				<div class="form-group">
					
					<input name="sign_up" class="btn btn-primary" type="submit" value="Sign Up">
				</div>
			</div>
			<div class="card-footer"></div>
			
		</div>
	</form>



</body>
</html>