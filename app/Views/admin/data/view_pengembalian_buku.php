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
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cari Pengembalian Buku..." name="searchInput" id="searchInput" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <div class="col-selector" style="display: flex; justify-content: flex-end; margin-bottom: 10px;"></div>
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Admin Penerima Buku</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Kelompok Kelas</th>
                                        <th scope="col">Buku yang dipinjam</th>
                                        <th scope="col">Jumlah Buku dipinjam</th>
                                        <th scope="col">Jumlah Buku dikembalikan</th>
                                        <th scope="col">Tanggal Peminjaman</th>
                                        <th scope="col">Tanggal Pengembalian</th>
                                        <th scope="col" style="width: 15%;">Gambar Buku</th>
                                        <th scope="col">Status Buku</th> <!-- Kolom tambahan untuk gambar -->
                                        <!-- <th scope="col">Detail Buku</th> Kolom tambahan untuk gambar -->
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableData">
                                    <?php foreach ($pengembalian_buku as $index => $item) : ?>
                                        <tr>
                                            <th scope="row"><?= $index + 1; ?></th>
                                            <td><?= $item['nama_admin_penerima_buku']; ?></td>
                                            <td><?= $item['nama_pengembali']; ?></td>
                                            <td><?= $item['kelas_pengembali']; ?></td>
                                            <td><?= $item['kelompok_kelas_pengembali']; ?></td>
                                            <td>
                                                <?php
                                                $judul_buku = $item['nama_buku_dikembalikan'];
                                                if (strlen($judul_buku) > 20) {
                                                    $judul_buku = substr($judul_buku, 0, 20) . '...';
                                                }
                                                ?>
                                                <?= $judul_buku ?>
                                            </td>
                                            <td><?= $item['jumlah_buku_dipinjamkan']; ?></td>
                                            <td><?= $item['jumlah_buku_dikembalikan']; ?></td>
                                            <td><?= $item['tanggal_peminjaman_buku']; ?></td>
                                            <td><?= $item['tanggal_pengembalian_buku']; ?></td>
                                            <td>
                                                <?php if (!empty($item['detail_buku'])) : ?>
                                                    <img src="/images/book/<?= $item['detail_buku']['gambar_buku']; ?>" style="width: 80%;" alt="Gambar Buku">
                                                <?php else : ?>
                                                    <img src="/images/book/default.jpg" style="width: 80%;" alt="Gambar Buku">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="row mx-2" style="display: flex; align-items: center; justify-content: center;">
                                                    <?php
                                                    $colorText = ($item['status_buku'] === 'Belum Lunas') ? 'black' : 'white';
                                                    $colorBg = ($item['status_buku'] === 'Belum Lunas') ? 'warning' : 'success';
                                                    ?>
                                                    <button type="button" class="btn text-<?= $colorText ?> bg-<?= $colorBg ?>" data-bs-toggle="modal" data-bs-target="#modalStatusPengembalianBuku<?= $item['id']; ?>">
                                                        <?= $item['status_buku'] ?>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class=" row my-1">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetailPengembalianBuku<?= $item['id']; ?>">
                                                        Detail
                                                    </button>
                                                </div>
                                                <!-- <div class="row my-1">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEditPeminjamanBuku<?= $item['id']; ?>">
                                                        Edit
                                                    </button>
                                                </div>
                                                <div class="row my-1">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeletePeminjamanBuku<?= $item['id']; ?>">
                                                        Delete
                                                    </button>
                                                </div> -->
                                            </td>
                                        </tr>

                                        <!-- Modal Detail Peminjaman Buku -->
                                        <div class="modal fade" id="modalDetailPengembalianBuku<?= $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailPengembalianBukuLabel<?= $item['id']; ?>Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalDetailPengembalianBukuLabel<?= $item['id']; ?>Label">Detail Pengembalian Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5>Detail Identitas Peminjam</h5>
                                                                <h6>Nama: <?= $item['nama_pengembali']; ?></h6>
                                                                <h6>Kelas: <?= $item['kelas_pengembali']; ?></h6>
                                                                <h6>Kelompok Kelas: <?= $item['kelompok_kelas_pengembali']; ?></h6>

                                                                <?php if (!empty($item['detail_pengembalian'])) : ?>
                                                                    <h6>Jenis Kelamin: <?= $item['detail_pengembalian']['jenis_kelamin']; ?></h6>
                                                                    <h6>Tanggal Lahir: <?= $item['detail_pengembalian']['tanggal_lahir']; ?></h6>
                                                                    <h6>Wali Kelas: <?= $item['detail_pengembalian']['wali_kelas']; ?></h6>
                                                                <?php elseif (empty($item['detail_pengembalian'])) : ?>
                                                                    <h6>Jenis Kelamin: -</h6>
                                                                    <h6>Tanggal Lahir: -</h6>
                                                                    <h6>Wali Kelas: -</h6>
                                                                <?php endif; ?>

                                                                <div class="col my-5">
                                                                    <h5>Detail Data Pengembalian Buku</h5>
                                                                    <h6>Admin Penerima Buku: <?= $item['nama_admin_penerima_buku']; ?></h6>
                                                                    <h6>Jumlah Buku yang dipinjamkan: <?= $item['jumlah_buku_dipinjamkan']; ?></h6>
                                                                    <h6>Jumlah Buku yang dikembalikan: <?= $item['jumlah_buku_dikembalikan']; ?></h6>
                                                                    <h6>Tanggal Peminjaman: <?= $item['tanggal_peminjaman_buku']; ?></h6>
                                                                    <h6>Tanggal Pengembalian: <?= $item['tanggal_pengembalian_buku']; ?></h6>
                                                                    <h6>Status Buku: <?= $item['status_buku']; ?></h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h5>Detail Data Buku</h5>
                                                                <h6>Buku yang Dipinjam: <?= $item['nama_buku_dikembalikan']; ?></h6>

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

                                        <!-- Modal Status Pengembalian Buku -->
                                        <div class="modal fade" id="modalStatusPengembalianBuku<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalStatusPengembalianBukuLabel<?= $item['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalStatusPengembalianBukuLabel<?= $item['id']; ?>">Status Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <?php if ($item['status_buku'] === 'Belum Lunas') : ?>
                                                        <form action="/elibrary/admin/data-pengembalian-buku/return/<?= $item['id']; ?>" method="POST">
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <p style="white-space: pre-line;">
                                                                        Status buku ini <span class="text-black bg-warning">belum lunas</span> dikarenakan buku yang dikembalikan baru sebagian.
                                                                        Total buku dipinjamkan: <?= $item['jumlah_buku_dipinjamkan']; ?> buku.
                                                                        Total buku dikembalikan: <?= $item['jumlah_buku_dikembalikan']; ?> buku.
                                                                    </p>
                                                                </div>
                                                                <!-- Input Number -->
                                                                <div class="mb-3">
                                                                    <label for="inputpengembalianbeberapabuku" class="form-label">Kembalikan beberapa/semua buku :</label>
                                                                    <input type="number" class="form-control" id="inputpengembalianbeberapabuku" name="inputpengembalianbeberapabuku" value="<?= ($item['jumlah_buku_dipinjamkan'] - $item['jumlah_buku_dikembalikan']); ?>">
                                                                    <input type="hidden" class="form-control" id="inputidpengembalianbeberapabuku" name="jumlahbukudipinjamkan" value="<?= $item['jumlah_buku_dipinjamkan']; ?>">
                                                                    <input type="hidden" class="form-control" id="inputidbukudikembalikan" name="jumlahbukudikembalikan" value="<?= $item['jumlah_buku_dikembalikan']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    <?php else : ?>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <p style="white-space: pre-line;">
                                                                    Status buku ini sudah lunas dikarenakan buku yang dikembalikan sudah sesuai dengan jumlah buku yang dipinjamkan.
                                                                    Total buku dipinjamkan : <?= $item['jumlah_buku_dipinjamkan']; ?> buku.
                                                                    Total buku dikembalikan : <?= $item['jumlah_buku_dikembalikan']; ?> buku.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    <?php endif; ?>
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