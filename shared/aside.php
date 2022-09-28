<?php
if ($_SESSION == NULL) {
    echo '<script>window.location="/ODC8/404.php"</script>';
}
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                  
                 
                    <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
                        echo ' <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="/ODC8/dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                  ';
                    }
                   echo ' <div class="sb-sidenav-menu-heading">METHODS</div>';
                    if ($_SESSION['role'] == 1) {
                        echo ' 

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#admin_collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">

                        <div class="sb-nav-link-icon"> <i class="fa-solid fa-user-astronaut"></i></div>
                        Admin
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="admin_collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/ODC8/auth/add_admin.php">
                                <div class="sb-nav-link-icon"> <i class="fa-solid fa-plus"></i></div>
                                Add
                            </a>
                            <a class="nav-link" href="/ODC8/auth/admins_table.php">
                                <div class="sb-nav-link-icon"> <i class="fa-solid fa-list-ol"></i></div>
                                List
                            </a>
                        </nav>
                    </div>';
                    } ?>
                    <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
                        echo '<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#lawyer_collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"> <i class="fa-solid fa-gavel"></i></div>

                        Lawyer
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="lawyer_collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/ODC8/auth/add_lawyer.php">
                                <div class="sb-nav-link-icon"> <i class="fa-solid fa-plus"></i></div>
                                Add
                            </a>
                            <a class="nav-link" href="/ODC8/auth/lawyer_table.php">
                                <div class="sb-nav-link-icon"> <i class="fa-solid fa-list-ol"></i></div>
                                List
                            </a>
                        </nav>
                    </div>';
                    } ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#articles_collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"> <i class="fa-solid fa-newspaper"></i></div>

                        Articles
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="articles_collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/ODC8/auth/add_article.php">
                                <div class="sb-nav-link-icon"> <i class="fa-solid fa-plus"></i></div>
                                Add
                            </a>
                            <a class="nav-link" href="/ODC8/auth/read_articles.php">
                                <div class="sb-nav-link-icon"> <i class="fa-solid fa-book-open-reader"></i></div>
                                Read
                            </a>
                            <a class="nav-link" href="/ODC8/auth/your_articles.php">
                                <div class="sb-nav-link-icon"> <i class="fa-brands fa-readme"></i></div>
                                Your Articles
                            </a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">PAGES</div>

                    <a class="nav-link collapsed" href="/ODC8/auth/profile.php">
                        <div class="sb-nav-link-icon"> <i class="fa-solid fa-user"></i></div>
                        Profile
                    </a>
                    <a class="nav-link collapsed" href="/ODC8/contact_me.php">
                        <div class="sb-nav-link-icon"> <i class="fa-solid fa-paper-plane"></i></div>
                        Contact me
                    </a>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: <?php echo $_SESSION['name'] ?></div>

            </div>
        </nav>
    </div>