<?php
if (!isset($_GET['id']) || getProductByID(intval($_GET['id'])) === null) {
    header('Location: ./?page=product/home');
    exit();
}

$id_product = intval($_GET['id']);
$manage_product = getProductByID($id_product);

$id_product_category = [];
while ($row = $manage_categories->fetch_object()) {
    $id_product_category[] = $row->category;
}


$name_err = $slug_err = $price_err = $short_des_err = $long_des_err = $image_err = '';

?>



<form action="./?page=product/update" method="post" class="w-50 mx-auto" enctype="multipart/form-data">
    <h1>Create Product</h1>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control <?php echo $name_err !== '' ? 'is-invalid' : '' ?>"
            value="<?php echo isset($_POST['name']) ? $_POST['name'] : $manage_product->name ?>">
        <div class="invalid-feedback">
            <?php echo $name_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control <?php echo $slug_err !== '' ? 'is-invalid' : '' ?>"
            value="<?php echo isset($_POST['slug']) ? $_POST['slug'] :  $manage_product->slug ?>">
        <div class="invalid-feedback">
            <?php echo $slug_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" class="form-control <?php echo $price_err !== '' ? 'is-invalid' : '' ?>"
            value="<?php echo isset($_POST['price']) ? $_POST['price'] : $manage_product->price ?>">
        <div class="invalid-feedback">
            <?php echo $price_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="short_des" class="form-label">Short Description</label>
        <textarea name="short_des"
            class="form-control <?php echo $short_des_err !== '' ? 'is-invalid' : '' ?>"><?php echo isset($_POST['short_des']) ? $_POST['short_des'] :  $manage_product->short_des ?></textarea>
        <div class="invalid-feedback">
            <?php echo $short_des_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="long_des" class="form-label">Long Description</label>
        <textarea name="long_des"
            class="form-control <?php echo $long_des_err !== '' ? 'is-invalid' : '' ?>"><?php echo isset($_POST['long_des']) ? $_POST['long_des'] :  $manage_product->long_des ?></textarea>
        <div class="invalid-feedback">
            <?php echo $long_des_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="product-image" class="form-label">Select Product Image</label>
        <input name="image" class="form-control <?php echo $image_err !== '' ? 'is-invalid' : '' ?>" type="file"
            id="product-image">
        <div class="invalid-feedback">
            <?php echo $image_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Categories</label>
        <?php
        $manage_categories = getCategories();
        if ($manage_categories !== null) {
            while ($row = $manage_categories->fetch_object()) {
                $checked = in_array($row->category, $id_product_category) ? 'checked' : '';
        ?>
                <div class="form-check">
                    <input <?php echo $checked ?> name="id_categories[]" class="form-check-input" type="checkbox"
                        value="<?php echo $row->id_category ?>" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        <?php echo $row->name ?>
                    </label>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="d-flex justify-content-between">
        <a href="./?page=product/home" role="button" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-success">Create</button>
    </div>
</form>