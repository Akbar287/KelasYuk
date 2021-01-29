<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-md-5">
            <div class="input-group shadow-sm">
                <input type="text" class="form-control bg-light border-0 small imdb_id_plus"
                    placeholder="Masukan Imdb ID" aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary detail_movie_plus" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
            <div class="card mt-3 border-left-danger msg_imdb_card" style="display:none;">
                <div class="card-body">
                    <h5 class="msg_imdb_plus"></h5>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <h5 class="modal-title" id="modal_edit">Detail Film</h5>
            <div id="msg_edit" role="alert" style="display: none;">
                <p class="help-block "></p>
            </div>
            <form action="#" method="post">
                <div class="row text-center">
                    <div class="col-md-4">
                        <img src="" class="img-thumbnail shadow img-responsive img_edit_movie" alt="">
                        <p class="img_text" style="display: none;"></p>
                        <div class="table-responsive mt-2">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Genre</td>
                                        <td><input type="text" class="form-control" name="genre_edit"
                                                placeholder="Genre Film"></td>
                                    </tr>
                                    <tr>
                                        <td>Director</td>
                                        <td><textarea class="form-control" name="director_edit" id="" cols="30"
                                                rows="10" placeholder="Director Film"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Writer</td>
                                        <td><textarea class="form-control" name="writer_edit" id="" cols="30" rows="10"
                                                placeholder="Writer Film"></textarea></td>
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
                                        <td><input type="text" class="form-control" name="title_edit" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td><input type="text" class="form-control" name="year_edit" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Rated</td>
                                        <td><input type="text" class="form-control" name="rated_edit" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Plot</td>
                                        <td><textarea class="form-control" name="plot_edit" id="" cols="30" rows="10"
                                                placeholder="Plot Film"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Released</td>
                                        <td><input type="date" class="form-control" name="released_edit" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Runtime</td>
                                        <td><input type="text" class="form-control" name="runtime_edit" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Language</td>
                                        <td><input type="text" class="form-control" name="language_edit" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><input type="text" class="form-control" name="country_edit" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>480p</td>
                                        <td><input type="text" placeholder="Link 480p" class="form-control"
                                                name="link_sd" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>720p</td>
                                        <td><input type="text" placeholder="Link 720p" class="form-control"
                                                name="link_hd" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>1080p</td>
                                        <td><input type="text" placeholder="Link 1080p" class="form-control"
                                                name="link_fhd" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Trailer</td>
                                        <td><input type="text" placeholder="Link Trailer" class="form-control"
                                                name="link_trailer" id=""></td>
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
                                        <td><textarea class="form-control" name="actors_edit" id="" cols="30" rows="10"
                                                placeholder="Actors Film"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Awards</td>
                                        <td><input type="text" class="form-control" name="awards_edit" id="">
                                        </td>
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
                                        <td><input type="text" class="form-control" readonly name="imdb_id_edit" id="">
                                        </td>
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
                            <a href="#" class="btn btn-xl mb-3 btn-outline-success shadow-lg saved_movie_db"
                                title="Simpan Ke Database"><i class="fa fa-save"></i> Simpan</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>