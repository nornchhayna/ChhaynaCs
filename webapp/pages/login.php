<?php
$username_err = $password_err = '';
if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (usernameExists($username)) {
        if (logUserIn($username, $password)) {

            header('Location: ./?page=dashboard');
        } else {
            $password_err = 'Password not match';
        }
    } else {
        $username_err = 'Username not found';
    }
}

?>
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <form action="./?page=login" method="post" class="w-50 p-4 shadow-lg rounded bg-light">
        <h2 class="text-center mb-4 text-primary">Login</h2>

        <div class="mb-3">
            <label for="username" class="form-label fw-bold">Username</label>
            <input type="text"
                name="username"
                class="form-control <?php echo !empty($username_err) ? 'is-invalid' : ''; ?>"
                id="username"
                placeholder="Enter your username"
                value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            <?php if (!empty($username_err)): ?>
                <div class="invalid-feedback"><?php echo $username_err; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-bold">Password</label>
            <input type="password"
                name="password"
                class="form-control <?php echo !empty($password_err) ? 'is-invalid' : ''; ?>"
                id="password"
                placeholder="Enter your password">
            <?php if (!empty($password_err)): ?>
                <div class="invalid-feedback"><?php echo $password_err; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>

        <div class="text-center mt-3">
            <a href="#" class="text-decoration-none text-secondary">Forgot password?</a>
        </div>
    </form>
</div>