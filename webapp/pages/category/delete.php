<?php
if (!isset($_GET['id']) || !getCategoryByID($_GET['id']) === null) {
    header('Location: ./?page=category/home');
}
if (deleteCategory($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">Category has been deleted! <a href="./?page=category/home">category page</a></div>';
    header("Location: ./?page=category/home");
    exit();
} else {
    echo '<div class="alert alert-danger" role="alert">category can not  delete!
    !<a href="./?page=category/home">category page</a></div>';
}
