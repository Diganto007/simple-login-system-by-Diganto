<?php
include_once('config.php');
if(isset($_POST['form_login'])){
		
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		

	try{
	
		if(empty($_POST['name'])){
			throw new Exception('Name cannot be empty.....');
		}
		
		if(empty($_POST['username'])){
			throw new Exception('Username cannot be empty.....');
		}
		
		if(empty($_POST['password'])){
			throw new Exception('Password cannot be empty.....');
		}
		
		if(empty($_POST['user_email'])){
			throw new Exception('Email cannot be empty.....');
		}
		
		if(empty($_POST['user_type'])){
			throw new Exception('User type cannot be empty.....');
		}
		
		$num = 0;
		
		$statement = $db->prepare("select * from users where user_name=?");
		$statement->execute(array($_POST['username']));
		$num = $statement->rowCount();
		
		if($num>0){
			
			throw new Exception('Username already exist. Please, choose another one....');
		}

		$statement = $db->prepare("insert into users (name, user_name, user_pass, user_email, user_phone) values(?,?,?,?,?)");
		$statement->execute(array($_POST['name'],$_POST['username'],$password,$_POST['user_email'],$_POST['user_phone']));
		
		$success_message = "User has been Registerd Successfully.....!";	
	
	}
		catch(Exception $e){
		$error_message = $e->getMessage();
	}

}

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Simple Login System :: PHP</title>
        <link href="style.css" rel="stylesheet">
    </head>

    <body>
        <div class="main_content">
            <div class="form_message">
                <?php 

                    if(isset($error_message)){
                    echo "<div class=' text-danger message message_warning'>".$error_message."</div>";

                    }

                    if(isset($success_message)){
                    echo "<div class='text-success message message_success'>".$success_message."</div>";
                    }

                ?>
            </div>
			<div class="company_logo">
                <img src="img/logo.png" alt="">
            </div>
            <div class="login_form">
                <form action="" method="post">
                    <h3>Name :</h3>
                    <input type="text" class="" name="name" placeholder="Name" />
                    <h3>Usernam :</h3>
                    <input type="text" class="" name="username" placeholder="Username" />
                    <h3>Password : </h3>
                    <input type="password" class="" name="password" placeholder="Password" />
                    <h3>Email :</h3>
                    <input type="text" class="" name="user_email" placeholder="Email" />
                    <h3>Contact :</h3>
                    <input type="text" class="" name="user_phone" placeholder="Phone Number Optional" />
                    <h3>User Type :</h3>
                    <select class="login_select" name="user_type">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                    <br/>
                    <input type="submit" class="btn btn-success" value="Register" name="form_login" />
                    <a href="login.php">Back to login Page</a>
                </form>
            </div>
        </div>
    </body>

    </html>
