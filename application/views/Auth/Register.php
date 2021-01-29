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
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>
                                    <?= $this->session->flashdata('msg') ?>
                                    <form class="user" action="<?= base_url('Auth/Register') ?>" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="nama"
                                                value="<?= set_value('nama') ?>" placeholder="Nama">
                                            <?= form_error('nama', '<div class="mt-1 alert alert-danger" role="alert" style="border-radius: 50px;">', '</div>') ?>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="email"
                                                value="<?= set_value('email') ?>" placeholder="Email">
                                            <?= form_error('email', '<div class="mt-1 alert alert-danger" style="border-radius: 50px;" role="alert">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username"
                                                value="<?= set_value('username') ?>" placeholder="Username">
                                            <?= form_error('username', '<div class="mt-1 alert alert-danger" role="alert" style="border-radius: 50px;">', '</div>') ?>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user"
                                                    name="password" placeholder="Password">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user"
                                                    name="password_confirmation" placeholder="Konfirmasi Password">
                                            </div>
                                            <?= form_error('password_confirmation', '<div class="mt-1 mr-3 ml-3 alert alert-danger" role="alert" style="border-radius: 50px;">', '</div>') ?>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary btn-user btn-block">
                                            Register Account
                                        </button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= base_url() ?>">Saya Punya Akun</a>
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