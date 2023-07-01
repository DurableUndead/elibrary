<!DOCTYPE html>
<html>

<head>
    <title>Daftar Buku</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="/icons/icon_elibrary.ico" type="image/x-icon">
    <style>
        /* Atur lebar kolom buku */
        td {
            width: 33%;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="text-center">
            <h1>Cari Buku</h1>
            <form action="" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Buku..." name="searchInput" id="searchInput" autocomplete="off">
                </div>
            </form>
            <div class="mt-3">
                <h3>Jika buku tidak ditemukan, silakan tanyakan ke Admin/Penjaga Perpus</h3>
            </div>
        </div>
        <br>
        <div class="text-right">
            <button class="btn btn-primary" onclick="location.reload()">Refresh</button>
            <!-- <div>
                <label for="columnSelect">Jumlah Kolom:</label>
                <select id="columnSelect" onchange="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4" selected>4</option>
                </select>
            </div> -->
        </div>
        <br>
        <div class="text-center mt-5">
            <h2>Daftar Buku</h2>
            <table id="tableData">
                <tr>
                    <?php foreach ($buku as $index => $item) : ?>
                        <td class="col-md-1" style="border: 1px solid #dee2e6; padding: 10px; ">
                            <div class="container" style="width: 100%;">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center" style="height: 450px;">
                                        <img src="/images/book/<?= $item['gambar_buku']; ?>" width="300" height="400" class="img-fluid" style="max-width: 100%;">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <?php
                                        $judul_buku = $item['judul_buku'];
                                        if (strlen($judul_buku) > 20) {
                                            $judul_buku = substr($judul_buku, 0, 20) . '...';
                                        }
                                        ?>
                                        <h3><?= $judul_buku; ?></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailbukumodal<?= $item['id']; ?>">Detail Buku</button>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalPinjamBuku">Pinjam Buku</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php if (($index + 1) % 5 == 0) : ?>
                </tr>
                <tr>
                <?php endif; ?>
                            
                <!-- Modal Detail Buku-->
                <div class="modal fade" id="detailbukumodal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $item['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel<?= $item['id']; ?>">Detail Buku: </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="/images/book/<?= $item['gambar_buku']; ?>" alt="Gambar Buku" style="width: 100%;">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text-left">
                                            <p>Judul Buku: <?= $item['judul_buku']; ?></h5>
                                            <p>Pengarang: <?= $item['pengarang']; ?></p>
                                            <p>Penerbit: <?= $item['penerbit']; ?></p>
                                            <p>Tahun Terbit: <?= $item['tahun_terbit']; ?></p>
                                            <p>Kategori: <?= $item['kategori']; ?></p>
                                            <p>Jumlah Buku: <?= $item['jumlah_buku']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Pinjam Buku -->
                <div class="modal fade" id="pinjamModal<?= $index; ?>" tabindex="-1" role="dialog" aria-labelledby="pinjamModalLabel<?= $index; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pinjamModalLabel<?= $index; ?>">Pinjam Buku: <?= $item['judul_buku']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Isi konten modal pinjam buku di sini -->
                                <p>Buku dengan judul <?= $item['judul_buku']; ?> telah dipinjam.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
                </tr>
            </table>

        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPinjamBuku" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">Cara Meminjam Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Untuk murid yang ingin meminjamkan buku, berbicara ke admin perpus langsung agar data anda diinput dan disimpan ke server pinjam buku.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan link JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

</body>

</html>