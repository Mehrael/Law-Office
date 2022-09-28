<!-- LOGIN PAGE -->

<?php

$connection = mysqli_connect('localhost', 'root', '', 'office');
session_start();
$allow = true;

if(isset($_GET['logout']))
{
    session_unset();
    session_destroy();
    header("Location: /ODC8/index.php");
    exit;
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['isAdmin'])) {
        $fetch = "SELECT * FROM `admin`";
        $sql = mysqli_query($connection, $fetch);

        foreach ($sql as $admins) {

            if ($email == $admins['email'] && $password == $admins['password']) {
                $allow = true;

                $_SESSION['id'] = $admins['id'];
                $_SESSION['role'] = $admins['role'];
                $_SESSION['isAdmin'] = true;
                $_SESSION['name'] = $admins['name'];

                header("Location: /ODC8/dashboard.php");
                exit;
                break;
            } else {
                $allow = false;
            }
        }
    } else {
        $fetch = "SELECT * FROM `lawyers`";
        $sql = mysqli_query($connection, $fetch);

        foreach ($sql as $lawyer) {

            if ($email == $lawyer['email'] && $password == $lawyer['password']) {
                $_SESSION['id'] = $lawyer['id'];
                $_SESSION['role'] = 3;
                $_SESSION['isAdmin'] = false;
                $_SESSION['name'] = $lawyer['name'];

                header("Location: /ODC8/dashboard.php");
                exit;
                break;
            } else {
                $allow = false;
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<br>

<body class="bg-primary">
    <br>
    <div id="layoutAuthentication">

        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <h1 style="color: white; text-align:center;"> <i class="fa-solid fa-scale-balanced"></i> Law Office</h1>
                    <div class="row justify-content-center">
                        <div class="col-lg-5">

                            <div class="card shadow-lg border-0 rounded-lg mt-5">

                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="isAdmin" />
                                            <label class="form-check-label" for="inputRememberPassword">Admin</label>
                                        </div>
                                        <?php if (!$allow) { ?>
                                            <div class="mx-auto" style="color:red; font-weight:500;">
                                                <label for="formGroupExampleInput2"><i class="fa-solid fa-circle-exclamation"></i> Either email or password is incorrect</label>
                                            </div>

                                        <?php } ?>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                                    </form>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>