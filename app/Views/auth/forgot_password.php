<!DOCTYPE html>
<html>

<head>
    <title>Lupa Password</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Tambahkan styling khusus di sini jika diperlukan */
    </style>
</head>

<body>
    <div class="container">
        <h2>Lupa Password</h2>
        <p>Masukkan alamat email Anda dengan benar agar Anda dapat mereset kata sandi dengan PIN.</p>
        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger">
                <?= session('error') ?>
            </div>
        <?php endif; ?>



        <?php if (session()->has('success_checkEmail') || session()->has('error_pin')) : ?>
            <div class="alert alert-<?= session()->has('error_pin') ? 'danger' : 'success' ?>">

                <?= session('success_checkEmail') ?? session('error_pin') ?>
            </div>
            <!-- Tampilkan form untuk memasukkan PIN -->
            <form action="/elibrary/login/forgot-password/verification" method="POST">
                <div class="form-group">
                    <label for="pin">PIN:</label>
                    <!-- <input type="text" name="pin" id="pin" class="form-control" required> -->
                    <input type="number" name="pin" id="pin" class="form-control" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required/>
                    <input type="hidden" name="email" value="<?= session('email') ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Verifikasi PIN</button>
                    <a href="/elibrary/login/forgot-password" class="btn btn-secondary">Kembali</a>
                </div>
            </form>

        <?php elseif (session()->has('success_verificationPin') || session()->has('error_resetPassword')) : ?>
            <!-- <div class="alert alert-success"> -->
            <div class="alert alert-<?= session()->has('error_resetPassword') ? 'danger' : 'success' ?>">
            <!-- <div class="alert alert-<?= session()->has('success_verificationPin') ? 'success' : 'danger' ?>"> -->
                <?= session('success_verificationPin') ?? session('error_resetPassword') ?>
            </div>
            <!-- Tampilkan form untuk memasukkan password baru -->
            <form action="/elibrary/login/forgot-password/reset" method="POST">
                <div class="form-group">
                    <label for="password">Password Baru:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password Baru:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                        <label for="pin">Pin:<br>(untuk lupa password harus 6 digit)</label>
                        <input type="number" name="pin" id="pin" class="form-control" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required/>
                </div> -->
                <div class="form-group">
                    <label for="reset_pin">
                    <input type="checkbox" name="reset_pin" id="reset_pin"> Reset PIN juga?</label>
                </div>
                <div id="pin_section" style="display: none;">
                    <div class="form-group">
                        <label for="new_pin">PIN Baru:</label>
                        <!-- <input type="text" name="new_pin" id="new_pin" class="form-control"> -->
                        <input type="number" name="new_pin" id="new_pin" class="form-control" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="email" value="<?= session('email') ?>">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                    <a href="/elibrary/login/forgot-password" class="btn btn-secondary">Kembali</a>
                </div>
            </form>

        <?php else : ?>
            <!-- Tampilkan form untuk mencari email -->
            <form action="/elibrary/login/forgot-password/check" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                    <a href="/elibrary/login" class="btn btn-secondary">Kembali ke Login</a>
                </div>
            </form>
        <?php endif; ?>
    </div>


    <!-- Tambahkan script JS Bootstrap jika diperlukan -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- tampilin reset pin ketika checkbox ditekan -->
    <script>
        var resetPinCheckbox = document.getElementById('reset_pin');
        var pinSection = document.getElementById('pin_section');

        resetPinCheckbox.addEventListener('change', function() {
            if (resetPinCheckbox.checked) {
                pinSection.style.display = 'block';
            } else {
                pinSection.style.display = 'none';
            }
        });
    </script>
</body>

</html>