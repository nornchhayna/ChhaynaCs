<?php
if (!isset($_GET['id']) || !getProducts($_GET['id']) === null) {
    header('Location: ./?page=delete/home');
}
if (deleteProduct($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">product has been deleted! <a href="./?page=product/home">product page</a></div>';
    header("Location: ./?page=product/home");
    exit();
} else {
    echo '<div class="alert alert-danger" role="alert">product can not  delete!
    !<a href="./?page=product/home">product page</a></div>';
}
