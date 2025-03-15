<?php


require_once('init/init.php');

include('includes/header.inc.php');
include('includes/navbar.inc.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    $admin_pages = [
        'user/home',
        'user/create',
        'user/update',
        'user/delete',
        'category/home',
        'category/create',
        'category/update',
        'category/delete',
        'product/home',
        'product/create',
        'product/update',
        'product/delete',
    ];
    $user_pages = [];


    $before_login_pages = ['login', 'register'];
    $after_login_pages = [
        'dashboard',
        ...$admin_pages //flate copy

    ];

    // print_r($after_login_pages);

    if (
        $page === 'logout' ||
        (in_array($page, $before_login_pages) && !LoggedInUser()) ||
        (in_array($page, $after_login_pages) && LoggedInUser())
    ) {
        if (in_array($page, $admin_pages) && !isAdmin()) {
            header('Locaation: ./');
        }

        include('pages/' . $page . '.php');
    } else {
        header(header: 'Location: ./');
    }
} else {


    include('./pages/home.php');
}


include('includes/footer.inc.php');

$db->close();
