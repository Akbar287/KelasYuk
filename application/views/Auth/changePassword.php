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
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password For</h1>
                                        <h5 class="help-block"><?= $this->session->userdata('reset_email') ?></h5>
                                    </div>
                                    <?= $this->session->flashdata('msg') ?>
                                    <form class="user" action="<?= base_url('Auth/changepassword') ?>" method="post">
                                        <div class="form-group">
                                            <input type="text" name="password" class="form-control form-control-user"
                                                placeholder="Password">
                                            <?= form_error('password', '<p class="mt-1 mr-3 ml-3" style="color: red;">', '</p>') ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="password_confirmation"
                                                class="form-control form-control-user"
                                                placeholder="Konfirmasi Password">
                                            <?= form_error('password_confirmation', '<p class="mt-1 mr-3 ml-3" style="color: red;">', '</p>') ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>