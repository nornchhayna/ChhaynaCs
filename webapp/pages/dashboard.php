<div class="container-fluid pt-1">
    <div class="row justify-content-center">
        <!-- Sidebar (Keep this as in previous example) -->
        <?php include 'sidebar.inc.php'; ?>

        <!-- Home Page Content -->
        <main class="col-md-8 col-lg-9 mx-auto pt-5"> <!-- Add pt-3 to create top padding -->
            <!-- Hero Section -->
            <section class="bg-primary text-white p-6 rounded-lg shadow mb-4">
                <div class="container text-center">
                    <h1 class="display-4">Welcome Back <?php echo htmlspecialchars($username); ?>!</h1>
                    <p class="lead">Your Playground, Your Toys, Your Fun!</p>
                </div>
            </section>

            <!-- Dashboard Overview Section -->
            <section class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm rounded">
                        <div class="card-body text-center">
                            <h5 class="card-title">Toy Collection</h5>
                            <p class="card-text">Browse and manage your collection of toys!</p>
                            <a href="#" class="btn btn-primary">View Collection</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm rounded">
                        <div class="card-body text-center">
                            <h5 class="card-title">Toy Inventory</h5>
                            <p class="card-text">Keep track of your toy inventory and stock levels!</p>
                            <a href="#" class="btn btn-success">Manage Inventory</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm rounded">
                        <div class="card-body text-center">
                            <h5 class="card-title">Toy Sales</h5>
                            <p class="card-text">View and manage toy sales!</p>
                            <a href="#" class="btn btn-warning">View Sales</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Playground Activity Section -->
            <section class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm rounded">
                        <div class="card-header bg-info text-white text-center">
                            <h5 class="card-title">Playground Activities</h5>
                        </div>
                        <div class="card-body">
                            <p class="lead text-center">Explore fun activities related to toys in your playground!</p>
                            <ul class="list-group text-center">
                                <li class="list-group-item">Toy Test Zone</li>
                                <li class="list-group-item">Toy Swap Events</li>
                                <li class="list-group-item">Toy Repair Services</li>
                                <li class="list-group-item">Playground Games</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Statistics Section -->
            <section class="row justify-content-center mt-4">
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm rounded">
                        <div class="card-header bg-secondary text-white text-center">
                            <h5 class="card-title">Total Toys</h5>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="display-4">128</h3>
                            <p>Number of toys in your collection!</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm rounded">
                        <div class="card-header bg-secondary text-white text-center">
                            <h5 class="card-title">Total Sales</h5>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="display-4">$12,345</h3>
                            <p>Total earnings from toy sales!</p>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>
</div>