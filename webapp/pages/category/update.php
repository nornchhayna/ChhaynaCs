<?php
if (!isset($_GET['id']) || getCategoryByID(intval($_GET['id'])) === null) {
    header('Location: ./?page=category/home');
    exit();
}

$id_category = intval($_GET['id']);
$manage_category = getCategoryByID($id_category);

$name_err = $slug_err = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);

    if (empty($name)) {
        $name_err = "Name is required!";
    } else {
        if ($name !== $manage_category->name && categoryNameExists($name)) {
            $name_err = "Slug already exists!";
        }
    }

    if (empty($slug)) {
        $slug_err = "Slug is required!";
    } else {
        if ($slug !== $manage_category->slug && categorySlugExists($slug)) {
            $slug_err = "Slug already exists!";
        }
    }

    if (empty($name_err) && empty($slug_err)) {
        if (updateCategory($id_category, $name, $slug)) {
            echo '<div class="alert alert-success" role="alert">Category has been updated successful! <a href="./?page=category/home">category page</a></div>';
            header("Location: ./?page=category/home");
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Category update failed.</div>';
        }
    }
}
?>

<form action="./?page=category/update&id=<?php echo $manage_category->id_category ?>" method="post" class="w-50 mx-auto">
    <h1>Update Category</h1>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text"
            name="name"
            class="form-control <?php echo !empty($name_err) ? 'is-invalid' : ''; ?>"
            value="<?php echo htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : $manage_category->name); ?>">

        <div class="invalid-feedback">
            <?php echo $name_err; ?>
        </div>
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text"
            name="slug"
            class="form-control <?php echo !empty($slug_err) ? 'is-invalid' : ''; ?>"
            value="<?php echo htmlspecialchars(isset($_POST['slug']) ? $_POST['slug'] : $manage_category->slug); ?>">

        <div class="invalid-feedback">
            <?php echo $slug_err; ?>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="./?page=category/home" role="button" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>