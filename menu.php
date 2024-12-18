<nav class="navbar container align-item-center m-auto navbar-expand-lg mt-3 p-2 mb-3">
    <div class="container-fluid text-center">
        <a class="navbar-brand" href="index.php">
            <img src="asset/css/images/logo.png" alt="Agrimart Logo" class="img-logo"> Agrimart
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item toggle">
                    <a class="nav-link" href="index.php"><i class="bi bi-house-door-fill"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact_us.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">My Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="feedback.php">Feedback</a>
                </li>
                <li class="nav-item toggle">
                    <a class="nav-link" href="cart.php"><i class="bi bi-cart"></i></a>
                </li>
            </ul>
            <?php if(isset($_SESSION['ROLE'])): ?>
            <div class="dropdown">
                <a class="nav-link d-flex align-items-center text-dark" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="asset/css/images/profile.png" alt="Profile" class="rounded-circle me-2"
                        style="width: 40px; height: 40px;">
                    <!-- <span><?php echo ucwords($_SESSION['USERNAME']); ?></span> -->
                </a>
                <ul class="dropdown-menu dropdown-menu-end glass-effect" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="myprofile.php"><i class="bi bi-person"></i> My Profile</a></li>
                    <li><a class="dropdown-item" href="orders.php"><i class="bi bi-box"></i> My Orders</a></li>
                    <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear"></i> Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i>
                            Logout</a></li>
                </ul>
            </div>

            <?php else: ?>
            <form class="d-flex">
                <a class="nav-link text-dark" href="login.php"><span class="btn text text-dark"><i
                            class="bi bi-person-circle"> Login</span></i></a>
            </form>
            <?php endif; ?>
        </div>
    </div>
</nav>