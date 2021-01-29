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
                                        <h1 class="h4 text-gray-900 mb-4">Forget your password ?</h1>
                                    </div>
                                    <?= $this->session->flashdata('msg') ?>
                                    <form class="user" action="<?= base_url('Auth/Forget') ?>" method="post">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control form-control-user"
                                                placeholder="Email">
                                            <?= form_error('email', '<p class="mt-1 mr-3 ml-3" style="border-radius: 50px;color: red;">', '</p>') ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= base_url() ?>">Saya Masih Ingat</a>
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