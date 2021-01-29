<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function Profil($ID)
    {
        $data = $this->db->query("SELECT users.ID, nama, email, active, gambar, username, colourNavigation, colourTopBar, colourPopUp FROM `taskme`.`users` JOIN `taskme`.`settings` ON `taskme`.`users`.ID = `taskme`.`settings`.ID WHERE `taskme`.`users`.ID = '{$ID['ID']}'")->row_array();
        return $data;
        exit;
    }
    public function colorChange($id, $data, $activity)
    {
        $this->db->insert('activity', $activity);
        $this->db->update('settings', $data, ['ID' => $id]);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function delete_img_profil($id, $activity)
    {
        $this->db->select('gambar');
        $img_old = $this->db->get_where('users', "ID = '{$id}'")->row_array();
        if ($img_old['gambar'] != 'nophoto.png') {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/TaskMe/assets/img/profil/' . $img_old['gambar']);
        }
        $this->db->query("UPDATE users SET gambar = 'nophoto.png' WHERE ID = '{$id}'");
        $this->db->insert('activity', $activity);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function GroupsRequest($type, $id, $id_group)
    {
        if ($type == 'Accept') {
            $this->db->select('request, member');
            $data = $this->db->get_where('member_group', ['ID' => $id_group])->row_array();
            $request = explode(';', $data['request']);
            if (empty($request['0'])) {
                unset($request['0']);
            }
            sort($request);
            for ($i = 0; $i < count($request); $i++) {
                if ($request[$i] == $id) {
                    unset($request[$i]);
                }
            }
            sort($request);

            if (count($request) > 1) {
                $request = implode(';', $request);
            }
            if (count($request) == 0) {
                $request = '';
            }

            $member = explode(';', $data['member']);
            if (empty($member['0'])) {
                unset($member['0']);
            }
            sort($member);

            $member[] = $id;
            if (count($member) > 1) {
                $member = implode(';', $member);
            } else {
                $member = $id;
            }
            $this->db->query("UPDATE `taskme`.`member_group` SET `member_group`.`request` = '{$request}', `member_group`.`member` = '{$member}' WHERE `ID` = '{$id_group}'");
            $activity = [
                'id_users' => $id,
                'tgl_activity' => Date('Y-m-d H-i-s'),
                'kegiatan' => 'Telah Diterima Masuk di grup dengan id = ' . $id_group,
                'keterangan' => 'Grup'
            ];
            $this->db->insert('activity', $activity);

            if ($this->db->affected_rows() > 0) {
                return true;
                exit;
            } else {
                return false;
                exit;
            }
        } else {
            $this->db->select('request');
            $data = $this->db->get_where('member_group', ['ID' => $id_group])->row_array();
            $request = explode(';', $data['request']);
            if (empty($request['0'])) {
                unset($request['0']);
            }
            sort($request);
            for ($i = 0; $i < count($request); $i++) {
                if ($request[$i] == $id) {
                    unset($request[$i]);
                }
            }
            sort($request);

            if (count($request) > 1) {
                $request = implode(';', $request);
            }
            if (count($request) == 0) {
                $request = '';
            }

            $code = $this->db->query("SELECT `code` FROM `taskme`.`group` WHERE `ID` = '{$id_group}'")->row_array();
            $this->db->select('kelompok');
            $kel = $this->db->get_where('kelompok', ['ID' => $id])->row_array();
            $kel = explode(';', $kel['kelompok']);
            if (empty($kel['0'])) {
                unset($kel['0']);
            }
            sort($kel);

            for ($i = 0; $i < count($kel); $i++) {
                if ($kel[$i] == $code['code']) {
                    unset($kel[$i]);
                }
            }
            sort($kel);
            if (count($kel) >= 1) {
                $kel = implode(';', $kel);
            } else if (count($kel) == 0) {
                $kel = '';
            }
            $this->db->query("UPDATE `taskme`.`member_group` SET `member_group`.`request` = '{$request}' WHERE `ID` = '{$id_group}'");
            $this->db->query("UPDATE `taskme`.`kelompok` SET `kelompok`.`kelompok` = '{$kel}' WHERE `ID` = '{$id}'");
            $activity = [
                'id_users' => $id,
                'tgl_activity' => Date('Y-m-d H-i-s'),
                'kegiatan' => 'Telah Ditolak Masuk di grup dengan id = ' . $id_group,
                'keterangan' => 'Grup'
            ];
            $this->db->insert('activity', $activity);
            if ($this->db->affected_rows() > 0) {
                return true;
                exit;
            } else {
                return false;
                exit;
            }
        }
    }
    public function Group_ID($id)
    {
        return $this->db->get_where('group', ['ID' => $id])->row_array();
    }
    public function Task($id)
    {
        $this->db->select('kelompok');
        $group = $this->db->get_where('kelompok', ['ID' => $id])->row_array();
        if (!empty($group['kelompok'])) {
            $group = explode(';', $group['kelompok']);
            if (empty($group['0'])) {
                unset($group['0']);
                sort($group);
            }
            for ($i = 0; $i < count($group); $i++) {
                $this->db->select('ID');
                $ID[$i] = $this->db->get_where('group', ['code' => $group[$i]])->row_array();
            }
            unset($group);
            for ($i = 0; $i < count($ID); $i++) {
                $task[$i] = $this->db->query("SELECT task.ID, task.subject, task.deadline FROM task WHERE task.id_group = '{$ID[$i]['ID']}' AND status = '0' ORDER BY date_created DESC")->result_array();
                for ($j = 0; $j < count($task[$i]); $j++) {
                    $temp = $this->db->query("SELECT ID FROM task_users WHERE id_task = '{$task[$i][$j]['ID']}' AND id_users = '{$id}'")->row_array();
                    if (!empty($temp)) {
                        $task[$i][$j]['upload'] = 1;
                    } else {
                        $task[$i][$j]['upload'] = 0;
                    }
                    $task[$i][$j]['aksi'] = '<button style="border-radius: 20px;" data-toggle="modal" data-target="#upload_task_active" class="btn btn-outline-success upload_file_task" data-task="' . $task[$i][$j]['ID'] . '"><i class="fas fa-upload"></i> Unggah</button>';
                    $task[$i][$j]['group'] = $this->db->query("SELECT nama, code FROM `taskme`.`group` WHERE ID = '{$ID[$i]['ID']}'")->row_array();
                }
            }
            return $task;
        } else {
            return 0;
            exit;
        }
    }
    public function TaskHistory($id)
    {
        $this->db->select('kelompok');
        $grup = $this->db->get_where('kelompok', ['ID' => $id])->row_array();

        $grup = explode(';', $grup['kelompok']);
        if (empty($grup['0'])) {
            unset($grup['0']);
            sort($grup);
        }
        for ($i = 0; $i < count($grup); $i++) {
            $this->db->select('ID');
            $ID[$i] = $this->db->get_where('group', ['code' => $grup[$i]])->row_array();
        }
        unset($group);
        for ($i = 0; $i < count($grup); $i++) {
            $task[$i] = $this->db->query("SELECT task.ID, task.subject, task.deadline FROM task WHERE task.id_group = '{$ID[$i]['ID']}' AND status = '1' ORDER BY date_created DESC")->result_array();

            for ($j = 0; $j < count($task[$i]); $j++) {
                $temp = $this->db->query("SELECT ID FROM task_users WHERE id_task = '{$task[$i][$j]['ID']}' AND id_users = '{$id}'")->row_array();
                if (!empty($temp)) {
                    $task[$i][$j]['upload'] = 1;
                } else {
                    $task[$i][$j]['upload'] = 0;
                }
                $task[$i][$j]['aksi'] = '<button data-toggle="modal" data-target="#upload_task_active" class="btn btn-outline-success upload_file_task" data-task="' . $task[$i][$j]['ID'] . '"><i class="fas fa-info"></i></button>';
                $task[$i][$j]['group'] = $this->db->query("SELECT nama, code FROM `taskme`.`group` WHERE ID = '{$ID[$i]['ID']}'")->row_array();
            }
        }
        $task['count'] = count($task);
        return $task;
        exit;
    }
    public function TaskUpload($data, $activity)
    {
        $this->db->insert('activity', $activity);
        $this->db->insert('task_users', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function TaskID($id, $task)
    {
        $cek = $this->db->get_where('task_users', ['id_users' => $id, 'id_task' => $task])->row_array();
        if (empty($cek['ID'])) {
            $status = 0;
        } else {
            $status = 1;
        }
        $data = $this->db->get_where('task', ['ID' => $task])->row_array();
        $grup = $this->db->query("SELECT nama, code, gambar FROM `taskme`.`group` WHERE ID = '{$data['id_group']}'")->row_array();
        $task = [$data, $grup, $status, $cek];
        return $task;
        exit;
    }
    public function TaskDetailID($id)
    {
        $task = $this->db->get_where('task', ['ID' => $id])->row_array();
        $user = [];
        $this->db->select('member');
        $users = $this->db->get_where('member_group', ['ID' => $task['id_group']])->row_array();
        $users = explode(';', $users['member']);
        if (empty($users['0'])) {
            unset($users['0']);
            sort($users['0']);
        }
        for ($i = 0; $i < count($users); $i++) {
            $temp = $this->db->query("SELECT task_users.ID, users.username, users.nama, users.gambar FROM task_users JOIN users ON task_users.id_users = users.ID WHERE id_task = '{$id}' AND id_users = '{$users[$i]}'")->row_array();

            $this->db->select('nama, username, gambar');
            $no = $this->db->get_where('users', ['ID' => $users[$i]])->row_array();
            $user[$i] = (!empty($temp)) ? $temp : $no;
        }
        return [$task, $user];
    }
    public function TaskDetailUsers($id)
    {
        return $this->db->query("SELECT task.file AS iFile, task.subject, task.messages, task.detail, task_users.ID, task_users.file, task_users.pesan, task_users.tgl_upload, task_users.pesanAdmin, users.username, users.email, users.nama, users.gambar FROM task_users JOIN users ON task_users.id_users = users.ID JOIN task ON task_users.id_task = task.ID WHERE task_users.ID = '{$id}'")->row_array();
    }
    public function createTask($data, $activity)
    {
        $this->db->insert('task', $data);
        $this->db->insert('activity', $activity);
        mkdir($_SERVER['DOCUMENT_ROOT'] . '/taskme/assets/files/tugas/' . $data['file'] . '/');
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function getFolderTask($id)
    {
        $this->db->select('file');
        return $this->db->get_where('task', ['ID' => $id])->row_array();
    }
    public function unSubmitted($task, $activity)
    {
        $this->db->insert('activity', $activity);
        $oldFile = $this->db->query("SELECT task_users.file, task_users.id_task FROM task_users WHERE ID = '{$task}'")->row_array();
        if (!empty($oldFile['file'])) {
            $folder = $this->db->get_where('task', ['ID' => $oldFile['id_task']])->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'] . '/taskme/assets/files/tugas/' . $folder['file']   . '/' . $oldFile['file']);
            $this->db->delete('task_users', ['ID' => $task]);
            if ($this->db->affected_rows() > 0) {
                return true;
                exit;
            } else {
                return false;
                exit;
            }
        } else {
            return 0;
            exit;
        }
    }
    public function TaskDelete($id, $activity)
    {
        $this->db->insert('activity', $activity);
        $data = $this->db->get_where('task', ['ID' => $id])->row_array();
        $this->db->select('file');
        $task = $this->db->get_where('task_users', ['id_task' => $id])->result_array();
        if (count($task) > 0) {
            for ($i = 0; $i < count($task); $i++) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/taskme/assets/files/tugas/' . $data['file']   . '/' . $task[$i]['file']);
            }
        }
        rmdir($_SERVER['DOCUMENT_ROOT'] . '/taskme/assets/files/tugas/' . $data['file']   . '/');
        $this->db->query("DELETE FROM task_users WHERE id_task = '{$id}'");
        $this->db->query("DELETE FROM task WHERE ID = '{$id}'");
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function MemberGroupAdmin($id)
    {
        $this->db->select('member, admin');
        $member = $this->db->get_where('member_group', ['ID' => $id])->row_array();
        $admin = explode(';', $member['admin']);
        $member = explode(';', $member['member']);
        if (empty($member['0'])) {
            unset($member['0']);
            sort($member);
        }
        $this->db->select('admin');
        $owner = $this->db->get_where('group', ['ID' => $id])->row_array();
        $users = [];
        for ($i = 0; $i < count($member); $i++) {
            $this->db->select('nama, username, ID, gambar');
            $users[$i] = $this->db->get_where('users', ['ID' => $member[$i]])->row_array();
            $users[$i]['gambar'] = '<img src="' . base_url('assets/img/profil/') . $users[$i]['gambar'] . '" class="img-responsive img-thumbnail" style="width: 120px; height: 100px;">';
            $users[$i]['aksi'] = (in_array($member[$i], $admin)) ? '<button style="border-radius: 20px;" class="btn btn-outline-info member-change" data-group="' . $id . '" data-id="' . $member[$i] . '" title="Jadikan Anggota"><i class="fas fa-user-edit"></i> Anggota</button>' : '<button data-group="' . $id . '" class="btn btn-outline-info admin-change" style="border-radius: 20px;" data-id="' . $member[$i] . '" title="Jadikan Admin"><i class="fas fa-user-edit"></i> Admin</button>';
            $users[$i]['aksi'] = ($users[$i]['username'] == $owner['admin']) ? '<button data-group="' . $id . '" disabled="" style="border-radius: 20px;" class="btn btn-outline-info member-change" data-group="' . $id . '" data-id="' . $member[$i] . '" title="Jadikan Anggota"><i class="fas fa-user-edit"></i> Anggota</button>' : $users[$i]['aksi'];
        }
        return $users;
        exit;
    }
    public function AdminChange($id, $group)
    {
        $this->db->select('admin, member');
        $data = $this->db->get_where('member_group', ['ID' => $group])->row_array();
        $admin = explode(';', $data['admin']);
        if (empty($admin['0'])) {
            unset($admin['0']);
            sort($admin['0']);
        }
        $admin[] = $id;
        if (count($admin) > 1) {
            $admin = implode(';', $admin);
        } else {
            $admin = $id;
        }
        $this->db->update('member_group', ['admin' => $admin], ['ID' => $group]);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function memberChange($id, $group)
    {
        $this->db->select('admin, member');
        $data = $this->db->get_where('member_group', ['ID' => $group])->row_array();
        $this->db->select('admin');
        $owner = $this->db->get_where('group', ['ID' => $group])->row_array();
        $this->db->select('ID');
        $owner = $this->db->get_where('users', ['username' => $owner['admin']])->row_array();
        $admin = explode(';', $data['admin']);
        if (empty($admin['0'])) {
            unset($admin['0']);
            sort($admin['0']);
        }
        for ($i = 0; $i < count($admin); $i++) {
            if ($admin[$i] == $id) {
                if ($owner['ID'] !== $id) {
                    unset($admin[$i]);
                }
            }
        }
        sort($admin);
        if (count($admin) > 0) {
            $admin = implode(';', $admin);
        } else {
            $admin = '';
        }

        $this->db->update('member_group', ['admin' => $admin], ['ID' => $group]);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function TaskGroupAdmin($group)
    {
        $this->db->select('status, ID, subject, deadline, messages');
        $data = $this->db->get_where('task', ['id_group' => $group])->result_array();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['status'] = ($data[$i]['status'] == 1) ? '<div class="badge badge-success">Selesai</div>' : '<div class="badge badge-info">Belum</div>';
            $data[$i]['aksi'] = '<button data-target="#detail-admin-task-change" title="Lihat" data-toggle="modal" class="btn btn-outline-success detail-group-admin" data-id="' . $data[$i]['ID'] . '"><i class="fas fa-eye"></i> </button> <button title="Hapus" data-group="' . $group . '" class="btn btn-outline-danger delete-group-admin" data-id="' . $data[$i]['ID'] . '"><i class="fas fa-eraser"></i> </button>';
        }
        return $data;
    }
    public function TaskZip($file)
    {
        $zip = new ZipArchive();
        $name = 'zip-' . $file . '.zip';
        $this->db->select('ID');
        $id_group = $this->db->get_where('task', ['file' => $file])->row_array();
        $this->db->select('file');
        $task = $this->db->get_where('task_users', ['id_task' => $id_group['ID']])->result_array();
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/taskme/assets/files/tugas/' . $file   . '/' . 'zip-' . $file)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/taskme/assets/files/tugas/' . $file   . '/' . 'zip-' . $file);
        }
        if ($zip->open($_SERVER['DOCUMENT_ROOT'] . '/taskme/assets/files/tugas/' . $file   . '/' . $name, ZipArchive::CREATE) == TRUE) {
            for ($i = 0; $i < count($task); $i++) {
                $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/taskme/assets/files/tugas/' . $file   . '/' . $task[$i]['file'], $task[$i]['file']);
            }
            $zip->close();
            return $name;
            exit;
        }
        return false;
        exit;
    }
    public function Friends($id)
    {
        $data = $this->db->get_where('friends', ['ID' => $id])->row_array();
        $friends = explode(';', $data['friends']);
        if (empty($friends['0'])) {
            unset($friends['0']);
            sort($friends);
        }
        $blocked = explode(';', $data['blocked']);
        if (empty($blocked['0'])) {
            unset($blocked['0']);
            sort($blocked);
        }
        $request = explode(';', $data['request']);
        if (empty($request['0'])) {
            unset($request['0']);
            sort($request);
        }
        return [count($friends), count($request), count($blocked)];
        exit;
    }
    public function FriendRequest($id)
    {
        $requests = [];
        $data = $this->db->get_where('friends', ['ID' => $id])->row_array();
        $request = explode(';', $data['request']);
        if (empty($request['0'])) {
            unset($request['0']);
            sort($request);
        }
        if (!empty($request)) {
            for ($i = 0; $i < count($request); $i++) {
                $this->db->select('ID, nama, gambar, username');
                $requests[] = $this->db->get_where('users', ['ID' => $request[$i]])->row_array();
                $requests[$i]['gambar'] = '<img src="' . base_url('assets/img/profil/') . $requests[$i]['gambar'] . '" class="img-responsive img-thumbnail" style="width: 150px;">';
                $requests[$i]['number'] = $i + 1;
                $requests[$i]['aksi'] = '<div class="btn-group"><button class="btn btn-outline-success acceptRequestFriends" data-id="' . $requests[$i]['ID'] . '" title="Terima"><i class="fas fa-user-plus"></i></button><button class="declinedRequestFriends btn btn-outline-danger" data-id="' . $requests[$i]['ID'] . '" title="Tolak"><i class="fas fa-user-times"></i></button></div>';
            }
            return $requests;
            exit;
        } else {
            return 0;
            exit;
        }
    }
    public function AcceptRequestFriends($myID, $id, $activity, $activity2)
    {
        $this->db->select('friends, request');
        $data = $this->db->get_where('friends', ['ID' => $myID])->row_array();
        $request = explode(';', $data['request']);
        if (empty($request['0'])) {
            unset($request['0']);
            sort($request);
        }
        for ($i = 0; $i < count($request); $i++) {
            if ($request[$i] == $id) {
                unset($request[$i]);
            }
        }
        sort($request);
        if (count($request) >= 1) {
            $request = implode(';', $request);
        } else {
            $request = '';
        }
        $friends = explode(';', $data['friends']);
        if (empty($friends['0'])) {
            unset($friends['0']);
            sort($friends);
        }
        $friends[] = $id;
        if (count($friends) >= 1) {
            $friends = implode(';', $friends);
        } else {
            $friends = $id;
        }
        $this->db->select('friends');
        $data = $this->db->get_where('friends', ['ID' => $id])->row_array();
        $data = explode(';', $data['friends']);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        $data[] = $myID;
        if (count($data) >= 1) {
            $data = implode(';', $data);
        } else {
            $data = $myID;
        }
        $this->db->insert('activity', $activity);
        $this->db->insert('activity', $activity2);
        $this->db->update('friends', ['friends' => $data], ['ID' => $id]);
        $this->db->update('friends', ['friends' => $friends, 'request' => $request], ['ID' => $myID]);
        unset($friends);
        unset($request);
        unset($data);
        return true;
        exit;
    }
    public function declinedRequestFriends($myID, $id, $activity)
    {
        $this->db->select('request');
        $data = $this->db->get_where('friends', ['ID' => $myID])->row_array();
        $request = explode(';', $data['request']);
        if (empty($request['0'])) {
            unset($request['0']);
            sort($request);
        }
        for ($i = 0; $i < count($request); $i++) {
            if ($request[$i] == $id) {
                unset($request[$i]);
            }
        }
        sort($request);
        if (count($request) >= 1) {
            $request = implode(';', $request);
        } else {
            $request = '';
        }
        $this->db->insert('activity', $activity);

        $this->db->update('friends', ['request' => $request], ['ID' => $myID]);
        return true;
        exit;
    }
    public function NotifyNavbar($id)
    {
        $this->db->select('COUNT(ID) AS ID');
        $messageNavbar = $this->db->get_where('chat', ['id_to' => $id, 'status' => 0])->row_array();
        $this->db->select('COUNT(ID) AS ID');
        $alertNavbar = $this->db->get_where('alerts', ['id_users' => $id, 'id_group' => 0, 'status' => 0])->row_array();
        return [(int)$messageNavbar['ID'], (int)$alertNavbar['ID']];
    }
    public function MessageGroup($myid, $id)
    {
        $this->db->select('ID, id_group, id_users, text, file, date_chat');
        $this->db->order_by('date_chat', 'asc');
        $this->db->limit(100);
        $chat = $this->db->get_where('chatgroup', ['id_group' => $id])->result_array();
        if (empty($chat)) {
            return [];
            exit;
        } else {
            for ($i = 0; $i < count($chat); $i++) {
                $chat[$i]['file'] = ($chat[$i]['text'] == ';-;-;-;-;-;-;') ? 'deleted' : $chat[$i]['file'];
                $chat[$i]['text'] = ($chat[$i]['text'] == ';-;-;-;-;-;-;') ? '' : $chat[$i]['text'];
                $this->db->select('nama, gambar');
                $chat[$i]['profil'] = $this->db->get_where('users', ['ID' => $chat[$i]['id_users']])->row_array();
                $chat[$i]['stats'] = ($myid == $chat[$i]['id_users']) ? 1 : 0;
            }
            return $chat;
            exit;
        }
    }
    public function UrungKirim($myid, $id, $activity)
    {
        if (!empty($this->db->get_where('chatgroup', ['ID' => $id, 'id_users' => $myid]))) {
            $this->db->update('chatgroup', ['text' => ';-;-;-;-;-;-;', 'file' => ''], ['ID' => $id]);
            $this->db->insert('activity', $activity);
            if ($this->db->affected_rows() > 0) {
                return true;
                exit;
            } else {
                return false;
                exit;
            }
        } else {
            return false;
            exit;
        }
    }
    public function sendMessageGroup($data, $activity)
    {
        $this->db->insert('activity', $activity);
        $this->db->insert('chatgroup', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function MessageIDGroup($myid, $id)
    {
        $data = $this->db->get_where('chatgroup', ['ID' => $id])->row_array();
        if (empty($data)) {
            return 0;
            exit;
        } else {
            $this->db->select('friends, blocked');
            $friends = $this->db->get_where('friends', ['ID' => $myid])->row_array();
            $blocked = explode(';', $friends['blocked']);
            $friends = explode(';', $friends['friends']);
            $data['stats'] = ($myid == $data['id_users']) ? 1 : 0;
            $data['relate'] = [(in_array($data['id_users'], $friends)) ? 1 : 0, (in_array($data['id_users'], $blocked)) ? 1 : 0];
            $this->db->select('nama, gambar, username, loginStats');
            $data['profil'] = $this->db->get_where('users', ['ID' => $data['id_users']])->row_array();
            return $data;
            exit;
        }
    }
    public function MessagesNavbar($id)
    {
        $this->db->update('chat', ['status' => 1], ['ID' => $id]);
        $message = $this->db->get_where('chat', ['ID' => $id])->row_array();
        $this->db->select('nama, username, loginStats, gambar');
        $profil = $this->db->get_where('users', ['ID' => $message['id_from']])->row_array();
        $this->db->select('friends');
        $friends = $this->db->get_where('friends', ['ID' => $message['id_to']])->row_array();
        $friends = explode(';', $friends['friends']);
        if (empty($friends['0'])) {
            unset($friends['0']);
            sort($friends);
        }
        $friend = (in_array($message['id_from'], $friends)) ? 1 : 0;
        unset($friends);
        return [$message, $friend, $profil];
    }
    public function Alerts($id)
    {
        $this->db->update('alerts', ['status' => 1], ['ID' => $id]);
        return $this->db->get_where('alerts', ['ID' => $id])->row_array();
    }
    public function AlertsNavbar($id)
    {
        $this->db->select('SUBSTRING(text, 1, 15) AS text, date_created, ID, id_users, id_group, image, status, type, text');
        return $this->db->get_where('alerts', ['id_users' => $id, 'id_group' => 0, 'status' => 0])->result_array();
    }
    public function MessageNavbar($id)
    {
        $this->db->select('ID, id_from, id_to, subject, file, date_send');
        $messageNavbar = $this->db->get_where('chat', ['id_to' => $id, 'status' => 0])->result_array();
        for ($i = 0; $i < count($messageNavbar); $i++) {
            $temp = $this->db->query("SELECT loginStats, ID, nama, gambar, username FROM users WHERE ID = '{$messageNavbar[$i]['id_from']}'")->row_array();
            $messageNavbar[$i]['profil'] = $temp;
        }
        return $messageNavbar;
    }
    public function sendTextMailFastFriends($data, $activity)
    {
        $this->db->insert('activity', $activity);
        $this->db->insert('chat', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function getID($username)
    {
        $this->db->select('ID');
        $data = $this->db->get_where('users', ['username' => $username])->row_array();
        $data = $data['ID'];
        return $data;
    }
    public function FriendHome($id)
    {
        $friends = [];
        $this->db->select('friends, blocked');
        $data = $this->db->get_where('friends', ['ID' => $id])->row_array();
        $friend = explode(';', $data['friends']);
        if (empty($friend['0'])) {
            unset($friend['0']);
            sort($friend);
        }
        $blocked = explode(';', $data['blocked']);
        if (empty($blocked['0'])) {
            unset($blocked['0']);
            sort($blocked);
        }
        if (!empty($friend)) {
            for ($i = 0; $i < count($friend); $i++) {
                $this->db->select('ID, nama, gambar, username');
                $friends[] = $this->db->get_where('users', ['ID' => $friend[$i]])->row_array();
                $friends[$i]['gambar'] = '<img src="' . base_url('assets/img/profil/') . $friends[$i]['gambar'] . '" class="img-responsive img-thumbnail" style="width: 150px;">';
                $friends[$i]['number'] = (in_array($friends[$i]['ID'], $blocked)) ? '<p class="help-block num-friends-home-' . $friends[$i]['ID'] . '" style="color:red">' . ($i + 1) . '</p>' : '<p class="help-block num-friends-home-' . $friends[$i]['ID'] . '" style="color:black">' . ($i + 1) . '</p>';
                $friends[$i]['aksi'] = '<button data-toggle="modal" data-target="#detail-member-friends" class="btn btn-outline-info info_friends_detail" data-id="' . $friends[$i]['ID'] . '" title="Detail"><i class="fas fa-info"></i></button>';
            }
            return $friends;
            exit;
        } else {
            return 0;
            exit;
        }
    }
    public function unBlockedFriends($myID, $id, $activity)
    {
        $this->db->select('blocked');
        $data = $this->db->get_where('friends', ['ID' => $myID])->row_array();
        $data = explode(';', $data['blocked']);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        if (in_array($id, $data)) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i] == $id) {
                    unset($data[$i]);
                }
            }
            sort($data);
            if (count($data) >= 1) {
                $data = implode(';', $data);
            } else {
                $data = '';
            }
            $this->db->insert('activity', $activity);
            $this->db->update('friends', ['blocked' => $data], ['ID' => $myID]);
            if ($this->db->affected_rows() > 0) {
                return true;
                exit;
            } else {
                return false;
                exit;
            }
        } else {
            return 0;
            exit;
        }
    }
    public function FriendsDetail($myID, $id)
    {
        $this->db->select('ID, nama, username, email, gambar');
        $data = $this->db->get_where('users', ['ID' => $id])->row_array();
        if (!empty($data)) {
            $this->db->select('blocked');
            $block = $this->db->get_where('friends', ['ID' => $myID])->row_array();
            $blocked = explode(';', $block['blocked']);
            $data['blockStats'] = (in_array($id, $blocked)) ? 1 : 0;
            return $data;
            exit;
        } else {
            return 0;
            exit;
        }
    }
    public function FriendBlocked($id)
    {
        $blocked = [];
        $data = $this->db->get_where('friends', ['ID' => $id])->row_array();
        $block = explode(';', $data['block']);
        if (empty($block['0'])) {
            unset($block['0']);
            sort($block);
        }
        if (!empty($block)) {
            for ($i = 0; $i < count($block); $i++) {
                $this->db->select('ID, nama, gambar, username');
                $blocked[] = $this->db->get_where('users', ['ID' => $block[$i]])->row_array();
            }
            return $blocked;
            exit;
        } else {
            return 0;
            exit;
        }
    }
    public function CloseGroup($id_group)
    {
        $groups = $this->session->userdata('groups');
        for ($i = 0; $i < count($groups); $i++) {
            if ($groups[$i]['ID'] == $id_group) {
                unset($groups[$i]);
            }
        }
        sort($groups);
        if (empty($groups['0'])) {
            $this->session->unset_userdata('groups');
            return 0;
            exit;
        }
        $this->session->set_userdata('groups', $groups);
        return count($groups);
        exit;
    }
    public function Groups($id, $type)
    {
        if ($type == 'member') {
            $this->db->select('member, admin');
            $data = $this->db->get_where('member_group', ['ID' => $id])->row_array();
            $users = explode(';', $data['member']);
            if (empty($users['0'])) {
                unset($users['0']);
                sort($users);
            }
            for ($i = 0; $i < count($users); $i++) {
                $user[$i] = $this->db->query("SELECT ID, nama, email, username, gambar FROM users WHERE ID = '{$users[$i]}'")->row_array();
                $user[$i]['gambar'] = '<img src="' . base_url('assets/img/profil/') . $user[$i]['gambar'] . '" class="img-responsive shadow-sm img-thumbnail" style=" width: 200px;">';
                $user[$i]['aksi'] = '<button data-toggle="modal" data-target="#detail_member_modal" class="btn btn-outline-info detail_member_groups" data-grup="' . $id . '" data-id="' . $user[$i]['ID'] . '"><i class="fas fa-info"></i></button>';
            }
            return $user;
            exit;
        } else if ($type == 'request') {
            $this->db->select('request');
            $data = $this->db->get_where('member_group', ['ID' => $id])->row_array();
            $users = explode(';', $data['request']);
            if (empty($users['0'])) {
                unset($users['0']);
                sort($users);
            }
            for ($i = 0; $i < count($users); $i++) {
                $user[$i] = $this->db->query("SELECT ID, nama, email, username, gambar FROM users WHERE ID = '{$users[$i]}'")->row_array();
                $user[$i]['gambar'] = '<img src="' . base_url('assets/img/profil/') . $user[$i]['gambar'] . '" class="img-responsive shadow-sm img-thumbnail" style=" width: 200px;">';
                $user[$i]['aksi'] = '<div class="btn-group"><button data-groups="' . $id . '" data-id="' . $user[$i]['ID'] . '" class="btn btn-outline-success acceptRequestGroups" data-name="' . $user[$i]['nama'] . '" title="Terima"><i class="fas fa-user-plus"></i></button><button class="btn btn-outline-danger declineRequestGroups" data-groups="' . $id . '" data-name="' . $user[$i]['nama'] . '" data-id="' . $user[$i]['ID'] . '" title="Tolak"><i class="fas fa-user-times"></i></button></div>';
            }
            return $user;
            exit;
        } else {
            return 0;
            exit;
        }
    }
    public function GroupsMember($ID, $id, $grup)
    {
        $this->db->select('ID, nama, username, email, gambar');
        $profil = $this->db->get_where('users', ['ID' => $id])->row_array();
        $data = ['admin' => 0, 'member' => 0];
        $this->db->select('member, admin');
        $type = $this->db->get_where('member_group', ['ID' => $grup])->row_array();

        $member = explode(';', $type['member']);
        $admin = explode(';', $type['admin']);
        unset($type);

        if (empty($member['0'])) {
            unset($member['0']);
            sort($member);
        }
        if (empty($admin['0'])) {
            unset($admin['0']);
            sort($admin);
        }
        for ($i = 0; $i < count($member); $i++) {
            if ($member[$i] == $id) {
                $data['member'] = 1;
            }
        }
        for ($i = 0; $i < count($admin); $i++) {
            if ($admin[$i] == $id) {
                $data['admin'] = 1;
            }
        }
        unset($member);
        unset($admin);
        $this->db->select('request, friends');
        $myData = $this->db->get_where('friends', ['ID' => $ID])->row_array();
        $friend = explode(';', $myData['friends']);
        $friends = (in_array($id, $friend)) ? 1 : 0;
        unset($friend);
        $request = explode(';', $myData['request']);
        $requested = (in_array($id, $request)) ? 1 : 0;
        unset($request);
        $iData = [$friends, $requested];
        $return = ['profil' => $profil, 'type' => $data, 'data' => $iData];
        return $return;
        die;
    }
    public function RequestFriends($id, $myid, $type)
    {
        if ($type == 'Add') {
            $this->db->select('request');
            $request = $this->db->get_where('friends', ['ID' => $id])->row_array();
            $request = explode(';', $request['request']);
            if (empty($request['0'])) {
                unset($request['0']);
                sort($request);
            }
            if (count($request) >= 1) {
                if (!in_array($myid, $request)) {
                    $request[] = $myid;
                }
                $request = implode(';', $request);
            } else {
                $request = $myid;
            }
            $activity = [
                'id_users' => $myid,
                'tgl_activity' => Date('Y-m-d H-i-s'),
                'kegiatan' => 'Mengirim Permintaan Pertemanan kepada id = ' . $id,
                'keterangan' => ''
            ];
            $this->db->insert('activity', $activity);

            $this->db->query("UPDATE friends SET request = '{$request}' WHERE ID = '{$id}'");
            if ($this->db->affected_rows() > 0) {
                return true;
                exit;
            } else {
                return false;
                exit;
            }
        } else {
            $this->db->select('request');
            $request = $this->db->get_where('friends', ['ID' => $id])->row_array();
            $request = explode(';', $request['request']);
            if (empty($request['0'])) {
                unset($request['0']);
                sort($request);
            }
            for ($i = 0; $i < count($request); $i++) {
                if ($request[$i] == $myid) {
                    unset($request[$i]);
                }
            }
            sort($request);
            if (count($request) >= 1) {
                $request = implode(';', $request);
            } else {
                $request = '';
            }
            $activity = [
                'id_users' => $myid,
                'tgl_activity' => Date('Y-m-d H-i-s'),
                'kegiatan' => 'Membetalkan Permintaan Pertemanan kepada id = ' . $id,
                'keterangan' => ''
            ];
            $this->db->insert('activity', $activity);

            $this->db->query("UPDATE friends SET request = '{$request}' WHERE ID = '{$id}'");
            if ($this->db->affected_rows() > 0) {
                return true;
                exit;
            } else {
                return false;
                exit;
            }
        }
    }
    public function Report($data)
    {
        $this->db->insert('report', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function TaskGroupHome($grup, $id)
    {
        $this->db->order_by('deadline', 'desc');
        $data = $this->db->get_where('task', ['id_group' => $grup, 'status' => 0])->result_array();

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['stats'] = (!empty($this->db->get_where('task_users', ['id_task' => $data[$i]['ID'], 'id_users' => $id])->row_array())) ? '<div class="badge badge-success">Sudah Upload</div>' : '<div class="badge badge-danger">Belum Upload</div>';
            $data[$i]['number'] = $i + 1;
        }
        return $data;
        exit;
    }
    public function Group_Home($id_group, $myid)
    {
        $data = $this->db->query("SELECT * FROM `taskme`.`group` WHERE `taskme`.`group`.ID = '{$id_group}'")->row_array();
        $file = $this->db->query("SELECT * FROM taskme.filegroup WHERE id_group = '{$id_group}'")->row_array();
        $file = explode(';', $file['file']);
        if (empty($file['0'])) {
            unset($file['0']);
            sort($file);
        }
        $file = count($file);
        $task = $this->db->query("SELECT COUNT(ID) AS JML FROM task WHERE id_group = '{$id_group}' AND status = '0' ORDER BY date_created DESC")->row_array();
        $this->db->select('request, member, admin');
        $temp = $this->db->get_where('member_group', ['ID' => $id_group])->row_array();
        $request = explode(';', $temp['request']);
        $member = explode(';', $temp['member']);
        $admin = explode(';', $temp['admin']);
        unset($temp);
        if (empty($member['0'])) {
            unset($member['0']);
            sort($member);
        }
        $member = count($member);
        if (empty($request['0'])) {
            unset($request['0']);
            sort($request);
        }
        $request = count($request);
        $data = ['data' => $data, 'admin' => (in_array($myid, $admin)) ? 1 : 0, 'task' => $task, 'msg' => '', 'request' => $request, 'member' => $member, 'file' => $file];
        return $data;
        exit;
    }
    public function DirFileGroup($id)
    {
        $this->db->select('file_dir');
        return $this->db->get_where('filegroup', ['id_group' => $id])->row_array();
    }
    public function registNewFile($id, $name)
    {
        $data = $this->db->get_where('filegroup', ['id_group' => $id])->row_array();
        $data = explode(';', $data['file']);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        $data[] = $name;
        $data = (count($data) > 1) ? implode(';', $data) : $data;
        $this->db->update('filegroup', ['file' => $data], ['id_group' => $id]);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function GroupRequest($id, $group, $type, $activity)
    {
        $this->db->insert('activity', $activity);

        if ($type == 'Add') {
            $this->db->select('code');
            $code = $this->db->get_where('group', ['ID' => $group])->row_array();

            $data = $this->db->get_where('kelompok', ['ID' => $id])->row_array();
            $data = explode(';', $data['kelompok']);
            if (empty($data['0'])) {
                unset($data['0']);
                sort($data);
            }
            $data[] = $code['code'];
            if (count($data) > 1) {
                $iData = implode(';', $data);
            } else {
                $iData = $code['code'];
            }
            $this->db->query("UPDATE kelompok SET kelompok = '{$iData}' WHERE ID = '{$id}'");

            $this->db->select('request');
            $request = $this->db->get_where('member_group', ['ID' => $group])->row_array();
            $temp = explode(';', $request['request']);
            if (empty($temp['0'])) {
                unset($temp['0']);
                sort($temp);
            }
            $temp[] = $id;
            if (count($temp) > 1) {
                $request = implode(';', $temp);
            } else {
                $request = $id;
            }
            $this->db->query("UPDATE member_group SET request = '{$request}' WHERE ID = '{$group}'");
            return $this->db->get_where('group', ['ID' => $group])->row_array();
            exit;
        }
        if ($type == 'Remove') {
            $this->db->select('code');
            $code = $this->db->get_where('group', ['ID' => $group])->row_array();

            $data = $this->db->get_where('kelompok', ['ID' => $id])->row_array();
            $data = explode(';', $data['kelompok']);
            if (empty($data['0'])) {
                unset($data['0']);
                sort($data);
            }
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i] == $code['code']) {
                    unset($data[$i]);
                }
            }
            sort($data);

            if (count($data) > 0) {
                $iData = implode(';', $data);
            } else {
                $iData = '';
            }
            $this->db->query("UPDATE kelompok SET kelompok = '{$iData}' WHERE ID = '{$id}'");

            $this->db->select('request');
            $request = $this->db->get_where('member_group', ['ID' => $group])->row_array();
            $request = explode(';', $request['request']);
            if (empty($request['0'])) {
                unset($request['0']);
                sort($request);
            }
            for ($i = 0; $i < count($request); $i++) {
                if ($request[$i] == $id) {
                    unset($request[$i]);
                }
            }
            sort($request);
            if (count($request) > 0) {
                $request = implode(';', $request);
            } else {
                $request = '';
            }
            $this->db->query("UPDATE member_group SET request = '{$request}' WHERE ID = '{$id}'");
            return true;
            exit;
        }
    }
    public function checkFileName($id, $name)
    {
        $data = $this->db->get_where('filegroup', ['id_group' => $id])->row_array();
        $data = explode(';', $data['file']);
        if (in_array($name, $data)) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function _file($id, $type)
    {
        $data = $this->db->get_where('filegroup', ['id_group' => $id])->row_array();
        $dir = $data['file_dir'];
        $id = $data['id_group'];
        $file = explode(';', $data['file']);
        if (empty($file['0'])) {
            unset($file['0']);
            sort($file);
        }
        asort($file);
        unset($data);
        if (count($file) > 0) {
            if ($type == 0) {
                $data = [];
                for ($i = 0; $i < count($file); $i++) {
                    $size = filesize($_SERVER['DOCUMENT_ROOT'] . '/TaskMe/assets/files/group/' . $dir . '/' . $file[$i]);
                    $size = (strlen($size) > 3 && strlen($size) <= 6) ? $size = (ceil($size / 1024)) . ' KB' : $size . 'B';
                    $data[$i] = ['name' => $file[$i], 'size' => $size, 'download' => '<a style="border-radius: 20px;" class="btn btn-outline-success btn-sm" href="' . base_url('assets/files/group/' . $dir . '/' . $file[$i]) . '" target="_blank" title="Unduh File"><i class="fas fa-download"></i> Unduh</a>'];
                }
                return $data;
            } else if ($type == 1) {
                $data = [];
                for ($i = 0; $i < count($file); $i++) {
                    $size = filesize($_SERVER['DOCUMENT_ROOT'] . '/TaskMe/assets/files/group/' . $dir . '/' . $file[$i]);
                    $size = (strlen($size) > 3 && strlen($size) <= 6) ? $size = (ceil($size / 1024)) . ' KB' : $size . 'B';
                    $data[$i] = ['name' => $file[$i], 'size' => $size, 'download' => '<a style="border-radius: 20px;" class="btn btn-outline-success btn-sm" href="' . base_url('assets/files/group/' . $dir . '/' . $file[$i]) . '" target="_blank" title="Unduh File"><i class="fas fa-download"></i> Unduh</a>', 'delete' => '<button data-id="' . $id . '" data-name="' . $file[$i] . '" style="border-radius: 20px;" class="btn btn-sm btn-outline-danger deleteFileGroup" data-file="' . $file[$i] . '" ><i class="fas fa-eraser"></i> Hapus</button>'];
                }
                return $data;
            } else {
                redirect(base_url());
                exit;
            }
        } else {
            return 0;
        }
    }
    public function deleteFileGroup($id, $file)
    {
        $data = $this->db->get_where('filegroup', ['id_group' => $id])->row_array();
        $dir = $data['file_dir'];
        $data = explode(';', $data['file']);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        if (in_array($file, $data)) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i] == $file) {
                    unset($data[$i]);
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/TaskMe/assets/files/group/' . $dir . '/' . $file);
                }
            }
            sort($data);
            if (count($data) > 1) {
                $data = implode(';', $data);
            } else if (count($data) == 1) {
                $data = $data;
            } else {
                $data = '';
            }
            $this->db->update('filegroup', ['file' => $data], ['id_group' => $id]);
            if ($this->db->affected_rows() > 0) {
                return true;
                exit;
            } else {
                return false;
                exit;
            }
        } else {
            return false;
            exit;
        }
    }
    public function set_image_name_profil($user, $name, $activity)
    {
        $this->db->select('gambar');
        $img_old = $this->db->get_where('users', "Username = '{$user}'")->row_array();
        if ($img_old['gambar'] != 'nophoto.png') {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/TaskMe/assets/img/profil/' . $img_old['gambar']);
        }
        $this->db->insert('activity', $activity);
        $this->db->query("UPDATE users SET gambar = '{$name}' WHERE username = '{$user}'");
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function my_profil($data, $id, $activity)
    {
        $this->db->insert('activity', $activity);

        $this->db->set('nama', $data['name']);
        $this->db->set('username', $data['username']);
        $this->db->set('email', $data['email']);
        $this->db->where('ID', $id);
        $this->db->update('users');

        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function Group($id)
    {
        $iData = [];
        $this->db->select('kelompok');
        $data = $this->db->get_where('kelompok', ['ID' => $id])->row_array();
        $data = explode(';', $data['kelompok']);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        if (empty($data['0'])) {
            return 0;
        }
        for ($i = 0; $i < count($data); $i++) {
            $groups = $this->db->get_where('group', ['code' => $data[$i]])->row_array();
            $check = $this->db->get_where('member_group', ['ID' => $groups['ID']])->row_array();

            $request = explode(';', $check['request']);
            $member = explode(';', $check['member']);
            $admin = explode(';', $check['admin']);
            $kick = explode(';', $check['kick']);
            $block = explode(';', $check['block']);
            if (in_array($id, $request)) {
                $iData['type'] = 'request';
            }
            if (in_array($id, $member)) {
                $iData['type'] = 'member';
            }
            if (in_array($id, $admin)) {
                $iData['type'] = 'admin';
            }
            if (in_array($id, $kick)) {
                $iData['type'] = 'kick';
            }
            if (in_array($id, $block)) {
                $iData['type'] = 'block';
            }
            $Groups[$i] = array_merge($groups, $iData);
        }
        return $Groups;
        exit;
    }
    public function GroupOut($id, $id_group, $type, $activity)
    {
        $this->db->select('code');
        $code = $this->db->get_where('group', ['ID' => $id_group])->row_array();

        $this->db->select($type);
        $data = $this->db->get_where('member_group', ['ID' => $id_group])->row_array();
        $data = explode(';', $data[$type]);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i] == $id) {
                unset($data[$i]);
            }
        }
        sort($data);
        $data = (count($data > 0)) ? implode(';', $data) : $data = '';
        $this->db->query("UPDATE member_group SET {$type} = '{$data}' WHERE ID = '{$id_group}'");

        $this->db->select('kelompok');
        $kelompok = $this->db->get_where('kelompok', ['ID' => $id])->row_array();
        $kelompok = explode(';', $kelompok['kelompok']);
        if (empty($kelompok['0'])) {
            unset($kelompok['0']);
            sort($kelompok);
        }
        for ($i = 0; $i < count($kelompok); $i++) {
            if ($kelompok[$i] == $code) {
                unset($kelompok[$i]);
            }
        }
        sort($kelompok);
        $kelompok = (count($kelompok > 0)) ? implode(';', $kelompok) : $kelompok = '';
        $this->db->query("UPDATE kelompok SET kelompok = '{$data}' WHERE ID = '{$id}'");
        $this->db->insert('activity', $activity);

        return true;
        exit;
    }
    public function CekGroup($id, $code)
    {
        $Group = $this->db->get_where('group', ['code' => $code])->row_array();

        $this->db->select('member, request, kick, block');
        $data = $this->db->get_where('member_group', ['ID' => $Group['ID']])->row_array();

        $request = explode(';', $data['request']);
        $request = in_array($id, $request);

        $member = explode(';', $data['member']);
        $member = in_array($id, $member);

        $kick = explode(';', $data['kick']);
        $kick = in_array($id, $kick);

        $block = explode(';', $data['block']);
        $block = in_array($id, $block);
        $return = '';
        if (!$request && !$member && !$kick && !$block) {
            $return = 'Ready';
        } else if ($request) {
            $return = 'Request';
        } else if ($member) {
            $return = 'Member';
        } else if ($kick) {
            $return = 'Kick';
        } else if ($block) {
            $return = 'Block';
        }

        $myData = ['Group' => $Group, 'Tipe' => $return];
        if (empty($Group)) {
            return 'Not Found';
            exit;
        } else {
            return $myData;
            exit;
        }
    }
    public function PC($myid)
    {
        $this->db->select('friends');
        $friends = $this->db->get_where('friends', ['ID' => $myid])->row_array();
        $friends = explode(';', $friends['friends']);
        if (empty($friends['0'])) {
            unset($friends['0']);
            sort($friends);
        }
        if (count($friends) > 0) {
            for ($i = 0; $i < count($friends); $i++) {
                $this->db->select('nama, username, ID, gambar, loginStats');
                $friend[$i] = $this->db->get_where('users', ['ID' => $friends[$i]])->row_array();
                $friend[$i]['last'] = $this->db->query("SELECT ID, id_from, id_to, SUBSTRING(chat.text, 1, 50) AS text, chat.date_send FROM chat WHERE id_from = '{$myid}' OR id_to = '{$myid}' ORDER BY date_send DESC LIMIT 1")->row_array();
            }
            unset($friends);
            return $friend;
        } else {
            return;
            exit;
        }
        exit;
    }
    public function _sendPCMessage($data, $activity)
    {
        $this->db->insert('chat', $data);
        $this->db->insert('activity', $activity);
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function PCMessage($myid, $id)
    {
        $this->db->update('chat', ['status' => 1], ['id_from' => $id, 'id_to' => $myid]);
        $data = $this->db->query("SELECT * FROM chat WHERE (id_from = '{$myid}' AND id_to = '{$id}') OR (id_from = '{$id}' AND id_to = '{$myid}')  ORDER BY date_send ASC ")->result_array();
        return $data;
        exit;
    }
    public function uniqCode($hash)
    {
        $this->db->select('code');
        $data = $this->db->get('group')->result_array();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['code'] == $hash) {
                return false;
                exit;
            }
        }
        return true;
        exit;
    }
    public function CreateGroup($data, $activity)
    {
        $this->db->insert('activity', $activity);
        $this->db->insert('group', $data);
        $grup = $this->db->get_where('group', ['code' => $data['code']])->row_array();
        $this->db->select('ID');
        $ID = $this->db->get_where('users', ['username' => $data['admin']])->row_array();
        unset($data);
        $member = [
            'ID' => $grup['ID'],
            'request' => '',
            'member' => $ID['ID'],
            'admin' => $ID['ID'],
            'kick' => '',
            'block' => ''
        ];
        $this->db->insert('member_group', $member);
        unset($member);
        $file_dir = $grup['ID'] . time();
        mkdir($_SERVER['DOCUMENT_ROOT'] . '/TaskMe/assets/files/group/' . $file_dir);
        $file = ['id_group' => $grup['ID'], 'file' => '', 'file_dir' => $file_dir];
        $this->db->insert('filegroup', $file);
        unset($file);
        unset($file_dir);
        $this->db->select('kelompok');
        $data = $this->db->get_where('kelompok', ['ID' => $ID['ID']])->row_array();
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        $data[] = $grup['code'];
        if (count($data) >= 1) {
            $data = implode(';', $data);
        } else {
            $data = $grup['code'];
        }
        $this->db->update('kelompok', ['kelompok' => $data], ['ID' => $ID['ID']]);
        return $grup;
    }
    public function Search($id, $q)
    {
        $people = $this->db->query("SELECT ID, gambar, nama, email, username FROM users WHERE nama LIKE '%{$q}%' OR email LIKE '%{$q}%' OR username LIKE '%{$q}%' ORDER BY nama ASC ")->result_array();
        for ($i = 0; $i < count($people); $i++) {
            $people[$i]['gambar'] = '<img src="' . base_url('assets/img/profil/') . $people[$i]['gambar'] . '" class="img-responsive img-thumbnail shadow" style="width: 200px;">';
            $temp = $this->db->get_where('friends', ['ID' => $id])->row_array();
            $friend = explode(';', $temp['friends']);
            $temp2 = $this->db->get_where('friends', ['ID' => $people[$i]['ID']])->row_array();
            $request = explode(';', $temp2['request']);
            $re = '<button class="btn shadow btn-outline-success send-request-friends" data-id="' . $people[$i]['ID'] . '" title="Kirim Permintaan Pertemanan"><i class="fas fa-user-plus"></i></button>';
            if ($id == $people[$i]['ID']) {
                $re = '<div class="badge text-center badge-success"><i class="fas fa-user"></i> Anda</div>';
            }
            if (in_array($people[$i]['ID'], $friend)) {
                $re = '<div class="badge badge-primary"><i class="fas fa-user"></i> Teman</div>';
            }
            if (in_array($id, $request)) {
                $re = '<button class="btn shadow btn-outline-info send-notreq-friends" data-id="' . $people[$i]['ID'] . '" title="Batalkan Permintaan Pertemanan"><i class="fas fa-user-times"></i></button>';
            }
            $people[$i]['aksi'] = $re;
        }
        $group = $this->db->query("SELECT ID, nama, code, gambar, group.description FROM taskme.group WHERE nama LIKE '%{$q}%' OR code LIKE '%{$q}%' OR `description` LIKE '%{$q}%'")->result_array();
        for ($i = 0; $i < count($group); $i++) {
            $group[$i]['gambar'] = '<img src="' . base_url('assets/img/group/') . $group[$i]['gambar'] . '" class="img-responsive img-thumbnail shadow" style="width: 200px;">';
        }
        $task = $this->db->query("SELECT task.deadline, task.subject, taskme.group.nama FROM taskme.task JOIN taskme.group ON taskme.group.ID = task.id_group WHERE task.subject LIKE '%{$q}%' OR task.messages LIKE '%{$q}%' OR task.detail LIKE '%{$q}%'")->result_array();
        return [(!empty($people)) ? $people : 0, (!empty($group)) ? $group : 0, (!empty($task)) ? $task : 0];
    }
    public function count_group($id)
    {
        $this->db->select('kelompok');
        $data = $this->db->get_where('kelompok', ['ID' => $id])->row_array();
        $data = explode(';', $data['kelompok']);
        if (empty($data)) {
            return 0;
            exit;
        } else {
            return count($data);
            exit;
        }
    }
    public function GroupSession($code)
    {
        $this->db->select('ID, nama, admin, gambar');
        return $this->db->get_where('group', ['code' => $code])->row_array();
    }
    public function count_friends($id)
    {
        $this->db->select('friends');
        $data = $this->db->get_where('friends', ['ID' => $id])->row_array();
        $data = explode(';', $data['friends']);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        return count($data);
        exit;
    }
    public function count_task($id)
    {
        $this->db->select('kelompok');
        $data = $this->db->get_where('kelompok', ['ID' => $id])->row_array();

        $data = explode(';', $data['kelompok']);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        if (count($data) < 1) {
            return 0;
            exit;
        }
        for ($i = 0; $i < count($data); $i++) {
            $id_group[$i] = $this->db->query("SELECT ID From `taskme`.`group` where code = '{$data[$i]}'")->row_array();
        }

        if (count($data) > 0) {
            for ($i = 0; $i < count($id_group); $i++) {
                $task[$i] = $this->db->query("SELECT COUNT(ID) FROM task Where id_group = '{$id_group[$i]['ID']}' AND status = '1'")->result_array();
            }
            if (count($task) >= 1) {
                return count($task);
                exit;
            } else {
                return 0;
                exit;
            }
        } else {
            return 0;
            exit;
        }
    }
    public function BlockFriends($id, $myid, $activity)
    {
        $this->db->select('blocked');
        $data = $this->db->get_where('friends', ['ID' => $myid])->row_array();
        $data = explode(';', $data['blocked']);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        $data[] = $id;
        if (count($data) > 1) {
            $data = implode(';', $data);
        } else {
            $data = $id;
        }
        $this->db->insert('activity', $activity);
        $this->db->update('friends', ['blocked' => $data], ['ID' => $myid]);
        $this->db->query("DELETE FROM chat WHERE (id_from = '{$id}' AND id_to = '{$myid}') OR (id_from = '{$myid}' AND id_to = '{$id}')");
        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function unfriends($id, $myid, $activity)
    {
        $this->db->select('friends');
        $data = $this->db->get_where('friends', ['ID' => $myid])->row_array();
        $data = explode(';', $data['friends']);
        if (empty($data['0'])) {
            unset($data['0']);
            sort($data);
        }
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i] == $id) {
                unset($data[$i]);
            }
        }
        sort($data);
        if (count($data) >= 1) {
            $data = implode(';', $data);
        } else {
            $data = '';
        }

        $this->db->select('friends');
        $myData = $this->db->get_where('friends', ['ID' => $id])->row_array();
        $myData = explode(';', $myData['friends']);
        if (empty($myData['0'])) {
            unset($myData['0']);
            sort($myData);
        }
        for ($i = 0; $i < count($myData); $i++) {
            if ($myData[$i] == $myid) {
                unset($myData[$i]);
            }
        }
        sort($myData);
        if (count($myData) >= 1) {
            $myData = implode(';', $myData);
        } else {
            $myData = '';
        }
        $this->db->insert('activity', $activity);
        $this->db->update('friends', ['friends' => $data], ['ID' => $myid]);
        $this->db->update('friends', ['friends' => $myData], ['ID' => $id]);
        $this->db->query("DELETE FROM chat WHERE (id_from = '{$id}' AND id_to = '{$myid}') OR (id_from = '{$myid}' AND id_to = '{$id}')");

        if ($this->db->affected_rows() > 0) {
            return true;
            exit;
        } else {
            return false;
            exit;
        }
    }
    public function Activity($id, $id_data = null)
    {
        if ($id_data == null) {
            return $this->db->query("SELECT SUBSTRING(kegiatan, 1, 15) AS kegiatan, ID, tgl_activity FROM activity WHERE id_users = '{$id}' ORDER BY tgl_activity DESC")->result_array();
        } else {
            return $this->db->get_where('activity', ['ID' => $id_data])->row_array();
        }
    }
}