<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	protected $profil;
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if (!$this->session->has_userdata('Recollabs')) {
			redirect(base_url());
			exit;
		}
		$this->load->library('upload');
		$this->load->model('Home_model', 'Home');
		$this->profil = $this->Home->Profil($this->session->userdata('Recollabs'));
	}
	public function index()
	{
		$title = 'Beranda';
		$data = ['profil' => $this->profil, 'title' => $title];
		$this->load->view('templates/Header', $data);
		$this->load->view('templates/Navbar', $data);
		$this->load->view('home/index', $data);
		$this->load->view('templates/Footer', $data);
	}
	public function Profil()
	{
		if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email'])) {
			$data = [
				'name' => htmlspecialchars(stripslashes($this->input->post('name'))),
				'username' => htmlspecialchars($this->input->post('username')),
				'email' => htmlspecialchars($this->input->post('email'))
			];
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Mengubah Profil',
				'keterangan' => 'Profil'
			];
			if ($this->Home->my_profil($data, $this->profil['ID'], $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function deleteFileGroup()
	{
		if (isset($_POST['id']) && isset($_POST['file'])) {
			if ($this->Home->deleteFileGroup($this->input->post('id'), $this->input->post('file'))) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function UploadFileGroup()
	{
		if (isset($_POST)) {
			$id = json_decode($this->input->post('data'), true);
			$dir = $this->Home->DirFileGroup($id['0']['id']);
			$name = $_FILES['file']['name'];
			$name = str_replace(" ", "_", $name);
			if ($this->Home->checkFileName($id['0']['id'], $name)) {
				return false;
				exit;
			}
			$config['upload_path']          = './assets/files/group/' . $dir['file_dir'] . '/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 8192;
			$config['file_name'] 			= $name;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file')) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Error ' . $this->upload->display_errors() . '</div>');
				return false;
				exit;
			} else {
				if ($this->Home->registNewFile($id['0']['id'], $name)) {
					return true;
					exit;
				} else {
					return false;
					exit;
				}
			}
		}
	}
	public function Search()
	{
		echo json_encode($this->Home->Search($this->profil['ID'], $this->input->get('q')));
	}
	public function delete_img_profil()
	{
		if (isset($_POST['id'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Menghapus Foto Profil',
				'keterangan' => 'Profil'
			];
			if ($this->Home->delete_img_profil($this->input->post('id'), $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function colorChange()
	{
		if (isset($_POST['navColor']) && isset($_POST['topBarColor']) && isset($_POST['modalColor'])) {
			$data = ['colourNavigation' => $this->input->post('navColor'), 'colourTopBar' => $this->input->post('topBarColor'), 'colourPopUp' => $this->input->post('modalColor')];
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Mengubah Warna',
				'keterangan' => 'Pengaturan'
			];
			if ($this->Home->colorChange($this->profil['ID'], $data, $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function upload_img_profil()
	{
		if (isset($_FILES['file'])) {
			$name = $_FILES['file']['name'];
			$config['upload_path']          = './assets/img/profil/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 2048;
			$config['max_width']            = 3840;
			$config['max_height']           = 2160;
			$config['file_name'] 			= $name;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file')) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Error ' . $this->upload->display_errors() . '</div>');
				return false;
				exit;
			} else {
				$activity = [
					'id_users' => $this->profil['ID'],
					'tgl_activity' => Date('Y-m-d H-i-s'),
					'kegiatan' => 'Mengunggah Foto Profil',
					'keterangan' => 'Profil'
				];
				if ($this->Home->set_image_name_profil($this->profil['username'], $name, $activity)) {
					return true;
					exit;
				} else {
					return true;
					exit;
				}
			}
		}
	}
	public function Group()
	{
		if (isset($_POST['code'])) {
			echo json_encode($this->Home->CekGroup($this->profil['ID'], $this->input->post('code')));
		} else if (isset($_POST['id'])) {
			echo json_encode($this->Home->Group_ID($this->input->post('id')));
		} else {
			echo json_encode($this->Home->Group($this->profil['ID']));
		}
	}
	public function PCMessage()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->PCMessage($this->profil['ID'], $this->input->post('id')));
		}
	}
	public function sendPCMessage()
	{
		if (isset($_POST['data'])) {
			$post = json_decode($_POST['data'], true);
			$data = ['id_from' => $this->profil['ID'], 'id_to' => $post['0']['id'], 'subject' => '', 'text' => $post['0']['pesan'], 'file' => (isset($_FILES['file'])) ? $this->uploadFilePersonalChat($_FILES['file']) : '', 'date_send' => Date('Y-m-d H:i:s'), 'status' => 0, 'report' => ''];

			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Mengirim Pesan Kepada Id = ' . $post['0']['id'],
				'keterangan' => 'Pesan'
			];
			if ($this->Home->_sendPCMessage($data, $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	private function uploadFilePersonalChat($file)
	{
		$name = explode('.', $file['name']);
		$extensi = end($name);
		unset($name[count($name) - 1]);
		$fileName = implode('', $name) . '_' . time() . '.' . $extensi;
		$config['file_name'] = $fileName;
		$config['upload_path'] = './assets/files/chat/';
		$config['allowed_types'] = '*';
		$config['max_size']  = '5120';

		$this->upload->initialize($config);

		if ($this->upload->do_upload('file')) {
			return $fileName;
		} else {
			print json_encode([$this->upload->display_errors()]);
			exit;
		}
	}
	public function PC()
	{
		echo json_encode($this->Home->PC($this->profil['ID']));
	}
	public function CreateGroupImage()
	{
		if (isset($_FILES['file'])) {
			$name = explode('.', $_FILES['file']['name']);
			$extensi = end($name);
			unset($name[count($name) - 1]);
			$fileName = implode('', $name) . '_' . time() . '.' . $extensi;
			$config['file_name'] = $fileName;
			$config['upload_path'] = './assets/img/group/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '5120';

			$this->upload->initialize($config);

			if ($this->upload->do_upload('file')) {
				echo json_encode([1, $fileName]);
				exit;
			} else {
				echo json_encode([0, $this->upload->display_errors()]);
				exit;
			}
		}
	}
	public function CreateGroup()
	{
		if (isset($_POST['name']) && isset($_POST['img']) && isset($_POST['description'])) {
			if ($_POST['img'] == null || $_POST['img'] == '') {
				$img = 'nophoto.png';
			} else {
				$img = $this->input->post('img');
			}
			$grup = [
				'nama' => htmlspecialchars($this->input->post('name')),
				'admin' => $this->profil['username'],
				'gambar' => $img,
				'code' => $this->_createCodeGroup(),
				'date_created' => Date('Y-m-d'),
				'date_deleted' => '0000-00-00',
				'description' => htmlspecialchars($this->input->post('description'))
			];
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Membuat Grup dengan Nama ' . $this->input->post('name'),
				'keterangan' => 'Grup'
			];
			if ($this->Home->CreateGroup($grup, $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	private function _createCodeGroup()
	{
		$check = true;
		do {
			$hash = strtolower(uniqid());
			if ($this->Home->uniqCode($hash)) {
				$check = false;
			}
		} while ($check);
		return $hash;
	}
	public function GroupOut()
	{
		if (isset($_POST['id']) && isset($_POST['type'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Keluar Dari Grup dengan ID = ' . $this->input->post('id'),
				'keterangan' => 'Grup'
			];
			if ($this->Home->GroupOut($this->profil['ID'], $this->input->post('id'), $this->input->post('type'), $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function GroupsRequest()
	{
		if (isset($_POST['id']) && isset($_POST['idGroups']) && isset($_POST['type'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Permintaan Ke Grup dengan id = ' . $this->input->post('id') . 'dan type = ' . $this->input->post('type'),
				'keterangan' => 'Grup'
			];
			if ($this->Home->GroupsRequest($this->input->post('type'), $this->input->post('id'), $this->input->post('idGroups'), $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function Task()
	{
		echo json_encode($this->Home->Task($this->profil['ID']));
	}
	public function Report()
	{
		if (isset($_POST['id']) && isset($_POST['text'])) {
			$data = ['id_to_report' => $this->input->post('id'), 'id_from_report' => $this->profil['ID'], 'text_report' => htmlspecialchars($this->input->post('text')), 'date_report' => time()];
			if ($this->Home->Report($data)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function RequestFriends()
	{
		if (isset($_POST['id']) && isset($_POST['type'])) {
			if ($this->Home->RequestFriends($this->input->post('id'), $this->profil['ID'], $this->input->post('type'))) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function FileMessageFastFriends()
	{
		if (isset($_FILES['file'])) {
			$name = explode('.', $_FILES['file']['name']);
			$extensi = end($name);
			unset($name[count($name) - 1]);
			$fileName = implode('', $name) . '_' . time() . '.' . $extensi;
			$config['file_name'] = $fileName;
			$config['upload_path'] = './assets/files/chat/';
			$config['allowed_types'] = 'rar|zip|doc|docx|ppt|pptx|gif|jpg|png|jpeg';
			$config['max_size']  = '5120';

			$this->upload->initialize($config);

			if ($this->upload->do_upload('file')) {
				echo json_encode([1, $fileName]);
				exit;
			} else {
				echo json_encode([0, $this->upload->display_errors()]);
				exit;
			}
		}
	}
	public function UrungKirim()
	{
		if (isset($_POST['id'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Urung Kirim Pesan Ke Grup Chat dengan id = ' . $this->input->post('id'),
				'keterangan' => 'Grup'
			];
			if ($this->Home->UrungKirim($this->profil['ID'], $this->input->post('id'), $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function sendMessageGroup()
	{
		if (isset($_POST['id']) && isset($_POST['text']) && isset($_POST['file'])) {
			$data = ['id_group' => $this->input->post('id'), 'id_users' => $this->profil['ID'], 'text' => htmlspecialchars($this->input->post('text')), 'file' => $this->input->post('file'), 'date_chat' => Date('Y-m-d H:i:s'), 'report' => ''];
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Mengirim Pesan Ke Grup dengan id = ' . $this->input->post('id') . 'dan text = ' . $this->input->post('text'),
				'keterangan' => 'Grup'
			];
			if ($this->Home->sendMessageGroup($data, $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function MessageGroup()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->MessageGroup($this->profil['ID'], $this->input->post('id')));
		}
	}
	public function MessageIDGroup()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->MessageIDGroup($this->profil['ID'], $this->input->post('id')));
		}
	}
	public function NotifyNavbar()
	{
		echo json_encode($this->Home->NotifyNavbar($this->profil['ID']));
	}
	public function MessagesNavbar()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->MessagesNavbar($this->input->post('id')));
		}
	}
	public function Alerts()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->Alerts($this->input->post('id')));
		}
	}
	public function AlertsNavbar()
	{
		echo json_encode($this->Home->AlertsNavbar($this->profil['ID']));
	}
	public function MessageNavbar()
	{
		echo json_encode($this->Home->MessageNavbar($this->profil['ID']));
	}
	public function sendTextMailFastFriends()
	{
		if (isset($_POST['to']) && isset($_POST['subject']) && isset($_POST['text']) && isset($_POST['file'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Mengirim Pesan Kepada ' . $this->input->post('to'),
				'keterangan' => 'Pertemanan'
			];
			$data = [
				'id_from' => $this->profil['ID'],
				'id_to' => $this->Home->getID($this->input->post('to')),
				'subject' => $this->input->post('subject'),
				'text' => $this->input->post('text'),
				'file' => $this->input->post('file'),
				'date_send' => Date('Y-m-d H:i:s'),
				'status' => 0,
				'report' => ''
			];
			if ($this->Home->sendTextMailFastFriends($data, $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function unBlockedFriends()
	{
		if (isset($_POST['id'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Membuka Blokir Teman Anda dengan id = ' . $this->input->post('id'),
				'keterangan' => 'Pertemanan'
			];
			if ($this->Home->unBlockedFriends($this->profil['ID'], $this->input->post('id'), $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function TaskGroupHome()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->TaskGroupHome($this->input->post('id'), $this->profil['ID']));
		}
	}
	public function GroupsMember()
	{
		if (isset($_POST['id']) && isset($_POST['group'])) {
			echo json_encode($this->Home->GroupsMember($this->profil['ID'], $this->input->post('id'), $this->input->post('group')));
		}
	}
	public function Groups_Member($id = null)
	{
		echo json_encode($this->Home->Groups($id, 'member'));
	}
	public function Groups_Request($id = null)
	{
		echo json_encode($this->Home->Groups($id, 'request'));
	}
	public function GroupsResource($id = null)
	{
		echo json_encode([$this->Home->Groups($id, 'request'), $this->Home->Groups($id, 'member')]);
	}
	public function fileGroup()
	{
		if (isset($_GET['id']))
			echo json_encode($this->Home->_file($this->input->get('id'), $this->input->get('type')));
		else
			redirect(base_url());
	}
	public function GroupClose()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->CloseGroup($this->input->post('id')));
		}
	}
	public function Group_Home()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->Group_Home($this->input->post('id'), $this->profil['ID']));
		}
	}
	public function GroupRequest()
	{
		if (isset($_POST['id_group']) && isset($_POST['type'])) {
			if ($_POST['type'] == 'Request') {
				if ($this->Home->GroupRequest($this->profil['ID'], $this->input->post('id_group'), 'Add')) {
					return true;
					exit;
				} else {
					return false;
					exit;
				}
			} else {
				if ($this->Home->GroupRequest($this->profil['ID'], $this->input->post('id_group'), 'Remove')) {
					return true;
					exit;
				} else {
					return false;
					exit;
				}
			}
		}
	}
	public function TaskDetailID()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->TaskDetailID($this->input->post('id')));
		}
	}
	public function TaskDetailUsers()
	{
		if (isset($_POST['data'])) {
			echo json_encode($this->Home->TaskDetailUsers($this->input->post('data')));
		}
	}
	public function TaskGroupAdmin()
	{
		echo json_encode($this->Home->TaskGroupAdmin($this->input->post('id')));
	}
	public function CreateTask()
	{
		if (isset($_POST['time']) && isset($_POST['subject']) && isset($_POST['messages']) && isset($_POST['detail']) && isset($_POST['deadlineTime']) && isset($_POST['id'])) {
			$data = [
				'id_group' => $this->input->post('id'),
				'subject' => $this->input->post('subject'),
				'messages' => $this->input->post('messages'),
				'detail' => $this->input->post('detail'),
				'file' => $this->input->post('id') . time() . $this->input->post('id'),
				'status' => 0,
				'date_created' => Date('Y-m-d H:i:s'),
				'deadline' => $this->input->post('deadlineTime') . ' ' . $this->input->post('time')
			];
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Membuat Tugas Di Grup dengan id Group = ' . $this->input->post('id') . ' dan subject ' . $this->input->post('subject'),
				'keterangan' => 'Tugas'
			];
			if ($this->Home->createTask($data, $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function jb()
	{
		$data = [
			'task' => $this->Home->count_task($this->profil['ID']),
			'group' => $this->Home->count_group($this->profil['ID']),
			'profil' => 60,
			'friends' => $this->Home->count_friends($this->profil['ID'])
		];
		echo json_encode($data);
		exit;
	}
	public function GroupSign()
	{
		if (isset($_POST['code'])) {
			$tipe = $this->Home->CekGroup($this->profil['ID'], $this->input->post('code'));
			if ($tipe['Tipe'] == 'Member') {
				$group_temp = $this->Home->GroupSession($this->input->post('code'));
				$tempSession = ($this->session->has_userdata('groups')) ? $this->session->userdata('groups') : '';
				if (!empty($tempSession['0'])) {
					for ($i = 0; $i < count($tempSession); $i++) {
						if ($tempSession[$i]['ID'] == $group_temp['ID']) {
							echo json_encode('Already');
							exit;
						}
					}
					$tempSession = $tempSession['0'];
					$data = [$group_temp, $tempSession];
				} else {
					$data = [$group_temp];
				}
				$this->session->set_userdata('groups', $data);
				echo json_encode($data);
				exit;
			}
		}
	}
	public function TaskUpload()
	{
		if (isset($_FILES['file']) && isset($_POST['data'])) {
			$data = json_decode($this->input->post('data'), true);
			$folder = $this->Home->getFolderTask($data['0']['id']);
			$config['file_name'] = $_FILES['file']['name'];
			$config['upload_path'] = './assets/files/tugas/' . $folder['file'] . '/';
			$config['allowed_types'] = 'rar|zip|doc|docx|ppt|pptx|gif|jpg|png|jpeg';
			$config['max_size']  = '5120';

			$this->upload->initialize($config);

			if ($this->upload->do_upload('file')) {
				$activity = [
					'id_users' => $this->profil['ID'],
					'tgl_activity' => Date('Y-m-d H-i-s'),
					'kegiatan' => 'Mengunggah File Tugas Dengan id Tugas = ' . $this->input->post('idTask'),
					'keterangan' => 'Tugas'
				];
				$data = ['id_task' => $data['0']['id'], 'id_users' => $this->profil['ID'], 'file' => $_FILES['file']['name'], 'pesan' => $data['0']['pesan'], 'tgl_upload' => Date('Y-m-d H:i:s'), 'pesanAdmin' => ''];
				if ($this->Home->TaskUpload($data, $activity)) {
					echo json_encode('uploaded');
					exit;
				} else {
					return false;
					exit;
				}
			} else {
				echo json_encode($this->upload->display_errors());
				exit;
			}
		}
	}
	public function TaskHistory()
	{
		echo json_encode($this->Home->TaskHistory($this->profil['ID']));
	}
	public function unSubmit()
	{
		if (isset($_POST['task'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Membatalkan Unggahan Tugas dengan id Tugas = ' . $this->input->post('task'),
				'keterangan' => 'Tugas'
			];
			if ($this->Home->unSubmitted($this->input->post('task'), $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function TaskDelete()
	{
		if (isset($_POST['id'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Menghapus Tugas dengan id tugas = ' . $this->input->post('id'),
				'keterangan' => 'Tugas'
			];
			if ($this->Home->TaskDelete($this->input->post('id'), $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function TaskZip()
	{
		if (isset($_POST['file'])) {
			echo json_encode($this->Home->TaskZip($this->input->post('file')));
			exit;
		}
	}
	public function AdminChange()
	{
		if (isset($_POST['id']) && isset($_POST['group'])) {
			if ($this->Home->AdminChange($this->input->post('id'), $this->input->post('group'))) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function MemberChange()
	{
		if (isset($_POST['id']) && isset($_POST['group'])) {
			if ($this->Home->MemberChange($this->input->post('id'), $this->input->post('group'))) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function MemberGroupAdmin()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->MemberGroupAdmin($this->input->post('id')));
			exit;
		}
	}
	public function AcceptRequestFriends()
	{
		if (isset($_POST['id'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Menerima Permintaan Pertemanan kepada id = ' . $this->input->post('id'),
				'keterangan' => 'Pertemanan'
			];
			$activity2 = [
				'id_users' => $this->input->post('id'),
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Permintaan Pertemanan kamu diterima dari id = ' . $this->profil['ID'],
				'keterangan' => 'Pertemanan'
			];
			if ($this->Home->AcceptRequestFriends($this->profil['ID'], $this->input->post('id'), $activity, $activity2)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function unfriends()
	{
		if (isset($_POST['id'])) {

			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Menghapus 1 teman dengan id = ' . $this->input->post('id'),
				'keterangan' => 'Pertemanan'
			];
			if ($this->Home->unfriends($this->input->post('id'), $this->profil['ID'], $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function declinedRequestFriends()
	{
		if (isset($_POST['id'])) {

			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Menolak Permintaan Pertemanan kepada id = ' . $this->input->post('id'),
				'keterangan' => 'Pertemanan'
			];
			if ($this->Home->declinedRequestFriends($this->profil['ID'], $this->input->post('id'), $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function FriendsDetail()
	{
		if (isset($_POST['id'])) {
			echo json_encode($this->Home->FriendsDetail($this->profil['ID'], $this->input->post('id')));
		}
	}
	public function FriendRequest()
	{
		echo json_encode($this->Home->FriendRequest($this->profil['ID']));
	}
	public function FriendBlocked()
	{
		echo json_encode($this->Home->FriendBlocked($this->profil['ID']));
	}
	public function FriendHome()
	{
		echo json_encode($this->Home->FriendHome($this->profil['ID']));
	}
	public function Friends()
	{
		echo json_encode($this->Home->Friends($this->profil['ID']));
	}
	public function TaskUsers()
	{
		if (isset($_POST['idTask']) && isset($_POST['pesan']) && isset($_POST['name'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Mengunggah File Tugas Dengan id Tugas = ' . $this->input->post('idTask'),
				'keterangan' => 'Tugas'
			];

			$data = ['id_task' => $this->input->post('idTask'), 'id_users' => $this->profil['ID'], 'file' => $this->input->post('name'), 'pesan' => $this->input->post('pesan'), 'tgl_upload' => Date('Y-m-d H:i:s'), 'pesanAdmin' => ''];
			if ($this->Home->TaskUpload($data, $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function TaskID()
	{
		if (isset($_POST['task'])) {
			echo json_encode($this->Home->TaskID($this->profil['ID'], $this->input->post('task')));
		}
	}
	public function BlockFriends()
	{
		if (isset($_POST['id'])) {
			$activity = [
				'id_users' => $this->profil['ID'],
				'tgl_activity' => Date('Y-m-d H-i-s'),
				'kegiatan' => 'Blokir Teman anda dengan id = ' . $this->input->post('id'),
				'keterangan' => 'Pertemanan'
			];
			if ($this->Home->BlockFriends($this->input->post('id'), $this->profil['ID'], $activity)) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}
	}
	public function Activity()
	{
		if (isset($_POST['id'])) {
			$activity = ($this->Home->Activity($this->profil['ID'], $this->input->post('id')));
			$activity = ['ID' => $activity['ID'], 'nama' => $this->profil['nama'], 'username' => $this->profil['username'], 'tgl_activity' => $activity['tgl_activity'], 'kegiatan' => $activity['kegiatan'], 'keterangan' => $activity['keterangan']];
			echo json_encode($activity);
			exit;
		} else {
			$activity = ($this->Home->Activity($this->profil['ID']));
			for ($i = 0; $i < count($activity); $i++) {
				$activity[$i] = ['number' => ($i + 1), 'nama' => $this->profil['nama'], 'username' => $this->profil['username'], 'tgl_activity' => $activity[$i]['tgl_activity'], 'kegiatan' => $activity[$i]['kegiatan'], 'info' => '<button class="btn btn-outline-info btn-activity-info" data-toggle="modal" title="Detail" data-target="#activity-info" data-id="' . $activity[$i]['ID'] . '"><i class="fas fa-info"></i></button>'];
			}
			echo json_encode($activity);
			exit;
		}
	}
}
