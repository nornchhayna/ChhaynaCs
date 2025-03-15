<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Product List</h1>

        <div>
            <a href="./?page=product/create" class="btn btn-sm btn-success px-4 py-2 rounded-pill">Add product</a>
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
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>short Des</th>
                        <th>long Des</th>
                        <th>image</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $manage_products = getProducts();
                    if ($manage_products !== null) {
                        while ($row = $manage_products->fetch_object()) {
                    ?>
                            <tr>
                                <td><?php echo $row->id_product; ?></td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo $row->slug; ?></td>
                                <td><?php echo $row->price; ?></td>
                                <td><?php echo $row->qty; ?></td>
                                <td><?php echo $row->short_des; ?></td>
                                <td><?php echo $row->long_des; ?></td>
                                <td><img width="100px" src="<?php echo $row->image; ?>" style="width = 100px;" alt=""></td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="./?page=product/update&id=<?php echo $row->id_product; ?>">Update</a>
                                    <a class="btn btn-danger btn-sm"
                                        href="./?page=product/delete&id=<?php echo $row->id_product; ?>">Delete</a>
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