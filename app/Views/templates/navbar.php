<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light px-5 bg-white topbar static-top shadow d-flex justify-content-between fixed-top">
            <!-- Sidebar Toggle (Topbar) -->
            <div class="d-flex align-items-center">
                <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
                <h1 class="mx-2 h3 mb-2 text-gray-800"><?= $judul ?></h1>
            </div>

            <div class="date">
                <h4 class="text-black" id="date" style='font-family: "Times New Roman", Times, serif;'></h4>
            </div>

            <!-- DropDown -->
            <div class="dropdown mx-1">
                <!-- <form action="/elibrary/admin/logout" method="post"> -->
                <a class="btn dropdown-toggle" href="#" role="button" id="navbarDarkDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- <i class="fas fa-user">Alfiansyah Achmad</i>  -->
                    <i class="fas fa-user mt-1">
                        <?= isset($user['nama']) ? $user['nama'] : 'Guest' ?>
                    </i>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="/elibrary/admin/account">Account Settings</a></li>
                    <!-- <li><button type="submit" class="dropdown-item">Logout</button></li> -->
                    <li><a class="dropdown-item" href="/elibrary/admin/logout/process">Logout</a></li>
                </ul>
                <img class="rounded-circle" src="<?= isset($user['nama']) ? base_url('images/profile/' . $user['email'] . $user['nama'] . '.jpg') : base_url('images/profile/user.jpg') ?>" alt="" style="max-width: 30px; max-height: 30px;">
                <!-- </form> -->
            </div>
        </nav>
        <!-- End of Topbar -->



        <script>
            var d = new Date();
            var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

            document.getElementById("date").innerHTML = days[d.getDay()] + ", " + d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
        </script>