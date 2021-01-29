<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Masalah ?</h1>
                                    </div>
                                    <?= $this->session->flashdata('msg') ?>
                                    <div class="row justify-content-center">
                                        <div class="col-md-4"><img src="<?= base_url('assets/img/profil/') . $gambar ?>"
                                                alt="Foto Profil" style="width:200px;height:180p;"
                                                class="img-responsive img-thumbnail shadow-sm"></div>
                                        <div class="col-md-6">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Nama </td>
                                                        <td>: <?= $nama ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Username </td>
                                                        <td>: <?= $username ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Masalah</td>
                                                        <td>:
                                                            <?php ($active == 1) ? print 'Reset Password' : print 'Verifikasi Akun'; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <form class="user mt-3" action="<?= base_url('Auth/help?email=' . $email) ?>"
                                        method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="email"
                                                value="<?= $email ?>" readonly placeholder="Email">
                                            <?= form_error('email', '<div class="mt-1 alert alert-danger" style="border-radius: 50px;" role="alert">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="help" value="<?= set_value('help') ?>" class="form-control"
                                                placeholder="Beritahu Kami Masalah Anda" rows="5"></textarea>
                                            <?= form_error('help', '<div class="mt-1 alert alert-danger" role="alert" style="border-radius: 50px;">', '</div>') ?>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary btn-user btn-block">
                                            Laporkan Masalah
                                        </button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= base_url() ?>">Kembali Ke Login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>