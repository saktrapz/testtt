<?php 
    include "function.php";

    if(isset($_POST['btnRegister'])){
        $email = $_POST['email'];
        $name = $_POST['username'];
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);

        $register = ("INSERT INTO tbl_admin VALUES('','".$name."','".$email."','".$pass."')");
        if($pass == $cpass){
            $register = "INSERT INTO tbl_admin VALUES('','".$name."','".$email."','".$pass."')";
            if($con -> query($register) == true){
                echo "
                    <script>
                        $(document).ready(function(){
                            Swal.fire(
                                'Successfully',
                                'Your account has been created',
                                'success'
                              )
                        });
                    </script>
                ";
            }
        }else{
            echo "
                <script>
                    $(document).ready(function(){
                        Swal.fire(
                            'Failed',
                            'Please check your information again',
                            'error'
                          )
                                                       
                    });
                </script>
            ";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="background-color: #2075FF; height: 1000px; position: fixed;">
                <div class="row">
                    <div class="col-4" style="background-color: white; height:600px; position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); border-radius: 5px; padding: 20px; box-shadow: -1px 0px 20px 1px rgba(0, 0, 0, 0.219);">
                        <form method="POST">
                            <h1 align="center">Register</h1>
                            <label for="" style="margin-top: 20px;" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="example@gmail.com" required>
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" pattern=".{8,}" required title="8 characters minimum" required>   
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control" required>

                            <button type="submit" class="btn btn-primary form-control" style="margin-top: 20px;" name="btnRegister">Confirm</button>
                            <a href="login.php" style="display: flex; justify-content: center; text-decoration: none; margin-top: 20px; font-weight: bold;">Already have account? Back to Login</a>        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>