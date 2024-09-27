<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <!-- Pesan flashdata untuk notifikasi sukses/gagal -->
            <?= $this->session->flashdata('message'); ?>



            <!-- Tabel daftar role -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($roles) && !empty($roles)): ?>
                        <?php foreach ($menu as $m): ?>
                            <tr>
                                <th scope="row"><?= $role['id']; ?></th>
                                <td><?= $role['menu']; ?></td>
                                <td>

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

        </div>
    </div>
</div>