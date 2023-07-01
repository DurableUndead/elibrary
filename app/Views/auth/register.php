<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registrasi Admin</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* .form-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        } */

        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }   
    </style>
</head>

<body>
    <div class="container">
        <div class="row center-form">
            <div class="col-md-6 mt-3 mb-5">
                <h2>Registrasi Admin E-Library</h2>
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success">
                        <?= session('success') ?>
                    </div>
                <?php elseif (session()->has('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>
                <form action="/elibrary/register/create" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama:<br>(bisa nama panggilan atau nama lengkap)</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:<br>(contoh: kulkas123@gmail.com)</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:<br>(Minimal 8 karakter)</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_verifikasi">Verifikasi Password:<br>(samakan dengan password diatas)</label>
                        <input type="password" name="password_verifikasi" id="password_verifikasi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pin">Pin:<br>(untuk lupa password harus 6 digit)</label>
                        <input type="number" name="pin" id="pin" class="form-control" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Daftar</button>
                        <a href="/elibrary/login" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tambahkan script JS Bootstrap jika diperlukan -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
