<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';
if (!$_SESSION['isAdmin']) {
    echo '<script>window.location="/ODC8/404.php"</script>';
}
$lawyers = mysqli_query($connection, "SELECT * FROM `lawyers`");

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($connection, "DELETE FROM `lawyers` WHERE id=$id");
    echo '<script>window.location="/ODC8/auth/lawyer_table.php"</script>';
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="pagetitle">
                <h1 class="">Lawyers List</h1>
                <nav>
                    <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lawyers List</li>
                    </ol>
                </nav>
            </div>

            <br>
            <div class="mx-auto p-3 mb-5 rounded" style="width: 1000px;">
                <table class="table table-striped tbl rounded">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>

                            <th scope="col">Actions</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lawyers as $e) { ?>
                            <tr>
                                <th scope="row"><?php echo $e['id'] ?></th>
                                <td><?php echo $e['name'] ?></td>
                                <td>
                                    <a class="btn btn-info" href="view_lawyer.php?edit=<?php echo $e['id']; ?>"> <i class="fa-solid fa-eye"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="edit_lawyer.php?edit=<?php echo $e['id']; ?>"> <i class="fa-solid fa-pen-to-square"></i></a>
                                </td>

                                <td>
                                    <a class="del_btn btn btn-danger" href="lawyer_table.php?del=<?php echo $e['id']; ?>"> <i class="fa-solid fa-trash-can"></i></a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <br>
            <br>

        </div>

    </main>
</div>


<?php
include '../shared/footer.php';
?>