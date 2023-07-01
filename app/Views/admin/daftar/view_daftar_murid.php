<!-- Main Wrapper -->
<div class="p-1 my-container active-cont my-5">
    <div class="container-fluid">
        <div class="my-5">
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
                <!-- Button untuk membuka modal -->
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMurid">
                            Tambah Murid Semua Kelas
                        </button>
                    </div>

                </div>
                <div class="row">
                    <div class="col d-flex justify-content-between mb-2 my-2">
                        <h2>Kelas 1</h2>
                        <div class="col-auto">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari Murid Kelas 1" name="searchInputKelas1" id="searchInputKelas1" autocomplete="off">
                            </div>
                        </div>
                        <button id="toggle-kelas-1" class="btn btn-primary btn-sm">Show/Hide Kelas 1</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tabel-kelas-1" class="table table-striped table-bordered border border-3">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>ID. </th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Kelompok Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            <?php $noKelas1 = 0; ?>
                            <?php foreach ($daftar_murid as $index => $item) : ?>
                                <?php if ($item['kelas'] == '1') : ?>
                                    <tr>
                                        <th scope="row"><?= ++$noKelas1 ?></th>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['nisn'] ?></td>
                                        <td><?= $item['nama'] ?></td>
                                        <td><?= $item['kelas'] ?></td>
                                        <td><?= $item['kelompok_kelas'] ?></td>
                                        <td><?= $item['jenis_kelamin'] ?></td>
                                        <td><?= $item['tanggal_lahir'] ?></td>
                                        <td><?= $item['wali_kelas'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditMuridKelas1<?= $item['id']; ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteMuridKelas1<?= $item['id']; ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal Delete Murid -->
                                    <div class="modal fade" id="modalDeleteMuridKelas1<?= $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $item['id']; ?>" aria-hidden="true">
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
                                                    <form action="/elibrary/admin/daftar-murid/delete/<?= $item['id']; ?>" method="POST" class="d-inline" id="deleteForm<?= $item['id']; ?>">
                                                        <button type="submit" class="btn btn-danger">Hapus Buku</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Edit Murid -->
                                    <div class="modal fade" id="modalEditMuridKelas1<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalEditMuridKelas1Label<?= $item['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditMuridKelas1Label<?= $item['id']; ?>">Edit Murid</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/elibrary/admin/daftar-murid/edit/<?= $item['id']; ?>" method="POST">
                                                        <div class="mb-3">
                                                            <label for="nisn" class="form-label">NISN</label>
                                                            <input type="text" class="form-control" id="nisn" name="nisnEdit" value="<?= $item['nisn'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Nama</label>
                                                            <input type="text" class="form-control" id="nama" name="namaEdit" value="<?= $item['nama'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kelas" class="form-label">Kelas</label>
                                                            <select class="form-select" id="kelas" name="kelasEdit" required>
                                                                <option value="">Pilih Kelas</option>
                                                                <option value="1" <?php if ($item['kelas'] == '1') echo 'selected'; ?>>Kelas 1</option>
                                                                <option value="2" <?php if ($item['kelas'] == '2') echo 'selected'; ?>>Kelas 2</option>
                                                                <option value="3" <?php if ($item['kelas'] == '3') echo 'selected'; ?>>Kelas 3</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kelompok_kelas" class="form-label">Kelompok Kelas</label>
                                                            <select class="form-select" id="kelompok_kelas" name="kelompok_kelasEdit" required>
                                                                <option value="">Pilih Kelompok</option>
                                                                <?php
                                                                //90 = Z
                                                                for ($i = 65; $i <= 72; $i++) {
                                                                    $kelompok_kelas = chr($i);
                                                                    $selected = ($kelompok_kelas == $item['kelompok_kelas']) ? 'selected' : '';
                                                                    echo "<option value='$kelompok_kelas' $selected>$kelompok_kelas</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                            <select class="form-select" id="jenis_kelamin" name="jenis_kelaminEdit" required>
                                                                <option value="">Pilih Jenis Kelamin</option>
                                                                <option value="L" <?php if ($item['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                                                                <option value="P" <?php if ($item['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahirEdit" value="<?= $item['tanggal_lahir'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="wali_kelas" class="form-label">Wali Kelas</label>
                                                            <input type="text" class="form-control" id="wali_kelas" name="wali_kelasEdit" value="<?= $item['wali_kelas'] ?>" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col">
                        <hr class="border border-5 border-gray">
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-between mb-2">
                        <h2>Kelas 2</h2>
                        <div class="col-auto">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari Murid Kelas 2" name="searchInputKelas2" id="searchInputKelas2" autocomplete="off">
                            </div>
                        </div>
                        <button id="toggle-kelas-2" class="btn btn-primary btn-sm">Show/Hide Kelas 2</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tabel-kelas-2" class="table table-striped table-bordered border border-3">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>ID. </th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Kelompok Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $noKelas2 = 0; ?>
                            <?php foreach ($daftar_murid as $index => $item) : ?>
                                <?php if ($item['kelas'] == '2') : ?>
                                    <tr>
                                        <th scope="row"><?= ++$noKelas2 ?></th>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['nisn'] ?></td>
                                        <td><?= $item['nama'] ?></td>
                                        <td><?= $item['kelas'] ?></td>
                                        <td><?= $item['kelompok_kelas'] ?></td>
                                        <td><?= $item['jenis_kelamin'] ?></td>
                                        <td><?= $item['tanggal_lahir'] ?></td>
                                        <td><?= $item['wali_kelas'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditMuridKelas2<?= $item['id']; ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteMuridKelas2<?= $item['id']; ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal Delete Murid -->
                                    <div class="modal fade" id="modalDeleteMuridKelas2<?= $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $item['id']; ?>" aria-hidden="true">
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
                                                    <form action="/elibrary/admin/daftar-murid/delete/<?= $item['id']; ?>" method="POST" class="d-inline" id="deleteForm<?= $item['id']; ?>">
                                                        <button type="submit" class="btn btn-danger">Hapus Buku</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Edit Murid -->
                                    <div class="modal fade" id="modalEditMuridKelas2<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalEditMuridKelas2Label<?= $item['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditMuridKelas2Label<?= $item['id']; ?>">Edit Murid</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/elibrary/admin/daftar-murid/edit/<?= $item['id']; ?>" method="POST">
                                                        <div class="mb-3">
                                                            <label for="nisn" class="form-label">NISN</label>
                                                            <input type="text" class="form-control" id="nisn" name="nisnEdit" value="<?= $item['nisn'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Nama</label>
                                                            <input type="text" class="form-control" id="nama" name="namaEdit" value="<?= $item['nama'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kelas" class="form-label">Kelas</label>
                                                            <select class="form-select" id="kelas" name="kelasEdit" required>
                                                                <option value="">Pilih Kelas</option>
                                                                <option value="1" <?php if ($item['kelas'] == '1') echo 'selected'; ?>>Kelas 1</option>
                                                                <option value="2" <?php if ($item['kelas'] == '2') echo 'selected'; ?>>Kelas 2</option>
                                                                <option value="3" <?php if ($item['kelas'] == '3') echo 'selected'; ?>>Kelas 3</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kelompok_kelas" class="form-label">Kelompok Kelas</label>
                                                            <select class="form-select" id="kelompok_kelas" name="kelompok_kelasEdit" required>
                                                                <option value="">Pilih Kelompok</option>
                                                                <?php
                                                                //90 = Z
                                                                for ($i = 65; $i <= 72; $i++) {
                                                                    $kelompok_kelas = chr($i);
                                                                    $selected = ($kelompok_kelas == $item['kelompok_kelas']) ? 'selected' : '';
                                                                    echo "<option value='$kelompok_kelas' $selected>$kelompok_kelas</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                            <select class="form-select" id="jenis_kelamin" name="jenis_kelaminEdit" required>
                                                                <option value="">Pilih Jenis Kelamin</option>
                                                                <option value="L" <?php if ($item['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                                                                <option value="P" <?php if ($item['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahirEdit" value="<?= $item['tanggal_lahir'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="wali_kelas" class="form-label">Wali Kelas</label>
                                                            <input type="text" class="form-control" id="wali_kelas" name="wali_kelasEdit" value="<?= $item['wali_kelas'] ?>" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col">
                        <hr class="border border-5 border-gray">
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-between mb-2">
                        <h2>Kelas 3</h2>
                        <div class="col-auto">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari Murid Kelas 3" name="searchInputKelas3" id="searchInputKelas3" autocomplete="off">
                            </div>
                        </div>
                        <button id="toggle-kelas-3" class="btn btn-primary btn-sm">Show/Hide Kelas 3</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tabel-kelas-3" class="table table-striped table-bordered border border-3">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>ID. </th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Kelompok Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $noKelas3 = 0; ?>
                            <?php foreach ($daftar_murid as $index => $item) : ?>
                                <?php if ($item['kelas'] == '3') : ?>
                                    <tr>
                                        <th scope="row"><?= ++$noKelas3 ?></th>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['nisn'] ?></td>
                                        <td><?= $item['nama'] ?></td>
                                        <td><?= $item['kelas'] ?></td>
                                        <td><?= $item['kelompok_kelas'] ?></td>
                                        <td><?= $item['jenis_kelamin'] ?></td>
                                        <td><?= $item['tanggal_lahir'] ?></td>
                                        <td><?= $item['wali_kelas'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditMuridKelas3<?= $item['id']; ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteMuridKelas3<?= $item['id']; ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal Delete Murid -->
                                    <div class="modal fade" id="modalDeleteMuridKelas3<?= $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $item['id']; ?>" aria-hidden="true">
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
                                                    <form action="/elibrary/admin/daftar-murid/delete/<?= $item['id']; ?>" method="POST" class="d-inline" id="deleteForm<?= $item['id']; ?>">
                                                        <button type="submit" class="btn btn-danger">Hapus Buku</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Edit Murid -->
                                    <div class="modal fade" id="modalEditMuridKelas3<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalEditMuridKelas3Label<?= $item['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditMuridKelas3Label<?= $item['id']; ?>">Edit Murid</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/elibrary/admin/daftar-murid/edit/<?= $item['id']; ?>" method="POST">
                                                        <div class="mb-3">
                                                            <label for="nisn" class="form-label">NISN</label>
                                                            <input type="text" class="form-control" id="nisn" name="nisnEdit" value="<?= $item['nisn'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Nama</label>
                                                            <input type="text" class="form-control" id="nama" name="namaEdit" value="<?= $item['nama'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kelas" class="form-label">Kelas</label>
                                                            <select class="form-select" id="kelas" name="kelasEdit" required>
                                                                <option value="">Pilih Kelas</option>
                                                                <option value="1" <?php if ($item['kelas'] == '1') echo 'selected'; ?>>Kelas 1</option>
                                                                <option value="2" <?php if ($item['kelas'] == '2') echo 'selected'; ?>>Kelas 2</option>
                                                                <option value="3" <?php if ($item['kelas'] == '3') echo 'selected'; ?>>Kelas 3</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kelompok_kelas" class="form-label">Kelompok Kelas</label>
                                                            <select class="form-select" id="kelompok_kelas" name="kelompok_kelasEdit" required>
                                                                <option value="">Pilih Kelompok</option>
                                                                <?php
                                                                //90 = Z
                                                                for ($i = 65; $i <= 72; $i++) {
                                                                    $kelompok_kelas = chr($i);
                                                                    $selected = ($kelompok_kelas == $item['kelompok_kelas']) ? 'selected' : '';
                                                                    echo "<option value='$kelompok_kelas' $selected>$kelompok_kelas</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                            <select class="form-select" id="jenis_kelamin" name="jenis_kelaminEdit" required>
                                                                <option value="">Pilih Jenis Kelamin</option>
                                                                <option value="L" <?php if ($item['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                                                                <option value="P" <?php if ($item['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahirEdit" value="<?= $item['tanggal_lahir'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="wali_kelas" class="form-label">Wali Kelas</label>
                                                            <input type="text" class="form-control" id="wali_kelas" name="wali_kelasEdit" value="<?= $item['wali_kelas'] ?>" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Murid -->
        <div class="modal fade" id="modalTambahMurid" tabindex="-1" aria-labelledby="modalTambahMuridLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahMuridLabel">Tambah Murid</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/elibrary/admin/daftar-murid/create" method="POST">
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisnTambah" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="namaTambah" required>
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-select" id="kelas" name="kelasTambah" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kelompok_kelas" class="form-label">Kelompok Kelas</label>
                                <select class="form-select" id="kelompok_kelas" name="kelompok_kelasTambah" required>
                                    <option value="">Pilih Kelompok</option>
                                    <?php
                                    //90 = Z
                                    for ($i = 65; $i <= 72; $i++) {
                                        $kelompok_kelas = chr($i);
                                        echo "<option value='$kelompok_kelas'>$kelompok_kelas</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelaminTambah" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahirTambah" required>
                            </div>
                            <div class="mb-3">
                                <label for="wali_kelas" class="form-label">Wali Kelas</label>
                                <input type="text" class="form-control" id="wali_kelas" name="wali_kelasTambah" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#toggle-kelas-1").click(function() {
                    $("#tabel-kelas-1").toggle();
                });

                $("#toggle-kelas-2").click(function() {
                    $("#tabel-kelas-2").toggle();
                });

                $("#toggle-kelas-3").click(function() {
                    $("#tabel-kelas-3").toggle();
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#searchInputKelas1").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#tabel-kelas-1 tr").filter(function() {
                        var rowText = $(this).text().toLowerCase();
                        var containsValue = rowText.indexOf(value) > -1;
                        $(this).toggle(containsValue);
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#searchInputKelas2").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#tabel-kelas-2 tr").filter(function() {
                        var rowText = $(this).text().toLowerCase();
                        var containsValue = rowText.indexOf(value) > -1;
                        $(this).toggle(containsValue);
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#searchInputKelas3").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#tabel-kelas-3 tr").filter(function() {
                        var rowText = $(this).text().toLowerCase();
                        var containsValue = rowText.indexOf(value) > -1;
                        $(this).toggle(containsValue);
                    });
                });
            });
        </script>