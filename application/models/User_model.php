<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_users($slug = FALSE, $limit = FALSE, $offset = FALSE)
    {

        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('first_name', 'AESC');
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function get_reports($slug = FALSE, $limit = FALSE, $offset = FALSE)
    {

        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('created_at', 'DESC');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('problem_reports', 'user_id = user.id');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_user($id)
    {
        $this->db->where('id', $id);
        $q = $this->db->get('user');
        $data = $q->result_array();

        return $data;
    }

    public function get_all_users_roles()
    {
        $this->db->select('*');
        $this->db->from('user_has_role');
        $this->db->join('user', 'user_has_role.user_id = user.id');
        $this->db->join('role', 'user_has_role.role_id = role.id');

        $query = $this->db->get();
        $data = $query->result_array();

        return $data;
    }

    public function get_user_roles($userId)
    {
        $this->db->select('*');
        $this->db->from('user_has_role');
        $this->db->join('user', 'user_has_role.user_id = user.id');
        $this->db->join('role', 'user_has_role.role_id = role.id');

        $this->db->where('user.id', $userId);
        $query = $this->db->get();
        $data = $query->result_array();

        return $data;
    }

    public function register($enc_password)
    {

        $data = array(
            'name' => $this->input->post('name'),
            'email_address' => $this->input->post('email_address'),
            'username' => $this->input->post('username'),
            'password' => $enc_password,
        );
        return $this->db->insert('user', $data);
    }

    public function update_user($enc_password)
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email_address' => $this->input->post('email_address'),
            'username' => $this->input->post('username'),
            'password' => $enc_password,
            'zipcode' => $this->input->post('zipcode')
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('user', $data);
    }

    public function login($username, $password)
    {

        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $result = $this->db->get('user');

        if ($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    public function check_username_exists($username)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($email)
    {
        $query = $this->db->get_where('user', array('email_address' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user_by_name($name)
    {

        $this->db->where('first_name', $name);
        $q = $this->db->get('user');
        $data = $q->result_array();

        return $data;
    }

    public function delete_user($userId)
    {

        $this->db->where('user_id', $userId);
        $this->db->delete('user_has_role');

        $this->db->where('user.id', $userId);
        $this->db->delete('user');

        return true;
    }


    public function add_user_role($id)
    {
        $data = array(
            'user_id' => $id,
            'role_id' => $this->input->post('role_id')
        );

        $this->db->where('id', $id);
        $q = $this->db->get('user');
        $temp = $q->result_array();
        $user = $temp[0];
        $user['role_status'] = 'Assigned';
        $this->db->where('id', $id);
        $this->db->update('user', $user);
        return $this->db->insert('user_has_role', $data);
    }

    public function user_role_check($userId, $roleId)
    {

        $this->db->where('user_id', $userId);
        $this->db->where('role_id', $roleId);

        $result = $this->db->get('user_has_role');

        if ($result->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function delete_user_role($userId, $roleId)
    {

        $this->db->where('user_id', $userId);
        $this->db->where('role_id', $roleId);
        $this->db->delete('user_has_role');

        $this->db->where('user_id', $userId);
        $result = $this->db->get('user_has_role');

        if ($result->num_rows() == 0) {
            $this->db->where('id', $userId);
            $q = $this->db->get('user');
            $temp = $q->result_array();
            $user = $temp[0];
            $user['role_status'] = 'Not Assigned';
            $this->db->where('id', $userId);

            return $this->db->update('user', $user);
        }

        return true;
    }

    public function add_report()
    {
        $username = $this->input->post('user_id');
        $this->db->where('username', $username);
        $q = $this->db->get('user');
        $data = $q->result_array();

        $data = array(
            'description' => $this->input->post('description'),
            'user_id' => $data[0]['id']
        );
        return $this->db->insert('problem_reports', $data);
    }

    public function get_report($id)
    {

        $this->db->where('id', $id);
        $result = $this->db->get('problem_reports');

        return $result->result_array();
    }

    public function update_report()
    {
        $data = array(
            'description' => $this->input->post('description'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('problem_reports', $data);
    }

    public function delete_report($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('problem_reports');
        return true;
    }


    //....................................................//
    /////////////// Roles' Operations ////////////////////// 
    //....................................................//

    public function get_roles($slug = FALSE)
    {
        $query = $this->db->get('role');
        return $query->result_array();
    }

    public function get_role($id)
    {

        $this->db->where('id', $id);
        $q = $this->db->get('role');
        $data = $q->result_array();

        return $data;
    }

    public function add_role()
    {

        $data = array(
            'role' => $this->input->post('role_name')
        );
        return $this->db->insert('role', $data);
    }

    public function delete_role($roleId)
    {

        $this->db->where('id', $roleId);
        $this->db->delete('role');
        return true;
    }

    public function update_role()
    {
        $data = array(
            'role' => $this->input->post('role_name'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('role', $data);
    }

    public function check_role_exists($role)
    {
        $query = $this->db->get_where('role', array('role' => $role));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }
}
