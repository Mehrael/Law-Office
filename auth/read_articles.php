<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';

?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="pagetitle">
                <h1 class="">Articles</h1>
                <nav>
                    <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Articles</li>
                    </ol>
                </nav>
            </div>

            <br>
            <br>
            <?php
            $fetch = "SELECT * FROM `articles`";
            $sql = mysqli_query($connection, $fetch);


            foreach ($sql as $ar) {
                $img = $ar['image'];
                $title = $ar['title'];
                $desc = $ar['description'];
                $create = $ar['created_time'];
                $auth_id = $ar['id_pro'];
                $updated = $ar['updated_time'];
                if (strpos($auth_id, 'a_') !== false) {
                    $id = (int)filter_var($auth_id, FILTER_SANITIZE_NUMBER_INT);
                    $admins = mysqli_query($connection, "SELECT * FROM `admin` WHERE id=$id");

                    $e = mysqli_fetch_assoc($admins);
                    $auth_name = $e['name'];
                    $img_pro = $e['image'];
                } else {
                    $id = (int)filter_var($auth_id, FILTER_SANITIZE_NUMBER_INT);

                    $lawyers = mysqli_query($connection, "SELECT * FROM `lawyers` WHERE id=$id");

                    $e = mysqli_fetch_assoc($lawyers);
                    $auth_name = $e['name'];
                    $img_pro = $e['image'];
                }


            ?>

                <div class='card'>

                    <div class='card-body'>

                        <div class='d-flex justify-content-center '>
                            <div class='card mb-3' style='width: 500px ;'>

                                <h5 class='card-header'>
                                    <?php if ($img_pro !== "") { ?>
                                        <img src='<?php echo $img_pro ?>' class='card-img-top rounded-circle' style="max-height: 36px; max-width:min-content;">
                                    <?php } ?>
                                    <?php echo $auth_name ?>
                                </h5>
                                <?php if ($img !== "") { ?>
                                    <img src='<?php echo $img ?>' class='card-img-top'>
                                <?php } ?>
                                <div class='card-body'>
                                    <h5 class='card-title'> <?php echo $title ?></h5>
                                    <p class='card-text'><?php echo $desc ?></p>

                                    <?php if ($updated != 0) { ?>
                                        <p class='card-text'><small class='text-muted'>Updated at <?php echo $updated ?></small></p>
                                    <?php } else { ?>
                                        <p class='card-text'><small class='text-muted'>Created at <?php echo $create ?></small></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            <?php
            } ?>


        </div>

    </main>
</div>
<?php
include '../shared/footer.php';
?>