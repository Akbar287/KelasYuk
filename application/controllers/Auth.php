<?php
defined('BASEPATH') or exit('No Script Allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->has_userdata('Recollabs') || get_cookie('Recollabs')) {
            redirect(base_url('Home'));
            exit;
        }
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[12]');
        if ($this->form_validation->run() == TRUE) {
            $this->_check();
        } else {
            $this->load->view('Templates/Header');
            $this->load->view('Auth/Login');
            $this->load->view('Templates/Footer');
        }
    }
    public function Register()
    {
        if ($this->session->has_userdata('Recollabs') || get_cookie('Recollabs')) {
            redirect(base_url('Home'));
            exit;
        }
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[users.email]', ['is_unique' => 'This E-mail has been Registered']);
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[8]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
        $this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password', 'required|matches[password]');
        if ($this->form_validation->run() == TRUE) {
            $this->_register();
        } else {
            $this->load->view('Templates/Header');
            $this->load->view('Auth/Register');
            $this->load->view('Templates/Footer');
        }
    }
    private function _register()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'email' => htmlspecialchars(($this->input->post('email'))),
            'active' => 0,
            'gambar' => 'nophoto.png',
            'date_created' => Date('Y-m-d'),
            'username' => htmlspecialchars($this->input->post('username')),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'loginStats' => 0
        ];
        $token = [
            'email' => htmlspecialchars(($this->input->post('email'))),
            'token' => base64_encode(random_bytes(32)),
            'date_created' => time()
        ];
        $this->db->insert('users', $data);
        $this->db->insert('token', $token);
        $this->verify($token['token'], $data['email']);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Selamat! Akun Berhasil Dibuat. Silahkan Login!</div>');
        redirect(base_url());
    }
    private function _send_email($token, $type, $email)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'muhammadakbar007muhammad@gmail.com',
            'smtp_pass' => '81288748757',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->from('muhammadakbar007muhammad@gmail.com', 'Task Me');
        $this->email->to($email);
        if ($type == 'Verifikasi') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('<div class="container mt-1"><div class="row justify-content-center"><div class="col-md-10"><div class="card "><div class="card-header bg-info"><h3 class="text-light">Task Me!</h3></div><div class="card-body bg-light"><div class="row mt-2 justify-content-center"><div class="col-md-10"><p>Terima Kasih telah menggunakan layanan dari Task Me!<br>Silahkan verifikasikan akun anda dengan klik tombol di bawah ini!</p><div class="row justify-content-center"><div class="col-md-4 text-center"><a class="btn btn-lg btn-success" href="' . base_url('Auth/verify?email=' . $email) . '&token=' . urlencode($token) . '">Verifikasi</a></div></div><p>Atau anda dapat klik/salin url berikut: <a href="' . base_url('Auth/verify?email=' . $email) . '&token=' . urlencode($token) . '">' . base_url('Auth/verify?email=' . $email) . '&token=' . urlencode($token) . '</a></p></div></div><p class="text-right mt-1">Butuh Bantuan? Hubungi kami: <a href="' . base_url('Auth/help?email=' . $email) . '">Pusat Bantuan</a></p></div><div class="card-footer bg-dark text-center"><h1 style="color: black;">Task Me!</h1></div></div></div></div></div>');
        } else if ($type == 'Forget') {
            $this->email->subject('Reset Password');
            $this->email->message('<div class="container mt-1"><div class="row justify-content-center"><div class="col-md-10"><div class="card "><div class="card-header bg-info"><h3 class="text-light">Task Me!</h3></div><div class="card-body bg-light"><div class="row mt-2 justify-content-center"><div class="col-md-10"><p>Terima Kasih telah menggunakan layanan dari Task Me!<br>Silahkan Mereset Password akun anda dengan klik tombol di bawah ini!</p><div class="row justify-content-center"><div class="col-md-4 text-center"><a class="btn btn-lg btn-success" href="' . base_url('Auth/resetpassword?email=' . $email) . '&token=' . urlencode($token) . '">Reset Password</a></div></div><p>Atau anda dapat klik/salin url berikut: <a href="' . base_url('Auth/resetpassword?email=' . $email) . '&token=' . urlencode($token) . '">' . base_url('Auth/resetpassword?email=' . $email) . '&token=' . urlencode($token) . '</a></p></div></div><p class="text-right mt-1">Butuh Bantuan? Hubungi kami: <a href="' . base_url('Auth/help?email=' . $email) . '">Pusat Bantuan</a></p></div><div class="card-footer bg-dark text-center"><h1 style="color: black;">Task Me!</h1></div></div></div></div></div>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function help()
    {
        $email = htmlspecialchars($this->input->get('email'));
        $this->db->select('ID, email, username, nama, active, gambar');
        $email = $this->db->get_where('users', ['email' => $email])->row_array();
        if ($this->session->has_userdata('Recollabs') || get_cookie('Recollabs')) {
            redirect(base_url('Home'));
            exit;
        }
        if (!empty($email)) {
            $this->form_validation->set_rules('help', 'Help', 'trim|required');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $this->db->select('ID');
                $id = $this->db->get_where('users', ['email' => $email['email']])->row_array();
                $data = ['ID' => null, 'id_users' => $id['ID'], 'detail' => $this->input->post('help'), 'gambar' => '', 'reply' => ''];
                $this->db->insert('help', $data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Laporan Telah disampaikan. tunggu balasan email dari kami!</div>');
                redirect(base_url());
            } else {
                $this->load->view('Templates/Header');
                $this->load->view('Auth/Help', $email);
                $this->load->view('Templates/Footer');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Akun Tidak Terdaftar!</div>');
            redirect(base_url());
        }
    }
    public function verify($token, $email)
    {
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        $data = ['ID' => $user['ID'], 'kelompok' => ''];
        $friend = ['ID' => $user['ID'], 'friends' => '', 'request' => '', 'blocked' => ''];
        $setting = ['ID' => $user['ID'], 'colourNavigation' => 'bg-gradient-primary', 'colourTopBar' => 'primary', 'colourPopUp' => 'primary'];
        if ($user) {
            $user_token = $this->db->get_where('token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->db->insert('kelompok', $data);
                $this->db->insert('friends', $friend);
                $this->db->insert('settings', $setting);
                $this->db->set('active', 1);
                $this->db->where('email', $email);
				$this->db->update('users');
				
				return true;exit;
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Aktivasi Akun Gagal. Token Salah!</div>');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Aktivasi Akun Gagal. E-mail Salah!</div>');
            redirect(base_url());
        }
    }
    private function _check()
    {
        $username = htmlspecialchars(stripslashes($this->input->post('username')));
        $data = $this->db->get_where('users', ['username' => $username])->row_array();
        if (!empty($data)) {
            if ($data['active'] == 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Akun Anda belum diaktivasi!</div>');
                redirect(base_url());
                exit;
            }
            if (password_verify($this->input->post('password'), $data['password'])) {
                $sesi = ['ID' => $data['ID'], 'Username' => $data['username']];
                $this->session->set_userdata('Recollabs', $sesi);
                $activity = [
                    'id_users' => $data['ID'],
                    'tgl_activity' => Date('Y-m-d H-i-s'),
                    'kegiatan' => 'Login ke dalam sistem dengan ip ' . $this->get_client_ip_server(),
                    'keterangan' => 'Sistem'
                ];
                $this->db->insert('activity', $activity);
                if ($this->input->post('remember')) {
                    $cookie = ['id' => $data['ID'], 'Code' => password_hash($data['username'], PASSWORD_DEFAULT)];
                    set_cookie('Recollabs', $cookie, 7200);
                }
                redirect(base_url('Home'));
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                redirect(base_url());
                exit;
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Username Not Found!</div>');
            redirect(base_url());
            exit;
        }
    }
    private function get_client_ip_server()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function Forget()
    {
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $user = $this->db->get_where('users', ['email' => $email])->row_array();
            if ($user) {
                $user_token = [
                    'email' => $email,
                    'token' => base64_encode(random_bytes(32)),
                    'date_created' => time()
                ];
                $this->db->insert('token', $user_token);
                $this->_send_email($user_token['token'], 'Forget', $email);
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Cek Email Untuk Reset Password Anda! Token Berlaku untuk 3 Hari!</div>');
                redirect(base_url('Auth/Forget'));
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Email Tidak Terdaftar!</div>');
                redirect(base_url('Auth/Forget'));
            }
        } else {
            $this->load->view('Templates/Header');
            $this->load->view('Auth/forgot');
            $this->load->view('Templates/Footer');
        }
    }
    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (3600 * 24 * 3)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->db->delete('token', ['token' => $token]);
                    $this->changepassword();
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Reset Password Gagal. Token Expired!</div>');
                    $this->db->delete('token', ['token' => $token]);
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Reset Password Gagal. Token Salah!</div>');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Reset Password Gagal. Email Salah!</div>');
            redirect(base_url());
        }
    }
    public function changepassword()
    {
        if ($this->session->has_userdata('reset_email')) {

            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
            $this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password', 'required|matches[password]');

            if ($this->form_validation->run() == TRUE) {
                $email = $this->session->userdata('reset_email');
                $this->db->set('password', password_hash($this->input->post('password'), PASSWORD_DEFAULT));
                $this->db->where('email', $email);
                $this->db->update('users');
                $this->session->unset_userdata('reset_email');
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Reset Password berhasil. Silakan Login</div>');
                $id = $this->db->get_where('users', ['email' => $email])->row_array();
                $activity = [
                    'id_users' => $id['ID'],
                    'tgl_activity' => Date('Y-m-d H-i-s'),
                    'kegiatan' => 'Password Telah Diganti',
                    'keterangan' => 'Sistem'
                ];
                $this->db->insert('activity', $activity);
                redirect(base_url());
                exit;
            } else {
                $this->load->view('Templates/Header');
                $this->load->view('Auth/changePassword');
                $this->load->view('Templates/Footer');
            }
        }
    }
    public function log_out()
    {
        if ($this->session->has_userdata('Recollabs')) {
            $data = $this->session->userdata('Recollabs');
            $activity = [
                'id_users' => $data['ID'],
                'tgl_activity' => Date('Y-m-d H-i-s'),
                'kegiatan' => 'Log Out dari Sistem',
                'keterangan' => 'Sistem'
            ];
            $this->db->insert('activity', $activity);
            $this->session->unset_userdata('Recollabs');
            $this->session->unset_userdata('groups');
            delete_cookie('Recollabs');
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Akun Kamu Berhasil Keluar!</div>');
            redirect(base_url());
        } else {
            redirect(base_url());
            exit;
        }
    }
}
