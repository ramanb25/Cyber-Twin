<?php
	include 'navbar.php';
	include 'class_manager.php';
	

	$manager= new Manager();
	$manager->is_manager_logged_in();


		if(isset($_POST['submit'])) { 
			if($_POST['pass']==$_POST['cpass']){
			if($_POST['type']==1){//echo "e";
			echo $manager->register_manager($_POST['user'],$_POST['pass']);}
			else echo $manager->register_operator($_POST['user'],$_POST['pass']);}
			else echo "Passwords do not match";

		 }


















?>
	<!DOCTYPE HTML> <html> <head> <title>Sign-Up</title> </head> <body id="body-color"> <div id="Sign-Up"> <fieldset style="width:30%"><legend>Registration Form</legend> <table border="0"> <tr> 
	 

	<form method="POST" action="register.php"> 
	  <tr> <td>UserName</td><td> <input type="text" name="user"></td> </tr>
	   <tr> <td>Password</td><td> <input type="password" name="pass"></td> </tr> 
	   <tr> <td>Confirm Password </td><td><input type="password" name="cpass"></td> </tr>
<select name="type">
  <option value="0">Operator</option>
  <option value="1">Manager</option>
</select>
	  
	    <tr> <td><input id="button" type="submit" name="submit" value="Register"></td> </tr>



	 </form> </table> </fieldset> </div> </body> </html>

