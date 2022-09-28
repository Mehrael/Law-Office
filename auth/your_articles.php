<?php
include '../shared/header.php';
include '../shared/navbar.php';
include '../shared/aside.php';
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="pagetitle">
                <h1 class="">Your articles</h1>
                <nav>
                    <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Your articles</li>
                    </ol>
                </nav>
            </div>

            <?php
            $fetch = "SELECT * FROM `articles`";
            $sql = mysqli_query($connection, $fetch);
     
            $id = $_SESSION['id'];

            $img = "";
            $title = "";
            $desc = "";
            $create = "";
            $article_id = "";
            $updated = "";
            $auth_name = "";
            $img_pro = "";

            foreach ($sql as $ar) {
                // print_r($ar);
                $auth_id = $ar['id_pro'];

                if ($_SESSION['isAdmin']) {
                    if (strpos($auth_id, 'a_') !== false) {
                        $admins = mysqli_query($connection, "SELECT * FROM `admin` WHERE id=$id");
                        $int = (int)filter_var($auth_id, FILTER_SANITIZE_NUMBER_INT);

                        if ($id == $int) {

                            $img = $ar['image'];
                            $title = $ar['title'];
                            $desc = $ar['description'];
                            $create = $ar['created_time'];
                            $article_id = $ar['id'];
                            $updated = $ar['updated_time'];

                            $e = mysqli_fetch_assoc($admins);
                            $auth_name = $e['name'];
                            $img_pro = $e['image'];
                        }
                    }
                } else {
                    if (strpos($auth_id, 'l_') !== false) {
                        $int = (int)filter_var($auth_id, FILTER_SANITIZE_NUMBER_INT);

                        if ($id == $int) {
                            $lawyers = mysqli_query($connection, "SELECT * FROM `lawyers` WHERE id=$id");
                            $img = $ar['image'];
                            $title = $ar['title'];
                            $desc = $ar['description'];
                            $create = $ar['created_time'];
                            $article_id = $ar['id'];
                            $updated = $ar['updated_time'];

                            $e = mysqli_fetch_assoc($lawyers);
                            $auth_name = $e['name'];
                            $img_pro = $e['image'];
                        }
                    }
                }

         
            ?>
                <?php if (!$article_id == "") { ?>
                    <div class='card'>
                        <div class='card-body'>
                            <div class='d-flex justify-content-center '>
                                <div class='card mb-3' style='width: 500px ;'>
                                    <h5 class='card-header'>
                                        <?php if ($img_pro != "") { ?>
                                            <img src='<?php echo $img_pro ?>' class='card-img-top rounded-circle' style="max-height: 36px; max-width:min-content;">
                                        <?php } ?>
                                        <?php echo $auth_name ?>
                                    </h5>
                                    <?php if ($img != "") { ?>
                                        <img src='<?php echo $img ?>' class='card-img-top'> <?php } ?>
                                    <div class='card-body'>
                                        <h5 class='card-title'> <?php echo $title ?></h5>
                                        <p class='card-text'><?php echo $desc ?></p>
                                        <?php if ($updated != 0) { ?>
                                            <p class='card-text'><small class='text-muted'>Updated at <?php echo $updated ?></small></p>
                                        <?php } else { ?>
                                            <p class='card-text'><small class='text-muted'>Created at <?php echo $create ?></small></p>
                                        <?php } ?>
                                        <a class="btn btn-primary" href="edit_article.php?edit=<?php echo $article_id ?>"> <i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } }?>
<?php if ($article_id == "") { ?>
<img src='../assets/img/no_result.jpg' class='card-img-top rounded-circle'>
<?php
                } ?>
        </div>
        <br>
    </main>
</div>

<?php
include '../shared/footer.php';
?>