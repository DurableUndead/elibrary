<!-- daftar buku html -->
<div class="p-1 my-container active-cont">
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-md-12 my-4">
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success">
                        <?= session('success') ?>
                    </div>
                <?php elseif (session()->has('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <h1>Kategori</h1>
                    <!-- <div class="row"> -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="searchInput" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="searchInput" placeholder="Masukkan nama kategori">
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">Tambah Kategori</button>
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableData">
                                <?php foreach ($kategori_buku as $index => $item) : ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1; ?></th>
                                        <td class="nama-kategori"><?= $item['nama_kategori']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditKategori<?= $item['id']; ?>">Edit</button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteKategori<?= $item['id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit Kategori -->
                                    <div class="modal fade" id="modalEditKategori<?= $item['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="/elibrary/admin/daftar-kategori-buku/edit/<?= $item['id']; ?>" method="POST">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="edit-kategori<?= $item['id']; ?>" class="form-label">Nama Kategori</label>
                                                            <input type="text" class="form-control" id="edit-kategori<?= $item['id']; ?>" name="edit-kategori" value="<?= $item['nama_kategori']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus Kategori -->
                                    <div class="modal fade" id="modalDeleteKategori<?= $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Hapus Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <form action="/elibrary/admin/daftar-kategori-buku/delete/<?= $item['id']; ?>" method="POST" style="display: inline;">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- </div>  -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/elibrary/admin/daftar-kategori-buku/create" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kategori_baru" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="kategori_baru" name="kategori_baru" placeholder="Masukkan nama kategori" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tableData tr").filter(function() {
                    $(this).toggle($(this).find(".nama-kategori").text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>