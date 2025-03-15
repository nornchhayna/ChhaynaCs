<?php
function getProducts()
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_product");
    if ($query->num_rows) {
        return $query;
    }
    return null;
}
function getProductByID($id)
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_product WHERE id_product = '$id'");
    if ($query->num_rows) {
        return $query->fetch_object();
    }
    return null;
}
function getProductCategory($id)
{

    global $db;
    $query = $db->query("SELECT * FROM tbl_category INNER JOIN tbl_product_category ON tbl_category.id_category = tbl_product_category  WHERE id_product = '$id'");
    if ($query->num_rows) {

        return $query;
    }
    return null;
}

function productNameExists($name)
{
    global $db;
    $query = $db->query("SELECT id_product FROM tbl_product WHERE name = '$name'");
    if ($query->num_rows) {
        return true;
    }
    return false;
}
function productSlugExists($slug)
{
    global $db;
    $query = $db->query("SELECT id_product FROM tbl_product WHERE slug = '$slug'");
    if ($query->num_rows) {
        return true;
    }
    return false;
}


function createProduct($name, $slug, $price, $short_des, $long_des, $image, $id_categories)
{
    global $db;
    $db->begin_transaction();
    try {

        $img_name = $image['name'];
        $tmp_name = $image['tmp_name'];
        $img_size = $image['size'];
        $error = $image['error'];

        $img_dir = './assets/images/';

        $allow_exs = ['jpg', 'png', 'jpeg'];

        if ($error !== 0) throw new Exception("Error uploading image.");
        if ($img_size >= 500000) throw new Exception("Image size exceeds 500KB.");

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $image_lowercase = strtolower($img_ex);
        if (!in_array($image_lowercase, $allow_exs)) throw new Exception("Invalid image type. Only JPG, PNG, and JPEG are allowed.");

        $new_image_name = uniqid("PI-") . '.' . $image_lowercase;
        $image_path = $img_dir . $new_image_name;
        move_uploaded_file($tmp_name, $image_path);

        $query = $db->prepare("INSERT INTO tbl_product (name, slug, price, qty, short_des, long_des, image) VALUES ('$name', '$slug', '$price', 0, '$short_des', '$long_des', '$image_path')");
        if (!$query->execute()) throw new Exception("Failed to insert product.");

        $id_product = $query->insert_id;
        foreach ($id_categories as $id_category) {
            $query1 = $db->prepare("INSERT INTO tbl_product_category (id_category, id_product) VALUES ('$id_category', '$id_product')");
            if (!$query1->execute()) throw new Exception("Failed to insert product category.");
        }

        $db->commit();
        return true;
    } catch (Exception $e) {
        $db->rollback();
        throw $e;
    }
}
function deleteProduct($id_product)
{
    global $db;

    $db->begin_transaction();

    try {
        if (empty($id_product) || !is_numeric($id_product)) {
            throw new Exception("Invalid product ID.");
        }

        // Fetch tv ler product details, including image path
        $query = "SELECT image FROM tbl_product WHERE id_product = $id_product";
        $result = $db->query($query);

        if ($result->num_rows === 0) {
            throw new Exception("Product not found.");
        }

        $product = $result->fetch_assoc();
        $imagePath = $product['image']; // jab yk Image file path

        //  Delete form tbl_product-category relationships
        $query_delete_categories = "DELETE FROM tbl_product_category WHERE id_product = $id_product";
        if (!$db->query($query_delete_categories)) {
            throw new Exception("Failed to delete product-category relationships: " . $db->error);
        }

        // this is the way to Delete product from tbl_product
        $query_delete_product = "DELETE FROM tbl_product WHERE id_product = $id_product";
        if (!$db->query($query_delete_product)) {
            throw new Exception("Failed to delete product: " . $db->error);
        }

        // after that Delete the image file from assets folder
        if (!empty($imagePath) && file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                throw new Exception("Failed to delete product image.");
            }
        }

        // Commit transaction
        $db->commit();
        return true;
    } catch (Exception $e) {
        // Rollback transaction on error
        $db->rollback();
        error_log($e->getMessage());
        echo "Error: " . $e->getMessage();
        return false;
    }
}
// function updateProduct($id_product, $name, $slug, $price, $short_des, $long_des, $image, $id_product_categories)
// {
//     global $db;
//     $db->begin_transaction();
//     try {
//         // Initialize image path variable
//         $image_path = null;

//         // Process image if a new one is uploaded
//         if ($image && $image['size'] > 0) {
//             $img_name = $image['name'];
//             $tmp_name = $image['tmp_name'];
//             $img_size = $image['size'];
//             $error = $image['error'];
//             $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
//             $image_lowercase = strtolower($img_ex);
//             if (!in_array($image_lowercase, $allow_exs)) throw new Exception("Invalid image type. Only JPG, PNG, and JPEG are allowed.");

//             $new_image_name = uniqid("PI-") . '.' . $image_lowercase;
//             $image_path = $img_dir . $new_image_name;
//             move_uploaded_file($tmp_name, $image_path);

//             // Update product with new image
//             $query = $db->prepare("UPDATE tbl_product SET name = '$name', slug = '$slug', price = '$price', short_des = '$short_des', long_des = '$long_des', image = '$image_path' WHERE id = '$id_product'");
//         } else {
//             // Update product without changing the image
//             $query = $db->prepare("UPDATE tbl_product SET name = '$name', slug = '$slug', price = '$price', short_des = '$short_des', long_des = '$long_des' WHERE id = '$id_product'");
//         }

//         if (!$query->execute()) throw new Exception("Failed to update product.");

//         // Delete existing product categories
//         $delete_query = $db->prepare("DELETE FROM tbl_product_category WHERE id_product = '$id_product'");
//         if (!$delete_query->execute()) throw new Exception("Failed to delete existing product categories.");

//         // Insert new product categories
//         foreach ($id_product_categories as $id_product_category) {
//             $query1 = $db->prepare("INSERT INTO tbl_product_category (id_category, id_product) VALUES ('$id_product_category', '$id_product')");
//             if (!$query1->execute()) throw new Exception("Failed to insert product category.");
//         }

//         $db->commit();
//         return true;
//     } catch (Exception $e) {
//         $db->rollback();
//         throw $e;
//     }
// }