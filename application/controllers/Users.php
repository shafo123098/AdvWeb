<?php
class Users extends CI_Controller
{


    public function getUsers($offset = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $config['base_url'] = base_url() . 'users/getUsers/';
        $config['total_rows'] = $this->db->count_all('user');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['title'] = 'Manage';
        $data['users'] = $this->user_model->get_users(FALSE, $config['per_page'], $offset);
        $data['roles'] = $this->user_model->get_roles();
        $data['userRoles'] = $this->user_model->get_all_users_roles();


        $this->load->view('templates/header');
        $this->load->view('users/usersList', $data);
        $this->load->view('templates/footer');
    }

    public function register()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['title'] = 'Register New User';

        $this->form_validation->set_rules('name', 'Name', 'required|alpha');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email_address', 'Email_address', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer');
        } else {
            // $enc_password = md5($this->input->post('password'));
            $enc_password = $this->input->post('password');

            $this->user_model->register($enc_password);

            $this->session->set_flashdata('user_registered', 'New User is Registered');
            redirect('/');
        }
    }


    public function getReportProblems($offset = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper' || $role['role'] == 'Deputy Director') {
                redirect(base_url());
            }
        }

        $config['base_url'] = base_url() . 'users/getReportProblems/';
        $config['total_rows'] = $this->db->count_all('problem_reports');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['title'] = 'Manage';
        $data['reports'] = $this->user_model->get_reports(FALSE, $config['per_page'], $offset);
        //print_r($data['reports']);

        $this->load->view('templates/header');
        $this->load->view('users/reportsList', $data);
        $this->load->view('templates/footer');
    }


    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect(base_url());
        }

        $data['title'] = 'Login';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {

            $username = $this->input->post('username');
            //$password = md5($this->input->post('password'));
            $password = $this->input->post('password');

            $user_id = $this->user_model->login($username, $password);
            //$userRoles = $this->user_model->get_user_roles($user_id);
            //$getRoles = $this->user_model->get_roles();
            if ($user_id) {
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true,
                    //'roles' => $userRoles,
                    //'allRoles' => $getRoles
                );
                //print_r($userRoles);

                //if ($userRoles == NULL) {
                //    $this->session->set_flashdata('user_role_not_assign', 'No Role is assigned to you yet!');
                //    redirect('users/login');
                //}
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_login', 'You are successfully Logged in');
                redirect('/');
            } else {
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('users/login');
            }
        }
    }

    public function logout()
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->session->set_userdata('logged_in');
        $this->session->set_userdata('user_id');
        $this->session->set_userdata('username');

        $this->session->set_flashdata('user_logout', 'You are now logged out!');
        redirect('login');
    }


    public function check_username_exists($username)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $this->form_validation->set_message(
            'check_username_exists',
            'That username is already taken. Please choose different one'
        );
        if ($this->user_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($email)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $this->form_validation->set_message(
            'check_email_exists',
            'That Email Address is already taken. Please choose different one'
        );
        if ($this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function viewUser($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['user'] = $this->user_model->get_user($id);
        $data['roles'] = $this->user_model->get_user_roles($data['user'][0]['id']);


        if (empty($data['user'])) {
            show_404();
        }

        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('users/viewUser', $data);
        $this->load->view('templates/footer');
    }

    public function editUser($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['user'] = $this->user_model->get_user($id);
        $data['roles'] = $this->user_model->get_roles();

        if (empty($data['user'])) {
            show_404();
        }

        $data['title'] = 'Edit User';

        $this->load->view('templates/header');
        $this->load->view('users/editUser', $data);
        $this->load->view('templates/footer');
    }

    public function editLoggedInUser($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['user'] = $this->user_model->get_user($id);
        $data['roles'] = $this->user_model->get_roles();

        if (empty($data['user'])) {
            show_404();
        }

        $data['title'] = 'Edit User';

        $this->load->view('templates/header');
        $this->load->view('users/editLoggedInUser', $data);
        $this->load->view('templates/footer');
    }

    public function updateUser()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $enc_password = md5($this->input->post('password'));
        $this->user_model->update_user($enc_password);
        redirect('/');
    }

    public function updateLoggedInUser()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $loggedInUserId = $this->input->post('id');
        $user = $this->user_model->get_user($loggedInUserId);
        if ($user[0]['password'] != md5($this->input->post('old_password'))) {

            $data['user'] = $this->user_model->get_user($loggedInUserId);
            $this->session->set_flashdata('old_password_not_correct', 'Your old Password is not correct!');
            redirect('users/editLoggedInUser/' . $loggedInUserId);
        }

        $enc_password = md5($this->input->post('password'));
        $this->user_model->update_user($enc_password);
        $this->session->set_flashdata('logged_in_user_updated', 'Your Account has been Updated!');

        redirect('/');
    }

    public function getUserByName()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $userName = $this->input->post('searchUser');

        $data['users'] = $this->user_model->get_user_by_name($userName);

        if (empty($data['users'])) {
            show_404();
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('users/usersList', $data);
        $this->load->view('templates/footer');
    }

    public function deleteUser($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->user_model->delete_user($id);
        redirect('users');
    }

    public function deleteReport($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->user_model->delete_report($id);
        redirect('users/getReportProblems');
    }

    public function openUserRoleForm($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['user'] = $this->user_model->get_user($id);
        $data['roles'] = $this->user_model->get_roles();

        if (empty($data['user'])) {
            show_404();
        }

        $data['title'] = 'Edit User';

        $this->load->view('templates/header');
        $this->load->view('users/editUser', $data);
        $this->load->view('templates/footer');
    }

    public function addUserRole($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['user'] = $this->user_model->get_user($id);
        $data['roles'] = $this->user_model->get_roles();
        $data['title'] = 'Add Role to User';

        $this->form_validation->set_rules('role_id', 'Role_Id', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/assignUserRole', $data);
            $this->load->view('templates/footer');
        } else {

            //$userId = $this->input->post('user_id');
            $roleId = $this->input->post('role_id');

            $userRole = $this->user_model->user_role_check($id, $roleId);

            if (!$userRole) {
                $this->user_model->add_user_role($id);
                redirect('users/getUsers');
            } else {
                $this->session->set_flashdata('userRoleAssign_failed', ' This Role is already assigned to the user!');
                redirect('users/getUsers');
            }
        }
    }

    public function deleteUserRole()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $roleId = $this->input->post('role_id');
        $userId = $this->input->post('user_id');

        $this->user_model->delete_user_role($userId, $roleId);
        redirect('users/getUsers');
    }

    public function addReport()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }


        $data['title'] = 'Add New Report';

        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/addReport', $data);
            $this->load->view('templates/footer');
        } else {

            $this->user_model->add_report();

            $this->session->set_flashdata('report_registered', 'Report Registered');
            redirect('users/getReportProblems');
        }
    }

    public function editReport($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['report'] = $this->user_model->get_report($id);

        if (empty($data['report'])) {
            show_404();
        }
        //print_r($data['report']);
        $data['title'] = 'Edit Report';

        $this->load->view('templates/header');
        $this->load->view('users/editReport', $data);
        $this->load->view('templates/footer');
    }

    public function updateReport()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->user_model->update_report();
        redirect('users/getReportProblems');
    }


    //....................................................//
    /////////////// Roles' Operations ////////////////////// 
    //....................................................//


    public function getRoles()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['title'] = 'Manage';

        $data['roles'] = $this->user_model->get_roles();

        $this->load->view('templates/header');
        $this->load->view('users/rolesList', $data);
        $this->load->view('templates/footer');
    }

    public function addRole()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['title'] = 'Add New Role';

        $this->form_validation->set_rules('role_name', 'Role_Name', 'required|callback_check_role_exists');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/addRole', $data);
            $this->load->view('templates/footer');
        } else {

            $this->user_model->add_role();

            $this->session->set_flashdata('role_added', 'New Role is added!');
            redirect('users/getRoles');
        }
    }

    public function deleteRole($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->user_model->delete_role($id);
        redirect('users/getRoles');
    }


    public function editRole($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['role'] = $this->user_model->get_role($id);

        if (empty($data['role'])) {
            show_404();
        }

        $data['title'] = 'Edit Role';

        $this->load->view('templates/header');
        $this->load->view('users/editRole', $data);
        $this->load->view('templates/footer');
    }

    public function updateRole()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->user_model->update_role();
        redirect('users/getRoles');
    }

    public function check_role_exists($role)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $this->form_validation->set_message(
            'check_role_exists',
            'That role is already present'
        );
        if ($this->user_model->check_role_exists($role)) {
            return true;
        } else {
            return false;
        }
    }
}
