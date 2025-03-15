<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4 fw-bold text-primary">User List</h1>

        <div>
            <a href="./?page=user/create" class="btn btn-sm btn-success rounded-pill px-4 py-2 shadow-sm">Add User</a>
        </div>
    </div>

    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <table class="table table-hover table-striped table-bordered table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User Label</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $manage_users = getUsers();
                    if ($manage_users !== null) {
                        while ($row = $manage_users->fetch_object()) {
                    ?>
                            <tr>
                                <td><?php echo $row->id_user; ?></td>
                                <td><?php echo $row->user_label; ?></td>
                                <td><?php echo $row->username; ?></td>
                                <td><?php echo $row->level; ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm rounded-pill px-3 py-1 shadow-sm" href="./?page=user/update&id=<?php echo $row->id_user ?>">Update</a>
                                    <a class="btn btn-danger btn-sm rounded-pill px-3 py-1 shadow-sm" href="./?page=user/delete&id=<?php echo $row->id_user ?>">Delete</a>
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