<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';
if (!$_SESSION['isAdmin'] && $_SESSION['role'] != 1)  {
    echo '<script>window.location="/ODC8/404.php"</script>';
}
$id = $_GET['edit'];
// echo $id;
$admins = mysqli_query($connection, "SELECT * FROM `admin` WHERE id=$id");
// print_r($admins);
$e = mysqli_fetch_assoc($admins);
// print_r($e);

$location = "";


if (isset($_POST['edit'])) {
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
        $location = $e['image'];
    }
    // echo $id;
    $query = "UPDATE `admin` SET `name`='$name',age=$age,`address`='$address',phone='$phone',email='$email',`password`='$password',`image`='$location', `role`=$access WHERE id = $id";

    mysqli_query($connection, $query);

    echo '<script>window.location="/ODC8/auth/admins_table.php"</script>';
}

?>



<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="pagetitle">
                <h1>Edit Admin</h1>
                <nav>
                    <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/ODC8/auth/admins_table.php">Admins List</a></li>
                        <li class="breadcrumb-item active">Edit Admin</li>
                    </ol>
                </nav>
            </div>

            <div class="parent">

                <div class="child" style="width: 33rem;">

                    <form class=" card-body rounded" style="  height: 830px;" enctype="multipart/form-data" method="POST" class=" p-3 mb-5 rounded frm" style="width: 500px;">
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $e['name'] ?>">
                        </div>

                        <br>
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Age</label>
                            <input type="number" class="form-control" name="age" value="<?php echo $e['age'] ?>">
                        </div>

                        <br>
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Address</label>
                            <input type="text" class="form-control" name="address" value="<?php echo $e['address'] ?>">
                        </div>

                        <br>
                        <div class="mx-auto">
                            <label for="formGroupExampleInput">Phone</label>
                            <input type="number" class="form-control" name="phone" value="<?php echo $e['phone'] ?>">
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
                            <input type="email" class="form-control" name="email" value="<?php echo $e['email'] ?>">
                        </div>

                        <br>

                        <div class="mx-auto">
                            <label for="formGroupExampleInput2">password</label>
                            <input type="password" class="form-control" name="pass" value="<?php echo $e['password'] ?>">
                        </div>

                        <br>

                        <div class="mx-auto">
                            <label for="formGroupExampleInput2">Role</label>
                            <br>
                            <select name="role">
                                <option value="1" <?php if ($e['role'] == 1) {
                                                        echo "selected";
                                                    } ?>>Add admin, lawyer, and articles</option>
                                <option value="2" <?php if ($e['role'] == 2) {
                                                        echo "selected";
                                                    } ?>>Add lawyer, and articles</option>
                                <option value="3" <?php if ($e['role'] == 3) {
                                                        echo "selected";
                                                    } ?>>Add articles only</option>
                            </select>


                        </div>
                        <br>
                        <div class="mx-auto">
                            <button class="btn btn-primary btn-lg btn-block" name="edit" value="<?php echo $id; ?>">Update</button>
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