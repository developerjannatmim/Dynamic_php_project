<?php

include('function.php');
$objCrudAdmin = new crudApp();

$students = $objCrudAdmin->display_data();

if(isset($_GET['status'])){
    if($_GET['status'] = "edit"){
        $id = $_GET['id'];
        $returndata = $objCrudAdmin->display_data_by_id($id);
    }
}

if(isset($_POST['edit_info'])){
   $msg = $objCrudAdmin->update_data($_POST);
}


?>



<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CRUD APP</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container my-4 p-4 shadow">
        <h2><a class="text" href="index.php">Student Database</a></h2>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <?php
            if (isset($msg)) {
                echo $msg;
            } ?>
            <input type="text" class="form-control mb-2" name="u_std_name" value="<?php echo $returndata['std_name']; ?>" />
            <input type="number" class="form-control mb-2" name="u_std_roll" value="<?php echo $returndata['std_roll']; ?>" />
            <label for="image">Upload Your Image</label>
            <input class="form-control mb-2" type="file" name="u_std_img" />
            <input type="hidden" name="std_id" value="<?php echo $returndata['id']; ?>" />
            <input type="submit" value="Update Information" name="edit_info" class="form-control bg-warning" />
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
