<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="alert_info"><?= $this->session->flashdata('msg') ?></div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="<?= base_url('assets/img/') . $profil['gambar'] ?>"
                        class="img-thumbnail img-responsive img_profil shadow-lg" alt="">
                    <div class="btn-group mt-3 shadow">
                        <button data-toggle="modal" data-target="#edit_img" class="btn btn-outline-primary edit_image"
                            title="Ubah Gambar"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-outline-danger delete_image" title="Hapus Gambar"><i
                                class="fa fa-eraser"></i></button>
                    </div>
                </div>
                <div class="col-md-8 text-center">
                    <form action="<?= base_url('Home/Profil') ?>" method="post">
                        <table class="table text-left">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>
                                        <input type="text" name="name" class="form-control"
                                            value="<?= $profil['nama'] ?>" placeholder="Nama">
                                        <?= form_error('name', '<div class="alert alert-danger mt-1" role="alert">', '</div>') ?>
                                    </td>
                                    <input type="hidden" class="form-control" value="<?= $profil['ID'] ?>" name="ID">
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>
                                        <input type="text" name="username" class="form-control"
                                            value="<?= $profil['username'] ?>" readonly placeholder="Username">
                                        <?= form_error('username', '<div class="alert alert-danger mt-1" role="alert">', '</div>') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>
                                        <input type="text" name="email" class="form-control"
                                            value="<?= $profil['email'] ?>" placeholder="E-mail">
                                        <?= form_error('email', '<div class="alert alert-danger mt-1" role="alert">', '</div>') ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class=" mt-3 btn btn-lg shadow-lg btn-outline-success" title="Simpan"><i
                                class="fa fa-save"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit_img" tabindex="-1" role="dialog" aria-labelledby="modal_edit_img" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit_img">Unggah Foto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center row">
                    <div class="col-md-8">
                        <img src="" class="img-responsive img-thumbnail shadow-lg img_temp" alt="">
                        <input type="file" class="form-control mt-2 upload_img" onchange="readImage(this);">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn_close_modal" type="button" data-dismiss="modal" title="Batal"><i
                        class="fa fa-times"></i></button>
                <button class="btn btn-primary save_edit_img" title="Simpan"><i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
function readImage(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('.img_temp').attr('src', e.target.result).css('display', 'block');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>