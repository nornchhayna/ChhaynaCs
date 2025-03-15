<?php $user = LoggedInUser(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="./">P-Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <?php if (isAdmin()) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage
                        </a>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="./?page=user/home">👤 User Account</a></li>
                            <li><a class="dropdown-item" href="./?page=category/home">📂 Category</a></li>
                            <li><a class="dropdown-item" href="./?page=product/home">📂 Product</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo (!$user ? '🔑 Account' : '👤 ' . $user->user_label); ?>
                    </a>
                    <ul class="dropdown-menu border-0 shadow">
                        <?php if (!$user) { ?>
                            <li><a class="dropdown-item" href="./?page=login">🔓 Login</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./?page=register">📝 Register</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item text-danger" href="./?page=logout">🚪 Logout</a></li>
                        <?php } ?>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-1 pt-5"> <!-- Added pt-5 to offset content from navbar -->
    <div class="row">
        <div class="col-12">
            <!-- Example content to show inside the page -->

        </div>
    </div>
</div>