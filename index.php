<?php

include('function.php');

$objCrudAdmin = new crudApp();

if (isset($_POST['add_info'])) {
    $return_msg = $objCrudAdmin->add_data($_POST);
}

$students = $objCrudAdmin->display_data();

if (isset($_GET['status'])) {
    if ($_GET['status'] = 'delete') {
        $delete_id = $_GET['id'];
        $del_img = $objCrudAdmin->delete_data($delete_id);
    }
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

    <!-- External CSS -->
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container my-4 p-4 shadow">
        <h2><a class="text" href="index.php">Student Database</a></h2>
        <?php if (isset($del_img)) {
            echo $del_img;
        } ?>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <?php
            if (isset($return_msg)) {
                echo $return_msg;
            } ?>
            <input type="text" class="form-control mb-2" name="std_name" placeholder="enter your name" />
            <input type="number" class="form-control mb-2" name="std_roll" placeholder="enter your roll" />
            <label for="image">Upload Your Image</label>
            <input type="file" class="form-control mb-2" name="std_img" />
            <input type="submit" value="Add Information" name="add_info" class="form-control bg-warning" />
        </form>
    </div>
    <div class="container my-4 p-4 shadow">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Roll</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($student = mysqli_fetch_assoc($students)) { ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['std_name']; ?></td>
                        <td><?php echo $student['std_roll']; ?></td>
                        <td><img class="image" src="upload/<?php echo $student['std_img']; ?>">
                        </td>
                        <td><a href="edit.php?status=edit&&id=<?php echo $student['id']; ?>" class="btn btn-success">Edit</a>
                            <a href="?status=delete&&id=<?php echo $student['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
