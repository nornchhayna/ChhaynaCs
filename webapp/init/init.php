<?php

session_start();
//include databse connection
require_once('init/db.init.php');
//include function
require_once('func/user.func.php');

//for manage user
require_once('func/manage/user.manage.php');
require_once('func/manage/category.manage.php');
require_once('func/manage/product.manage.php');
