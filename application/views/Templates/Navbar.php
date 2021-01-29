<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav <?= $profil['colourNavigation'] ?> sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center home" href="javascript:void(0)"
                onclick="Home()">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-drafting-compass"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Kelas Yuk!</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item home">
                <a class="nav-link home" href="javascript:void(0)" onclick="Home()">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Kelas
            </div>
            <li class="nav-item group">
                <a class="nav-link group" href="javascript:void(0)" onclick="Group()">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Kelas Saya</span>
                </a>
            </li>
            <div class="groups-navbar">
                <?php if ($this->session->has_userdata('groups')) : $id_groups = $this->session->userdata('groups'); ?>
                <li class="nav-item groups">
                    <a class="nav-link groups" href="javascript:void(0)" data-toggle="collapse" data-target="#grups"
                        aria-expanded="true" aria-controls="grups">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Kelas</span>
                    </a>
                    <div id="grups" class="collapse show" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php for ($i = 0; $i < count($id_groups); $i++) : $admin = explode(';', $id_groups[$i]['admin']); ?>
                            <a class="collapse-item group-<?= $id_groups[$i]['ID'] ?>" href="javascript:void(0)"
                                onclick="Groups(<?= $id_groups[$i]['ID'] ?>)"><?= $id_groups[$i]['nama'] ?></a>
                            <?php endfor ?>
                        </div>
                    </div>
                </li>
                <?php endif; ?>
            </div>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Utama
            </div>
            <li class="nav-item task">
                <a class="nav-link" href="javascript:void(0)" onclick="Task()">
                    <i class="fas fa-fw fa-drafting-compass"></i>
                    <span>Tugas</span></a>
            </li>
            <li class="nav-item friends">
                <a class="nav-link" href="javascript:void(0)" onclick="Friends()">
                    <i class="fas fa-fw fa-user-friends"></i>
                    <span>Teman</span></a>
            </li>
            <li class="nav-item chatting">
                <a class="nav-link" href="javascript:void(0)" onclick="Chat()">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Obrolan</span></a>
            </li>
            <li class="nav-item setting">
                <a class="nav-link" href="javascript:void(0)" onclick="Setting()">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav
                    class="navbar navbar-expand navbar-light bg-<?= $profil['colourTopBar'] ?> topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small search-input-tugas"
                                placeholder="Mau Cari Apa ya..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-search-navbar" title="Mulai Cari" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control bg-light search-input-tugas border-0 small"
                                            placeholder="Mau Cari Apa ya..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-search-navbar" title="Mulai Cari"
                                                type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <div class="badge-alert-navbar"></div>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notifikasi
                                </h6>
                                <div class="alerts-navbar"></div>
                                <a class="dropdown-item text-center small text-gray-500" href="javascript:void(0)"
                                    onclick="Activity()"><i class="fas fa-clipboard-list"></i> Lihat Semua
                                    Notifikasi</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <div class="badge-message-navbar"></div>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Pesan
                                </h6>
                                <div class="message-navbar"></div>
                                <a class="dropdown-item text-center small text-gray-500" href="javascript:void(0)"
                                    onclick="Chat()"><i class="fas fa-comments"></i> Buka Di Obrolan</a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-light small"><?= $profil['nama'] ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('assets/img/profil/') . $profil['gambar'] ?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item profil" href="javascript:void(0)" onclick="Profil()">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="Setting()">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan
                                </a>
                                <a class="dropdown-item activity" href="javascript:void(0)" onclick="Activity()">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Aktivitas
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
