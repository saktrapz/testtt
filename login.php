<?php 
    include "function.php";

    if(isset($_POST['btnLogin'])){
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $select = "SELECT * FROM tbl_admin WHERE `email` = '$email' AND `password` = '$pass' ";
        $result = $con -> query($select);
        $row = $result -> fetch_assoc();
        if($row > 0){
            session_start();
            $_SESSION['id'] = $row['id'];
            header("Location: home.php ");
        }else{
            echo "
                <script>
                    $(document).ready(function(){
                        Swal.fire(
                            'Failed',
                            'Email or Password invalid',
                            'error'
                          )
                                                       
                    });
                </script>
            ";
            
        }
        // echo $email;
        // echo $pass;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="background-color: #2075FF; height: 1000px; position: fixed;">
                <div class="row">
                    <div class="col-4" style="background-color: white; height:600px; position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); border-radius: 5px; padding: 20px; box-shadow: -1px 0px 20px 1px rgba(0, 0, 0, 0.219); display: flex; align-items: center;">
                        <form method="POST" style="width: 100%;">
                            <h1 align="center">Login</h1>
                            <label for="" style="margin-top: 20px;" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">     

                            <button type="submit" class="btn btn-primary form-control" style="margin-top: 20px;" name="btnLogin">Confirm</button>
                            <a href="register.php" style="display: flex; justify-content: center; text-decoration: none; margin-top: 20px; font-weight: bold;">Register New Account</a>        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>