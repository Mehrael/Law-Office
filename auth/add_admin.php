<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';

if (!$_SESSION['isAdmin'] && $_SESSION['role'] != 1) {
    echo '<script>window.location="/ODC8/404.php"</script>';
}
// print_r($_SESSION);
$good = false;
$location = "";
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $access = $_POST['role'];


    if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image_name = time() .  $_FILES['image']['name'];
        $image_tmpname = $_FILES['image']['tmp_name'];


        $location =   "../uploads/$image_name";

        $x = move_uploaded_file($image_tmpname, $location);
    } else {
        $image_name = "";
    }



    $insert = "INSERT INTO `admin` VALUES (NULL,'$name',$age,' $address','$phone','$email','$password','$location',$access)";
    $query = mysqli_query($connection, $insert);

    if ($query)
        $good = true;
}
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="pagetitle">
                <h1 class="mt-4">Add Admin</h1>
                <nav>
                <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Admin</li>
                    </ol>
                </nav>
            </div>

            <br>
            <?php if ($good) { ?>
                <div class="d-flex justify-content-center ">
                    <br>
                    <div class="alert alert-success " role="alert">
                        Admin added successfully
                    </div>
                    <br>
                    <br>
                </div>
            <?php } ?>
            <div class="parent">

                <div class="child" style="width: 33rem;">

                    <form class=" card-body rounded" style="  height: 830px;" enctype="multipart/form-data" method="POST" class=" p-3 mb-5 rounded frm" style="width: 500px;">
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <br>
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Age</label>
                            <input type="number" class="form-control" name="age">
                        </div>

                        <br>
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Address</label>
                            <input type="text" class="form-control" name="address">
                        </div>

                        <br>
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Phone</label>
                            <input type="number" class="form-control" name="phone">
                        </div>

                        <br>

                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Photo</label>
                            <br>
                            <input type="file" name="image">
                        </div>

                        <br>
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>

                        <br>

                        <div class="mx-auto">
                            <label for="formGroupExampleInput2">password</label>
                            <input type="password" class="form-control" name="pass">
                        </div>

                        <br>

                        <div class="mx-auto">
                            <label for="formGroupExampleInput2">Role</label>
                            <br>
                            <select name="role">
                                <option value="1">Add admin, lawyer, and articles</option>
                                <option value="2">Add lawyer, and articles</option>
                                <option value="3">Add articles only</option>
                            </select>


                        </div>
                        <br>
                        <div class="mx-auto">
                            <button class="btn btn-primary btn-lg btn-block" name="add">Add</button>
                        </div>
                    </form>



                </div>

                <div class="child d-flex" style="width: 100px;"> </div>
                <div class="child d-flex"> <img class="img" src="/ODC8/assets/img/admin.jpg"></div>
            </div>

            <br>
            <br>

        </div>

    </main>
</div>
<?php
include '../shared/footer.php';
?>