<?php
include './shared/header.php';
include './shared/navbar.php';
include './shared/aside.php';

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">

                <?php if ($_SESSION['role'] == 1) { ?> <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <p>
                                    Welcome Admin, <br>
                                    You have Full Access. <br>
                                    You can Add, Delete, and Edit (admin, lawyer, or article).
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($_SESSION['role'] == 2) { ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">
                                <p>
                                    Welcome Admin, <br>
                                    You have Semi Access.<br>
                                    You can Add, Delete, and Edit (lawyer, or article).
                                </p>
                            </div>

                        </div>
                    </div>
                <?php } ?>
                <?php if ($_SESSION['role'] == 3) { ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">
                            <?php if ($_SESSION['isAdmin']) { ?>
                                <p>
                                    Welcome Admin, <br>
                                    You can Add, Read, and Edit your article.
                                </p>
                                <?php }else{ ?>
                                <p>
                                    Welcome Lawyer, <br>
                                    You can Add, Read, and Edit your article.
                                </p>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
</div>

<?php
include './shared/footer.php';
?>