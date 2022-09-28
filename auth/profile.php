<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';

$id = $_SESSION['id'];
$e = '';
if ($_SESSION['isAdmin']) {
    $admins = mysqli_query($connection, "SELECT * FROM `admin` WHERE id=$id");
    // print_r($admins);
    $e = mysqli_fetch_assoc($admins);
} else {
    $lawyers = mysqli_query($connection, "SELECT * FROM `lawyers` WHERE id=$id");
    // print_r($admins);
    $e = mysqli_fetch_assoc($lawyers);
    $role = 0;
}

$alert = false;
$re_enter = false;

if (isset($_POST['change'])) {


    if ($_SESSION['isAdmin']) {
        $old_pass = $_POST['old_pass'];

        if ($old_pass == $e['password']) {
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];

            if ($new_pass == $confirm_pass) {
                $update = "UPDATE `admin` SET `password`=$new_pass WHERE id = $id";

                $query = mysqli_query($connection, $update);

                if (!$query) {
                    $re_enter = true;
                }
            }
        }
    } else {
        $alert = true;
    }
}



if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image_name = time() .  $_FILES['image']['name'];
        $image_tmpname = $_FILES['image']['tmp_name'];


        $location =   "../uploads/$image_name";

        $x = move_uploaded_file($image_tmpname, $location);
    } else {
        $location = $e['image'];
    }
    // echo $id;
    $query = "UPDATE `admin` SET `name`='$name',age=$age,`address`='$address',phone='$phone',email='$email',`image`='$location' WHERE id = $id";

    mysqli_query($connection, $query);
    echo '<script>window.location="/ODC8/auth/profile.php"</script>';
}

?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="pagetitle">
                <h1 class="">Profile</h1>
                <nav>
                    <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div>

            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <?php if ($e['image'] != "") { ?>
                                    <img src="<?php echo $e['image'] ?>" alt="Profile" class="rounded-circle" style="height: 200px; width: 200px;">
                                <?php } ?>
                                <h2><?php echo $e['name'] ?></h2>
                                <p><?php echo $e['email'] ?></p>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                    </li>

                                    <?php if ($_SESSION['isAdmin']) { ?>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                        </li>
                                    <?php } ?>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                        <h5 class="card-title">Profile Details</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Name</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $e['name'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Age</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $e['age'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Address</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $e['address'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Phone</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $e['phone'] ?></div>
                                        </div>

                                        <?php if (!$_SESSION['isAdmin']) { ?>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Salary</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $e['salary'] ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Years of exprience</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $e['yearsEX'] ?></div>
                                            </div>
                                        <?php } ?>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $e['email'] ?></div>
                                        </div>

                                        <?php if (!$_SESSION['isAdmin']) { ?> <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Role</div>
                                                <div class="col-lg-9 col-md-8">
                                                    <?php if ($role == 1) {
                                                        echo "Add admin, lawyer, and articles." . "<br>";
                                                    } else if ($role == 2) {
                                                        echo "Add lawyer, and articles." . "<br>";
                                                    } else {
                                                        echo "Add only articles." . "<br>";
                                                    } ?>
                                                </div>

                                            </div>
                                        <?php } ?>

                                    </div>

                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                        <!-- Profile Edit Form -->
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <?php if ($e['image'] != "") { ?>
                                                        <img src="<?php echo $e['image'] ?>" alt="Profile" style="height: 150px; width: 150px;">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Upload New Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="image" type="file" class="form-control" id="Email">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="name" value="<?= $e['name'] ?>" type="text" class="form-control" id="fullName" value="Kevin Anderson">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Age</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="age" value="<?= $e['age'] ?>" type="text" class="form-control" id="fullName" value="Kevin Anderson">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="address" value="<?= $e['address'] ?>" type="text" class="form-control" id="fullName" value="Kevin Anderson">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="phone" value="<?= $e['phone'] ?>" type="text" class="form-control" id="fullName" value="Kevin Anderson">
                                                </div>
                                            </div>



                                            <div class="row mb-3">
                                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="email" value="<?= $e['email'] ?>" type="email" class="form-control" id="Email">
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button name="update" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form><!-- End Profile Edit Form -->

                                    </div>
                                    <div class="tab-pane fade pt-3" id="profile-change-password">
                                        <!-- Change Password Form -->
                                        <form method="POST">
                                            <?php if ($alert) { ?>
                                                <div class="d-flex justify-content-center ">
                                                    <br>
                                                    <div class="alert alert-danger " role="alert">
                                                        password is incorrect
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row mb-3">
                                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="old_pass" type="password" class="form-control" id="currentPassword">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="new_pass" type="password" class="form-control" id="newPassword">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="confirm_pass" type="password" class="form-control" id="renewPassword">
                                                </div>
                                            </div>
                                            <?php if ($re_enter) { ?>
                                                <div class="d-flex justify-content-center ">
                                                    <label class="alert alert-danger" for="formGroupExampleInput2">Confirm your new password</label>
                                                </div>
                                                <br>
                                            <?php } ?>
                                            <div class="text-center">
                                                <button class="btn btn-primary" name="change">Change Password</button>
                                            </div>
                                        </form><!-- End Change Password Form -->

                                    </div>


                                </div><!-- End Bordered Tabs -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>


        </div>

    </main>
</div>
<?php
include '../shared/footer.php';
?>