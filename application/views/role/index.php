<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <!-- Pesan error atau sukses (jika ada) -->
            <?= $this->session->flashdata('message'); ?>

            <!-- Tabel daftar role -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($roles) && !empty($roles)): ?>
                        <?php foreach ($roles as $role): ?>
                            <tr>
                                <th scope="row"><?= $role['id']; ?></th>
                                <td><?= $role['role']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success">edit</a>
                                    <a href="" class="badge badge-danger">delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No roles available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Tombol untuk menambah role -->
            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

        </div>
    </div>
</div>

<!-- Modal untuk menambah role -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('role/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="role" name="role" placeholder="Enter role name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </div>
            </form>
        </div>
    </div>
</div>