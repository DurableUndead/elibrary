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
                                <!-- <a href="/elibrary/admin/tambahbuku" class="btn btn-primary">Tambah Buku</a> -->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahPeminjamanBuku">
                                    Tambah Peminjam Buku
                                </button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cari Peminjam Buku..." name="searchInput" id="searchInput" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <div class="col-selector" style="display: flex; justify-content: flex-end; margin-bottom: 10px;"></div>
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Admin Penanggung Jawab</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Kelompok Kelas</th>
                                        <th scope="col">Buku yang dipinjam</th>
                                        <th scope="col">Jumlah Buku dipinjam</th>
                                        <th scope="col">Tanggal Peminjaman</th>
                                        <th scope="col" style="width: 15%;">Gambar Buku</th>
                                        <th scope="col">Status Buku</th> <!-- Kolom tambahan untuk gambar -->
                                        <!-- <th scope="col">Detail Buku</th> Kolom tambahan untuk gambar -->
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableData">
                                    <?php foreach ($peminjaman_buku as $index => $item) : ?>
                                        <tr>
                                            <th scope="row"><?= $index + 1; ?></th>
                                            <td><?= $item['nama_admin_peminjam_buku']; ?></td>
                                            <td><?= $item['nama_peminjam']; ?></td>
                                            <td><?= $item['kelas_peminjam']; ?></td>
                                            <td><?= $item['kelompok_kelas_peminjam']; ?></td>
                                            <td>
                                                <?php
                                                $judul_buku = $item['buku_dipinjam'];
                                                if (strlen($judul_buku) > 20) {
                                                    $judul_buku = substr($judul_buku, 0, 20) . '...';
                                                }
                                                ?>
                                                <?= $judul_buku ?>
                                            </td>
                                            <td><?= $item['jumlah_buku_dipinjam']; ?></td>
                                            <td><?= $item['tanggal_peminjaman']; ?></td>
                                            <td>
                                                <?php if (!empty($item['detail_buku'])) : ?>
                                                    <img src="/images/book/<?= $item['detail_buku']['gambar_buku']; ?>" style="width: 80%;" alt="Gambar Buku">
                                                <?php else : ?>
                                                    <img src="/images/book/default.jpg" style="width: 80%;" alt="Gambar Buku">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalTindakanPinjamBuku<?= $item['id']; ?>">
                                                    Tindakan
                                                </button>
                                            </td>
                                            <td>
                                                <div class="row my-1">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetailPinjamBuku<?= $item['id']; ?>">
                                                        Detail
                                                    </button>
                                                </div>
                                                <div class="row my-1">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEditPeminjamanBuku<?= $item['id']; ?>">
                                                        Edit
                                                    </button>
                                                </div>
                                                <div class="row my-1">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeletePeminjamanBuku<?= $item['id']; ?>">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>


                                        <!-- Modal Tindakan Pinjam Buku -->
                                        <div class="modal fade" id="modalTindakanPinjamBuku<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalTindakanPinjamBukuLabel<?= $item['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTindakanPinjamBukuLabel<?= $item['id']; ?>">Tindakan Pinjam Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="/elibrary/admin/data-peminjaman-buku/action/<?= $item['id']; ?>" method="POST">
                                                        <div class="modal-body">

                                                            <input type="hidden" name="nama_admin_peminjam_buku" value="<?= $item['nama_admin_peminjam_buku']; ?>">
                                                            <input type="hidden" name="nama_peminjam" value="<?= $item['nama_peminjam']; ?>">
                                                            <input type="hidden" name="kelas_peminjam" value="<?= $item['kelas_peminjam']; ?>">
                                                            <input type="hidden" name="kelompok_kelas_peminjam" value="<?= $item['kelompok_kelas_peminjam']; ?>">
                                                            <input type="hidden" name="buku_dipinjam" value="<?= $item['buku_dipinjam']; ?>">
                                                            <input type="hidden" name="jumlah_buku_dipinjam" value="<?= $item['jumlah_buku_dipinjam']; ?>">
                                                            <input type="hidden" name="tanggal_peminjaman" value="<?= $item['tanggal_peminjaman']; ?>">
                                                            <input type="hidden" name="tanggal_pengembalian" value="<?php echo date('Y-m-d'); ?>">
                                                            <input type="hidden" name="nama_admin_peminjam_buku" value="<?= $item['nama_admin_peminjam_buku']; ?>">
                                                            <!-- Input Jumlah Buku Dikembalikan -->
                                                            <div class="mb-3">
                                                                <label for="jumlahBukuDikembalikan<?= $item['id']; ?>" class="form-label">Jumlah Buku Dikembalikan:</label>
                                                                <input type="number" class="form-control" id="jumlahBukuDikembalikan" name="jumlahBukuDikembalikan" value="<?= $item['jumlah_buku_dipinjam']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Kembalikan Buku</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Delete Peminjam Buku -->
                                        <div class="modal fade" id="ModalDeletePeminjamanBuku<?= $item['id']; ?>" tabindex="-1" aria-labelledby="ModalDeletePeminjamanBukuLabel<?= $item['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalDeletePeminjamanBukuLabel<?= $item['id']; ?>">Konfirmasi Hapus Peminjam Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus buku ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="/elibrary/admin/data-peminjaman-buku/delete/<?= $item['id']; ?>" method="POST" class="d-inline" id="deleteForm<?= $item['id']; ?>">
                                                            <button type="submit" class="btn btn-danger">Hapus Peminjam Buku</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Detail Peminjaman Buku -->
                                        <div class="modal fade" id="modalDetailPinjamBuku<?= $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailPinjamBukuLabel<?= $item['id']; ?>Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalDetailPinjamBukuLabel<?= $item['id']; ?>Label">Detail Peminjaman Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5>Detail Identitas Peminjam</h2>
                                                                    <h6>Nama: <?= $item['nama_peminjam']; ?></h6>
                                                                    <h6>Kelas: <?= $item['kelas_peminjam']; ?></h6>
                                                                    <h6>Kelompok Kelas: <?= $item['kelompok_kelas_peminjam']; ?></h6>

                                                                    <?php if (!empty($item['detail_peminjam'])) : ?>
                                                                        <h6>Jenis Kelamin: <?= $item['detail_peminjam']['jenis_kelamin']; ?></h6>
                                                                        <h6>Tanggal Lahir: <?= $item['detail_peminjam']['tanggal_lahir']; ?></h6>
                                                                        <h6>Wali Kelas: <?= $item['detail_peminjam']['wali_kelas']; ?></h6>
                                                                    <?php elseif (empty($item['detail_peminjam'])) : ?>
                                                                        <h6>Jenis Kelamin: -</h6>
                                                                        <h6>Tanggal Lahir: -</h6>
                                                                        <h6>Wali Kelas: -</h6>
                                                                    <?php endif; ?>
                                                            </div>
                                                            <div class="col">
                                                                <h5>Detail Data Buku</h2>
                                                                    <h6>Buku yang Dipinjam: <?= $item['buku_dipinjam']; ?></h6>

                                                                    <?php if (!empty($item['detail_buku'])) : ?>
                                                                        <h6>Pengarang: <?= $item['detail_buku']['pengarang']; ?></h6>
                                                                        <h6>Penerbit: <?= $item['detail_buku']['penerbit']; ?></h6>
                                                                        <h6>Tahun Terbit: <?= $item['detail_buku']['tahun_terbit']; ?></h6>
                                                                        <h6>Kategori: <?= $item['detail_buku']['kategori']; ?></h6>
                                                                        <h6>Jumlah Buku: <?= $item['detail_buku']['jumlah_buku']; ?></h6>
                                                                    <?php elseif (empty($item['detail_buku'])) : ?>
                                                                        <h6>Pengarang: -</h6>
                                                                        <h6>Penerbit: -</h6>
                                                                        <h6>Tahun Terbit: -</h6>
                                                                        <h6>Kategori: -</h6>
                                                                        <h6>Jumlah Buku: -</h6>
                                                                    <?php endif; ?>
                                                            </div>
                                                            <div class="col">
                                                                <?php if (!empty($item['detail_buku'])) : ?>
                                                                    <img src="/images/book/<?= $item['detail_buku']['gambar_buku']; ?>" style="width: 80%;" alt="Gambar Buku">
                                                                <?php else : ?>
                                                                    <div class="bg-dark text-center" style="height: 100%;">
                                                                        <img src="/images/book/default.jpg" alt="Gambar Buku" style="width: 80%;">
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Edit Peminjam Buku -->
                                        <div class="modal fade" id="ModalEditPeminjamanBuku<?= $item['id']; ?>" tabindex="-1" aria-labelledby="ModalEditPeminjamanBukuLabel<?= $item['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalEditPeminjamanBukuLabel<?= $item['id']; ?>">Tambah Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/elibrary/admin/data-peminjaman-buku/edit/<?= $item['id']; ?>" method="POST">
                                                            <div class="mb-3">
                                                                <label for="namaAdminEditPeminjaman" class="form-label">Nama Admin Pemberi pinjaman buku (Penanggung Jawab)</label>
                                                                <select class="form-select" id="namaAdminEditPeminjaman" name="namaAdminEditPeminjaman" required>
                                                                    <?php foreach ($admin as $admin3) : ?>
                                                                        <option value="<?= $admin3['nama']; ?>" <?php if ($user['nama'] == $admin3['nama']) echo 'selected'; ?>><?= $admin3['nama']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kelasEditPeminjamanID" class="form-label">Kelas (Kelas Sebelumnya : <?= $item['kelas_peminjam'] ?>)</label>
                                                                <select class="form-select" id="kelasEditPeminjamanID" name="kelasEditPeminjaman" required>
                                                                    <option value="">Pilih Kelas</option>
                                                                    <option value="1" <?php if ($item['kelas_peminjam'] == '1') echo 'selected'; ?>>Kelas 1</option>
                                                                    <option value="2" <?php if ($item['kelas_peminjam'] == '2') echo 'selected'; ?>>Kelas 2</option>
                                                                    <option value="3" <?php if ($item['kelas_peminjam'] == '3') echo 'selected'; ?>>Kelas 3</option>

                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kelompokKelasEditPeminjamanID" class="form-label">Kelompok Kelas (Kelompok Kelas Sebelumnya : <?= $item['kelompok_kelas_peminjam'] ?>)</label>
                                                                <select class="form-select" id="kelompokKelasEditPeminjamanID" name="kelompokKelasEditPeminjaman" required>
                                                                    <option value="">Pilih Kelompok</option>
                                                                    <?php
                                                                    for ($i = 65; $i <= 72; $i++) {
                                                                        $kelompok_kelas = chr($i);
                                                                        $selected = ($kelompok_kelas == $item['kelompok_kelas_peminjam']) ? 'selected' : '';
                                                                        echo "<option value='$kelompok_kelas' $selected>$kelompok_kelas</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="namaPeminjamEditPeminjamanID" class="form-label">Nama Peminjam (Nama Sebelumnya : <?= $item['nama_peminjam'] ?> )</label>
                                                                <select class="form-select" id="namaPeminjamEditPeminjamanID" name="namaPeminjamEditPeminjaman" required>
                                                                    <option value="">Pilih Nama</option>
                                                                    <?php
                                                                    foreach ($daftar_murid as $murid) {
                                                                        if ($murid['kelas'] == $item['kelas_peminjam'] && $murid['kelompok_kelas'] == $item['kelompok_kelas_peminjam']) {
                                                                            $selected = ($murid['nama'] == $item['nama_peminjam']) ? 'selected' : '';
                                                                            echo "<option value='{$murid['nama']}' $selected>{$murid['nama']}</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="judulBukuEditPeminjaman" class="form-label">Nama Buku</label>
                                                                <select class="form-select" id="judulBukuEditPeminjaman" name="judulBukuEditPeminjaman" required>
                                                                    <option value="">Pilih Buku</option>
                                                                    <?php foreach ($buku as $buku2) : ?>
                                                                        <option value="<?= $buku2['judul_buku']; ?>" <?= ($buku2['judul_buku'] == $item['buku_dipinjam']) ? 'selected' : ''; ?>>
                                                                            <?= $buku2['judul_buku']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="tanggalPinjamEditPeminjaman" class="form-label">Tanggal Pinjam</label>
                                                                <input type="date" class="form-control" id="tanggalPinjamEditPeminjaman" name="tanggalPinjamEditPeminjaman" value="<?= $item['tanggal_peminjaman']; ?>" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="jumlahBukuDipinjamEditPeminjaman" class="form-label">Jumlah Buku yang dipinjam</label>
                                                                <input type="number" class="form-control" id="jumlahBukuDipinjamEditPeminjaman" name="jumlahBukuDipinjamEditPeminjaman" value="<?= $item['jumlah_buku_dipinjam']; ?>" required>
                                                                <input type="hidden" class="form-control" id="jumlahBukuBekasEditPeminjaman" name="jumlahBukuBekasEditPeminjaman" value="<?= $item['jumlah_buku_dipinjam']; ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Peminjam Buku -->
    <div class="modal fade" id="ModalTambahPeminjamanBuku" tabindex="-1" aria-labelledby="ModalTambahPeminjamanBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTambahPeminjamanBukuLabel">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/elibrary/admin/data-peminjaman-buku/create" method="POST">
                        <!-- <input type="hidden" class="form-control" id="namaAdminTambahPeminjaman" name="namaAdminTambahPeminjaman" value="<2php echo $user['nama'] ?>"> -->
                        <div class="mb-3">
                            <label for="namaAdminTambahPeminjaman" class="form-label">Nama Admin Pemberi pinjaman buku (Penanggung Jawab)</label>
                            <select class="form-select" id="namaAdminTambahPeminjaman" name="namaAdminTambahPeminjaman" required>
                                <option value="">Pilih Nama Admin</option>
                                <?php foreach ($admin as $admin2) : ?>
                                    <option value="<?= $admin2['nama']; ?>"><?= $admin2['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas" name="kelasTambahPeminjaman" required>
                                <option value="">Pilih Kelas</option>
                                <option value="1">Kelas 1</option>
                                <option value="2">Kelas 2</option>
                                <option value="3">Kelas 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelompok_kelas" class="form-label">Kelompok Kelas</label>
                            <select class="form-select" id="kelompok_kelas" name="kelompokKelasTambahPeminjaman" required>
                                <option value="">Pilih Kelompok</option>
                                <?php
                                for ($i = 65; $i <= 72; $i++) {
                                    $kelompok_kelas = chr($i);
                                    echo "<option value='$kelompok_kelas'>$kelompok_kelas</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                            <select class="form-select" id="nama_peminjam" name="namaPeminjamTambahPeminjaman" required>
                                <option value="">Pilih Nama</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="judul_buku" class="form-label">Nama Buku</label>
                            <select class="form-select" id="judul_buku" name="judulBukuTambahPeminjaman" required>
                                <option value="">Pilih Buku</option>
                                <?php
                                foreach ($buku as $buku3) {
                                    $judul_buku = $buku3['judul_buku'];
                                    if (strlen($judul_buku) > 50) {
                                        $judul_buku = substr($judul_buku, 0, 50) . '...';
                                    }
                                    echo "<option value='" . $buku3['judul_buku'] . "'>" . $judul_buku . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggalPinjamTambahPeminjaman" required>
                        </div>

                        <div class="mb-3">
                            <label for="jumlahBukuDipinjam" class="form-label">Jumlah Buku yang dipinjam</label>
                            <input type="number" class="form-control" id="jumlahBukuDipinjam" name="jumlahBukuDipinjamTambahPeminjaman" placeholder="" required>
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

    <script>
        const kelasEditPeminjamanSelect = document.getElementById('kelasEditPeminjamanID');
        const kelompokKelasEditPeminjamanSelect = document.getElementById('kelompokKelasEditPeminjamanID');
        const namaPeminjamEditSelect = document.getElementById('namaPeminjamEditPeminjamanID');

        kelasEditPeminjamanSelect.addEventListener('change', updateNamaEditPeminjamOptions);
        kelompokKelasEditPeminjamanSelect.addEventListener('change', updateNamaEditPeminjamOptions);

        function updateNamaEditPeminjamOptions() {
            const selectedEditKelas = kelasEditPeminjamanSelect.value;
            const selectedEditKelompokKelas = kelompokKelasEditPeminjamanSelect.value;

            namaPeminjamEditSelect.innerHTML = '<option value="">Pilih Nama</option>';

            if (selectedEditKelas !== '' && selectedEditKelompokKelas !== '') {
                <?php foreach ($daftar_murid as $index => $item22) : ?>
                    if ('<?= $item22['kelas'] ?>' === selectedEditKelas && '<?= $item22['kelompok_kelas'] ?>' === selectedEditKelompokKelas) {
                        const option = document.createElement('option');
                        option.value = '<?= $item22['nama'] ?>';
                        option.textContent = '<?= $item22['nama'] ?>';
                        namaPeminjamEditSelect.appendChild(option);
                    }
                <?php endforeach; ?>
            }
        }
    </script>


    <script>
        const kelasSelect = document.getElementById('kelas');
        const kelompokKelasSelect = document.getElementById('kelompok_kelas');
        const namaPeminjamSelect = document.getElementById('nama_peminjam');

        kelasSelect.addEventListener('change', updateNamaPeminjamOptions);
        kelompokKelasSelect.addEventListener('change', updateNamaPeminjamOptions);

        function updateNamaPeminjamOptions() {
            const selectedKelas = kelasSelect.value;
            const selectedKelompokKelas = kelompokKelasSelect.value;

            namaPeminjamSelect.innerHTML = '<option value="">Pilih Nama</option>';

            if (selectedKelas !== '' && selectedKelompokKelas !== '') {
                <?php foreach ($daftar_murid as $index => $item) : ?>
                    if ('<?= $item['kelas'] ?>' === selectedKelas && '<?= $item['kelompok_kelas'] ?>' === selectedKelompokKelas) {
                        const option = document.createElement('option');
                        option.value = '<?= $item['nama'] ?>';
                        option.textContent = '<?= $item['nama'] ?>';
                        namaPeminjamSelect.appendChild(option);
                    }
                <?php endforeach; ?>
            }
        }
    </script>

    <script>
        const buku_terpilih = document.getElementById("judul_buku");
        const inputJumlahBuku = document.getElementById("jumlahBukuDipinjam");

        buku_terpilih.addEventListener('change', updatePlaceholder);

        function updatePlaceholder() {
            const selectedBuku = buku_terpilih.value;

            if (selectedBuku !== '') {
                <?php foreach ($buku as $buku4) : ?>
                    if ('<?= $buku4['judul_buku'] ?>' === selectedBuku) {
                        const jumlah_buku_tersisa = <?= $buku4['jumlah_buku']; ?>;
                        inputJumlahBuku.placeholder = "Buku tersisa: " + jumlah_buku_tersisa;
                    }
                <?php endforeach; ?>
            }
        }
    </script>