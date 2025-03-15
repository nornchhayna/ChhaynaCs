<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Category List</h1>

        <div>
            <a href="./?page=category/create" class="btn btn-sm btn-success px-4 py-2 rounded-pill">Add Category</a>
        </div>
    </div>

    <div class="card shadow-lg rounded-lg bg-light">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr class="table-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $manage_categories = getCategories();
                    if ($manage_categories !== null) {
                        while ($row = $manage_categories->fetch_object()) {
                    ?>
                            <tr>
                                <td><?php echo $row->id_category; ?></td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo $row->slug; ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="./?page=category/update&id=<?php echo $row->id_category; ?>">Update</a>
                                    <a class="btn btn-danger btn-sm" href="./?page=category/delete&id=<?php echo $row->id_category; ?>">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>