<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('Home/plus_movie') ?>"
            class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm" title="Tambahkan Film"><i
                class="fas fa-plus fa-sm"></i> Tambah Film</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="table-movie" class="table">
                    <thead>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Rated</th>
                        <th>Released</th>
                        <th>Runtime</th>
                        <th>Genre</th>
                        <th>Language</th>
                        <th>Country</th>
                        <th>Awards</th>
                        <th>imdbID</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_movie" tabindex="-1" role="dialog" aria-labelledby="modal_edit" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit">Detail Film</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="msg_edit" role="alert" style="display: none;">
                    <p class="help-block "></p>
                </div>
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="" class="img-thumbnail shadow img-responsive img_edit_movie" alt="">
                            <div class="table-responsive mt-2">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Director</td>
                                            <td><textarea class="form-control" name="director_edit" id="" cols="30"
                                                    rows="10" placeholder="Director Film"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Link 480p</td>
                                            <td><input type="text" name="link_sd" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>Link 720p</td>
                                            <td><input type="text" name="link_hd" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>Link 1080p</td>
                                            <td><input type="text" name="link_fhd" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Title</td>
                                            <td><input type="text" class="form-control" name="title_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Year</td>
                                            <td><input type="text" class="form-control" name="year_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Rated</td>
                                            <td><input type="text" class="form-control" name="rated_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Plot</td>
                                            <td><textarea class="form-control" name="plot_edit" id="" cols="30"
                                                    rows="10" placeholder="Plot Film"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Writer</td>
                                            <td><textarea class="form-control" name="writer_edit" id="" cols="30"
                                                    rows="10" placeholder="Writer Film"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Released</td>
                                            <td><input type="date" class="form-control" name="released_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Runtime</td>
                                            <td><input type="text" class="form-control" name="runtime_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Trailer</td>
                                            <td><input type="text" name="trailer" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Actors</td>
                                            <td><textarea class="form-control" name="actors_edit" id="" cols="30"
                                                    rows="10" placeholder="Actors Film"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Metascore</td>
                                            <td><input type="text" class="form-control" name="metascore_edit" id="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ImdbRating</td>
                                            <td><input type="text" class="form-control" name="imdb_rating_edit" id="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ImdbVotes</td>
                                            <td><input type="text" class="form-control" name="imdb_votes_edit" id="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ImdbID</td>
                                            <td><input type="text" class="form-control" readonly name="imdb_id_edit"
                                                    id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Language</td>
                                            <td><input type="text" class="form-control" name="language_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td><input type="text" class="form-control" name="country_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Awards</td>
                                            <td><input type="text" class="form-control" name="awards_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td><input type="text" class="form-control" name="type_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>DVD</td>
                                            <td><input type="date" class="form-control" name="dvd_edit" id=""></td>
                                        </tr>
                                        <tr>
                                            <td>Box Office</td>
                                            <td><input type="text" class="form-control" name="boxOffice_edit" id="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Website</td>
                                            <td><input type="text" class="form-control" name="website_edit" id="">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" title="Batal"><i
                        class="fa fa-times"></i></button>
                <button class="btn btn-primary save_edit_movie" title="Simpan"><i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>