<?php 
    require_once("form-process.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP CRUD</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">PHP CRUD Tutorial</h1>
        <div class="alert-box">
            <?php 
               
                if(isset($_SESSION["message"])){
                    ?>
            <div class="alert alert-<?php echo $_SESSION["msg_type"]?>">
                <?php 
                    echo $_SESSION["message"];
                    unset($_SESSION["message"]);
                ?>
            </div>
            <?php
                }
            ?>
        </div>
        <?php 
            $mysqli = new mysqli("localhost", "root", "", "crud") or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error_no());
        ?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php 
                    while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["name"]?></td>
                    <td><?php echo $row["location"]?></td>
                    <td>
                        <a href="index.php?action=edit&id=<?php echo $row['id'];?>">
                            <div class="btn btn-info">Edit</div>
                        </a>
                        <a href=" index.php?action=delete&id=<?php echo $row['id'];?>">
                            <div class="btn btn-danger">Delete</div>
                        </a>
                    </td>
                </tr>

                <?php endwhile;?>
            </table>
        </div>
        <div class=" row justify-content-center">
            <form action="form-process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php if(isset($name)){echo $name;}?>"
                        placeholder="Enter Your Name">
                </div>
                <div class="form-group">
                    <label for="">Location</label>
                    <input type="text" class="form-control" name="location"
                        value="<?php if(isset($location)){echo $location;}?>" placeholder="Enter Your Location">
                </div>
                <div class="form-group">

                    <?php
                        if($update == true):
                    ?>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                    <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>

                    <?php endif;?>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>