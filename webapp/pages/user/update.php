<?php

if (!isset($_GET['id']) || getUserByID($_GET['id']) === null) {
    header('Location: ./?page=user/home');
}


$manage_user = getUserByID($_GET['id']);
$user_label_err = $username_err;
if (isset($_POST['user_label'], $_POST['username'], $_POST['password'])) {
    $id_user = $_GET['id'];
    $user_label = $_POST['user_label'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($user_label)) {
        $user_label_err = "User label is required!";
    }
    if (empty($username) && usernameExists($username)) {
        $username_err = "Username already exists!";
    }
    if (empty($user_label_err) &&  empty($username_err)) {
        if (updateUser($id_user, $user_label, $username, $password)) {
            echo '<div class="alert alert-success" role="alert">user has been updated successful! <a href="./?page=user/home">user page</a></div>';
            header("Location: ./?page=category/home");
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">User cannot be Update!</div>';
        }
    }
}
?>


<form action="./?page=user/update&id=<?php echo $manage_user->id_user ?>" method="post" class="w-50 mx-auto p-4 shadow-lg rounded-lg bg-light">
    <h1 class="text-center text-primary mb-4">Update User ID: <?php echo $manage_user->id_user ?></h1>

    <div class="mb-4">
        <label for="user_label" class="form-label fw-semibold">User Label</label>
        <input type="text"
            name="user_label"
            class="form-control <?php echo $user_label_err !== '' ? 'is-invalid' : ''; ?>"
            id="user_label"
            value="<?php echo isset($_POST['user_label']) ? $_POST['user_label'] : $manage_user->user_label; ?>">

        <?php if ($user_label_err): ?>
            <div class="invalid-feedback">
                <?php echo $user_label_err; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <label for="username" class="form-label fw-semibold">Username</label>
        <input type="text"
            placeholder="(optional) input username to update"
            name="username"
            class="form-control <?php echo $username_err !== '' ? 'is-invalid' : ''; ?>"
            id="username"
            value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">

        <?php if ($username_err): ?>
            <div class="invalid-feedback">
                <?php echo $username_err; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password"
            placeholder="(optional) input password to update"
            name="password"
            class="form-control <?php echo $password_err !== '' ? 'is-invalid' : ''; ?>"
            id="password"
            value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">

        <?php if ($password_err): ?>
            <div class="invalid-feedback">
                <?php echo $password_err; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-between">
        <a href="./?page=user/home" role="button" class="btn btn-outline-secondary mt-3 px-4 py-2 rounded-pill">Cancel</a>
        <button type="submit" class="btn btn-primary mt-3 px-4 py-2 rounded-pill">Update</button>
    </div>
</form>