<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<?php if (isset($title)) : ?>
<div class="modal fade" id="sendMessageFriends" tabindex="-1" role="dialog" aria-labelledby="sendMessageFriendsModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-center modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?= $profil['colourPopUp'] ?>">
                <h5 class="modal-title text-gray-100" id="sendMessageFriendsModal"><i class="fas fa-envelope"></i> Kirim
                    Pesan Cepat</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <h5 class="messageFastMailFriends text-center"></h5>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>
                                            <p class="help-block">Kepada : </p>
                                        </th>
                                        <td><input type="text" class="form-control toFastMailFriends"
                                                placeholder="Username">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p class="help-block">Judul : </p>
                                        </th>
                                        <td><input type="text" class="form-control subjectFastMailFriends"
                                                placeholder="Judul"></td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p class="help-block">Teks : </p>
                                        </th>
                                        <td><textarea class="form-control textFastMailFriends" placeholder="Teks"
                                                rows="5"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Lampirkan File</td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputFile">Lampirkan</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input fileFastMessageFriends"
                                                        id="fileFastMessage" aria-describedby="inputFile">
                                                    <label class="custom-file-label label-file-fast-mail"
                                                        for="fileFastMessage">Pilih File</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn_close_modal" style="border-radius: 20px;" type="button"
                    data-dismiss="modal" title="Batal"><i class="fa fa-times"></i> Batal</button>
                <button class="btn btn-outline-success sendFastMailFriends" style="border-radius: 20px;"
                    title="Kirim"><i class="fa fa-paper-plane"></i> Kirim</button>
            </div>
        </div>
    </div>
</div>
<footer class="sticky-footer mt-2 bg-gray-100"></footer>
<div class="modal-task"></div>
<div class="modal-permanent"></div>
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/PACE/pace.js"></script>
<script>
let alertLenght = 0,
    messageLength = 0;
$(function() {
    $(document).ready(Start());
});

function Start() {
    Home();
    pace();
    modalStarted();
    $('footer').append(
        '<div class="container my-auto"><hr><div class="copyright text-center my-auto"><span>Copyright &copy; <strong>Kelasyuk</strong> 2019. All Right Reserved</span></div></div>'
    );
}

function modalStarted() {
    $('.modal-permanent').append(
        `<div class="modal fade" id="alertsNavbarModal" tabindex="-1" role="dialog" aria-labelledby="ModalAlerts" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="ModalAlerts"><i class="fas fa-bell"></i> Notifikasi</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row mr-3 ml-3 justify-content-center"><div class="col-md-4 text-center"><div style="width: 100px;height: 100px;" class="text-center text-gray-100 icon-circle icon-circle-alert-navbar"></div><br></div></div><div class="row mr-3 ml-3"><div class="col-md-10"><div class="table-responsive"><table class="table"><tbody><tr><th>Waktu</th><td><p class="date-alert-modal"></p></td></tr><tr><th>Isi Notif</th><td><div class="alerts-notif"></div></td></tr></tbody></table></div></div></div></div><div class="modal-footer"><button class="btn btn-outline-secondary" type="button" data-dismiss="modal" style="border-radius: 20px;" title="Tutup"><i class="fa fa-times"></i> Tutup</button></div></div></div></div>`
    );
    $('.modal-permanent').append(
        '<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLogOut" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="ModalLogOut"><i class="fas fa-sign-out-alt"></i> Keluar?</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body">Apakah Anda Yakin Untuk Keluar?</div><div class="modal-footer"><button class="btn btn-outline-secondary" type="button" style="border-radius: 20px;" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i> Tutup</button><a style="border-radius: 20px;" class="btn btn-outline-primary" href="<?= base_url('Auth/log_out') ?>" title="Keluar"><i class="fa fa-sign-out-alt"></i> Keluar</a></div></div></div></div>'
    );
    $('.modal-permanent').append(
        '<div class="modal fade" id="modal-new-file-group" tabindex="-1" role="dialog" aria-labelledby="modalgetNewFile" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="modalgetNewFile"><i class="fas fa-upload"></i> Unggah File ke Kelas</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row justify-content-center"><div class="col-md-8 mt-2"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="input_image_create_group">Unggah</span></div><div class="custom-file"><input type="file" class="custom-file-input file-group-upload" id="file-group-upload" aria-describedby="input_file_attach"><label class="custom-file-label" for="file-group-upload" class="label-image">Pilih File</label></div></div><br><p class="label-file-upload-group">Tidak Ada File terpilih</p></div></div></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" type="button" style="border-radius: 20px;" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i> Tutup</button><button style="border-radius: 20px;" class="btn btn-outline-primary newFileGroup" title="Unggah File Ke Kelas"><i class="fa fa-upload"></i> Unggah</button></div></div></div></div>'
    );
    $('.modal-permanent').append(
        '<div class="modal fade" id="MessageGroupID" tabindex="-1" role="dialog" aria-labelledby="ModalMessageGroup" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-scrollable" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="ModalMessageGroup"><i class="fas fa-info-circle"></i> Detail Obrolan</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body detailMessageGroupID"></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" type="button" data-dismiss="modal" title="Batal"  style="border-radius: 20px;"><i class="fa fa-times"></i></button><div class="btn-message-group-id"></div></div></div></div></div>'
    );
    $('.modal-permanent').append(
        '<div class="modal fade" id="fileSendPersonalChat" tabindex="-1" role="dialog" aria-labelledby="ModalFile" aria-hidden="true"><div class="modal-dialog modal-md modal-dialog-scrollable" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="ModalFile"><i class="fas fa-file"></i> Lampirkan File</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row justify-content-center"><div class="col-md-8"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="input_image_create_group">Unggah</span></div><div class="custom-file"><input type="file" class="custom-file-input file-attach" id="file-attach" aria-describedby="input_file_attach"><label class="custom-file-label" for="file-attach" class="label-image ">Pilih File</label></div></div></div><br><p class="help-block ml-2 mr-2 file-attach-label"></p></div></div><div class="modal-footer"><button class="btn btn-outline-secondary btn-clear-file-attach" style="border-radius: 20px;" type="button" data-dismiss="modal" title="Batal"><i class="fa fa-times"></i> Batalkan</button> <button class="btn btn-outline-success" data-dismiss="modal" style="border-radius: 20px;"><i class="fas fa-check"></i> Lampirkan</button></div></div></div></div>'
    );
    $('.modal-permanent').append(
        `<div class="modal fade" id="messageNavbarModal" tabindex="-1" role="dialog" aria-labelledby="ModalMessage" aria-hidden="true"><div class="modal-dialog modal-dialog-center modal-dialog-scrollable modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="ModalMessage"><i class="fas fa-envelope"></i> Pesan</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row ml-3 mb-1 mr-3"><h3 class="help-block">Informasi Pengirim</h3><br><hr></div><div class="row mr-4 mt-1 ml-4 justify-content-center"><div class="col-md-3 mb-2 text-center"><img src="" class="text-center messageNavbarImageModal shadow img-responsive icon-circle" style="width: 100px;height: 100px;"></div><div class="col-md-9"><div class="table-responsive"><table class="table table-message-modal-navbar"></table></div></div></div><div class="row ml-3 mr-3"><h3 class="help-block">Pesan</h3><br><hr></div><div class="row mt-1 mr-4 ml-4 justify-content-center"><div class="col-md-12"><div class="table-responsive"><table class="table table-message-modal-navbar-op"></table></div></div></div></div><div class="modal-footer"><button class="btn btn-outline-secondary" type="button" data-dismiss="modal" style="border-radius: 20px;" title="Tutup"><i class="fa fa-times"></i> Tutup</button> <button class="btn btn-outline-success sendMessageFriends" data-toggle="modal" data-target="#sendMessageFriends" data-id="" style="border-radius: 20px;" title="Kirim Pesan"><i class="fas fa-envelope"></i> Kirim Pesan Pribadi</button></div></div></div></div>`
    );
    $('.modal-permanent').append(
        '<div class="modal fade" id="report-user-member" tabindex="-1" role="dialog" aria-labelledby="report-user-modal" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="report-user-modal"><i class="fas fa-exclamation-triangle"></i> Isi Laporan Anda</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row pl-3 pr-3 text-center"><textarea rows="5" placeholder="Isi Laporan Ada." class="form-control fill-user-report-text"></textarea><input type="hidden" id="id_report"></div></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" type="button" data-dismiss="modal" title="Tutup" style="border-radius: 20px;"><i class="fa fa-times"></i> Tutup</button> <button class="btn btn-outline-danger report_user" type="button" style="border-radius: 20px;" data-dismiss="modal" title="Laporkan"><i class="fas fa-check"></i> Laporkan</button></div></div></div>'
    );
    $('.modal-permanent').append(
        '<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="report-user-modal" aria-hidden="true"><div class="modal-dialog modal-dialog-scrollable modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="report-user-modal"><i class="fas fa-info-circle"></i> Persyaratan Penggunaan</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row justify-content-center"><div class="col-md-10"><h5 class="help-block text-center">Penggunaan Layanan oleh Anda</h5><br><ol style="text-align: justify;"><li>Anda setuju untuk menggunakan Layanan hanya demi tujuan yang diizinkan menurut (a) Persyaratan dan (b) undang-undang, peraturan, pedoman, atau panduan apa pun yang diterima secara umum dan berlaku di wilayah hukum terkait. </li><li>Anda setuju bahwa Anda tidak akan terlibat dalam aktivitas apa pun yang mempengaruhi atau mengganggu Layanan (atau server dan jaringan yang tersambung ke Layanan). </li><li>Anda setuju untuk tidak memperbanyak, menggandakan, menyalin, menjual, memperdagangkan, atau menjual kembali Layanan demi tujuan apa pun, kecuali jika diizinkan secara khusus untuk melakukannya berdasarkan perjanjian terpisah dengan Kelasyuk. </li><li>Anda setuju untuk bertanggung jawab penuh (dan Kelasyuke tidak bertanggung jawab kepada Anda atau pihak ketiga mana pun) atas pelanggaran kewajiban Anda berdasarkan Persyaratan ini dan konsekuensi (termasuk kerugian maupun kerusakan apa pun yang mungkin dialami Kelasyuk) dari pelanggaran tersebut.</li></ol></div></div></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" type="button" data-dismiss="modal" title="Tutup" style="border-radius: 20px;"><i class="fa fa-times"></i> Tutup</button></div></div></div>'
    );
}
$(document).on('change', '.file-group-upload', function() {
    let readFile = ($('.file-group-upload').val());
    readFile = readFile.split("\\");
    $('.label-file-upload-group').html('Terpilih: ' + readFile[readFile.length - 1]);
})

function NotifyNavbar() {
    $('.message-navbar').children().remove();
    $('.alerts-navbar').children().remove();
    $.ajax({
        url: '<?= base_url('Home/NotifyNavbar') ?>',
        dataType: 'json',
        success: function(data) {
            if (data) {
                if (data[0] === 0) {
                    $('.badge-message-navbar').append('');
                    $('.message-navbar').append(
                        '<div class="mt-3 mb-3 row justify-content-center"><div class="col-md-12 text-center"><h5 class="help-block"><i class="fas fa-envelope-open"></i> Tidak Ada Pesan Masuk</h5></div></div>'
                    );
                } else {
                    $('.badge-message-navbar').append('<span class="badge badge-danger badge-counter">' +
                        data[0] + '</span>');
                    $.ajax({
                        url: '<?= base_url('Home/MessageNavbar') ?>',
                        method: 'post',
                        dataType: 'json',
                        success: function(message) {
                            for (let i = 0; i < message.length; i++) {
                                messageLength = message.length;
                                let stats = (message[i].profil.loginStats == '0') ? 'danger' :
                                    'success';
                                $('.message-navbar').append(
                                    '<a class="dropdown-item d-flex align-items-center message-navbar-' +
                                    message[i].ID +
                                    '" data-toggle="modal" data-target="#messageNavbarModal" onclick="MessageNavbar(' +
                                    message[i].ID +
                                    ')" href="javascript:void(0)"><div class="dropdown-list-image mr-3"><img class="rounded-circle"src="<?= base_url('assets/img/profil/') ?>' +
                                    message[i].profil.gambar +
                                    '" alt=""><div class="status-indicator bg-' +
                                    stats +
                                    '"></div></div><div class="font-weight-bold"><div class="text-truncate">' +
                                    message[i].subject +
                                    '.</div>    <div class="small text-gray-500">' +
                                    message[i].profil.nama + ' · ' + message[i].date_send +
                                    '</div></div></a>'
                                );
                            }
                        },
                        error: function() {
                            internetConnection();
                        }
                    });
                }
                if (data[1] === 0) {
                    $('.badge-alert-navbar').append('');
                    $('.alerts-navbar').append(
                        '<div class="mt-3 mb-3 row justify-content-center"><div class="col-md-12 text-center"><h5 class="help-block"><i class="fas fa-bell-slash"></i> Tidak Ada Notifikasi</h5></div></div >'
                    );
                } else {
                    $('.badge-alert-navbar').append('<span class="badge badge-danger badge-counter">' +
                        data[1] + '</span>');
                    $.ajax({
                        url: '<?= base_url('Home/AlertsNavbar') ?>',
                        dataType: 'json',
                        success: function(alert) {
                            if (jQuery.isEmptyObject(alert)) {
                                $('.alerts-navbar').append(
                                    '<div class="mt-3 mb-3 row justify-content-center"><div class="col-md-12 text-center"><h5 class="help-block"><i class="fas fa-warning"></i> Server Error</h5></div></div >'
                                );
                            } else {
                                alertLenght = alert.length;
                                for (let i = 0; i < alert.length; i++) {
                                    let date = alert[i].date_created,
                                        month = '';
                                    date = date.split('-');
                                    month = getMonthNow(date[1]);
                                    $('.alerts-navbar').append(
                                        '<a class="dropdown-item d-flex align-items-center alert-navbar-' +
                                        alert[i].ID +
                                        '" data-toggle="modal" data-target="#alertsNavbarModal" onclick="AlertsNavbar(' +
                                        alert[i].ID +
                                        ')" href="javascript:void(0)"><div class="mr-3"><div class="icon-circle bg-' +
                                        alert[i].type + '"><i class="fas fa-' +
                                        alert[i]
                                        .image +
                                        ' text-white"></i></div></div><div><div class="small text-gray-500"> ' +
                                        date[2] + ' ' + month + ' , ' + date[0] +
                                        '</div><span class="font-weight-bold">' + alert[i]
                                        .text + '</span></div></a>'
                                    );
                                }
                            }
                        },
                        error: function() {
                            internetConnection();
                        }
                    });
                }
            } else {}
        },
        error: function() {
            internetConnection();
        }
    });
}

function getMonthNow(x) {
    if (x == 01) {
        return 'Januari';
    } else if (x == 02) {
        return 'Februari';
    } else if (x == 03) {
        return 'Maret';
    } else if (x == 04) {
        return 'April';
    } else if (x == 05) {
        return 'Mei';
    } else if (x == 06) {
        return 'Juni';
    } else if (x == 07) {
        return 'Juli';
    } else if (x == 08) {
        return 'Agustus';
    } else if (x == 09) {
        return 'September';
    } else if (x == 10) {
        return 'Oktober';
    } else if (x == 11) {
        return 'November';
    } else {
        return 'Desember';
    }
}

function MessageNavbar(id) {
    $('.messageNavbarImageModal').attr('src', '<?= base_url('assets/img/profil/nophoto.png') ?>');
    $('.sendMessageFriends').removeAttr('data-id');
    $('.table-message-modal-navbar').children().remove();
    $('.table-message-modal-navbar-op').children().remove();
    $.ajax({
        url: '<?= base_url('Home/MessagesNavbar') ?>',
        method: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            let file = (data[0].file === "" || data[0].file === ' ' || data[0].file === 0 || data[0]
                    .file === '0') ?
                '<p class="help-block">Tidak Ada File Tersemat</p>' :
                '<a href="<?= base_url('assets/files/private/') ?>' + data[0].file +
                '" class="btn btn-outline-success" title="Unduh File"><i class="fas fa-download"></i> Unduh File</a>',
                stats = (data[1] === "0") ?
                '<div class="badge badge-danger">Tidak Dikenal</div>' :
                '<div class="badge badge-success">Teman</div>',
                status = (data[2].loginStats == "0") ? '<div class="badge badge-danger">off-line</div>' :
                '<div class="badge badge-success">on-line</div>';
            messageLength = (messageLength - 1);
            $('.table-message-modal-navbar').append('<tbody><tr><th>Nama</th><td>' + data[2].nama +
                '</td></tr><tr><th>Username</th><td>' + data[2].username +
                '</td></tr><tr><th>Waktu</th><td>' + data[0].date_send +
                '</td></tr><tr><th>Hubungan</th><td>' + stats + ' ' + status + '</td></tr></tbody>');
            $('.table-message-modal-navbar-op').append('<tbody><tr><th>Judul</th><td>' + data[0].subject +
                '</td></tr><tr><th>Isi</th><td>' + data[0].text + '</td></tr><tr><th>File</th><td>' +
                file +
                '</td></tr></tbody>');
            $('.messageNavbarImageModal').attr('src', '<?= base_url('assets/img/profil/') ?>' + data[2]
                .gambar);
            $('.sendMessageFriends').attr('data-id', data[0].id_from);
            $('.badge-message-navbar').append('');
            if (messageLength == 0) {
                $('.badge-message-navbar').children().remove();
                $('.message-navbar').children().remove();
                $('.message-navbar').append(
                    '<div class="mt-3 mb-3 row justify-content-center"><div class="col-md-12 text-center"><h5 class="help-block"><i class="fas fa-envelope-open"></i> Tidak Ada Pesan Masuk</h5></div></div>'
                );
            } else {
                $('.badge-message-navbar').append('<span class="badge badge-danger badge-counter">' +
                    messageLength + '</span>');
                $('.message-navbar-' + id).remove();
            }
        },
        error: function() {
            internetConnection();
        }
    });
}

function AlertsNavbar(id) {
    $('.alerts-notif').children().remove();
    $('.icon-circle-alert-navbar').children().remove();
    $('.date-alerts-modal').html('');
    $.ajax({
        url: '<?= base_url('Home/Alerts') ?>',
        method: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            $('.icon-circle-alert-navbar').addClass('bg-' + data.type).html('<i class="fas fa-' + data
                .image + '"></i>');
            $('.date-alert-modal').html('<p class="help-block">' + data.date_created + '</p>');
            $('.alerts-notif').append('<p class="help-block">' + data.text + '</p>');
            alertLenght = (alertLenght - 1);
            $('.badge-alert-navbar').children().remove();
            if (alertLenght == 0) {
                $('.alerts-navbar').children().remove();
                $('.alerts-navbar').append(
                    '<div class="mt-3 mb-3 row justify-content-center"><div class="col-md-12 text-center"><h5 class="help-block"><i class="fas fa-bell-slash"></i> Tidak Ada Notifikasi</h5></div></div >'
                );
            } else {
                $('.badge-alert-navbar').children().remove();
                $('.alert-navbar-' + id).remove();
                $('.badge-alert-navbar').append('<span class="badge badge-danger badge-counter">' +
                    alertLenght + '</span>');
            }
        },
        error: function() {
            internetConnection();
        }
    });
}

function pace() {
    $(document).ajaxStart(function() {
        Pace.restart();
    });
}

function Home() {
    NotifyNavbar();
    $('.home').addClass('active');
    $('.group').removeClass('active');
    $('.task').removeClass('active');
    $('.groups').removeClass('active');
    $('.friends').removeClass('active');
    $('.setting').removeClass('active');
    $('.chatting').removeClass('active');
    $('.body-task').children('div').remove();
    $('.modal-task').children('div').remove();
    $('.body-task').append(
        `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-home text-gray-700"></i> Beranda</h1></div><div class="row justify-content-center "><div class="col-md-10">`
    );

    $('.body-task').append(
        `<div class="row"><div class="col-xl-3 col-md-6 mb-4"><div class="card animate-opacity border-left-primary shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><div class="col mr-2"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a onclick="Task()" class="text-primary" href="javascript:void(0)" style="text-decoration: none;">Tugas</a></div><div class="h5 mb-0 font-weight-bold text-gray-800 task-jb">0</div></div><div class="col-auto"><i class="fas fa-drafting-compass fa-2x text-gray-300"></i></div></div></div></div></div><div class="col-xl-3 col-md-6 mb-4"><div class="card animate-opacity border-left-success shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><div class="col mr-2"><div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a onclick="Group()" class="text-success" href="javascript:void(0)" style="text-decoration: none;">Kelas</a></div><div class="h5 mb-0 font-weight-bold text-gray-800 group-jb">0</div></div><div class="col-auto"><i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i></div></div></div></div></div><div class="col-xl-3 col-md-6 mb-4"><div class="card animate-opacity border-left-info shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><div class="col mr-2"><div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a onclick="Profil()" class="text-info" href="javascript:void(0)" style="text-decoration: none;">Profil</a></div><div class="row no-gutters align-items-center"><div class="col-auto"><div class="h5 mb-0 mr-3 font-weight-bold profil-jb text-gray-800">0%</div></div><div class="col"><div class="progress progress-sm mr-2"><div class="progress-bar profil-progress-jb bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div></div></div></div><div class="col-auto"><i class="fas fa-user fa-2x text-gray-300"></i></div></div></div></div></div><div class="col-xl-3 col-md-6 mb-4"><div class="card animate-opacity border-left-warning shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><div class="col mr-2"><div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a onclick="Friends()" class="text-warning" href="javascript:void(0)" style="text-decoration: none;">Teman</a></div><div class="h5 mb-0 font-weight-bold text-gray-800 friends-jb">0</div></div><div class="col-auto"><i class="fas fa-user-friends fa-2x text-gray-300"></i></div></div></div></div></div></div>`
    );
    $('.body-task').append(`</div></div>`);

    $.ajax({
        url: '<?= base_url('Home/jb') ?>',
        dataType: 'json',
        success: function(data) {
            if (data) {
                $('.task-jb').html(data.task);
                $('.friends-jb').html(data.friends);
                $('.group-jb').html(data.group);
                $('.profil-jb').html(data.profil + '%');
                $('.profil-progress-jb').css('width', data.profil + '%');
            }
        }
    });
}

function Group() {
    NotifyNavbar();
    $('.group').addClass('active');
    $('.home').removeClass('active');
    $('.task').removeClass('active');
    $('.groups').removeClass('active');
    $('.friends').removeClass('active');
    $('.setting').removeClass('active');
    $('.chatting').removeClass('active');
    $('.modal-task').children('div').remove();
    $('.body-task').children('div').remove();
    $('.modal-task').append(
        '<div class="modal fade" id="add_group" tabindex="-1" role="dialog" aria-labelledby="modal_add_group" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="modal_add_group"><i class="fas fa-plus"></i> Tambah Kelas</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="justify-content-center row"><div class="col-md-8"><div class="input-group"><input type="text" class="form-control bg-light border-0 small code_group_add" placeholder="Masukan Kode Kelas"><div class="input-group-append"><button class="btn btn-outline-success add_group_code" title="Tambah" type="button"><i class="fas fa-plus fa-sm"></i></button></div></div><div class="message-add-group"></div></div></div></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" style="border-radius: 20px;" type="button" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i> Tutup</button></div></div></div></div>'
    );
    $('.modal-task').append(
        '<div class="modal fade" id="info_group" tabindex="-1" role="dialog" aria-labelledby="modal_info_group" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="modal_info_group"><i class="fas fa-info-circle"></i> Info Kelas</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row"><div class="col-sm-4"><img src="" class="img-thumbnail img-responsive img-info-modal"></div><div class="col-sm-8"><div class="table-responsive"><table class="table table-info-modal"><tbody></tbody></table></div></div></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" style="border-radius: 20px;" type="button" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i> Tutup</button></div></div></div>'
    );
    $('.modal-task').append(
        '<div class="modal fade" id="create_group" tabindex="-1" role="dialog" aria-labelledby="modal_create_group" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="modal_create_group"><i class="fas fa-info-circle"></i> Info Kelas</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row"><div class="col-sm-4"><img src="" class="img-thumbnail img_temp img-responsive img-create-modal"></div><div class="col-sm-8"><div class="table-responsive"><table class="table table-create-modal"><tbody><tr><th>Nama</th><td><input type="text" class="form-control name-create-group" placeholder="Nama Kelas"></td></tr><tr><th>Gambar</th><td><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="input_image_create_group">Unggah</span></div><div class="custom-file"><input type="file" onchange="readImage(this);" class="custom-file-input image-create-group" id="image_create_group" aria-describedby="input_image_create_group"><label class="custom-file-label" for="image_create_group" class="label-image image_label_create">Pilih File</label></div></div></td></tr><tr><th>Deskripsi</th><td><textarea class="form-control decription_create_group" placeholder="Deskripsikan Kelas Anda" rows="3"></textarea></td></tr><tr><th></th><td><div class="form-check"><input class="form-check-input" name="agreementCreateGroup" type="checkbox" value="ok" id="agreement"><label class="form-check-label" for="agreement">Saya Setuju & Menaati Peraturan Yang Berlaku di Aplikasi Kelasyuk dan UU ITE.</label></div></td></tr></tbody></table></div></div></div><div class="modal-footer"><button style="border-radius: 20px;" class="btn btn-outline-secondary btn_close_modal" type="button" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i> Tutup</button> <button class="btn btn-outline-success btn-create-group-modal" style="border-radius: 20px;" type="button" data-dismiss="modal" title="Buat Kelas"><i class="fa fa-chalkboard-teacher"></i> Buat Kelas</button></div></div></div>'
    );
    $('.body-task').append(
        `<div class="d-sm-flex align-items-center justify-content-between mb-2"><h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-chalkboard-teacher text-gray-700"></i> Kelas</h1><button data-toggle="modal" data-target="#create_group" style="border-radius: 20px;" class="d-none d-sm-inline-block btn btn-sm shadow btn-outline-primary btn-create-group"><i class="fas fa-sm fa-plus"></i> Buat Kelas</button></div><div class="row justify-content-center"><div class="col-md-12 message_Group"></div></div><div class="row justify-content-center"><div class="col-md-12 Group_body"></div></div><div class="row justify-content-center"><div class="col-md-12 Group_add_body"></div></div><div class="row justify-content-center text-center mb-5"><div class="col-md-4"><button data-toggle="modal" data-target="#add_group" style="border-radius: 20px;" class="btn btn-sm btn-outline-primary shadow-sm" title="Tambah Kelas"><i class="fas fa-plus fa-sm"></i> Tambah Kelas</button></div></div>`
    );
    Group_body();
}

function Groups(id) {
    NotifyNavbar();
    $('.group').removeClass('active');
    $('.home').removeClass('active');
    $('.task').removeClass('active');
    $('.friends').removeClass('active');
    $('.setting').removeClass('active');
    $('.chatting').removeClass('active');
    $('.groups').addClass('active');
    $('.modal-task').children('div').remove();
    $('.body-task').children('div').remove();
    $('.modal-task').append(
        '<div class="modal fade" id="detail_member_modal" tabindex="-1" role="dialog" aria-labelledby="detail-member-modal" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="detail-member-modal"><i class="fas fa-info-circle"></i> Info Anggota Kelas</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row"><div class="col-sm-4"><img src="" class="img-thumbnail img-responsive img-info-member"></div><div class="col-sm-8"><div class="table-responsive"><table class="table table-info-member"><tbody></tbody></table></div></div></div><div class="row justify-content-center"><div class="text-center btn-member-option"></div></div></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" type="button" style="border-radius: 20px;" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i> Tutup</button></div></div></div>'
    );
    $('.modal-task').append(
        '<div class="modal fade" id="detail-admin-task-change" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-xl modal-dialog-scrollable" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100"><i class="fas fa-pen"></i> Tugas</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body modal-task-admin-change"></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" style="border-radius: 20px;" type="button" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i> Tutup</button></div></div></div>'
    );
    $('.modal-task').append(
        '<div class="modal fade" id="detailTaskUsers" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100"><i class="fas fa-drafting-compass"></i> Hasil Tugas Anggota</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body modal-result-task-users"></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" style="border-radius: 20px;" type="button" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i> Tutup</button></div></div></div>'
    );
    $('.modal-task').append(
        '<div class="modal fade" id="createNewTaskAdmin" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100"><i class="fas fa-drafting-compass"></i> Buat Tugas Baru</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row justify-content-center"><div class="col-md-10"><div class="table-responsive"><table class="table"><tbody><tr><th>Judul</th><td><input type="text" placeholder="Judul Tugas" class="form-control subjectTask"><input type="hidden" value="" class="form-control idCreateTask"></td></tr><tr><th>Pesan</th><td><textarea class="form-control messagesTask" placeholder="Pesan untuk anggota tentang cara mengerjakan tugas ini" rows="5"></textarea></td></tr><tr><th>Detail</th><td><input type="text" class="form-control detailTask" placeholder="Rincian lebih lanjut"></td></tr><tr><th>Waktu Terakhir</th><td><input type="date" class="form-control deadlineCreateTask"><p class="help-block deadlineAlert"></p></td></tr><tr id="timeDeadline"></tr></tbody></table></div><p class="help-block">Semua field Setelah dibuat tidak dapat diganti termasuk deadline</p></div></div></div><div class="modal-footer"><button style="border-radius:20px;" class="btn btn-outline-secondary btn_close_modal" type="button" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i> Tutup</button> <button style="border-radius:20px;" class="btn btn-outline-success createTaskNow" type="button" data-dismiss="modal" title="Buat"><i class="fa fa-pen"></i> Buat</button></div></div></div>'
    );
    $.ajax({
        url: '<?= base_url('Home/Group_Home') ?>',
        method: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            let id = data.data.ID,
                task = '<h3 class="help-block text-center">Tidak Ada Tugas</h3>';
            if (data.task.JML > 0) {
                task =
                    '<div class="table-responsive"><table class="table" id="task_group_info"><thead><th>No.</th><th>Subjek</th><th>Deadline</th><th>Status</th></thead><tbody></tbody></table></div>';
            }
            $.ajax({
                url: '<?= base_url('Home/TaskGroupHome') ?>',
                dataType: 'json',
                data: {
                    id: id
                },
                method: 'post',
                success: function(task) {
                    $('#task_group_info').DataTable({
                        "aaData": task,
                        "columns": [{
                                "data": "number"
                            },
                            {
                                "data": "subject"
                            },
                            {
                                "data": "deadline"
                            },
                            {
                                "data": "stats"
                            }
                        ]
                    });
                },
                error: function() {
                    internetConnection();
                }
            });
            let button_group = (data.admin == 1) ?
                `<div class="btn-group mt-2"><button style="border-radius: 20px 0 0 20px;" class="btn btn-sm btn-outline-danger shadow-sm close_groups" data-id="` +
                data.data.ID +
                `" title="Tutup Kelas"><i class="fas fa-sign-out-alt fa-sm"></i> Tutup Kelas</button><button style="border-radius: 0 20px 20px 0;" class="btn btn-sm btn-outline-primary shadow-sm" onclick="changeMode(` +
                data.data.ID +
                `)" title="Ganti Mode"><i class="fas fa-sign-out-alt fa-sm"></i> Mode Admin</button></div>` :
                `<button style="border-radius: 20px;" class="btn btn-sm mt-2 btn-outline-danger shadow-sm close_groups" data-id="` +
                data.data
                .ID +
                `" title="Tutup Kelas"><i class="fas fa-sign-out-alt fa-sm"></i> Tutup Kelas</button>`;

            $('.body-task').append(
                `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mt-1 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-users text-gray-700"></i> ` +
                data.data.nama +
                `</h1>` + button_group +
                `</div><div class="row justify-content-center"><div class="col-md-12 Groups_Home"></div></div><div class="row justify-content-center"><div class="col-md-12 Groups_body mb-3"></div></div>`
            );
            $('.Groups_body').append(
                '<div class="row justify-content-center"><div class="col-md-8 info_groups"></div><div class="col-md-4 message_groups"></div></div>'
            );
            $('.info_groups').append(
                '<div class="card animate-opacity shadow mb-2 bg-gray-100"><div class="card-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="help-block text-gray-100"><i class="fas fa-info-circle"></i> Kelas</h5></div><div class="card-body"><div class="row pr-2 pl-2"><div class="col-md-4"><img src="<?= base_url('assets/img/group/') ?>' +
                data.data.gambar +
                '" class="img-thumbnail img-responsive"></div><div class="col-md-4"><div class="table-responsive"><table class="table"><tbody><tr><td>Nama: </td><td>' +
                data.data.nama + '</td></tr><tr><td>Dibuat: </td><td>' + data.data.admin +
                '</td></tr><tr><td>Kode: </td><td>' + data.data.code +
                '</td></tr></tbody></table></div></div><div class="col-md-4"><div class="table-responsive"><table class="table"><tbody><tr><td>Dibuat: </td><td>' +
                data.data.date_created + '</td></tr><tr><td>Deskripsi: </td><td>' + data.data
                .description +
                '</td></tr></tbody></table></div></div></div></div></div><div class="card animate-opacity shadow mb-2 bg-gray-100"><div class="card-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="help-block text-gray-100"><i class="fas fa-drafting-compass"></i> Tugas Aktif</h5></div><div class="card-body">' +
                task + '</div></div>'
            );
            $('.message_groups').append(
                `<div class="card animate-opacity shadow mb-2 bg-gray-100"><div class="card-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="text-gray-100"><i class="fas fa-comments"></i> Chat Kelas</h5></div><div class="card-body"><div class="inbox_msg_group"><div class="mesgs_group" id="messageHeight"></div><div class="type_msg_group mt-2"><div class="input_msg_write_group mt-2"><div class="input-group"><input type="text" style="border-radius: 20px 0 0 20px;" class="form-control text-msg-group bg-light border-0 small" data-id="` +
                data.data.ID +
                `" placeholder="Ketik Pesan..."><div class="input-group-append"><button style="border-radius: 0 20px 20px 0;" class="btn btn-send-msg-group btn-outline-success" data-id="` +
                data.data.ID +
                `" type="button" title="Kirim Pesan"><i class="fas fa-paper-plane fa-sm"></i></button></div></div></div></div></div></div></div>`
            );
            $('.Groups_body').append(
                '<div class="row justify-content-center"><div class="col-md-12"><div class="card animate-opacity mt-1 shadow bg-gray-100"><div class="card-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="text-gray-100"><i class="fas fa-file"></i> File Kelas</h5></div><div class="card-body file-group-body"></div></div></div></div><div class="row justify-content-center"><div class="col-md-6"><div class="card animate-opacity mt-1 shadow bg-gray-100"><div class="card-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="text-gray-100 help-block"><i class="fas fa-user-plus"></i> Permintaan Bergabung</h5></div><div class="card-body request-groups"></div></div></div><div class="col-md-6"><div class="card shadow animate-opacity bg-gray-100 mt-1"><div class="card-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="text-gray-100"><i class="fas fa-users"></i> Anggota Kelas</h5></div><div class="card-body member-groups"></div></div></div>'
            );
            if (parseInt(data.file) > 0) {
                setTimeout(function() {
                    $.ajax({
                        url: '<?= base_url('Home/fileGroup') ?>',
                        data: {
                            id: id,
                            type: 0
                        },
                        method: 'get',
                        dataType: 'json',
                        success: function(file) {
                            $('.file-group-body').append(
                                '<div class="row"><div class="col-md-12"><div class="table-responsive"><table class="table table-hover" id="table_file_group"><thead><th>Nama File</th><th>Ukuran File</th><th>Unduh</th></thead><tbody></tbody></table></div></div></div>'
                            );
                            $('#table_file_group').DataTable({
                                "aaData": file,
                                "columns": [{
                                        "data": "name"
                                    },
                                    {
                                        "data": "size"
                                    },
                                    {
                                        "data": "download"
                                    }
                                ]
                            });
                        }
                    });
                }, 500);
            } else {
                $('.file-group-body').append(
                    '<div class="row justify-content-center text-center"><div class="col-md-6"><h5 class="help-block">Tidak Ada File</h5></div></div>'
                );
            }
            if (parseInt(data.request) > 0) {
                setTimeout(function() {
                    $.ajax({
                        url: '<?= base_url('Home/Groups_Request/') ?>' + data.data.ID,
                        method: 'post',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('.request-groups').children().remove();
                                $('.request-groups').append(
                                    '<div class="table-responsive"><table class="table table-hover" id="table_request_groups"><thead><th>No</th><th>Gambar</th><th>Nama</th><th>Username</th><th>Aksi</th></thead><tbody></tbody></table></div>'
                                );
                                $('#table_request_groups').DataTable({
                                    "aaData": data,
                                    "columns": [{
                                            "data": "ID"
                                        },
                                        {
                                            "data": "gambar"
                                        },
                                        {
                                            "data": "nama"
                                        },
                                        {
                                            "data": "username"
                                        },
                                        {
                                            "data": "aksi"
                                        }
                                    ]
                                });
                            }
                        },
                        error: function() {
                            internetConnection();
                        }
                    })
                }, 2000);
            } else {
                $('.request-groups').append(
                    '<h5 class="help-block text-center">Belum Ada Request</h5>'
                );
            }
            setTimeout(function() {
                $.ajax({
                    url: '<?= base_url('Home/Groups_Member/') ?>' + data.data.ID,
                    method: 'post',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            $('.member-groups').append(
                                '<div class="table-responsive"><table class="table table-hover" id="tab-member-group"><thead><th>No</th><th>Foto</th><th>Nama</th><th>Username</th><th>Detail</th</thead><tbody></tbody></table></div>'
                            );
                            $('#tab-member-group').DataTable({
                                "aaData": data,
                                "columns": [{
                                        "data": "ID"
                                    },
                                    {
                                        "data": "gambar"
                                    },
                                    {
                                        "data": "nama"
                                    },
                                    {
                                        "data": "username"
                                    },
                                    {
                                        "data": "aksi"
                                    }
                                ]
                            });
                        } else {
                            $('.member-groups').append(
                                '<h5 class="text-block text-center">Tidak Ada Anggota Kelas</h5>'
                            );
                        }
                    },
                    error: function() {
                        internetConnection();
                    }
                });
                message_group(id);
            }, 500);
        },
        error: function() {
            internetConnection();
        }
    });
}
$(document).on('click', '.createTaskNow', function() {
    let time = $('.hourTaskDeadline').val() + ':' + $('.minuteTaskDeadline').val() + ':' + $(
            '.secondsTaskDeadline').val(),
        subject = $('.subjectTask').val(),
        messages = $('.messagesTask').val(),
        deadlineTime = $('.deadlineCreateTask').val(),
        detail = $('.detailTask').val(),
        id = $('.idCreateTask').val();
    $.ajax({
        url: '<?= base_url('Home/CreateTask') ?>',
        method: 'post',
        data: {
            time: time,
            subject: subject,
            messages: messages,
            deadlineTime: deadlineTime,
            detail: detail,
            id: id
        },
        success: function() {
            Swal.fire('Tugas Ditambahkan', 'Tugas Baru Sudah ditambahkan ke dalam tugas aktif',
                'success');
            $('.btn_close_modal').trigger('click');
            changeMode(id);
        },
        errror: function() {
            internetConnection();
        }
    });
});
$(document).on('change', '.deadlineCreateTask', function() {
    $('.deadlineAlert').html('');
    $('#timeDeadline').children().remove();
    let date = new Date();
    let day = date.getDate(),
        month = (date.getMonth() + 1),
        year = date.getFullYear();
    let dateVal = $(this).val();
    dateVal = dateVal.split('-');
    if (dateVal[0] >= year) {
        if (dateVal[1] >= month && dateVal[2] > day) {
            $('#timeDeadline').append(
                '<th>Waktu</th><td>Jam: <input type="number" class="form-control hourTaskDeadline" min="0" max="23"> Menit: <input type="number" class="form-control minuteTaskDeadline" min="0" max="59"> Detik: <input type="number" class="form-control secondsTaskDeadline" min="0" max="59"></td>'
            );
        } else if (dateVal[1] > month) {
            $('#timeDeadline').append(
                '<th>Waktu</th><td>Jam: <input type="number" class="form-control hourTaskDeadline" min="0" max="23"> Menit: <input type="number" class="form-control minuteTaskDeadline" min="0" max="59"> Detik: <input type="number" class="form-control secondsTaskDeadline" min="0" max="59"></td>'
            );
        } else {
            $('.deadlineAlert').html('Waktu Sudah Lewat!').css('color', 'red');
        }
    } else {
        $('.deadlineAlert').html('Waktu Sudah Lewat!').css('color', 'red');
    }
});
$(document).on('click', '.detail-group-admin', function() {
    $('.modal-task-admin-change').children().remove();
    let id = $(this).data('id');
    $.ajax({
        url: '<?= base_url('Home/TaskDetailID') ?>',
        data: {
            id: id
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {
            $('.modal-task-admin-change').append(
                '<div class="row justify-content-center"><div class="col-md-10"><h3 class="help-block">Informasi Tugas</h3><div class="table-responsive ml-1 mr-1"><table class="table"><tbody><tr><th>Judul</th><td>' +
                data[0].subject + '</td></tr><tr><th>Pesan</th><td>' + data[0].messages +
                '</td></tr><tr><th>Deadline</th><td>' + data[0].deadline +
                '</td></tr></tbody></table></div><br><div class="row mb-1"><div class="col-8 float-left mb-1"><h3 class="help-block">Tugas terkumpul</h3></div><div class="col-4 float-right"><button data-file="' +
                data[0].file +
                '" style="border-radius: 20px;" class="btn btn-sm zipFileTask btn-outline-success" title="Unduh Semua File Sebagai Zip"><i class="fas fa-download"></i> Unduh Semua</button></div><div class="ml-1 mr-1 table-responsive"><table class="table"><thead><th>Nama</th><th>Username</th><th>Status</th><th>Aksi</th></thead><tbody class="task-users-modal"></tbody></table></div></div></div>'
            );
            for (let i = 0; i < data[1].length; i++) {
                let stats = (data[1][i].ID !== undefined) ?
                    '<div class="badge badge-success">Sudah</div>' :
                    '<div class="badge badge-danger">Belum</div>',
                    check = (data[1][i].ID !== undefined) ? '' : 'disabled';
                $('.task-users-modal').append('<tr><td>' + data[1][i].nama +
                    '</td><td>' + data[1][i].username +
                    '</td><td>' + stats +
                    '</td><td><button type="button" ' + check +
                    '  class="btn btn-outline-info result-task-admin-modal" data-toggle="modal" data-target="#detailTaskUsers" data-task="' +
                    (data[1][i].ID) +
                    '" style="border-radius: 20px;" title="Detail"><i class="fas fa-info fa-sm"></i> Lihat Tugas</button></td></tr>'
                );
            }
        },
        error: function() {
            internetConnection();
        }
    });
});
$(document).on('click', '.zipFileTask', function() {
    let file = $(this).data('file');
    $.ajax({
        url: '<?= base_url('Home/TaskZip') ?>',
        method: 'post',
        data: {
            file: file
        },
        dataType: 'json',
        success: function(data) {
            let redirect = window.open('<?= base_url('assets/files/tugas/') ?>' + file + '/' +
                data);
            redirect.location;
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '.result-task-admin-modal', function() {
    let data = $(this).data('task');
    $('.modal-result-task-users').children().remove();
    $.ajax({
        url: '<?= base_url('Home/TaskDetailUsers') ?>',
        method: 'post',
        data: {
            data: data
        },
        dataType: 'json',
        success: function(data) {
            $('.modal-result-task-users').append(
                '<h3 class="help-block ml-2">Informasi Anggota</h3><div class="row"><div class="col-md-4 text-center mb-2"><img class="img-responsive img-thumbnail" style="width: 120px;height: 100px;" src="<?= base_url('assets/img/profil/') ?>' +
                data.gambar +
                '"></div><div class="col-md-8"><div class=table-responsive"><table class="table"><tbody><tr><th>Nama</th><td>' +
                data.nama + '</td></tr><tr><th>Username</th><td>' + data.username +
                '</td></tr><tr><th>Email</th><td>' + data.email +
                '</td></tr></tbody></table></div></div></div><h3 class="help-block ml-2">Informasi Tugas</h3><br><div class="row justify-content-center"><div class="col-md-10"><div class="table-responsive"><table class="table"><tbody><tr><th>Judul</th><td>' +
                data.subject + '</td></tr><tr><th>Pesan</th><td>' + data.messages +
                '</td></tr><tr><th>File</th><td><a class="btn btn-outline-success" style="border-radius: 20px;" target="_blank" title="Unduh File" href="<?= base_url('assets/files/tugas/') ?>' +
                data.iFile + '/' +
                data.file +
                '"><i class="fas fa-download"></i> Unduh</a></td></tr><tr><th>Pesan Anggota</th><td>' +
                data.pesan + '</td></tr></tbody></table></div></div></div>'
            );
        },
        error: function() {}
    });
});
$(document).on('click', '.showModalCreateModal', function() {
    let id = $(this).data('id');
    $('.idCreateTask').val(id);
});

function changeMode(id) {
    $('.body-task').children().remove();
    $.ajax({
        url: '<?= base_url('Home/Group_Home') ?>',
        method: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            $('.body-task').append(
                `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mt-1 mb-2 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-users text-gray-700"></i> ` +
                data.data.nama +
                `</h1><div class="btn-group"><button style="border-radius: 20px 0 0 20px;" class="btn btn-sm btn-outline-danger shadow-sm close_groups" data-id="` +
                id +
                `" title="Tutup Kelas"><i class="fas fa-sign-out-alt fa-sm"></i> Tutup Kelas</button><button style="border-radius: 0 20px 20px 0;" class="btn btn-sm btn-outline-primary shadow-sm" onclick="Groups(` +
                id +
                `)" title="Ganti Mode"><i class="fas fa-sign-out-alt fa-sm"></i> Mode Anggota</button></div></div><div class="row justify-content-center"><div class="col-md-10 Groups_Home"><div class="card mb-2"><div class="card-header bg-<?= $profil['colourTopBar'] ?>"><div class="row justify-content-center"><div class="col-sm-6 float-left"><h5 class="help-block text-gray-200"><i class="fas fa-drafting-compass"></i> Tugas</h5></div><div class="col-sm-6 float-right"><button class="btn btn-sm btn-outline-success showModalCreateModal" style="border-radius: 20px;" data-toggle="modal" data-id="` +
                id +
                `" data-target="#createNewTaskAdmin"><i class="fas fa-pen"></i> Buat Tugas</button></div></div></div><div class="card-body bg-gray-100"><div class="table-responsive ml-2 mr-2 table-task-admin-group"></div></div></div></div></div><div class="row mt-2 justify-content-center"><div class="col-md-10 mb-3"><div class="card mb-2"><div class="card-header bg-<?= $profil['colourTopBar'] ?>"><div class="row justify-content-center"><div class="col-sm-6 float-left"><h5 class="help-block text-gray-200"><i class="fas fa-file"></i> File</h5></div><div class="col-sm-6 float-right"><button style="border-radius: 20px;" data-target="#modal-new-file-group" data-id="` +
                id +
                `" data-toggle="modal" class="btn btn-sm btn-outline-success file-group-before" title="Tambah File Kelas"><i class="fas fa-plus"></i> Tambah File</button></div></div></div><div class="card-body bg-gray-100 justify-content-center"><div class="ml-2 mr-2 file-body-admin"></div></div></div></div></div><div class="row mt-2 justify-content-center"><div class="col-md-10 mb-3"><div class="card mb-2"><div class="card-header bg-<?= $profil['colourTopBar'] ?>"><div class="row"><h5 class="help-block text-gray-200"><i class="fas fa-user-edit"></i> Anggota</h5></div></div><div class="card-body bg-gray-100"><div class="table-responsive ml-2 mr-2"><table class="table table-hover" id="adminGroupMember"><thead><th>Foto Profil</th><th>Nama</th><th>Username</th><th>Aksi</th></thead><tbody></tbody></table></div></div></div></div></div></div>`
            );
            if (parseInt(data.file) > 0) {
                $.ajax({
                    url: '<?= base_url('Home/fileGroup') ?>',
                    method: 'get',
                    data: {
                        id: id,
                        type: 1
                    },
                    dataType: 'json',
                    success: function(file) {
                        $('.file-body-admin').append(
                            '<div class="row justify-content-center"><div class="table-responsive"><table class="table table-hover" id="fileGroupAdmin"><thead><tr><th>Nama File</th><th>Ukuran</th><th>Unduh</th><th>Hapus</th></tr></thead><tbody></tbody></table></div></div>'
                        );
                        $('#fileGroupAdmin').DataTable({
                            "order": [
                                [0, "ASC"]
                            ],
                            "aaData": file,
                            "columns": [{
                                    "data": "name"
                                },
                                {
                                    "data": "size"
                                },
                                {
                                    "data": "download"
                                },
                                {
                                    "data": "delete"
                                }
                            ]
                        });
                    }
                });
            } else {
                $('.file-body-admin').append(
                    '<div class="row"><h5 class="help-block text-center"></h5></div>')
            }
            $.ajax({
                url: '<?= base_url('Home/TaskGroupAdmin') ?>',
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(task) {
                    if (task) {
                        $('.table-task-admin-group').append(
                            '<table class="table table-hover" id="table-group-admin-task"><thead><th>Judul</th><th>Pesan</th><th>Status</th><th>Deadline</th><th>Aksi</th></thead><tbody></tbody></table>'
                        );
                        $('#table-group-admin-task').DataTable({
                            "order": [
                                [3, "desc"]
                            ],
                            "aaData": task,
                            "columns": [{
                                    "data": "subject"
                                },
                                {
                                    "data": "messages"
                                },
                                {
                                    "data": "status"
                                },
                                {
                                    "data": "deadline"
                                },
                                {
                                    "data": "aksi"
                                }
                            ]
                        });
                    } else {
                        $('.table-task-admin-group').append(
                            '<h5 class="text-center help-block">Tidak Ada Tugas</h5>');
                    }
                },
                error: function() {
                    internetConnection();
                }
            });
            $.ajax({
                url: '<?= base_url('Home/MemberGroupAdmin') ?>',
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(member) {
                    $('#adminGroupMember').DataTable({
                        "order": [
                            [1, "asc"]
                        ],
                        "aaData": member,
                        "columns": [{
                                "data": "gambar"
                            },
                            {
                                "data": "nama"
                            },
                            {
                                "data": "username"
                            },
                            {
                                "data": "aksi"
                            }
                        ]
                    });
                },
                error: function() {
                    internetConnection();
                }
            });
        },
        error: function() {
            internetConnection();
        }
    });
}
$(document).on('click', '.newFileGroup', function() {
    let fd = new FormData();
    let data = [];
    let id = $('.file-group-before').data('id');
    let files = ($('#file-group-upload').val() != '' || $('#file-attach') != null) ? $('#file-group-upload')[0]
        .files[0] :
        '';
    fd.append('file', files);
    data.push({
        "id": id
    });
    fd.append('data', JSON.stringify(data));
    $.ajax({
        url: '<?= base_url('Home/UploadFileGroup') ?>',
        method: 'post',
        data: fd,
        processData: false,
        contentType: false,
        success: function() {
            $('.btn_close_modal').trigger('click');
            $('.file-group-upload').val('');
            $('.label-file-upload-group').html('Terpilih: ');
            changeMode(id);
        },
        error: function() {
            Swal.fire('Gagal', 'Periksa kembali nama, ukuran file', 'warning');
        }
    });
});
$(document).on('click', '.admin-change', function() {
    let id = $(this).data('id'),
        group = $(this).data('group');
    $.ajax({
        url: '<?= base_url('Home/AdminChange') ?>',
        method: 'post',
        data: {
            id: id,
            group: group
        },
        success: function() {
            Swal.fire('Berhasil', 'Admin telah Bertambah', 'success');
            changeMode(group);
        },
        error: function() {
            internetConnection();
        }
    });
});
$(document).on('click', '.member-change', function() {
    let id = $(this).data('id'),
        group = $(this).data('group');
    $.ajax({
        url: '<?= base_url('Home/MemberChange') ?>',
        method: 'post',
        data: {
            id: id,
            group: group
        },
        success: function() {
            Swal.fire('Berhasil', 'Admin telah Berkurang', 'success');
            changeMode(group);
        },
        error: function() {
            internetConnection();
        }
    });
});
$(document).on('click', '.deleteFileGroup', function() {
    let id = $(this).data('id');
    let file = $(this).data('file');
    Swal.fire({
        title: 'Hapus File?',
        text: "File yang dipilih akan dihapus secara permanen! Lanjutkan?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Hapus Saja!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/deleteFileGroup') ?>',
                method: 'post',
                data: {
                    id: id,
                    file: file
                },
                success: function() {
                    Swal.fire('Berhasil', 'File Telah dihapus', 'success');
                    changeMode(id);
                },
                error: function() {
                    internetConnection();
                }
            });
        }
    });
});
$(document).on('click', '.delete-group-admin', function() {
    let id = $(this).data('id');
    let group = $(this).data('group');
    Swal.fire({
        title: 'Hapus Tugas?',
        text: "Semua informasi tugas termasuk file tugas dari member akan dihapus permanen!",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Hapus Saja!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/TaskDelete') ?>',
                method: 'post',
                data: {
                    id: id
                },
                success: function() {
                    Swal.fire('Berhasil', 'Tugas Telah dihapus', 'success');
                    changeMode(group);
                },
                error: function() {
                    internetConnection();
                }
            });
        }
    });
});

function message_group(id) {
    $('.mesgs_group').children().remove();
    $.ajax({
        url: '<?= base_url('Home/MessageGroup') ?>',
        method: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(msg) {
            let date = '',
                tgl = '';
            if (jQuery.isEmptyObject(msg)) {
                $('.mesgs_group').append(
                    '<h5 class="help-block text-center margin-auto mt-5 mb-5">Tidak Ada Chat</h5>'
                );
            } else {
                $('.mesgs_group').append('<div class="msg_history_group"></div>');
                for (let i = 0; i < msg.length; i++) {
                    date = msg[i].date_chat;
                    date = date.split(' ');
                    tgl = date[0].split('-');
                    date = date[1].split(':');
                    tgl[1] = getMonthNow(tgl[1]);
                    if (msg[i].text == '' && msg[i].file ==
                        'deleted') {
                        $('.msg_history_group').append(
                            '<div class="incoming_msg msg-group-' + msg[
                                i].ID +
                            ' text-center"><div class="badge badge-info text-gray-100">' +
                            msg[i].profil.nama +
                            ' urung kirim pesan</div></div>');
                    } else {
                        if (msg[i].stats == 0) {
                            $('.msg_history_group').append(
                                `<div class="incoming_msg msg-group-` +
                                msg[i].ID +
                                `"><div class="incoming_msg_img_group"><img class="img-responsive rounded-circle" style="width: 45px; height: 35px;" src="<?= base_url('assets/img/profil/') ?>` +
                                msg[i].profil.gambar +
                                `" alt="sunil"> </div><div class="received_msg_group"><a data-toggle="modal" data-target="#MessageGroupID" onclick="GroupMSG(` +
                                msg[i].ID + `)" data-id="` +
                                msg[i].ID +
                                `" href="javascript:void(0)">` +
                                msg[i].profil.nama +
                                `</a><div class="received_withd_msg_group"><p>` +
                                msg[i].text +
                                `</p><span class="time_date"> ` + date[
                                    0] +
                                `:` + date[1] + `    |   ` + tgl[2] +
                                ` ` +
                                tgl[1] + ` ` + tgl[0] +
                                `</span></div></div></div>`
                            );
                        } else {
                            $('.msg_history_group').append(
                                `<div class="outgoing_msg_group msg-group-` +
                                msg[i].ID +
                                `"><div class="outgoing_msg_img_group"><img class="img-responsive rounded-circle" style="width: 45px;height: 35px;" src="<?= base_url('assets/img/profil/') ?>` +
                                msg[i].profil.gambar +
                                `" alt="sunil"> </div><div class="sent_msg_group"><a data-toggle="modal" data-target="#MessageGroupID" onclick="GroupMSG(` +
                                msg[i].ID + `)" data-id="` +
                                msg[i].ID +
                                `" href="javascript:void(0)">` +
                                msg[i].profil.nama + `</a><p>` + msg[i]
                                .text +
                                `</p><span class="time_date"> ` + date[
                                    0] +
                                `:` + date[1] + `    |   ` + tgl[2] +
                                ` ` +
                                tgl[1] + ` ` + tgl[0] +
                                `</span> </div></div></div>`
                            );
                        }
                    }
                }
            }
            setTimeout(function() {
                $('.msg_history_group').animate({
                    scrollTop: $('.msg_history_group').prop("scrollHeight")
                }, 500);
            }, 100);
        },
        error: function() {
            internetConnection();
        }
    });
}
$(document).on('click', '.btn-send-msg-group', function() {
    sendMessageGroup($(this).data('id'), $('.text-msg-group').val());
});
$(document).on('keyup', '.text-msg-group', function(e) {
    if (e.which == 13) {
        sendMessageGroup($(this).data('id'), $(this).val());
    }
});

function sendMessageGroup(id, text) {
    let file = '';
    if (text !== '' || text !== ' ' || text !== null) {
        $.ajax({
            url: '<?= base_url('Home/sendMessageGroup') ?>',
            method: 'post',
            data: {
                id: id,
                text: text,
                file: file
            },
            success: function() {
                message_group(id);
                $('.text-msg-group').val('');
            },
            error: function() {
                internetConnection();
            }
        });
    }
}

function GroupMSG(id) {
    $('.detailMessageGroupID').children().remove();
    $('.btn-message-group-id').children().remove();
    $.ajax({
        url: '<?= base_url('Home/MessageIDGroup') ?>',
        method: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            if (data) {
                let btn = (data.stats == 1) ?
                    '<button style="border-radius: 20px;" class="btn btn-outline-danger urungKirim" data-group="' +
                    data.id_group +
                    '" data-id="' + data.ID +
                    '" title="Tarik Obrolan Kamu"><i class="fas fa-envelope"></i> Urung Kirim</button>' :
                    '<button style="border-radius: 20px;" class="btn btn-outline-danger report-user" data-id="' +
                    data.id_users +
                    '" data-toggle="modal" data-target="#report-user-member" title="Laporkan"><i class="fas fa-exclamation-triangle"></i> Laporkan</button>',
                    stats = (data.stats == 1) ? [
                        '<div class="badge badge-info">Anda</div>',
                        '<div class="badge badge-info">Sendiri</div>'
                    ] : [
                        (data.relate[0] == 0) ? '<div class="badge badge-danger">Tidak Dikenal</div>' :
                        '<div class="badge badge-success">Teman</div>',
                        (data.relate[1] == 0) ? '' : '<div class="badge badge-danger">Diblokir</div>'
                    ],
                    file = (data.file !== '') ? '<a href="<?= base_url('assets/files/group/') ?>' + data
                    .file +
                    '" target="_blank" style="border-radius: 20px;" class="btn btn-outline-success" title="Unduh File"><i class="fas fa-download"> Unduh File</a>' :
                    '<p class="help-block">Tidak Ada File</p>';
                $('.detailMessageGroupID').append(
                    '<div class="row ml-3 mr-3"><h5 class="help-block">Informasi Pengirim</h5><br><hr></div><div class="row justify-content-center mr-4 ml-4"><div class="col-md-3"><img src="<?= base_url('assets/img/profil/') ?>' +
                    data.profil.gambar +
                    '" class="img-responsive img-thumbnail shadow" alt="" style="width: 200px;height: 150px;"></div><div class="col-md-7"><div class="table-responsive"><table class="table"><tbody><tr><th>Nama</th><td>' +
                    data.profil.nama + '</td></tr><tr><th>Username</th><td>' + data.profil.username +
                    '</td></tr><tr><th>Status</th><td>' + stats[0] +
                    ' ' + stats[1] +
                    '</td></tr></tbody></table></div></div></div><div class="row ml-3 mr-3"><h5 class="help-block">Obrolan</h5><br><hr></div><div class="row ml-4 mr-4"><div class="col-md-12"><div class="table-responsive"><table class="table"><tbody><tr><th>Waktu</th><td>' +
                    data.date_chat + '</td></tr><tr><th>Teks</th><td>' + data.text +
                    '</td></tr><tr><th>file</th><td>' + file +
                    '</td></tr></tbody></table></div></div></div>'
                );
                $('.btn-message-group-id').append(btn);
            } else {}
        },
        error: function() {
            internetConnection();
        }
    });
}

$(document).on('click', '.urungKirim', function() {
    let id = $(this).data('id'),
        idG = $(this).data('group');
    Swal.fire({
        title: 'Urung Kirim?',
        text: "Pesan yang kamu kirim Akan ditarik!",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Urung Kirim!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/UrungKirim') ?>',
                method: 'post',
                data: {
                    id: id
                },
                success: function() {
                    $('.btn_close_modal').trigger('click');
                    message_group(idG);
                    Swal.fire('Berhasil',
                        'Urung Kirim Berhasil.', 'success');
                },
                error: function() {
                    internetConnection();
                }
            });
        }
    });
});
$(document).on('click', '.detail_member_groups', function() {
    $('.table-info-member > tbody').children().remove();
    $('.img-info-member').attr('src', '');
    $('.btn-member-option').children().remove();
    let group = $(this).data('grup'),
        id = $(this).data('id');
    $.ajax({
        url: '<?= base_url('Home/GroupsMember') ?>',
        method: 'post',
        data: {
            group: group,
            id: id
        },
        dataType: 'json',
        success: function(data) {
            if (data) {
                let type = '',
                    btn = '';
                if (data.type.admin == 1) {
                    type += ' <div class="badge badge-success">Admin</div>';
                }
                if (data.type.member == 1) {
                    type += ' <div class="badge badge-primary">Member</div>';
                }
                if ('<?= $profil['ID'] ?>' !== data.profil.ID) {
                    if (data.data[0] == 1 && data.data[1] == 0) {
                        btn +=
                            ' <button data-id="' + data.profil.ID +
                            '" style="border-radius: 20px;" class="btn mt-1 btn-outline-primary sendMessageFriends" data-id="' +
                            data.profil.ID +
                            '" data-toggle="modal" data-target="#sendMessageFriends" title="Kirim Pesan Cepat"><i class="fas fa-envelope"></i> Kirim Pesan</button>'
                    } else if (data.data[0] == 0 && data.data[1] == 1) {
                        btn +=
                            ' <button data-id="' + data.profil.ID +
                            '" style="border-radius: 20px;" class="btn mt-1 btn-outline-primary send-notreq-friends" title="Batalkan Permintaan Pertemanan"><i class="fas fa-user-plus"></i> Batalkan Permintaan Pertemanan</button>';
                    } else {
                        btn +=
                            ' <button data-id="' + data.profil.ID +
                            '" style="border-radius: 20px;" class="btn mt-1 btn-outline-success send-request-friends" title="Kirim Permintaan Pertemanan"><i class="fas fa-user-plus"></i> Kirim Permintaan Pertemanan</button>';
                    }
                    btn +=
                        ' <button class="btn mt-1 btn-outline-danger report-user" data-toggle="modal" data-target="#report-user-member" style="border-radius: 20px;" data-id="' +
                        data.profil.ID +
                        ' title="Laporkan pengguna"><i class="fas fa-exclamation-triangle"></i> Laporkan</button>';
                }
                $('.img-info-member').attr('src', '<?= base_url('assets/img/profil/') ?>' + data
                    .profil.gambar);
                $('.table-info-member > tbody').append('<tr><td>Nama</td><td>' + data.profil
                    .nama +
                    '</td></tr><tr><td>Username</td><td>' + data.profil.username +
                    '</td></tr><tr><td>Email</td><td>' + data.profil.email +
                    '</td></tr><tr><td>Tipe</td><td>' + type + '</td></tr>');
                $('.btn-member-option').append(btn);
            }
        },
        error: function() {
            internetConnection();
        }
    });
});
$(document).on('click', '.report-user', function() {
    $('.btn_close_modal').trigger('click');
    let id = $(this).data('id');
    $('#id_report').val(id);
});
$(document).on('click', '.report_user', function() {
    let id = $('#id_report').val(),
        text = $('.fill-user-report-text').val();
    $.ajax({
        url: '<?= base_url('Home/Report') ?>',
        method: 'post',
        data: {
            id: id,
            text: text
        },
        success: function() {
            $('.btn_close_modal').trigger('click');
            $('#id_report').val('');
            $('.fill-user-report-text').val('');
            Swal.fire('Terima Kasih', 'Laporan Anda Akan kami tindak lanjuti', 'success');
        },
        error: function() {
            internetConnection();
        }
    });
});
$(document).on('click', '.send-notreq-friends', function() {
    let id = $(this).data('id'),
        type = 'Remove';
    $.ajax({
        url: '<?= base_url('Home/RequestFriends') ?>',
        method: 'post',
        data: {
            id: id,
            type: type
        },
        success: function() {
            Swal.fire('Berhasil', 'Permintaan pertemanan telah dibatalkan', 'success');
            $('.btn_close_modal').trigger('click');
        },
        error: function() {
            internetConnection();
        }
    });
});
$(document).on('click', '.send-request-friends', function() {
    let id = $(this).data('id'),
        type = 'Add';
    $.ajax({
        url: '<?= base_url('Home/RequestFriends') ?>',
        method: 'post',
        data: {
            id: id,
            type: type
        },
        success: function() {
            Swal.fire('Berhasil', 'Permintaan pertemanan telah dikirim', 'success');
            $('.btn_close_modal').trigger('click');
        },
        error: function() {
            internetConnection();
        }
    });
});
$(document).on('click', '.acceptRequestGroups', function() {
    let id = $(this).data('id'),
        idGroups = $(this).data('groups'),
        name = $(this).data('name'),
        type = 'Accept';
    $.ajax({
        url: '<?= base_url('Home/GroupsRequest') ?>',
        method: 'post',
        data: {
            id: id,
            type: type,
            idGroups: idGroups
        },
        success: function() {
            Swal.fire('Berhasil', 'Username ' + name +
                ' telah berhasil dimasukan ke dalam Kelas',
                'success');
            Groups(idGroups);
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '.declineRequestGroups', function() {
    let id = $(this).data('id'),
        idGroups = $(this).data('groups'),
        name = $(this).data('name'),
        type = 'Decline';
    $.ajax({
        url: '<?= base_url('Home/GroupsRequest') ?>',
        method: 'post',
        data: {
            id: id,
            type: type,
            idGroups: idGroups
        },
        success: function() {
            Swal.fire('Berhasil', 'Username ' + name +
                ' tidak disetujui untuk masuk ke dalam Kelas',
                'success');
            Groups(idGroups);
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '.close_groups', function() {
    let id = $(this).data('id');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Kamu akan menutup Kelas yang telah dipilih!",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Tutup!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/GroupClose') ?>',
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (parseInt(data) == 0) {
                        $('.groups-navbar').children().remove();
                    } else {
                        $('.group-' + id).remove();
                    }
                    Group();
                    Swal.fire('Berhasil', 'Kelas Sudah ditutup!', 'success');
                },
                error: function() {
                    internetConnection();
                }
            })
        }
    });
});

function Group_body() {
    $.ajax({
        url: '<?= base_url('Home/Group') ?>',
        method: 'post',
        dataType: 'json',
        success: function(data) {
            if (data.length > 0) {
                let title = '',
                    icon = '',
                    btn = '',
                    classi = '';
                for (let i = 0; i < data.length; i++) {
                    if (data[i].type == 'request') {
                        title = "Menunggu Konfirmasi Admin";
                        icon = "fa-times";
                        btn = "disabled";
                    }
                    if (data[i].type == 'block') {
                        title = "Anda Di Blokir";
                        icon = "fa-shield-alt";
                        btn = "disabled";
                    }
                    if (data[i].type == 'member' || data[i].type == 'admin') {
                        title = "Masuk";
                        icon = "fa-sign-in-alt";
                        classi = "sign_in_group";
                    }
                    if (data[i].type == 'kick') {
                        title = "Anda Dikeluarkan";
                        icon = "fa-times";
                        btn = "disabled";
                    }
                    $('.Group_body').append(
                        '<div class="card border-left-primary mb-3 animate-opacity shadow-lg" id="' +
                        data[i]
                        .ID +
                        '"><div class="card-body"><div class="row justify-content-center"><div class="col-md-4 text-center mb-1"><img src="<?= base_url('assets/img/group/') ?>' +
                        data[i].gambar +
                        '" style="width: 200px;" class="img-responsive image_group img-thumbnail shadow-sm"></div><div class="col-md-4 mb-1"><div class="table-responsive"><table class="table"><tbody><tr><td>Nama</td><td>' +
                        data[i].nama + '</td></tr><tr><td>Dibuat oleh</td><td>' + data[i].admin +
                        '</td></tr></tbody></table></div></div><div class="col-md-4 mb-1"><div class="table-responsive"><table class="table"><tbody><tr><td>Kode</td><td>' +
                        data[i].code + '</td></tr><tr><td>Dibuat</td><td>' + data[i]
                        .date_created +
                        '</td></tr></tbody></table></div></div><div class="row text-center justify-content-center"><div class="col-sm-12"><button class="btn-outline-primary btn info_group" style="border-radius: 20px;" title"Detail" data-toggle="modal" data-target="#info_group" data-id="' +
                        data[i].ID +
                        '"><i class="fas fa-info fa-sm"></i> info</button> <button style="border-radius: 20px;" ' +
                        btn +
                        ' title="' + title + '" class="btn btn-outline-success ' + classi +
                        '" data-id="' + data[i].ID + '" data-code="' + data[i].code +
                        '"><i class="fas ' + icon + ' fa-sm"></i> ' +
                        title +
                        '</button> <button title="Keluar" style="border-radius: 20px;" class="btn btn-outline-danger out_group" data-id="' +
                        data[i].ID + '" data-type="' +
                        data[i].type +
                        '"><i class="fas fa-eraser fa-sm"></i> Keluar</button></div></div></div>');
                }
            } else {
                $('.Group_body').append(
                    '<div class=" text-center"><h3 class="help-block">Tidak Ada Kelas</h3><br><button class="btn btn-outline-primary" title="Tambahkan Kelas" data-toggle="modal" data-target="#add_group"><i class="fas fa-plus"></i> Tambah Kelas</button></div>'
                );
            }
        },
        error: function() {
            $('.Group_body').append(
                '<h3 class="help-block text-center">Periksa Kembali Koneksi Anda</h3>');
        }
    })
}

function Activity() {
    NotifyNavbar();
    $('.group').removeClass('active');
    $('.home').removeClass('active');
    $('.task').removeClass('active');
    $('.friends').removeClass('active');
    $('.groups').removeClass('active');
    $('.chatting').removeClass('active');
    $('.setting').removeClass('active');
    $('.modal-task').children('div').remove();
    $('.body-task').children('div').remove();
    $('.body-task').children('div').remove();
    $('.modal-task').append(
        '<div class="modal fade" id="activity-info" tabindex="-1" role="dialog" aria-labelledby="modal_add_group" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="modal_add_group"><i class="fas fa-info-circle"></i> Detail Aktivitas</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body margin-auto"><div class="table-responsive"><table class="table"><tbody><tr><td>Nama</td><td><p class="nama-activity-info"></td></tr><tr><td>Username</td><td><p class="username-activity-info"></td></tr><tr><td>Tanggal Aktivitas</td><td><p class="tgl_activity_info"></p></td></tr><tr><td>Kegiatan</td><td><p class="kegiatan-activity-info"></p></td></tr><tr><td>Keterangan</td><td><p class="keterangan-activity-info"></p></td></tbody></table></div></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" type="button" data-dismiss="modal" title="Batal"><i class="fa fa-times"></i></button></div></div></div></div>'
    );
    $('.body-task').append(
        `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-clipboard-list text-gray-700"></i> Aktivitas</h1></div><div class="row justify-content-center"><div class="col-md-10 activity_main"></div></div>`
    );
    $.ajax({
        url: '<?= base_url('Home/Activity') ?>',
        dataType: 'json',
        success: function(data) {
            if (data.length > 0) {
                $('.activity_main').append(
                    '<div class="table-responsive mb-3 animate-opacity"><table class="table" id="table_activity"><thead><tr><th>ID</th><th>Nama</th><th>Username</th><th>Tanggal</th><th>Kegiatan</th><th>Aksi</th></tr></thead><tbody></tbody></table></div>'
                );
                $('#table_activity').DataTable({
                    "aaData": data,
                    "order": [
                        [3, "desc"]
                    ],
                    "columns": [{
                            "data": "number"
                        },
                        {
                            "data": "nama"
                        },
                        {
                            "data": "username"
                        },
                        {
                            "data": "tgl_activity"
                        },
                        {
                            "data": "kegiatan"
                        },
                        {
                            "data": "info"
                        }
                    ]
                });
            } else {
                $('.activity_main').append(
                    '<h3 class="help-block text-center animate-opacity">Tidak Ada Aktivitas baru-baru Ini</h3>'
                );
            }
        },
        error: function() {
            internetConnection();
        }
    })
}

function Task() {
    NotifyNavbar();
    $('.group').removeClass('active');
    $('.home').removeClass('active');
    $('.task').addClass('active');
    $('.groups').removeClass('active');
    $('.chatting').removeClass('active');
    $('.friends').removeClass('active');
    $('.setting').removeClass('active');
    $('.modal-task').children('div').remove();
    $('.modal-task').append(
        '<div class="modal fade" id="upload_task_active" tabindex="-1" role="dialog" aria-labelledby="modal_upload_task" aria-hidden="true"><div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="modal_upload_task"><i class="fas fa-drafting-compass"></i> Unggah Tugas Anda</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body tab-modal-task"></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" type="button" data-dismiss="modal" style="border-radius: 20px;" title="Tutup"><i class="fa fa-times"></i> Tutup</button> <button class="btn btn-outline-success task_upload_complete" style="border-radius: 20px;" type="button" data-dismiss="modal" title="Unggah"><i class="fas fa-paper-plane"></i> Kirim Tugas</button></div></div></div>'
    );
    $('.body-task').children('div').remove();
    $('.body-task').append(
        `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-drafting-compass text-gray-700"></i> Tugas</h1></div><div class="row justify-content-center"><div class="col-md-12  task_home"></div></div>`
    );
    $.ajax({
        url: '<?= base_url('Home/Task') ?>',
        dataType: 'json',
        success: function(data) {
            $('.task_home').append(
                '<div class="card shadow mb-2 animate-opacity"><div class="card-body"><div class="row justify-content-center"><div class="col-sm-12"><h5 class="help-block"><i class="fas fa-drafting-compass"></i> Tugas Aktif </h5></div></div><hr><div class="row table-responsive active_table_task pr-3 pl-3"></div></div></div>'
            );
            if (jQuery.isEmptyObject(data)) {
                $('.active_table_task').append(
                    '<h5 class="help-block text-center">Tidak Ada Tugas Aktif</h5>');
            } else {
                $('.active_table_task').append(
                    '<table class="table"><thead><th>No.</th><th>Kelas</th><th>Kode</th><th>Subjek</th><th>Deadline</th><th>Unggah</th></thead><tbody class="active_task"></tbody></table>'
                );
                let no = 1,
                    color = '';
                for (let i = 0; i < data.length; i++) {
                    for (let j = 0; j < data[i].length; j++) {
                        color = 'danger';
                        if (data[i][j].upload == 1) {
                            color = 'success';
                        }
                        $('.active_task').append('<tr><td class="bg-' + color + ' task-' +
                            data[i][j].ID +
                            ' text-gray-100">' + (no) +
                            '</td><td>' + data[i][j].group.nama + '</td><td>' + data[i][j].group
                            .code +
                            '</td><td>' + data[i][j].subject + '</td><td>' + data[i][j].deadline +
                            '</td><td>' + data[i][j].aksi + '</td></tr>');
                        no++;
                    }
                }
            }
        },
        error: function() {
            internetConnection();
        }
    });
    setTimeout(function() {
        $('.task_home').append(
            '<div class="card shadow mb-2 animate-opacity"><div class="card-body"><div class="row justify-content-center"><div class="col-sm-12"><h5 class="help-block"><i class="fas fa-history"></i> Riwayat Tugas </h5></div></div><hr><div class="row table-responsive history_table_task pr-3 pl-3"></div></div></div>'
        );
        $.ajax({
            url: '<?= base_url('Home/TaskHistory') ?>',
            dataType: 'json',
            success: function(history) {
                if (history.count !== 0) {
                    if (jQuery.isEmptyObject(history[0])) {
                        $('.history_table_task').append(
                            '<h3 class="help-block text-center">Tidak Ada Riwayat Tugas</h3>'
                        );
                    } else {
                        $('.history_table_task').append(
                            '<table class="table"><thead><th>No.</th><th>Kelas</th><th>Kode</th><th>Subjek</th><th>Deadline</th><th>Detil</th></thead><tbody class="history_task_tab"></tbody></table>'
                        );
                        let no = 1,
                            color = '';
                        for (let i = 0; i < history.count; i++) {
                            for (let j = 0; j < history[i].length; j++) {
                                color = 'danger';
                                if (history[i][j].upload == 1) {
                                    color = 'success';
                                }
                                $('.history_task_tab').append(
                                    '<tr><td class="rowTaskSubmit bg-' +
                                    color +
                                    ' task-' + history[i][j].ID + ' text-gray-100">' + (
                                        no) +
                                    '</td><td>' +
                                    history[i][j].group.nama + '</td><td>' + history[i][j]
                                    .group
                                    .code + '</td><td>' + history[i][j].subject +
                                    '</td><td>' +
                                    history[i][j].deadline + '</td><td>' + history[i][j]
                                    .aksi +
                                    '</td></tr>');
                                no++;

                            }
                        }
                    }
                } else {
                    $('.history_table_task').append(
                        '<h3 class="help-block text-center">Tidak Ada Riwayat Tugas</h3>'
                    );
                }
            },
            error: function() {
                internetConnection();
            }
        });
    }, 200);
}

function Friends() {
    NotifyNavbar();
    $('.group').removeClass('active');
    $('.home').removeClass('active');
    $('.chatting').removeClass('active');
    $('.task').removeClass('active');
    $('.groups').removeClass('active');
    $('.friends').addClass('active');
    $('.setting').removeClass('active');
    $('.modal-task').children('div').remove();
    $('.modal-task').append(
        '<div class="modal fade" id="detail-member-friends" tabindex="-1" role="dialog" aria-labelledby="detail-member-friends-modal" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="detail-member-friends-modal"><i class="fas fa-info-circle"></i> Rincian Teman Anda</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="row justify-content-center mr-2 ml-2"><div class="col-md-4 mb-1"><img src="" style="width: 200px;" class="img-friends-detail img-responsive img-thumbnail shadow"></div><div class="col-md-8 mb-1"><div class="table-responsive"><table class="table"><tbody class="tab-detail-member"></tbody></table></div></div></div></div><div class="modal-footer"><div class="btn-member-friends"></div><button class="btn btn-outline-secondary btn_close_modal" style="border-radius: 20px;" type="button" data-dismiss="modal" title="Tutup"><i class="fa fa-times"></i></button></div></div></div>'
    );
    $('.body-task').children('div').remove();
    $('.body-task').append(
        `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-user-friends text-gray-700"></i> Teman</h1></div><div class="row justify-content-center friends_home"></div>`
    );
    $.ajax({
        url: '<?= base_url('Home/Friends') ?>',
        dataType: 'json',
        success: function(data) {
            $('.friends_home').append(
                '<div class="col-md-6"><div class="card shadow animate-opacity mb-1 mr-2 ml-2"><div class="card-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="text-gray-100"><i class="fas fa-user-plus"></i> Permintaan Pertemanan</h5></div><div class="card-body request-friends-sort"></div></div></div><div class="col-md-6"><div class="card shadow animate-opacity mb-1 mr-2 ml-2"><div class="card-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="text-gray-100"><i class="fas fa-users"></i> Teman</h5></div><div class="card-body friends-card"></div></div></div>'
            );
            if (data[1] == 0) {
                $('.request-friends-sort').append(
                    '<p class="help-block text-center">Tidak Ada Permintaan Pertemanan</p>');
            } else {
                $('.request-friends-sort').append(
                    '<div class="table-responsive"><table class="table" id="tab-request-friends"><thead><th>No</th><th>Gambar</th><th>Nama</th><th>Username</th><th>Aksi</th></thead><tbody></tbody></table></div>'
                );
                $.ajax({
                    url: '<?= base_url('Home/FriendRequest') ?>',
                    dataType: 'json',
                    success: function(data) {
                        $('#tab-request-friends').DataTable({
                            "order": [
                                [0, "desc"]
                            ],
                            "aaData": data,
                            "columns": [{
                                    "data": "number"
                                },
                                {
                                    "data": "gambar"
                                },
                                {
                                    "data": "nama"
                                },
                                {
                                    "data": "username"
                                },
                                {
                                    "data": "aksi"
                                }
                            ]
                        });
                    },
                    error: function() {
                        internetConnection();
                    }
                });
            }
            if (data[0] == 0) {
                $('.friends-card').append('<p class="help-block text-center">Tidak Ada Teman</p>');
            } else {
                $('.friends-card').append(
                    '<div class="table-responsive"><table class="table" id="table-friends-list"><thead><th>No.</th><th>Gambar</th><th>Nama</th><th>Username</th><th>Aksi</th></thead><tbody></tbody></table></div>'
                );
                $.ajax({
                    url: '<?= base_url('Home/FriendHome') ?>',
                    dataType: 'json',
                    success: function(data) {
                        $('#table-friends-list').DataTable({
                            "aaData": data,
                            "columns": [{
                                    "data": "number"
                                },
                                {
                                    "data": "gambar"
                                },
                                {
                                    "data": "nama"
                                },
                                {
                                    "data": "username"
                                },
                                {
                                    "data": "aksi"
                                }
                            ]
                        });
                    },
                    error: function() {
                        internetConnection();
                    }
                });
            }
        },
        error: function() {
            internetConnection();
        }
    })
}

$('.navbar-search').on('keydown', function(e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        Search($('.search-input-tugas').val());
    }
});

$('.btn-search-navbar').on('click', function() {
    Search($('.search-input-tugas').val());
});

function Search(q) {
    NotifyNavbar();
    $('.group').removeClass('active');
    $('.home').removeClass('active');
    $('.chatting').removeClass('active');
    $('.task').removeClass('active');
    $('.groups').removeClass('active');
    $('.friends').removeClass('active');
    $('.setting').removeClass('active');
    $('.modal-task').children('div').remove();
    $('.body-task').children('div').remove();
    $('.body-task').append(
        `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-search text-gray-700"></i> Cari</h1></div><div class="row justify-content-center search_home"></div>`
    );

    if (q == '' || q == undefined || q == null || q == ' ') {
        $('.search_home').append(
            '<div class="col-md-10"><div class="row"><h5 class="help-block text-gray-800">Tidak Ada Kata Kunci</h5></div></div>'
        );
        $('.orang-search-tab').append('<h3 class="help-block text-center"></h3>');
    } else {
        $('.search_home').append(
            '<div class="col-md-10"><div class="row"><h5 class="help-block text-gray-800">Orang</h5><br><hr><div class="table-responsive orang-search-tab"></div></div><br><div class="row"><h5 class="help-block text-gray-800">Kelas</h5><br><hr><div class="table-responsive grup-search-tab"></div></div><br><div class="row"><h5 class="help-block text-gray-800">Tugas</h5><br><hr><div class="table-responsive tugas-search-tab"></div></div></div>'
        );
        $.ajax({
            url: '<?= base_url('Home/Search') ?>',
            method: 'get',
            data: {
                q: q
            },
            dataType: 'json',
            success: function(data) {
                if (data[0] === 0) {
                    $('.orang-search-tab').append(
                        '<hr><h5 class="text-center">Tidak Ditemukan Pengguna</h5>');
                }
                if (data[0] !== 0) {
                    $('.orang-search-tab').append(
                        '<hr><table class="table" id="search-people"><thead><th>Gambar</th><th>Nama</th><th>Username</th><th>Email</th><th>Aksi</th></thead><tbody></tbody></table>'
                    );
                    $('#search-people').DataTable({
                        "aaData": data[0],
                        "columns": [{
                                "data": "gambar"
                            },
                            {
                                "data": "nama"
                            },
                            {
                                "data": "username"
                            },
                            {
                                "data": "email"
                            },
                            {
                                "data": "aksi"
                            }
                        ]
                    });
                }
                if ((data[1] === 0)) {
                    $('.grup-search-tab').append(
                        '<hr><h5 class="text-center">Tidak Ditemukan Kelas</h5>');
                }
                if (data[1] !== 0) {
                    $('.grup-search-tab').append(
                        '<hr><table class="table" id="search-group"><thead><th>Gambar</th><th>Nama</th><th>Kode</th><th>Deskripsi</th></thead><tbody></tbody></table>'
                    );
                    $('#search-group').DataTable({
                        "aaData": data[1],
                        "columns": [{
                                "data": "gambar"
                            },
                            {
                                "data": "nama"
                            },
                            {
                                "data": "code"
                            },
                            {
                                "data": "description"
                            }
                        ]
                    });
                }
                if (data[2] === 0) {
                    $('.tugas-search-tab').append(
                        '<hr><h5 class="text-center">Tidak Ditemukan Tugas</h5>');
                }
                if (data[2] !== 0) {
                    $('.tugas-search-tab').append(
                        '<hr><table class="table" id="search-task"><thead><th>Judul</th><th>Kelas</th><th>Deadline</th></thead><tbody></tbody></table>'
                    );
                    $('#search-task').DataTable({
                        "aaData": data[2],
                        "columns": [{
                                "data": "subject"
                            },
                            {
                                "data": "nama"
                            },
                            {
                                "data": "deadline"
                            }
                        ]
                    });
                }
            },
            error: function() {
                internetConnection();
            }
        });
    }
}
$(document).on('click', '.info_friends_detail', function() {
    $('.tab-detail-member').children().remove();
    $('.btn-member-friends').children().remove();
    $('.img-friends-detail').removeAttr('src');
    let id = $(this).data('id');
    $.ajax({
        url: '<?= base_url('Home/FriendsDetail') ?>',
        method: 'post',
        dataType: 'json',
        data: {
            id: id
        },
        success: function(data) {
            if (data) {
                let status = (data.blockStats == 1) ?
                    '<div class="badge badge-danger">Diblokir</div>' :
                    '<div class="badge badge-success">Teman</div>',
                    block = (data.blockStats == 1) ?
                    '<button style="border-radius: 20px;" class="btn btn-outline-success unblock-friends-modal" data-id="' +
                    data.ID +
                    '" type="button" title="Blokir"><i class="fas fa-user-slash"></i> UnBlokir</button>' :
                    '<button style="border-radius: 20px;" class="btn btn-outline-danger block-friends-modal" data-id="' +
                    data.ID +
                    '" type="button" title="Blokir"><i class="fas fa-user-slash"></i> Blokir</button>';
                $('.img-friends-detail').attr('src', '<?= base_url('assets/img/profil/') ?>' +
                    data
                    .gambar);
                $('.tab-detail-member').append(
                    '<tr><th>Nama</th><td>' + data.nama +
                    '</td></tr><tr><th>Username</th><td>' +
                    data.username + '</td></tr><tr><th>Email</th><td>' + data.email +
                    '</td></tr><tr><th>Status</th><td>' + status + '</td></tr>'
                );
                $('.btn-member-friends').append(
                    block +
                    ' <button style="border-radius: 20px;" class="btn btn-outline-danger unfriends-modal-tag" data-id="' +
                    data.ID +
                    '" type="button" title="Putuskan Hubungan"><i class="fas fa-user-times"></i> Bukan Teman</button> <button style="border-radius: 20px;" class="btn btn-outline-primary sendMessageFriends" data-id="' +
                    data.ID +
                    '" data-toggle="modal" data-target="#sendMessageFriends" title="Kirim Pesan"><i class="fas fa-envelope"></i> Kirim Pesan</button'
                );
            }
        },
        error: function() {
            internetConnection();
        }
    });
});
$(document).on('click', '.sendMessageFriends', function() {
    $('.btn_close_modal').trigger('click');
    $('.toFastMailFriends').val('').removeAttr('disabled');
    $('.subjectFastMailFriends').val('').removeAttr('disabled');
    $('.textFastMailFriends').val('').removeAttr('disabled');
    $('.sendFastMailFriends').removeAttr('disabled', '');
    $('.messageFastMailFriends').css('color', 'red').html('');
    $('.fileFastMessageFriends').val('');
    $('.label-file-fast-mail').html('Pilih File');
    let id = $(this).data('id');
    $.ajax({
        url: '<?= base_url('Home/FriendsDetail') ?>',
        method: 'post',
        dataType: 'json',
        data: {
            id: id
        },
        success: function(data) {
            if (data) {
                if (data.blockStats == 0) {
                    $('.toFastMailFriends').val(data.username).attr('disabled', '');
                } else {
                    $('.messageFastMailFriends').css('color', 'red').html(
                        'Anda memblokir Pengguna Ini');
                    $('.sendFastMailFriends').attr('disabled', '');
                    $('.toFastMailFriends').attr('disabled', '');
                    $('.subjectFastMailFriends').attr('disabled', '');
                    $('.textFastMailFriends').attr('disabled', '');
                }
            }
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('change', '.fileFastMessageFriends', function() {
    let name = $('.fileFastMessageFriends').val();
    name = name.split('fakepath');
    $('.label-file-fast-mail').html(name[name.length - 1]);
});
$(document).on('click', '.sendFastMailFriends', function() {
    let to = $('.toFastMailFriends').val(),
        subject = $('.subjectFastMailFriends').val(),
        text = $('.textFastMailFriends').val();
    if (subject.length > 0 && text.length > 0) {
        if ($('.fileFastMessageFriends').val().length > 0) {
            let fd = new FormData();
            let files = $('.fileFastMessageFriends')[0].files[0];
            fd.append('file', files);
            $.ajax({
                url: '<?= base_url('Home/FileMessageFastFriends') ?>',
                method: 'post',
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                success: function(data) {
                    sendFileFastMessageFriends(to, subject, text, data[1]);
                },
                error: function() {}
            });
        } else {
            sendFileFastMessageFriends(to, subject, text, '');
        }
    } else {
        Swal.fire('Tidak Terkirim', 'Judul dan kolom teks tidak boleh kosong', 'warning');
    }
});

function sendFileFastMessageFriends(to, subject, text, files) {
    let file = (files.length > 1) ? files : 0;
    $.ajax({
        url: '<?= base_url('Home/sendTextMailFastFriends') ?>',
        method: 'post',
        data: {
            to: to,
            subject: subject,
            text: text,
            file: file
        },
        success: function() {
            $('.btn_close_modal').trigger('click');
            Swal.fire('Berhasil', 'Pesan Sudah terkirim', 'success');
        },
        error: function() {
            internetConnection();
        }
    });
}

$(document).on('click', '.unblock-friends-modal', function() {
    let id = $(this).data('id');
    Swal.fire({
        title: 'Batalkan Blokir ?',
        text: "Apakah anda ingin Buka Blokir Teman Anda ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Buka!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/unBlockedFriends') ?>',
                method: 'post',
                data: {
                    id: id
                },
                success: function() {
                    $('.num-friends-home-' + id).css('color', 'black');
                    $('.btn_close_modal').trigger('click');
                    Swal.fire('Berhasil', 'Blokir Sudah Dibuka', 'success');
                },
                error: function() {
                    internetConnection();
                }
            });
        }
    });
});
$(document).on('click', '.unfriends-modal-tag', function() {
    let id = $(this).data('id');
    Swal.fire({
        title: 'Bukan Teman ?',
        text: "Bukan Teman Anda ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Bukan!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/unfriends') ?>',
                method: 'post',
                data: {
                    id: id
                },
                success: function() {
                    $('.btn_close_modal').trigger('click');
                    $('#tab-request-friends').DataTable().ajax.reload();
                },
                error: function() {
                    internetConnection();
                }
            })
        }
    });
});
$(document).on('click', '.block-friends-modal', function() {
    let id = $(this).data('id');
    Swal.fire({
        title: 'Blokir ?',
        text: "Apakah anda ingin Blokir Teman Anda ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Blokir!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/BlockFriends') ?>',
                method: 'post',
                data: {
                    id: id
                },
                success: function() {
                    $('.num-friends-home-' + id).css('color', 'red');
                    $('.btn_close_modal').trigger('click');
                    Swal.fire('Terblokir', 'Teman Anda sudah diblokir.', 'success');
                },
                error: function() {
                    internetConnection();
                }
            })
        }
    });
});
$(document).on('click', '.acceptRequestFriends', function() {
    let id = $(this).data('id');
    Swal.fire({
        title: 'Terima ?',
        text: "Apakah anda ingin menerima Permintaan pertemanan ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Terima!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/AcceptRequestFriends') ?>',
                data: {
                    id: id
                },
                method: 'post',
                success: function() {
                    Swal.fire('Berhasil', 'Kamu Sudah menambah 1 orang teman',
                        'success');
                    Friends();
                },
                error: function() {
                    internetConnection();
                }
            });
        }
    });
});
$(document).on('change', '.image-create-group', function() {
    $('.image_label_create').html($(this).val());
});
$(document).on('click', '.btn-create-group-modal', function() {
    if ($('input[name=agreementCreateGroup]:checked').length > 0) {
        $('.btn_close_modal').trigger('click');
        let name = $('.name-create-group').val(),
            description = $('.decription_create_group').val();
        if ($('.image-create-group').val() !== null || $('.image-create-group').val() !== undefined || $(
                '.image-create-group').val() !== '') {
            let fd = new FormData();
            let files = $('.image-create-group')[0].files[0];
            fd.append('file', files);
            $.ajax({
                url: '<?= base_url('Home/CreateGroupImage') ?>',
                method: 'post',
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                success: function(data) {
                    if (data[0] == 0) {
                        Swal.fire('Gagal', 'Unggah Foto Kelas Gagal', 'warning');
                    } else {
                        CreateGroupAgree(name, description, data[1]);
                    }
                },
                error: function() {
                    internetConnection();
                }
            });
        } else {
            CreateGroupAgree(name, description, null);
        }
    } else {
        Swal.fire('Gagal', 'Isi dan centang semua form', 'warning');
    }
});

function CreateGroupAgree(name, description, img) {
    $.ajax({
        url: '<?= base_url('Home/CreateGroup') ?>',
        method: 'post',
        data: {
            name: name,
            description: description,
            img: img
        },
        success: function() {
            Group();
        },
        error: function() {
            internetConnection();
        }
    });
}

$(document).on('click', '.declinedRequestFriends', function() {
    let id = $(this).data('id');
    Swal.fire({
        title: 'Tolak ?',
        text: "Apakah anda ingin menolak Permintaan pertemanan ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Tolak!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/declinedRequestFriends') ?>',
                data: {
                    id: id
                },
                method: 'post',
                success: function() {
                    Swal.fire('Berhasil', 'Kamu Sudah menolak 1 orang', 'success');
                    Friends();
                },
                error: function() {
                    internetConnection();
                }
            });
        }
    });
});

function Chat() {
    if (messageLength > 0) {
        $('.badge-message-navbar').children().remove();
        $('.message-navbar').children().remove();
        $('.message-navbar').append(
            '<div class="mt-3 mb-3 row justify-content-center"><div class="col-md-12 text-center"><h5 class="help-block"><i class="fas fa-envelope-open"></i> Tidak Ada Pesan Masuk</h5></div></div>'
        );
    }
    NotifyNavbar();
    $('.group').removeClass('active');
    $('.home').removeClass('active');
    $('.task').removeClass('active');
    $('.friends').removeClass('active');
    $('.groups').removeClass('active');
    $('.chatting').addClass('active');
    $('.setting').removeClass('active');
    $('.modal-task').children('div').remove();
    $('.body-task').children('div').remove();
    $('.body-task').append(
        `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-comments text-gray-700"></i> Obrolan</h1></div><div class="row justify-content-center animate-opacity"><div class="col-md-12 chat-home"></div></div>`
    );
    $('.chat-home').append(
        `<div class="messaging"><div class="inbox_msg" style="border-radius: 5px;"><div class="inbox_people"><div class="headind_srch"><div class="recent_heading"><h4>Obrolan Pribadi</h4></div></div><div class="inbox_chat"></div></div><div class="mesgs"><div class="msg_history"></div><div class="type_msg"><div class="input_msg_write mb-1 mt-1"><div class="input-group"><div class="input-group-append"><button style="border-radius: 5px;"  class="btn btn-outline-info" data-toggle="modal" data-target="#fileSendPersonalChat" title="Sematkan File" type="button"><i class="fas fa-file fa-sm"></i></button></div><input type="text" class="form-control text-obrolan-group bg-light border-0 small" data-id="" placeholder="Ketik Pesan..."><div class="input-group-append"><button style="border-radius: 5px;" data-id="" class="btn btn-outline-primary btn-obrolan-pc" type="button"><i class="fas fa-paper-plane fa-sm"></i></button></div></div></div></div></div></div></div>`
    );
    $('.msg_history').append(
        '<h5 style="font-style: italic;" class="help-block text-center">Pilih Nama Teman Disamping Kiri</h5>');
    $.ajax({
        url: '<?= base_url('Home/PC') ?>',
        dataType: 'json',
        success: function(friendsChat) {
            if (friendsChat) {
                for (let i = 0; i < friendsChat.length; i++) {
                    if ((friendsChat[i].last == null)) {
                        $('.inbox_chat').append(
                            '<div class="chat_list chat_list_' + friendsChat[i].ID +
                            '"><div class="chat_people"><div class="chat_img"> <img src="<?= base_url('assets/img/profil/') ?>' +
                            friendsChat[i].gambar +
                            '" alt="sunil" class="img-responsive rounded-circle" style="width: 50px; height: 40px;"> </div><div class="chat_ib"><h5><a href="#" onclick="PersonalChat(' +
                            friendsChat[i]
                            .ID + ') " class="text-gray-800" style="text-decoration: none;">' +
                            friendsChat[i].nama +
                            '</a> <span class="chat_date"></span></h5><p style="font-weight: bold;font-style: italic;" class="text-gray-900">Belum Ada Obrolan</p></div></div></div>'
                        );
                    } else {
                        let date = friendsChat[i].last.date_send,
                            tgl;
                        date = date.split(' ');
                        date = date[0];
                        date = date.split('-');
                        date[1] = getMonthNow(date[1]);
                        $('.inbox_chat').append(
                            '<div class="chat_list chat_list_' + friendsChat[i].ID +
                            '"><div class="chat_people"><div class="chat_img"> <img src="<?= base_url('assets/img/profil/') ?>' +
                            friendsChat[i].gambar +
                            '" class="img-responsive rounded-circle" style="width: 50px; height: 40px;" alt="sunil"> </div><div class="chat_ib"><h5><a href="#" onclick="PersonalChat(' +
                            friendsChat[i].ID +
                            ')" class="text-gray-800" style="text-decoration: none;">' + friendsChat[i]
                            .nama + '</a> <span class="chat_date">' + date[2] + ' ' + date[1] +
                            '</span></h5><p>' + friendsChat[i].last.text + '</p></div></div></div>'
                        );
                    }
                }
                PersonalChat(friendsChat[0].ID);
            } else {
                $('.inbox_chat').append('<h5 class="text-center mt-3">Tidak Ada Teman</h5>');
            }
        },
        error: function() {
            return 0;
        }
    });
}
$(document).on('click', '.btn-obrolan-pc', function() {
    let id = $(this).data('id');
    sendPCMessage(id, $('.text-obrolan-group').val());
});
$(document).on('keydown', '.text-obrolan-group', function(e) {
    if (e.which == 13) {
        e.preventDefault();
        let id = $('.btn-obrolan-pc').data('id');
        sendPCMessage(id, $(this).val());
    }
});

function sendPCMessage(id, text) {
    if (id == '' || id == ' ' || id == null || id == undefined) {
        Swal.fire('Tidak Dikirim', 'Pilih Terlebih Dahulu Penerima Pesan', 'warning');
    } else {
        if (text == '' || text == ' ' || text == null || text == undefined) {
            Swal.fire('Tidak Dikirim', 'Pesan Teks Harus Diisi', 'warning');
        } else {
            let fd = new FormData();
            let data = [];
            let files = ($('#file-attach').val() != '' || $('#file-attach') != null) ? $('#file-attach')[0].files[0] :
                '';
            fd.append('file', files);
            data.push({
                "pesan": text,
                "id": id
            });
            fd.append('data', JSON.stringify(data));
            $.ajax({
                url: '<?= base_url('Home/sendPCMessage') ?>',
                method: 'post',
                data: fd,
                processData: false,
                contentType: false,
                success: function() {
                    $('.text-obrolan-group').val('');
                    PersonalChat(id);
                },
                error: function() {
                    internetConnection();
                }
            });
        }
    }
}

function PersonalChat(id) {
    let numLengthPersonal = 0;
    $('.btn-obrolan-pc').removeAttr('data-id');
    $('.text-obrolan-group').removeAttr('data-id');
    $('.msg_history').children().remove();
    $('.chat_list').removeClass('active_chat');
    $('.chat_list_' + id).addClass('active_chat');
    $.ajax({
        url: '<?= base_url('Home/PCMessage') ?>',
        method: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            if (data !== null) {
                num = data.length;
                $('.btn-obrolan-pc').attr('data-id', id);
                $('.text-obrolan-group').attr('data-id', id);
                for (let i = 0; i < data.length; i++) {
                    let date = data[i].date_send,
                        tgl;
                    date = date.split(' ');
                    tgl = date[1];
                    date = date[0].split('-');
                    date[1] = getMonthNow(date[1]);
                    if (data[i].file == '' || data[i].file == null) {
                        if (data[i].id_from == id) {
                            $('.msg_history').append(
                                '<div class="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>' +
                                data[i].text +
                                '</p><span class="time_date"> ' + tgl + '    |  ' + date[2] + ' ' +
                                date[
                                    1] + ' ' + date[0] + '</span></div></div></div>'
                            );
                        } else {
                            $('.msg_history').append('<div class="outgoing_msg"><div class="sent_msg"><p>' +
                                data[i].text +
                                '</p><span class="time_date"> ' + tgl + '    |  ' + date[2] + ' ' +
                                date[
                                    1] + ' ' + date[0] + '</span> </div></div>');
                        }
                    } else {
                        if (data[i].id_from == id) {
                            $('.msg_history').append(
                                '<div class="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>File: <a href="<?= base_url('assets/files/chat/') ?>' +
                                data[i].file +
                                '" class="text-dark" target="_blank" style="text-decoration: none">' +
                                data[i].file + '</a> <br>-----------------------------------<br>' +
                                data[i].text +
                                '</p><span class="time_date"> ' + tgl + '    |  ' + date[2] + ' ' +
                                date[
                                    1] + ' ' + date[0] + '</span></div></div></div>'
                            );
                        } else {
                            $('.msg_history').append(
                                '<div class="outgoing_msg"><div class="sent_msg"><p>File: <a href="<?= base_url('assets/files/chat/') ?>' +
                                data[i].file +
                                '" class="text-light" target="_blank" style="text-decoration: none">' +
                                data[i].file + '</a> <br>-----------------------------------<br>' +
                                data[i].text +
                                '</p><span class="time_date"> ' + tgl + '    |  ' + date[2] + ' ' +
                                date[
                                    1] + ' ' + date[0] + '</span> </div></div>');
                        }
                    }
                }
                setTimeout(function() {
                    $('.msg_history').animate({
                        scrollTop: $('.msg_history').prop("scrollHeight")
                    }, 200);
                }, 100);
            } else {
                $('.msg_history').append(
                    '<p class="help-block text-center" style="font-style: italic;">Belum Ada Obrolan</p>'
                );
            }
        },
        error: function() {
            internetConnection();
        }
    });
}

function Profil() {
    NotifyNavbar();
    $('.group').removeClass('active');
    $('.home').removeClass('active');
    $('.task').removeClass('active');
    $('.friends').removeClass('active');
    $('.groups').removeClass('active');
    $('.chatting').removeClass('active');
    $('.setting').removeClass('active');
    $('.modal-task').children('div').remove();
    $('.body-task').children('div').remove();
    $('.modal-task').append(
        '<div class="modal fade" id="edit_img" tabindex="-1" role="dialog" aria-labelledby="modal_edit_img" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header bg-<?= $profil['colourPopUp'] ?>"><h5 class="modal-title text-gray-100" id="modal_edit_img"><i class="fas fa-images"></i> Unggah Foto</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="justify-content-center row"><div class="col-md-8"><img src="" class="img-responsive img-thumbnail shadow-lg img_temp" alt=""><div class="custom-file"><input type="file" onchange="readImage(this);" class="custom-file-input upload_img"><label class="custom-file-label" class="label-image">Pilih File</label></div></div></div></div><div class="modal-footer"><button class="btn btn-outline-secondary btn_close_modal" style="border-radius: 20px;" type="button" data-dismiss="modal" title="Batal"><i class="fa fa-times"></i> Batal</button><button class="btn btn-outline-primary save_edit_img" style="border-radius: 20px;" title="Simpan"><i class="fa fa-save"></i> Simpan</button></div></div></div></div>'
    );
    $('.body-task').append(
        `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-user text-gray-700"></i> Profil</h1></div><div class="row justify-content-center"><div class="col-md-10"><div class="alert_info"></div><div class="row"><div class="col-md-4 text-center"><img src="<?= base_url('assets/img/profil/') . $profil['gambar'] ?>"class="img-thumbnail animate-opacity img-responsive img_profil shadow-lg" alt=""><div class="btn-group animate-opacity mt-3 shadow"><button data-toggle="modal" data-target="#edit_img" class="btn btn-outline-primary edit_image" style="border-radius: 20px 0 0 20px;" title="Ubah Gambar"><i class="fa fa-edit"></i> Ubah</button><button style="border-radius: 0 20px 20px 0;" class="btn btn-outline-danger delete_image" title="Hapus Gambar"><i class="fa fa-eraser"></i> Hapus</button></div></div><div class="col-md-8 mt-2 text-center"><table class="table animate-opacity text-left"><tbody><tr><td>Nama</td><td><input type="text" class="form-control profil_name" value="<?= $profil['nama'] ?>" placeholder="Nama"><?= form_error('name', '<div class="alert alert-danger mt-1" role="alert">', '</div>') ?></td><input type="hidden" class="form-control" value="<?= $profil['ID'] ?>" name="ID"></tr><tr><td>Username</td><td><input type="text" class="form-control profil_username" value="<?= $profil['username'] ?>" readonly placeholder="Username"><?= form_error('username', '<div class="alert alert-danger mt-1" role="alert">', '</div>') ?></td></tr><tr><td>Email</td><td><input type="text" class="form-control profil_email" readonly value="<?= $profil['email'] ?>" placeholder="E-mail"><?= form_error('email', '<div class="alert alert-danger mt-1" role="alert">', '</div>') ?></td></tr></tbody></table><button class="mt-3 animate-opacity mb-3 btn btn-lg shadow-lg btn-outline-success btn-save-profil" title="Simpan" style="border-radius: 20px;"><i class="fa fa-save"></i> Simpan</button></div></div></div></div>`
    );
}

function readImage(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('.img_temp').attr('src', e.target.result).css('display', 'block');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function Setting() {
    NotifyNavbar();
    $('.group').removeClass('active');
    $('.chatting').removeClass('active');
    $('.home').removeClass('active');
    $('.groups').removeClass('active');
    $('.task').removeClass('active');
    $('.friends').removeClass('active');
    $('.setting').addClass('active');
    $('.modal-task').children('div').remove();
    $('.body-task').children('div').remove();
    $('.body-task').append(
        `<div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-sm fa-cogs text-gray-700"></i> Pengaturan</h1></div><div class="row justify-content-center"><div class="col-md-8">`
    );
    $('.body-task').append(
        `<div class="card animate-opacity shadow-sm"><div class="card-body"><h5 class="help-block"><i class="fas fa-palette fa-sm text-grey-900"></i> Warna</h5><div class="table-responsive ml-3 pr-5"><table class="table"><tbody><tr><td>Navigasi</td><td><select class="form-control navigation-color"><option <?= ($profil['colourNavigation'] == 'bg-gradient-primary') ? 'selected=""' : ''; ?> value="bg-gradient-primary">Biru</option><option <?= ($profil['colourNavigation'] == 'bg-gradient-info') ? 'selected=""' : ''; ?> value="bg-gradient-info">Teal</option><option <?= ($profil['colourNavigation'] == 'bg-gradient-success') ? 'selected=""' : ''; ?> value="bg-gradient-success">Hijau</option><option <?= ($profil['colourNavigation'] == 'bg-gradient-warning') ? 'selected=""' : ''; ?> value="bg-gradient-warning">Kuning</option><option <?= ($profil['colourNavigation'] == 'bg-gradient-danger') ? 'selected=""' : ''; ?> value="bg-gradient-danger">Merah</option><option <?= ($profil['colourNavigation'] == 'bg-dark') ? 'selected=""' : ''; ?> value="bg-dark">Hitam</option></select></td></tr><tr><td>Top Bar</td><td><select class="form-control top-bar-color"><option <?= ($profil['colourTopBar'] == 'primary') ? 'selected=""' : ''; ?> value="primary">Biru</option><option <?= ($profil['colourTopBar'] == 'info') ? 'selected=""' : ''; ?> value="info">Teal</option><option <?= ($profil['colourTopBar'] == 'success') ? 'selected=""' : ''; ?> value="success">Hijau</option><option <?= ($profil['colourTopBar'] == 'warning') ? 'selected=""' : ''; ?> value="warning">Kuning</option><option <?= ($profil['colourTopBar'] == 'danger') ? 'selected=""' : ''; ?> value="danger">Merah</option><option <?= ($profil['colourTopBar'] == 'dark') ? 'selected=""' : ''; ?> value="dark">Hitam</option></select></td></tr><tr><td>Pop up, Kartu, dll</td><td><select class="form-control modal-color"><option <?= ($profil['colourPopUp'] == 'primary') ? 'selected=""' : ''; ?> value="primary">Biru</option><option <?= ($profil['colourPopUp'] == 'info') ? 'selected=""' : ''; ?> value="info">Teal</option><option <?= ($profil['colourPopUp'] == 'success') ? 'selected=""' : ''; ?> value="success">Hijau</option><option <?= ($profil['colourPopUp'] == 'warning') ? 'selected=""' : ''; ?> value="warning">Kuning</option><option <?= ($profil['colourPopUp'] == 'danger') ? 'selected=""' : ''; ?> value="danger">Merah</option><option <?= ($profil['colourPopUp'] == 'dark') ? 'selected=""' : ''; ?> value="dark">Hitam</option></select></td></tr></tbody></table></div><div class="row justify-content-center"><div class="col-md-2 text-center"><button class="btn btn-outline-success colourChange" title="Simpan Warna Tema" style="border-radius: 20px;"><i class="fas fa-save"></i> Simpan</button></div></div></div></div>`
    );

    $('.body-task').append(
        `<div class="row ml-2 mt-1 text-center text-gray-100"><div class="col-sm-4"></div></div><div class="card animate-opacity mb-2 shadow-sm mt-2"><div class="card-body"><h5 class="help-block"><i class="fas fa-info-circle fa-sm text-grey-700"></i> Tentang</h5><p class="ml-2">Task Me v1.0.0.<br>Hak Cipta 2019 Task Me Corporation. Semua hak dilindungi Undang - undang<br><br>Ada Masalah ? Lapor Kepada Kami. <a href="javascript:void(0)" class="reportMe" data-toggle="modal" data-target="#report-user-member">Disini</a><br><a href="javascript:void(0)" data-toggle="modal" data-target="#terms">Persyaratan Penggunaan</a> Task Me<br><br><strong>&copy; Task Me 2019.</strong> All Right Reserved.</p></div></div></div></div>`
    );
}
$(document).on('click', '.reportMe', function() {
    $('#id_report').val('0');
});

function internetConnection() {
    Swal.fire('Koneksi Internet', 'Periksa kembali koneksi internet anda. lalu coba lagi',
        'question');
}
$(document).on("keydown", 'fileInput', function(event) {
    if (event.keyCode == 13 || event.keyCode == 32) {
        this.focus();
    }
});
$(document).on('click', '.upload_file_task', function() {
    let task = $(this).data('task');
    $('.task_upload_complete').removeAttr('disabled');
    $('.tab-modal-task').children().remove();
    $.ajax({
        url: '<?= base_url('Home/TaskID') ?>',
        method: 'post',
        data: {
            task: task
        },
        dataType: 'json',
        success: function(data) {
            let status = '<div class="badge badge-danger">Belum Selesai</div>',
                file = 'Tidak Ada File',
                cek = '',
                pesan = '',
                fileUploadDone = '',
                backUpload = '',
                checkCancel;
            if (data[2] == 1) {
                checkCancel = (data[0].status == 1) ? 'disabled=""' : '';
                status = '<div class="badge badge-success">Sudah Selesai</div>';
                cek = 'disabled=""';
                $('.task_upload_complete').attr('disabled', '');
                pesan = data[3].pesan;
                fileUploadDone = 'Terpilih: ' + data[3].file;
                backUpload =
                    '<div class="row mr-3 ml-3 text-center justify-content-center"><div class="col-md-4"><p class="help-block float-left">Batalkan Upload</p><br><hr><button ' +
                    checkCancel + ' data-id="' +
                    data[0].ID + '" data-task="' +
                    data[3].ID +
                    '" class="btn text-center btn-outline-danger unSubmittedUpload" style="border-radius: 20px;" title="Batalkan Unggah"><i class="fas fa-times"></i> Batalkan Unggah</div><div class="col-md-4"><p class="help-block float-left">Unduh File</p><br><hr><a class="btn btn-outline-success" title="Unduh" href="<?= base_url('assets/files/tugas/') ?>' +
                    data[0].file + '/' +
                    data[3].file +
                    '" target="_blank" style="border-radius: 20px;"><i class="fas fa-download"></i> Unduh File Anda</a></div></div>';
            }
            if (data[0].status == 1) {
                cek = 'disabled=""';
                $('.task_upload_complete').attr('disabled', '');
            }
            $('.tab-modal-task').append(
                '<div class="row"><h5 class="help-block pl-3">Informasi Kelas</h5></div><hr><div class="row"><div class="col-md-4 mb-1 text-center"><img src="<?= base_url('assets/img/group/') ?>' +
                data[1].gambar +
                '" class="img-thumbnail img-tab-modal-task img-responsive" style="width: 200px;"></div><div class="col-md-8 mb-1"><table class="table"><tbody><tr><th>Nama Kelas</th><td>' +
                data[1].nama + '</td></tr><tr><th>Kode Kelas</th><td>' + data[1]
                .code +
                '</td></tr><tr><th>Status</th><td>' + status +
                '</td></tr></tbody></table></div></div><div class="row"><h5 class="help-block pl-3">Informasi Tugas</h5></div><hr><div class="row mt-2"><div class="col-md-6"><table class="table"><tbody><tr><th>Subjek</th><td>' +
                data[0].subject + '</td></tr><tr><th>Pesan</th><td>' + data[0]
                .messages +
                '</td></tr><tr><th>Detail</th><td>' + data[0].detail +
                '</td></tr></tbody></table></div><div class="col-md-6"><table class="table"><tbody><tr><th>Dibuat</th><td>' +
                data[0].date_created +
                '</td></tr><tr><th>Deadline</th><td style="color: red;">' + data[0]
                .deadline +
                '</td></tr></tbody></table></div></div><div class="row"><h5 class="help-block pl-3">Unggah</h5></div><hr><div class="row justify-content-center text-center mr-5 ml-5"><div class="col-md-8"><div class="input-file-container"><input class="input-file" ' +
                cek +
                ' id="task_file" type="file"><label tabindex="0" for="my-file" class="input-file-trigger">Pilih Tugas</label></div><p class="file-return help-block">' +
                fileUploadDone +
                '</p></div></div><div class="ml-3 mr-3 row"><div class="col-md-12"><p class="help-block">Pesan Untuk Admin</p><textarea class="form-control message-task-user" placeholder="Pesan anda akan disampaikan ke admin bersama tugas yang anda upload" rows="5">' +
                pesan + '</textarea><input type="hidden" value="' +
                data[0].ID +
                '" class="task_id_upload"><br></div></div>' +
                backUpload +
                '<br><div class="row mr-3 ml-3"><div class="col-md-12"><p class="help-block">Catatan</p><hr><ol><li><p class="help-block">Ekstensi yang diperbolehkan .rar .zip .jpg .jpeg .png .doc .docx .ppt .pptx </p></li><li><p class="help-block">Ukuran File tidak lebih dari 5 MB (MegaBytes) / 5120 Mb (MegaBit).</p></li><li><p class="help-block">Setelah melewati Waktu Deadline Maka tombol Upload tidak akan bisa ditekan.</p></li><li>Jika Anda Salah memasukkan file atau tidak sengaja sudah terkirim. tekan tombol "Batalkan Unggah" berwarna MERAH dipaling bawah. pastikan juga waktu deadline belum habis.</li><li>Selengkapnya anda bisa baca di <a href="javascript:void(0)">Buku Panduan</a></li></ol></div></div>'
            );
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '.unSubmittedUpload', function() {
    let task = $(this).data('task'),
        id = $(this).data('id');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Tugas yang sudah diunggah akan dihapus ? \nTermasuk File dan pesan Ke admin",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Hapus Saja!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/unSubmit') ?>',
                method: 'post',
                data: {
                    task: task
                },
                success: function() {
                    Swal.fire('Berhasil',
                        'Silahkan Unggah kembali file sebelum waktu deadline tiba.',
                        'success');
                    $('.btn_close_modal').trigger('click');
                    $('.task-' + id).removeClass().addClass(
                        'bg-danger text-gray-100 task-' +
                        id);
                },
                error: function() {
                    internetConnection();
                }
            });
        }
    });
});
$(document).on('click', '.task_upload_complete', function() {
    if ($('#task_file').val().length > 0) {
        let fd = new FormData();
        let pesan = $('.message-task-user').val(),
            idTask = $('.task_id_upload').val(),
            data = [];
        let files = $('#task_file')[0].files[0];
        fd.append('file', files);
        data.push({
            "pesan": pesan,
            "id": idTask
        });
        fd.append('data', JSON.stringify(data));
        $.ajax({
            url: '<?= base_url('Home/TaskUpload') ?>',
            method: 'post',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success: function(res) {
                if (res !== 'uploaded') {
                    Swal.fire('Gagal', 'Kesalahan: ' + res, 'warning');
                } else {
                    Swal.fire('Berhasil', 'Tugas Anda telah dikumpul', 'success');
                    $('.task-' + idTask).removeClass().addClass('bg-success text-gray-100 task-' +
                        idTask);
                }
            },
            error: function() {
                internetConnection();
            }
        });
    } else {
        Swal.fire('Gagal', 'Unggah File Terlebih Dahulu', 'warning');
    }
});
$(document).on('change', '#task_file', function() {
    $('.file-return').html("File Tugas: " + $(this).val());
});

$(document).on('click', '.colourChange', function() {
    let navColor = $('.navigation-color').val(),
        topBarColor = $('.top-bar-color').val(),
        modalColor = $('.modal-color').val();
    $.ajax({
        url: '<?= base_url('Home/colorChange') ?>',
        method: 'post',
        data: {
            navColor: navColor,
            topBarColor: topBarColor,
            modalColor: modalColor
        },
        success: function() {
            Swal.fire({
                title: 'Refresh?',
                text: "Warna Berhasil disimpan. Perlu refresh halaman untuk menerapkan warna. \nIngin Merefresh halaman ini sekarang?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tidak, Nanti Saja!',
                confirmButtonText: 'Ya, Refresh!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = "";
                }
            });
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '.add_group_code', function() {
    let code = $('.code_group_add').val();
    $('.message-add-group').children('div').remove();
    $.ajax({
        url: '<?= base_url('Home/Group') ?>',
        method: 'post',
        data: {
            code: code
        },
        dataType: 'json',
        success: function(data) {
            if (data !== 'Not Found') {
                let btn, btn_id;
                if (data.Tipe == 'Ready' || data.Tipe == 'Kick' || data.Tipe ==
                    'Block') {
                    btn = 'Gabung Ke Kelas ';
                    btn_id = 'join_group';
                }
                if (data.Tipe == 'Member') {
                    btn = 'Masuk Ke Kelas ';
                    btn_id = 'sign_in_group';
                }
                if (data.Tipe == 'Request') {
                    btn = 'Batalkan Permintaan Gabung ';
                    btn_id = 'cancel_request_group';
                }

                $('.message-add-group').append(
                    '<div class="row mt-2 margin-auto"><div class="col-sm-4"><img src="<?= base_url('assets/img/group/') ?>' +
                    data.Group.gambar +
                    '" class="img-thumbnail img-responsive shadow"></div><div class="col-sm-8"><table class="table"><tbody><tr><td>Nama</td><td>' +
                    data.Group.nama + '</td></tr><tr><td>Admin</td><td>' + data
                    .Group
                    .admin +
                    '</td></tr><tr><td>Deskripsi</td><td>' + data.Group
                    .description +
                    '</td></tr><tr><button data-code="' + data.Group.code +
                    '" class="btn mt-1 btn-block btn-outline-success ' + btn_id +
                    '" title="' +
                    btn + data.Group.nama +
                    '" id="' + btn_id + '" data-id="' + data.Group.ID +
                    '">' + btn +
                    ' <i class="fas fa-sm fa-sign-in-alt"></i></button></tr></tbody></table></div></div>'
                );
            } else if (data == 'Not Found') {
                $('.message-add-group').append(
                    '<div class="alert mt-1 alert-danger alert-dismissible fade show" role="alert"><strong>Tidak Ditemukan! </strong>Kode Kelas Salah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                )
            } else {
                Swal.fire('Kesalahan Server',
                    'Coba segarkan laman ini. lalu coba lagi',
                    'error');
            }
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('change', '.file-attach', function() {
    let fileName = $('.file-attach').val();
    fileName = fileName.split('\\')
    $('.file-attach-label').css('text-align', 'center').css('font-style', 'italic').html('Terpilih: ' +
        fileName[fileName.length - 1]);
});
$(document).on('click', '.btn-clear-file-attach', function() {
    $('.file-attach').val('');
    $('.file-attach-label').html('');
});

$(document).on('click', '.sign_in_group', function() {
    let code = $(this).data('code');
    $.ajax({
        url: '<?= base_url('Home/GroupSign') ?>',
        method: 'post',
        data: {
            code: code
        },
        dataType: 'json',
        success: function(data) {
            if (data == 'Already') {
                Swal.fire('Sudah Masuk', 'Kamu Sudah masuk kedalam Kelas tersebut',
                    'info');
            } else if (data.length !== 'Already') {
                $('.groups-navbar').children().remove();
                $('.groups-navbar').append(
                    '<li class="nav-item groups"><a class="nav-link groups" href="#" data-toggle="collapse" data-target="#grups" aria-expanded="true"aria-controls="grups"><i class="fas fa-fw fa-users"></i><span>Kelas</span></a><div id="grups" class="collapse show" data-parent="#accordionSidebar"><div class="bg-white py-2 collapse-inner rounded groups-link"></div></div></li>'
                );
                for (let i = 0; i < data.length; i++) {
                    $('.groups-link').append(
                        '<a class="collapse-item group-' + data[i].ID +
                        '" href="javascript:void(0)" onclick="Groups(' + data[i]
                        .ID +
                        ')">' +
                        data[i].nama + '</a>');
                }
            }
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '.out_group', function() {
    let id = $(this).data('id'),
        type = $(this).data('type');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Apakah Kamu Benar-benar Ingin Menghapus Kelas Tersebut ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Batalkan!',
        confirmButtonText: 'Ya, Hapus Saja!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/GroupOut') ?>',
                method: 'post',
                data: {
                    id: id,
                    type: type
                },
                success: function() {
                    $('.message_Group').append(
                        '<div class="alert mt-1 alert-success alert-dismissible fade show" role="alert"><strong>Berhasil! </strong>Anda Telah keluar Dari Kelas.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    );
                    $('.Group_body').children('div').remove();
                    $('.message-add-group').children().remove();
                    Group_body();
                },
                error: function() {
                    $('.message_Group').append(
                        '<div class="alert mt-1 alert-danger alert-dismissible fade show" role="alert"><strong>Gagal! </strong>Kelas gagal dihapus! Coba Lagi nanti <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    );
                }
            })
        }
    })
});
$(document).on('click', '#join_group', function() {
    let id_group = $(this).data('id');
    let type = 'Request';
    $.ajax({
        url: '<?= base_url('Home/GroupRequest') ?>',
        method: 'post',
        data: {
            id_group: id_group,
            type: type
        },
        success: function() {
            $('#join_group').html(
                    'Batalkan Permintaan Gabung <i class="fas fa-sm fa-times"></i>')
                .attr('id', 'cancel_request_group');
            $('.Group_body').children('div').remove();
            Group_body();
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '#cancel_request_group', function() {
    let id_group = $(this).data('id');
    let type = 'Remove';
    $.ajax({
        url: '<?= base_url('Home/GroupRequest') ?>',
        method: 'post',
        data: {
            id_group: id_group,
            type: type
        },
        success: function() {
            $('#cancel_request_group').html(
                'Gabung Ke Kelas <i class="fas fa-sm fa-sign-in-alt"></i>').attr(
                'id',
                'join_group');
            $('.Group_body').children('div').remove();
            $('.message-add-group').children().remove();
            Group_body();
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '.info_group', function() {
    let id = $(this).data('id');
    $.ajax({
        url: '<?= base_url('Home/Group') ?>',
        method: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            if (data) {
                $('.table-info-modal').children().remove();
                $('.img-info-modal').attr('src',
                    '<?= base_url('assets/img/group/') ?>' + data
                    .gambar);
                $('.table-info-modal').append('<tr><td>Nama</td><td>' + data.nama +
                    '</td></tr><tr><td>Admin</td><td>' + data.admin +
                    '</td></tr><tr><td>Kode</td><td>' + data.code +
                    '</td></tr><tr><td>Dibuat</td><td>' + data.date_created +
                    '</td></tr><tr><td>Deskripsi</td><td>' + data.description +
                    '</td></tr>'
                );
            }
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '.btn-activity-info', function() {
    let id = $(this).data('id');
    $.ajax({
        url: '<?= base_url('Home/Activity') ?>',
        method: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            let keterangan = (data.keterangan == '') ? '-' : data.keterangan;
            $('.nama-activity-info').html(data.nama);
            $('.username-activity-info').html(data.username);
            $('.tgl_activity_info').html(data.tgl_activity);
            $('.kegiatan-activity-info').html(data.kegiatan);
            $('.keterangan-activity-info').html(keterangan);
        },
        error: function() {
            internetConnection();
        }
    })
});
$(document).on('click', '.btn-save-profil', function() {
    let name = $('.profil_name').val();
    let username = $('.profil_username').val();
    let email = $('.profil_email').val();
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Pengaturan Profil kamu akan diubah!",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Jangan, Biarkan Saja!',
        confirmButtonText: 'Ya, Ubah Saja!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Home/Profil') ?>',
                method: 'post',
                data: {
                    name: name,
                    username: username,
                    email: email
                },
                success: function(data) {
                    Swal.fire('Profil', 'Pengaturan Profil telah diubah',
                        'success');
                    $('.alert_info').children('div').remove();
                    $('.alert_info').append(
                        `<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Berhasil! </strong>Profil Berhasil Di Ubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`
                    )
                },
                error: function() {
                    Swal.fire('Gagal', 'Segarkan laman ini. lalu coba lagi',
                        'error');
                }
            })
        }
    })
});
$(document).on('click', '.delete_image', function() {
    Swal.fire({
        title: 'Yakin Dihapus',
        text: "Hapus Foto profil kamu?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Jangan, Batalkan itu!',
        confirmButtonText: 'Ya, Hapus itu!'
    }).then((result) => {
        if (result.value) {
            $('.img_profil').attr('src',
                '<?= base_url('assets/img/profil/nophoto.png') ?>');
            let id = $('input[name=ID]').val();
            $.ajax({
                url: '<?= base_url('Home/delete_img_profil') ?>',
                method: 'post',
                data: {
                    id: id
                },
                success: function() {
                    $('.img-profile').attr('src',
                        '<?= base_url('assets/img/profil/nophoto.png') ?>'
                    );
                    Swal.fire('Berhasil', 'Foto berhasil Dihapus',
                        'success');
                },
                error: function() {
                    internetConnection();
                }
            })
        }
    })
});
$(document).on('click', '.save_edit_img', function() {
    let fd = new FormData();
    let files = $('.upload_img')[0].files[0];
    fd.append('file', files);
    $.ajax({
        url: '<?= base_url() ?>Home/upload_img_profil',
        method: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function() {
            $('.btn_close_modal').trigger('click');
            $('.img-profile').attr('src', '<?= base_url('assets/img/profil/') ?>' +
                files
                .name);
            $('.img_profil').attr('src', '<?= base_url('assets/img/profil/') ?>' +
                files.name);
            $('.alert_info').children('div').remove();
            $('.alert_info').append(
                `<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Berhasil! </strong> Foto profil Berhasil Di Ubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`
            )
        },
        error: function() {
            $('.btn_close_modal').trigger('click');
            $('.img_profil').attr('src', '<?= base_url('assets/img/profil/') ?>' +
                files.name);
            $('.alert_info').children('div').remove();
            $('.alert_info').append(
                `<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal! </strong> Foto profil Gagal Di Ubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`
            )
        }
    });
});
</script>

<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/swal/sweetalert2.all.min.js"></script>
<?php endif; ?>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
</body>

</html>
