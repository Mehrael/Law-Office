<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';

?>


<?php
// print_r($_SESSION);
$id = $_SESSION['id'];
if($_SESSION['isAdmin'])
{
    $data = mysqli_query($connection, "SELECT * FROM `admin` WHERE id=$id");
    $con = 'a_';
}
else{
    $data = mysqli_query($connection, "SELECT * FROM `lawyers` WHERE id=$id");
    $con = 'l_';
}
$row = mysqli_fetch_assoc($data);

$good = false;
$location = "";
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $author = $row['name'];

    $image_pro = $row['image'];
    $id_pro = $con . $row['id'];

    if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image_name = time() .  $_FILES['image']['name'];
        $image_tmpname = $_FILES['image']['tmp_name'];


        $location =   "../uploads/$image_name";

        $x = move_uploaded_file($image_tmpname, $location);
    } else {
        $image_name = "";
    }

    $insert = "INSERT INTO `articles` VALUES (NULL,'$title','$desc',' $author','$location',DEFAULT,'0','$image_pro','$id_pro')";
    $query = mysqli_query($connection, $insert);

    if ($query)
        $good = true;
}
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="pagetitle">
                <h1 class="mt-4">Add Article</h1>
                <nav>
                <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Article</li>
                    </ol>
                </nav>
            </div>

            <br>
            <?php if ($good) { ?>
                <div class="d-flex justify-content-center ">
                    <br>
                    <div class="alert alert-success " role="alert">
                    Article added successfully
                    </div>
                    <br>
                    <br>
                </div>
            <?php } ?>
            <div class="parent">

                <div class="child" style="width: 33rem;">

                    <form class=" card-body rounded" style="  height: 355px;" enctype="multipart/form-data" method="POST" class=" p-3 mb-5 rounded frm" style="width: 500px;">
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>

                        <br>
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Description</label>
                            <input type="text" class="form-control" name="desc">
                        </div>

                        <br>


                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Photo</label>
                            <br>
                            <input type="file" name="image">
                        </div> <br>

                        <div class="mx-auto">
                            <button class="btn btn-primary btn-lg btn-block" name="add">Add</button>
                        </div>
                    </form>
                </div>

              


                <div class="child d-flex" style="width: 100px;"> </div>
                <div class="child d-flex"> <img class="img" src="/ODC8/assets/img/article.jpg"></div>
            </div>
            <br>

        </div>

        <br>
        <br>

</main>

</div>

<?php
include '../shared/footer.php';
?>
