<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';
if (!$_SESSION['isAdmin']) {
    echo '<script>window.location="/ODC8/404.php"</script>';
}
$id = $_GET['edit'];
// echo $id;
$lawyers = mysqli_query($connection, "SELECT * FROM `lawyers` WHERE id=$id");
// print_r($admins);
$e = mysqli_fetch_assoc($lawyers);

?>



<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4" >

            <div class="pagetitle">
                <h1>View Lawyer</h1>
                <nav>
                    <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/ODC8/auth/admins_table.php">Lawyers List</a></li>
                        <li class="breadcrumb-item active">View Lawyer</li>
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
                        Salary: <?php echo $e['salary'] . '<br>' ?>
                        Years of exprience: <?php echo $e['yearsEX'] . '<br>' ?>
                        Phone: <?php echo $e['phone'] . '<br>' ?>
                        Email: <?php echo $e['email'] . '<br>' ?>
                    </p>
                    <a class="btn btn-primary" href="edit_lawyer.php?edit=<?php echo $e['id']; ?>"> <i class="fa-solid fa-pen-to-square"></i></a>

                </div>
            </div>


        </div>

    </main>
</div>
<?php
include '../shared/footer.php';
?>