<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';

if (!$_SESSION['isAdmin'] && $_SESSION['role'] != 1) {
    echo '<script>window.location="/ODC8/404.php"</script>';
}
$id = $_GET['edit'];
// echo $id;
$admins = mysqli_query($connection, "SELECT * FROM `admin` WHERE id=$id");
// print_r($admins);
$e = mysqli_fetch_assoc($admins);

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
                        <li class="breadcrumb-item active">View Admin</li>
                    </ol>
                </nav>
            </div>
            <div class="card" style="width: 22rem; align-items:center; ">
            <?php if ($e['image'] !== "") { ?>      
                <img src="<?php echo $e['image'] ?>" class="card-img-top" alt="...">
                <?php } ?>
                <div class="card-body">
                    <p class="card-text">
                        Name: <?php echo $e['name'] . '<br>' ?>
                        Age: <?php echo $e['age'] . '<br>' ?>
                        Address: <?php echo $e['address'] . '<br>' ?>
                        Phone: <?php echo $e['phone'] . '<br>' ?>
                        Email: <?php echo $e['email'] . '<br>' ?>
                        Role: <?php if ($e['role'] == 1) {
                                    echo "Add admin, lawyer, and articles." . "<br>";
                                } else if ($e['role'] == 2) {
                                    echo "Add lawyer, and articles." . "<br>";
                                } else {
                                    echo "Add only articles." . "<br>";
                                } ?>
                    </p>
                    <a class="btn btn-primary" href="edit_admin.php?edit=<?php echo $e['id']; ?>"> <i class="fa-solid fa-pen-to-square"></i></a>

                </div>
            </div>


        </div>

    </main>
</div>
<?php
include '../shared/footer.php';
?>