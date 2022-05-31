<?php
  include "function.php";

  session_start();
  if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    
    $select_user = "SELECT * FROM tbl_admin WHERE `id` = '$id' ";
    $result_user = $con -> query($select_user);
    $row_user = $result_user -> fetch_assoc();

    // ---Add products----

    if(isset($_POST['add'])){
      $pname = $_POST['pname'];
      $pprice = $_POST['price'];
      $desc = $_POST['desc'];
      $filename = $_FILES['image']['name'];
      $path_upload = "image/".$filename;
      move_uploaded_file($_FILES['image']['tmp_name'],$path_upload);

      $insert = "INSERT INTO tbl_products VALUES('','".$pname."','".$desc."','".$pprice."','".$_FILES['image']['name']."')";
      
      if($con->query($insert) == true) {
        echo "
                <script>
                    $(document).ready(function(){
                        Swal.fire(
                            'Product Added',
                            'Product added Successfully',
                            'success'
                          )                                          
                    });
                </script>
            ";
      }
    }

    if(isset($_POST['delete'])){
      $id_pro = $_POST['id_pro'];
      $delete = "DELETE FROM tbl_products WHERE id = '$id_pro'";
      if($con->query($delete) == true){
        echo "
                <script>
                    $(document).ready(function(){
                        Swal.fire(
                            'Delete Successfully',
                            'Your Product has been deleted',
                            'success'
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" integrity="sha512-QfDd74mlg8afgSqm3Vq2Q65e9b3xMhJB4GZ9OcHDVy1hZ6pqBJPWWnMsKDXM7NINoKqJANNGBuVRIpIJ5dogfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../etec/css/style.css">
    <title>Document</title>
    <style>
      .fa-edit:hover{
        color: blue;
      }
      .fa-trash-alt:hover{
        color: red;
      }

    </style>
</head>
<body>
    <div class="container-fluid">

        <div class="row">
            <div class="col-2 left-content">
                <div class="row">
                    <div class="col-12 logo">
                        <a href="#">MY SHOP</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 menu-lists">
                        <ul class="menu-links">
                            <li><a href="home.php">PRODUCTS</a></li>
                            <li><a href="">STOCK</a></li>
                            <li><a href="">USER MANAGEMENT</a></li>
                            <li><a href="">SUBSCRIPTION</a></li>
                            <li class="exit" style="background-color: red;"><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-10 right-content">
                <div class="row">
                    <div class="col-12 top-content">
                        <div class="row justify-content-end">
                            <div class="col-2 profile">
                                <i class="fas fa-user-circle"></i>
                                <div class="infor">
                                    <h4 style="text-transform: uppercase;"><?php echo $row_user['username'] ?></h4>
                                    <p>ADMIN</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 buttom-content">
                        <h3>ALL PRODUCT</h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                          ADD PRODUCT
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                              <h3 align="left">ADD PRODUCT</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                  <form method="POST" enctype="multipart/form-data">                                    
                                      <label for="" class="form-label">Product Name</label>
                                      <input type="text" name="pname" class="form-control" required>
                                      <label for="" class="form-label">Description</label>
                                      <textarea name="desc" class="form-control" row="10" cols="500" required></textarea>
                                      <label for="" class="form-label">Price</label>
                                      <input type="number" name="price" class="form-control" min="0" required>
                                      <label for="" class="form-label">Upload Image</label>
                                      <input type="file" accept=".jpg,.png" name="image" class="form-control">    
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="add">Save changes</button>
                                      </div>
                                  </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-12 user-manage">
                                <table class="table">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Option</th>
                                      </tr>
                                    </thead>
                                    <?php
                                      $select_pro = "SELECT * FROM tbl_products";
                                      $result_select = $con ->query($select_pro);
                                      while($row = $result_select->fetch_assoc())
                                      {
                                      ?>
                                      <tbody>
                                        
                                          <tr style="text-align: left; align-self:center;">
                                            <th scope="row"><?php echo $row['id'] ?></th>
                                            <td><img src="image/<?php echo $row['image']?>" style="width: 40px; object-fit:cover;"></td>
                                            <td><?php echo $row['pname'] ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td>$ <?php echo $row['price'] ?></td>
                                            
                                            <td style="display:flex; align-items: center;">
                                        
                                                <!-- <button type="submit" style="border: none;font-size: 22px;" data-toggle="modal" data-target="#edit"> -->
                                                  <a href="home.php?id=".$row["id"] data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></a>
                                                  
                                                <!-- </button> -->
                                                <!-- UPDATE Modal -->
                                                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                      <h3 align="left">EDIT PRODUCT</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <form method="POST" enctype="multipart/form-data">    
                                                              <input type="text" name="id_pro" value="<?php echo $row['id'] ?>">
                                                              <label for="" class="form-label">Product Name</label>
                                                              <input type="text" name="pname" class="form-control" value="<?php echo $row['pname'] ?>" required>
                                                              <label for="" class="form-label">Description</label>
                                                              <textarea name="desc" class="form-control" row="4" cols="50" required></textarea>
                                                              <label for="" class="form-label">Price</label>
                                                              <input type="number" name="price" class="form-control" min="0" value="<?php echo $row['price'] ?>"required>
                                                              <label for="" class="form-label">Upload Image</label>
                                                              <input type="file" accept=".jpg,.png" name="image" class="form-control">    
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="add">Save changes</button>
                                                              </div>
                                                        
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!-- Modal -->
                                                   
                                              <form method="POST">       
                                                <input type="text" name="id_pro" value="<?php echo $row['id'] ?>">                      
                                                <button type="submit" name="delete" style="border: none;font-size: 22px;"><i class="fas fa-trash-alt"></i></button>                                     
                                              </form>
                                            </td>
                                            
                                          </tr>
                                        
                                      </tbody>  
                                      <?php
                                      }
                                    ?>
                                  </table>
                            </div>
                        </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
<?php
  }else{
    header('Location: login.php');
  }
?>