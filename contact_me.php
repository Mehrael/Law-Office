<?php
include './shared/header.php';
include './shared/navbar.php';
include './shared/aside.php';
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="pagetitle">
                <h1 class="">Contact me</h1>
                <nav>
                    <ol class="breadcrumb" style="height: 40px; align-items:center;">
                        <li class="breadcrumb-item"><a href="/ODC8/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Contact me</li>
                    </ol>
                </nav>
            </div>

            <div class=" align-items-center align-self-center" >
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" style="width: 600px;">

                    <img src="./assets/img/Mehrael.jpeg" alt="Profile" class="rounded-circle" style="height: 250px; width: 250px;">
                    <h2>Mehrael Ashraf</h2>
                    <p> Back-End Developer
                    </p>
                    <p> email: mehraelashraf20@gmail.com
                    </p>

                    <div class="social-links mt-2">

                        <a href="https://www.facebook.com/mehrael20/" class="facebook" >
                            <i class="fa-brands fa-facebook" style="height: 35px; "></i>
                        </a>
                        <a href="https://www.instagram.com/mehrael.ashraf/" class="instagram">
                            <i class="fa-brands fa-instagram" style="height: 35px; color:deeppink;"></i>
                        </a>
                        <a href="https://github.com/Mehrael" class="github">
                        <i class="fa-brands fa-github" style="height: 35px; color:darkslategrey;"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/mehrael-ashraf-6248a1210/" class="linkedin">
                            <i class="fa-brands fa-linkedin" style="height: 35px; "></i>
                        </a>
                
                    </div>
                </div>
            </div>

        </div>

    </main>
</div>
<?php
include './shared/footer.php';
?>