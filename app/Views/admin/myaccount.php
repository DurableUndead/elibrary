<!-- Main Wrapper -->
<div class="p-1 my-container active-cont my-5">
    <div class="container-fluid">
        <div class="mt-3">
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php elseif (session()->has('error')) : ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- User Profile Section -->
        <div class="row">
            <!-- Profile Card -->
            <div class="col-md-4 mt-2 mx-1">
                <div class="card" style="width: 18rem;">
                    <img src="<?= isset($user['nama']) ? base_url('images/profile/' . $user['email'] . $user['nama'] . '.jpg') : base_url('images/profile/user.jpg') ?>" class="card-img-top" alt="Profile Photo">
                    <div class="card-body">
                        <h5 class="card-title"><?= isset($user['nama']) ? $user['nama'] : 'Guest' ?></h5>
                        <p class="card-text"><?= isset($user['email']) ? $user['email'] : 'Guest@email.com' ?></p>
                        <div class="mb-3 justify-content-between d-flex">
                            <button class="btn btn-primary" onclick="toggleForm('formSection')">Edit Profile</button>
                            <!-- <button type="button" class="btn btn-danger" onclick="">Hapus Akun</button> -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Hapus Akun</button>
                            <!-- <form action="/elibrary/admin/account/delete-account" method="POST" id="deleteAccountForm">
                            <button type="button" class="btn btn-danger" onclick="showConfirmation()">Hapus Akun</button>
                        </form> -->
                        </div>
                        <div class="mb-3 text-center">
                            <button type="button" class="btn btn-primary" onclick="toggleForm('formSectionPassword')">Ganti Password User</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="col-md-5 mt-5" id="formSection" style="display: none;">
                <h4>Ganti Identitas User</h4>
                <form action="/elibrary/admin/account/update" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" id="changename" name="changename" value="<?= isset($user['nama']) ? $user['nama'] : 'Guest' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="changeemail" name="changeemail" value="<?= isset($user['email']) ? $user['email'] : 'Guest@email.com' ?>" required>
                    </div>
                    <!-- <div class="mb-3">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div> -->
                    <div class="mb-3">
                        <label for="pin">PIN:</label>
                        <!-- <input type="text" class="form-control" id="changepin" name="changepin" value=""> -->
                        <input type="number" name="changepin" id="changepin" class="form-control" value="<?= isset($pin) ? $pin : '000000' ?>" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile_photo">Foto Profile:</label>
                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
            <!-- Form Section -->
            <div class="col-md-5 mt-5" id="formSectionPassword" style="display: none;">
                <h4>Ganti Password User</h4>
                <form action="/elibrary/admin/account/change" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="password">Password Lama:</label>
                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password Baru:</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Konfirmasi Password Baru:</label>
                        <input type="password" class="form-control" id="newconfirmpassword" name="newconfirmpassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus akun?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="/elibrary/admin/account/delete" method="POST" id="deleteAccountForm">
                        <button type="submit" class="btn btn-danger">Hapus Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleForm(formId) {
        var formSection = document.getElementById('formSection');
        var formSectionPassword = document.getElementById('formSectionPassword');

        if (formId === 'formSection') {
            formSection.style.display = formSection.style.display === 'none' ? 'block' : 'none';
            formSectionPassword.style.display = 'none';
        } else if (formId === 'formSectionPassword') {
            formSectionPassword.style.display = formSectionPassword.style.display === 'none' ? 'block' : 'none';
            formSection.style.display = 'none';
        }
    }
</script>

<!-- <script>
    function showConfirmation() {
        $('#konfirmasiModal').modal('show');
    }
</script> -->