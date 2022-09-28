<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';

?>

<?php

$id = $_GET['edit'];
$image_name = "";
$admins = mysqli_query($connection, "SELECT * FROM `articles` WHERE id=$id");
$article = mysqli_fetch_assoc($admins);

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];


    $update =  time();

    if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image_name = time() .  $_FILES['image']['name'];
        $image_tmpname = $_FILES['image']['tmp_name'];


        $location =   "../uploads/$image_name";

        $x = move_uploaded_file($image_tmpname, $location);
    } else {
        $location = $article['image'];
    }

    $insert = "UPDATE `articles` SET title='$title',`description`='$desc',`image`='$location',updated_time=DEFAULT WHERE id=$id";
    $query = mysqli_query($connection, $insert);

    echo '<script>window.location="/ODC8/auth/your_articles.php"</script>';

}
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

        <div class="pagetitle">
                <h1 class="">Edit article</h1>
                <nav>
                    <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/ODC8/auth/your_articles.php">Your articles</a></li>
                        <li class="breadcrumb-item active">Edit article</li>
                    </ol>
                </nav>
            </div>

            <br>
        
            <div class="parent">

                <div class="child" style="width: 33rem;">

                    <form class=" card-body rounded" style="  height: 355px;" enctype="multipart/form-data" method="POST" class=" p-3 mb-5 rounded frm" style="width: 500px;">
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $article['title'] ?>">
                        </div>

                        <br>
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Description</label>
                            <input type="text" class="form-control" name="desc" value="<?php echo $article['description'] ?>">
                        </div>

                        <br>


                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Photo</label>
                            <br>
                            <input type="file" name="image">
                        </div> <br>

                        <div class="mx-auto">
                            <button class="btn btn-primary btn-lg btn-block" name="update" value="<?php echo $id; ?>">Update</button>
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
