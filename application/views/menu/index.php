<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <!-- Pesan error atau sukses (jika ada) -->
            <?= $this->session->flashdata('message'); ?>

            <!-- Tombol tambah menu -->
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>

            <!-- Tabel daftar menu -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($menu) && !empty($menu)): ?>
                        <?php foreach ($menu as $m): ?>
                            <tr>
                                <th scope="row"><?= $m['id']; ?></th>
                                <td><?= $m['menu']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success">edit</a>
                                    <a href="" class="badge badge-danger">delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No menu available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>