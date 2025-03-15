<?php
if (!isset($_GET['id']) || !getUserByID($_GET['id']) === null) {
    header('Location: ./?page=user/home');
}
if (deleteUser($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">User has been deleted! <a href="./?page=user/home">user page</a></div>';
    header("Location: ./?page=user/home");
    exit();
} else {
    echo '<div class="alert alert-danger" role="alert">User can not  delete!
    !<a href="./?page=user/home">User page</a></div>';
}
