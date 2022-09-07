<html>

<head>
    <title>AdvWeb Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <style>
        #map {
            height: 500px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }
    </style>

</head>

<body>
    <?php
    $nav = '';
    if($this->session->userdata('logged_in') == NULL){
        $nav = 'none';
    }?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navBar" style="display: <?php echo $nav ?>;">
        <a class="navbar-brand" href="#home">AdvWeb 1 Project</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" style="float: right;">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <li class="nav-item" style="float: right;">
                    <a class="nav-link" href="#about">About</a>
                </li>
            </ul>
            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                        <a class="nav-link" href="#register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo $_SESSION['username'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-bottom: 100px;">

        <?php if ($this->session->flashdata('user_registered')) : ?>
            <?php echo '<p class="alert alert-secondary" style="text-align:center">' . $this->session->flashdata('user_registered') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('student_registered')) : ?>
            <?php echo '<p class="alert alert-success" style="text-align:center">' . $this->session->flashdata('student_registered') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('login_failed')) : ?>
            <?php echo '<p class="alert alert-danger" style="text-align:center">' . $this->session->flashdata('login_failed') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('user_login')) : ?>
            <?php echo '<p class="alert alert-success" style="text-align:center">' . $this->session->flashdata('user_login') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('busRouteRegistration_failed')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('busRouteRegistration_failed') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('student_exist')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('student_exist') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('student_not_found')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('student_not_found') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('bus_not_found')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('bus_not_found') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('bus_history_not_found')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('bus_history_not_found') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('bus_location_not_found')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('bus_location_not_found') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('driver_not_found')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('driver_not_found') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('route_not_found')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('route_not_found') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('faculty_not_found')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('faculty_not_found') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('user_logout')) : ?>
            <?php echo '<p class="alert alert-success" style="text-align:center">' . $this->session->flashdata('user_logout') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('bus_exist')) : ?>
            <?php echo '<p class="alert alert-success" style="text-align:center">' . $this->session->flashdata('bus_exist') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('userRoleAssign_failed')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('userRoleAssign_failed') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('role_added')) : ?>
            <?php echo '<p class="alert alert-success" style="text-align:center">' . $this->session->flashdata('role_added') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('old_password_not_correct')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('old_password_not_correct') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('bus_history_not_found_by_date')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('bus_history_not_found_by_date') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('report_registered')) : ?>
            <?php echo '<p class="alert alert-success" style="text-align:center">' . $this->session->flashdata('report_registered') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('user_role_not_assign')) : ?>
            <?php echo '<p class="alert alert-danger" style="text-align:center">' . $this->session->flashdata('user_role_not_assign') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('bus_in_out_history_not_found')) : ?>
            <?php echo '<p class="alert alert-warning" style="text-align:center">' . $this->session->flashdata('bus_in_out_history_not_found') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('logged_in_user_updated')) : ?>
            <?php echo '<p class="alert alert-success" style="text-align:center">' . $this->session->flashdata('logged_in_user_updated') . '</p>'; ?>
        <?php endif; ?>

        <script>
            function bgDo() {
                document.getElementById('userDropDown').style.backgroundColor = '#b8defc';
            }

            function bgUndo() {
                document.getElementById('userDropDown').style.backgroundColor = '#e6f2fc';
            }

            function showPassword() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }

            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>

        <script type="text/javascript">
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>