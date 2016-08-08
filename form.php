<?php
require 'validator.php';
// this part should be in the template controller or View
if(isset($_POST['submit'])) {
	$validationRules = array("name"   => "required|string|mini:8|maxi:20",
							"email"   => "required|email|mini:8|maxi:30",
				   			"password" => "required|mini:8",
				   			"user_type"=> "required|int");
	#create a vaildator object
	$validate = new Validator;

	$validate->validate($_POST,$validationRules);
		if(!$validate->isPass()){
			$validate->getErrors();
		}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
			<h3> Test Form</h3>
			<form method="post" action="form.php" class="form-horizental">
				<div class="form-group">
					<label >Name : </label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label >Email : </label>
					<input type="email" name="email" class="form-control">
				</div>
				<div class="form-group">
					<label >Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<label >Type</label>
					<select  name="user_type" class="form-control">
						<option value="1">Super User</option>
						<option value="2"> Admin </option>
						<option value="3"> User </option>
					</select>
				</div>
				<div class="form-group">
					<label > submit</label>
					<input type="submit" name="submit" value="login" class="btn btn-default">
				</div>
			</form>
			 </div>
		</div>
	</div>	
</body>
</html>