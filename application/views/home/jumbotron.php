<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>
    <div class="row">
        <div class="col-md-10">
            <?= $this->session->flashdata('msg') ?>
            <div class="card mb-5 mt-3 py-3 border-left-success">
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Page</th>
                            <th>Urutan</th>
                            <th>ImdbID</th>
                            <th>Ganti*</th>
                            <th>Aksi</th>
                        </thead><?php for ($i = 0; $i < count($Jumbotron); $i++) : ?><tbody>
                            <td><?= $i + 1 ?></td>
                            <form action="<?= base_url('Home/JBEdit') ?>" method="post">
                                <td><input type="text" name="page" readonly class=" mb-3 form-control"
                                        value="<?= $Jumbotron[$i]['page'] ?>"></td>
                                <td><input type="text" name="no" readonly class="mb-3 form-control"
                                        value="<?= $Jumbotron[$i]['no'] ?>"></td>
                                <td><?= $Jumbotron[$i]['imdbID'] ?></td>
                                <td>
                                    <div class="input-group mb-3"><input type="text" name="imdbID"
                                            class="form-control input-edit-jb" placeholder="imdbID">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"
                                                title="submit"><i class="fa fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </form>
                            <td><a href="#" class="btn btn-primary detail-jb" data-toggle="modal" data-target="#detail"
                                    data-id="<?= $Jumbotron[$i]['imdbID'] ?>" title="Detail"><i
                                        class="fa-info fa"></i></a></td>
                        </tbody><?php endfor; ?>
                    </table>
                    <p>*Pastikan imdb ID sudah terdaftar di Database Anda.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="ModalDetail" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalDetail">Detail</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="" class="img-thumbnail img-responsive shadow img-detailJb" alt="">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tbody class="table-detailJB"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>