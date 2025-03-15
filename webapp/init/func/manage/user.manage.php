<?php
function getUsers()
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_user");

    if ($query->num_rows) {


        return $query;
    }
    return null;
}
function createUser($user_label, $username, $password)
{
    global $db;

    $query = $db->prepare("INSERT INTO tbl_user (user_label, username, password, level) VALUES ('$user_label', '$username', '$password', 'User')");

    if ($query->execute()) {
        return true;
    }
    return false;
}



function getUserByID($id)
{
    global $db;
    $query = $db->query("SELECT id_user,user_label,level FROM tbl_user WHERE id_user = '$id' AND level='User'");

    if ($query->num_rows) {


        return $query->fetch_object();
    }
    return null;
}
function updateUser($id, $user_label, $username, $password)
{
    global $db;

    if (empty($username)) {
        $username = "";
    } else {
        $username_query = ", username ='$username'";
    }
    if (empty($password)) {
        $password = "";
    } else {
        $password_query = ", username ='$password'";
    }
    $db->query("UPDATE tbl_user SET user_label = '$user_label' " . $username_query . "" . $password_query . " WHERE id_user = '$id' ");
    if ($db->affected_rows) {
        return true;
    }
    return false;
}

function deleteUser($id)
{
    global $db;
    $db->query("DELETE FROM tbl_user WHERE id_user = '$id'");
    if ($db->affected_rows) {
        return true;
    }
    return false;
}
