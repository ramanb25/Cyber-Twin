<?php
	include 'navbar.php';
	include 'class_manager.php';
	

	$manager= new Manager();
	$manager->is_manager_logged_in();


		if(isset($_POST['submit'])) { 
			
			if($_POST['pass']==$_POST['cpass']){
				
				
			if($_POST['type']==1){//echo "e";echo "e";
				
			echo $manager->register_manager($_POST['user'],$_POST['pass']);}
			else {echo $manager->register_operator($_POST['user'],$_POST['pass']);}}
			else echo "Passwords do not match";

		 }


















?>
	<!DOCTYPE HTML> <html> <head> <title>Sign-Up</title> </head> <body id="body-color"> <div id="Sign-Up"> <fieldset><legend>Registration Form</legend> 
	 

	<form method="POST" action="register.php"> 
	  UserName <input type="text" name="user">
	  Password<input type="password" name="pass"> 
	  Confirm Password<input type="password" name="cpass">
<select name="type">
  <option value="0">Operator</option>
  <option value="1">Manager</option>
</select>
	  
	   <input id="button" type="submit" name="submit" value="Register">



	 </form>  </fieldset> </div> </body> </html>

