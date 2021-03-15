<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Save Password</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <?php

                if (isset($_SESSION['userID'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Hello, <?php echo $_SESSION['full_name']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="operation.php?action=logout">Logout</a>
                    </li>
                <?php
                } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>