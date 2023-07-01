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
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">
                                    Tambah Buku
                                </button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cari Buku" name="searchInput" id="searchInput" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <div class="col-selector" style="display: flex; justify-content: flex-end; margin-bottom: 10px;"></div>
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Judul Buku</th>
                                        <th scope="col">Pengarang</th>
                                        <th scope="col">Penerbit</th>
                                        <th scope="col">Tahun Terbit</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Jumlah Buku</th>
                                        <th scope="col">Gambar Buku</th> <!-- Kolom tambahan untuk gambar -->
                                        <!-- <th scope="col">Detail Buku</th> Kolom tambahan untuk gambar -->
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableData">
                                    <?php foreach ($buku as $index => $item) : ?>
                                        <tr>
                                            <th scope="row"><?= $index + 1; ?></th>
                                            <td>
                                                <?php
                                                $judul_buku = $item['judul_buku'];
                                                if (strlen($judul_buku) > 20) {
                                                    $judul_buku = substr($judul_buku, 0, 20) . '...';
                                                }
                                                ?>
                                                <?= $judul_buku; ?>
                                            </td>
                                            <td><?= $item['pengarang']; ?></td>
                                            <td><?= $item['penerbit']; ?></td>
                                            <td><?= $item['tahun_terbit']; ?></td>
                                            <td><?= $item['kategori']; ?></td>
                                            <td><?= $item['jumlah_buku']; ?></td>
                                            <!-- <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailbukumodal<?= $item['id']; ?>">
                                                Detail
                                            </button>
                                        </td> -->
                                            <!-- <td><img src="" style="width: 100px;"></td> Kolom gambar buku -->
                                            <!-- <td><img src="/public/images/book/<?= $item['gambar_buku']; ?>" style="width: 100px;"></td> -->
                                            <td><img src="/images/book/<?= $item['gambar_buku']; ?>" style="width: 100px;"></td>
                                            <td>
                                                <?= csrf_field(); ?>
                                                <div class="row my-1">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailbukumodal<?= $item['id']; ?>">
                                                        Detail
                                                    </button>
                                                </div>
                                                <div class="row my-1">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditBuku<?= $item['id']; ?>">
                                                        Edit
                                                    </button>
                                                </div>
                                                <div class="row my-1">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $item['id']; ?>">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Delete Buku Modal -->
                                        <div class="modal fade" id="deleteModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $item['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $item['id']; ?>">Konfirmasi Hapus Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus buku ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="/elibrary/admin/daftar-buku/delete/<?= $item['id']; ?>" method="POST" class="d-inline" id="deleteForm<?= $item['id']; ?>">
                                                            <button type="submit" class="btn btn-danger">Hapus Buku</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Detail Buku-->
                                        <div class="modal fade" id="detailbukumodal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?= $item['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="/images/book/<?= $item['gambar_buku']; ?>" alt="Gambar Buku" style="width: 100%;">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <h1>Keterangan Buku</h1>
                                                                <h5>Judul Buku: <?= $item['judul_buku']; ?></h5>
                                                                <p>Pengarang: <?= $item['pengarang']; ?></p>
                                                                <p>Penerbit: <?= $item['penerbit']; ?></p>
                                                                <p>Tahun Terbit: <?= $item['tahun_terbit']; ?></p>
                                                                <p>Kategori: <?= $item['kategori']; ?></p>
                                                                <p>Jumlah Buku: <?= $item['jumlah_buku']; ?></p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->

                                        <!-- Modal Edit Buku -->
                                        <div class="modal fade" id="modalEditBuku<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalEditBukuLabel<?= $item['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalEditBukuLabel<?= $item['id']; ?>">Edit Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="/images/book/<?= $item['gambar_buku']; ?>" alt="Gambar Buku" style="width: 100%;">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <!-- Form Edit Buku -->
                                                                <form action="/elibrary/admin/daftar-buku/edit/<?= $item['id']; ?>" method="POST" enctype="multipart/form-data">
                                                                    <?= csrf_field(); ?>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="mb-3">
                                                                                <label for="edit_judul_buku_<?= $item['id']; ?>" class="form-label">Judul Buku</label>
                                                                                <input type="text" class="form-control" id="edit_judul_buku_<?= $item['id']; ?>" name="edit_judul_buku" value="<?= $item['judul_buku']; ?>" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="edit_pengarang_<?= $item['id']; ?>" class="form-label">Pengarang</label>
                                                                                <input type="text" class="form-control" id="edit_pengarang_<?= $item['id']; ?>" name="edit_pengarang" value="<?= $item['pengarang']; ?>" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="edit_penerbit_<?= $item['id']; ?>" class="form-label">Penerbit</label>
                                                                                <input type="text" class="form-control" id="edit_penerbit_<?= $item['id']; ?>" name="edit_penerbit" value="<?= $item['penerbit']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="mb-3">
                                                                                <label for="edit_tahun_terbit_<?= $item['id']; ?>" class="form-label">Tahun Terbit</label>
                                                                                <input type="text" class="form-control" id="edit_tahun_terbit_<?= $item['id']; ?>" name="edit_tahun_terbit" value="<?= $item['tahun_terbit']; ?>" required>
                                                                            </div>
                                                                            <!-- <div class="mb-3">
                                                                            <label for="edit-kategori-" class="form-label">Kategori</label>
                                                                            <input type="text" class="form-control" id="edit-kategori-" name="edit-kategori" value="" required>
                                                                        </div> -->
                                                                            <div class="mb-3">
                                                                                <select class="form-select" id="edit_kategori_<?= $item['id'] ?>" name="edit_kategori" required>
                                                                                    <option name="kategori" value="">Pilih Kategori</option>
                                                                                    <?php foreach ($kategori_buku as $kategori) : ?>
                                                                                        <option name="kategori" value="<?= $kategori['nama_kategori']; ?>" <?php if ($kategori['nama_kategori'] == $item['kategori']) echo 'selected'; ?>><?= $kategori['nama_kategori']; ?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="edit_jumlah_buku_<?= $item['id']; ?>" class="form-label">Jumlah Buku</label>
                                                                                <input type="number" class="form-control" id="edit_jumlah_buku_<?= $item['id']; ?>" name="edit_jumlah_buku" value="<?= $item['jumlah_buku']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="edit_gambar_<?= $item['id']; ?>" class="form-label">Ganti Gambar Buku ?</label>
                                                                        <input type="file" class="form-control" id="edit_gambar_<?= $item['id']; ?>" name="edit_gambar_buku">
                                                                        <input type="hidden" name="edit_gambar_lama" value="<?= $item['gambar_buku']; ?>">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                    </div>
                                                                </form>
                                                                <!-- End Form Edit Buku -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Edit Buku -->
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Buku-->
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/elibrary/admin/daftar-buku/create" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="judul_buku" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
                        </div>
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang" required>
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div> -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori_select" name="kategori_select" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategori_buku as $kategori) : ?>
                                    <option name="kategori" value="<?= $kategori['nama_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                            <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_buku" class="form-label">Gambar Buku</label>
                            <input type="file" class="form-control" id="gambar_buku" name="gambar_buku">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tableData tr").filter(function() {
                    var rowText = $(this).text().toLowerCase();
                    var containsValue = rowText.indexOf(value) > -1;
                    $(this).toggle(containsValue);
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                // Menghilangkan fitur Show/Hide Columns
                dom: 'lrtip',
                // Menghilangkan fitur Search
                searching: false,
            });
        });
    </script>