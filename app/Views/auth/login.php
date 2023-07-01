<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title_web; ?>
    </title>

    <link rel="icon" href="/icons/icon_elibrary.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('/css/login.css') ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <div class="row center-form-login">
            <div class="col-md-6 mt-3 mb-5 login-form-container-login">
                <h2 class="text-center">
                    <?= $judul; ?>
                </h2>
                <?php if (isset($_GET['success']) && $_GET['success'] == 1) : ?>
                    <div class="alert alert-success">
                        Anda Berhasil Logout!
                    </div>
                <?php endif; ?>
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success">
                        <?= session('success') ?>
                    </div>
                <?php elseif (session()->has('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>
                <form action="/elibrary/login/process" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control form-control-lg" type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input class="form-control form-control-lg" type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-wide-login">Login</button>
                    </div>
                    <div class="form-group">
                        <a href="/elibrary/login/forgot-password" class="">Lupa Password?</a>
                    </div>
                    <div class="form-group">
                        <a href="/elibrary/register" class="">Belum punya akun?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>