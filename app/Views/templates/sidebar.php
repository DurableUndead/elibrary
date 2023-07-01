<!-- Side-Nav -->
<div class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column my-5" id="sidebar">
    <ul class="nav flex-column text-white w-100 my-2">
        <div class="nav-link text-center mt-1">
            <img class="text-center" src="/icons/icon_elibrary.png" style="width: 100px;">
            <p href="#" class="text-center h4 text-white text-decoration-none">
                E-Library
            </p>
        </div>
        <li class="nav-link mt-1">
            <i class="bx bxs-dashboard"></i>
            <a class="mx-2 text-white text-decoration-none" href="/elibrary/admin">Dashboard</a>
        </li>
        <li class="nav-link">
            <i class="bx bx-list-ul"></i>
            <a href="#pageSubmenuDaftar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle mx-2 text-white text-decoration-none">Daftar</a>
            <ul class="collapse list-unstyled my-2" id="pageSubmenuDaftar">
                <li class="nav-link">
                    <i class="bx bx-book"></i>
                    <a href="/elibrary/admin/daftar-buku" class="mx-1 text-white text-decoration-none" style="font-size: 14px;">Buku</a>
                </li>
                <li class="nav-link">
                    <i class="fas fa-th-large"></i>
                    <a href="/elibrary/admin/daftar-kategori-buku" class="mx-1 text-white text-decoration-none" style="font-size: 14px;">Kategori</a>
                </li>
                <li class="nav-link">
                    <i class="fas fa-users"></i>
                    <a href="/elibrary/admin/daftar-murid" class="mx-1 text-white text-decoration-none" style="font-size: 14px;">Murid</a>
                </li>
            </ul>
        </li>
        <li class="nav-link">
            <i class="bx bx-data"></i>
            <a href="#pageSubmenuData" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle mx-2 text-white text-decoration-none">Data</a>
            <ul class="collapse list-unstyled my-2" id="pageSubmenuData">
                <li class="nav-link">
                    <i class="fas fa-hand-holding"></i>
                    <a href="/elibrary/admin/data-peminjaman-buku" class="mx-1 text-white text-decoration-none" style="font-size: 13px;">Peminjaman</a>
                </li>
                <li class="nav-link">
                    <i class="fas fa-handshake"></i>
                    <a href="/elibrary/admin/data-pengembalian-buku" class="mx-1 text-white text-decoration-none" style="font-size: 13px;">Pengembalian</a>
                </li>
            </ul>
        </li>
    </ul>

    <span href="#" class="nav-link h4 w-100 mb-5 text-center">
        <a href="https://www.instagram.com/durableundead">
            <i class="bx bxl-instagram-alt text-white" style="font-size: 30px"></i>
        </a>
        <a href="https://github.com/DurableUndead">
            <i class="bx bxl-github text-white" style="font-size: 30px"></i>
        </a>
    </span>
</div>