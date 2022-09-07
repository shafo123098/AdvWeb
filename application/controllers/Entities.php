<?php
//php -S 127.0.0.1:8080    


class Entities extends CI_Controller
{

    //....................................................//
    /////////////// Students' Operations ///////////////////
    //....................................................//

    public function index($offset = 0)
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $config['base_url'] = base_url() . 'entities/index/';
        $config['total_rows'] = $this->db->count_all('student');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['title'] = 'Manage';
        $data['students'] = $this->entity_model->get_students(FALSE, $config['per_page'], $offset);

        $this->load->view('templates/header');
        $this->load->view('entities/index', $data);
        $this->load->view('templates/footer');
    }


    public function viewStudent($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['student'] = $this->entity_model->get_student($id);
        $route = $data['student'][0]['route_id'];
        $data['route'] = $this->entity_model->get_route($route);

        if (empty($data['student'])) {
            show_404();
        }

        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/viewStudent', $data);
        $this->load->view('templates/footer');
    }

    public function getStudentByRollNo()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $studentRollNo = $this->input->post('searchStudent');

        $data['students'] = $this->entity_model->get_student_by_name($studentRollNo);

        if (empty($data['students'])) {
            $this->session->set_flashdata('student_not_found', 'This Student with that roll number does not exist!');
            redirect('entities/index');
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/index', $data);
        $this->load->view('templates/footer');
    }

    public function addStudent()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['routes'] = $this->entity_model->get_routes();
        //print_r($data['routes']);

        $data['title'] = 'Add Student';

        $this->form_validation->set_rules('first_name', 'First_Name', 'required|alpha');
        $this->form_validation->set_rules('last_name', 'Last_Name', 'required|alpha');
        $this->form_validation->set_rules('age', 'Age', 'required');
        $this->form_validation->set_rules('email_address', 'Email_address', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('roll_no', 'Roll_no', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('entities/addNewStudent', $data);
            $this->load->view('templates/footer');
        } else {

            $stdId = $this->input->post('roll_no');

            $std = $this->entity_model->check_student_exist($stdId);

            if (!$std) {
                $this->entity_model->add_student();
                redirect('entity');
            } else {
                $this->session->set_flashdata('student_exist', 'This Student with that roll number already exists!');
                redirect('entities/index');
            }
        }
    }

    public function deleteStudent($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->delete_student($id);
        redirect('entity');
    }

    public function editStudent($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['student'] = $this->entity_model->get_student($id);
        $route = $this->entity_model->get_route($data['student'][0]['route_id']);
        $data['route'] = $route;
        $data['routes'] = $this->entity_model->get_routes();
        if (empty($data['student'])) {
            show_404();
        }

        $data['title'] = 'Edit Student';

        $this->load->view('templates/header');
        $this->load->view('entities/editStudent', $data);
        $this->load->view('templates/footer');
    }

    public function updateStudent()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $stdId = $this->input->post('roll_no');

        $std = $this->entity_model->check_student_exist($stdId);

        //if (!$std) {
            $this->entity_model->update_student();
            //redirect('entity');
        //} else {
            //$this->session->set_flashdata('student_exist', 'This Student with that roll number already exists!');
            redirect('entities/index');
        
    }

    //....................................................//
    /////////////// Buses' Operations ////////////////////// 
    //....................................................//

    public function showBuses($offset = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        // foreach ($this->session->userdata('roles') as $role) {
        //     if ($role['role'] == 'Gate Keeper') {
        //         redirect(base_url());
        //     }
        // }

        $config['base_url'] = base_url() . 'entities/showBuses/';
        $config['total_rows'] = $this->db->count_all('bus');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['title'] = 'Manage';
        $data['buses'] = $this->entity_model->get_buses(FALSE, $config['per_page'], $offset);
        $this->load->view('templates/header');
        $this->load->view('entities/busesList', $data);
        $this->load->view('templates/footer');
    }

    public function viewBus($id)
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        // foreach ($this->session->userdata('roles') as $role) {
        //     if ($role['role'] == 'Gate Keeper') {
        //         redirect(base_url());
        //     }
        // }

        $data['bus'] = $this->entity_model->get_bus($id);

        if (empty($data['bus'])) {
            show_404();
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/viewBus', $data);
        $this->load->view('templates/footer');
    }

    public function getDriverByBus($busId)
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['driver'] = $this->entity_model->get_driver_by_bus($busId);
        $bus = $data['driver'][0]['bus_id'];
        $data['bus'] = $this->entity_model->get_bus($bus);

        if (empty($data['driver'])) {
            show_404();
        }
        $data['title'] = 'Driver Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/viewDriver', $data);
        $this->load->view('templates/footer');
    }



    public function getBusByRegNo()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $busReg = $this->input->post('searchBus');

        $data['buses'] = $this->entity_model->get_bus_by_reg($busReg);

        if (empty($data['buses'])) {
            $this->session->set_flashdata('bus_not_found', 'This Bus with that registration number does not exist!');
            redirect('entities/showBuses');
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/busesList', $data);
        $this->load->view('templates/footer');
    }

    public function getBusHistoryByRegNo()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $busReg = $this->input->post('searchBus');

        $data['busesHistory'] = $this->entity_model->get_bus_history_by_reg($busReg);

        if (empty($data['busesHistory'])) {
            $this->session->set_flashdata('bus_history_not_found', 'This Bus with that registration number does not contains any maintenance history!');
            redirect('entities/busesHistory');
        }
        $data['title'] = 'Detail Info.';
        $this->load->view('templates/header');
        $this->load->view('entities/viewBusesHistory', $data);
        $this->load->view('templates/footer');
    }

    public function getBusHistoryByDate()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $date = $this->input->post('searchBusByDate');

        $data['busesHistory'] = $this->entity_model->get_bus_history_by_date($date);

        if (empty($data['busesHistory'])) {
            $this->session->set_flashdata('bus_history_not_found_by_date', 'There is no Maintenance History according to this date!');
            redirect('entities/busesHistory');
        }
        //print_r($data['busesHistory']);
        $data['title'] = 'Detail Info.';
        $this->load->view('templates/header');
        $this->load->view('entities/viewBusesHistory', $data);
        $this->load->view('templates/footer');
    }



    public function addBus()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        //$data['routes'] = $this->entity_model->get_routes();
        //print_r($data['routes']);

        $data['title'] = 'Add Bus';

        $this->form_validation->set_rules('registration_no', 'Registration_no', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('entities/addNewBus', $data);
            $this->load->view('templates/footer');
        } else {
            $busId = $this->input->post('registration_no');

            $bus = $this->entity_model->check_bus_exist($busId);

            if (!$bus) {
                $this->entity_model->add_bus();
                redirect('entities/showBuses');
            } else {
                $this->session->set_flashdata('bus_exist', 'This Bus with that registration number already exists!');
                redirect('entities/showBuses');
            }
        }
    }

    public function addBusHistory($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['bus'] = $this->entity_model->get_bus($id);

        if (empty($data['bus'])) {
            show_404();
        }

        $data['title'] = 'Add Bus History';

        $this->load->view('templates/header');
        $this->load->view('entities/addNewBusHistory', $data);
        $this->load->view('templates/footer');
    }

    public function busHistoryAdded()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->add_bus_history();
        redirect('entity/buses');
    }

    public function deleteBus($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->delete_Bus($id);
        redirect('entity/buses');
    }

    public function deleteBusHistory($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->delete_Bus_history($id);
        redirect('entities/busesHistory');
    }

    public function busesHistory($offset = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }


        $config['base_url'] = base_url() . 'entities/busesHistory/';
        $config['total_rows'] = $this->db->count_all('maintenance_history');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['busesHistory'] = $this->entity_model->get_buses_history($config['per_page'], $offset);
        $this->load->view('templates/header');
        $this->load->view('entities/viewBusesHistory', $data);
        $this->load->view('templates/footer');
    }

    public function busHistory($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['busHistories'] = $this->entity_model->get_bus_history($id);

        $this->load->view('templates/header');
        $this->load->view('entities/viewBusHistory', $data);
        $this->load->view('templates/footer');
    }

    public function editBusHistory($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['busHistory'] = $this->entity_model->get_one_bus_history($id);

        if (empty($data['busHistory'])) {
            show_404();
        }

        $data['title'] = 'Edit Bus History';

        $this->load->view('templates/header');
        $this->load->view('entities/editBusHistory', $data);
        $this->load->view('templates/footer');
    }

    public function updateBusHistory()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->update_bus_history();
        redirect('entities/busesHistory');
    }

    public function editBus($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['bus'] = $this->entity_model->get_bus($id);

        if (empty($data['bus'])) {
            show_404();
        }

        $data['title'] = 'Edit Bus';

        $this->load->view('templates/header');
        $this->load->view('entities/editBus', $data);
        $this->load->view('templates/footer');
    }

    public function updateBus()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->update_bus();
        redirect('entity/buses');
    }


    //....................................................//
    /////////////// Drivers' Operations //////////////////// 
    //....................................................//

    public function showDrivers($offset = 0)
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $config['base_url'] = base_url() . 'entities/showDrivers/';
        $config['total_rows'] = $this->db->count_all('driver');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['title'] = 'Manage';
        $data['drivers'] = $this->entity_model->get_drivers(FALSE, $config['per_page'], $offset);


        $this->load->view('templates/header');
        $this->load->view('entities/driversList', $data);
        $this->load->view('templates/footer');
    }

    public function viewDriver($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['driver'] = $this->entity_model->get_driver($id);
        $bus = $data['driver'][0]['bus_id'];
        $data['bus'] = $this->entity_model->get_bus($bus);

        if (empty($data['driver'])) {
            show_404();
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/viewDriver', $data);
        $this->load->view('templates/footer');
    }

    public function getDriverByName()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $driverName = $this->input->post('searchDriver');

        $data['drivers'] = $this->entity_model->get_driver_by_name($driverName);

        if (empty($data['drivers'])) {
            $this->session->set_flashdata('driver_not_found', 'This Driver with that name does not exist!');
            redirect('entities/showDrivers');
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/driversList', $data);
        $this->load->view('templates/footer');
    }

    public function editDriver($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['driver'] = $this->entity_model->get_driver($id);
        $bus = $this->entity_model->get_bus($data['driver'][0]['bus_id']);
        $data['bus'] = $bus;
        $data['buses'] = $this->entity_model->get_not_assigned_buses();
        if (empty($data['driver'])) {
            show_404();
        }

        $data['title'] = 'Edit Driver';

        $this->load->view('templates/header');
        $this->load->view('entities/editDriver', $data);
        $this->load->view('templates/footer');
    }

    public function updateDriver()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->update_driver();
        redirect('entity/drivers');
    }

    public function addDriver()
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['buses'] = $this->entity_model->get_not_assigned_buses();
        //print_r($data['routes']);

        $data['title'] = 'Add Driver';

        $this->form_validation->set_rules('first_name', 'First_Name', 'required|alpha');
        $this->form_validation->set_rules('last_name', 'Last_Name', 'required|alpha');
        $this->form_validation->set_rules('age', 'Age', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('entities/addNewDriver', $data);
            $this->load->view('templates/footer');
        } else {
            $this->entity_model->add_driver();
            redirect('entity/drivers');
        }
    }

    public function deleteDriver($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->delete_driver($id);
        redirect('entity/drivers');
    }


    //....................................................//
    /////////////// Routes' Operations ///////////////////// 
    //....................................................//


    public function showRoutes($offset = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $config['base_url'] = base_url() . 'entities/showRoutes/';
        $config['total_rows'] = $this->db->count_all('route');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['title'] = 'Manage';
        $data['routes'] = $this->entity_model->get_routes(FALSE, $config['per_page'], $offset);

        $this->load->view('templates/header');
        $this->load->view('entities/routesList', $data);
        $this->load->view('templates/footer');
    }

    public function viewRoute($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['route'] = $this->entity_model->get_route($id);

        if (empty($data['route'])) {
            show_404();
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/viewRoute', $data);
        $this->load->view('templates/footer');
    }

    public function getRouteByName()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $routeName = $this->input->post('searchRoute');

        $data['routes'] = $this->entity_model->get_route_by_name($routeName);

        if (empty($data['routes'])) {
            $this->session->set_flashdata('route_not_found', 'This Route with that name does not exist!');
            redirect('entities/showRoutes');
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/routesList', $data);
        $this->load->view('templates/footer');
    }

    public function deleteRoute($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->delete_route($id);
        redirect('entity/routes');
    }

    public function editRoute($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['route'] = $this->entity_model->get_route($id);
        if (empty($data['route'])) {
            show_404();
        }

        $data['title'] = 'Edit Route';

        $this->load->view('templates/header');
        $this->load->view('entities/editRoute', $data);
        $this->load->view('templates/footer');
    }

    public function updateRoute()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->update_route();
        redirect('entity/routes');
    }

    public function addRoute()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['title'] = 'Add Route';

        $this->form_validation->set_rules('route_name', 'Route_name', 'required');
        $this->form_validation->set_rules('route_no', 'Route_no', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('entities/addNewRoute', $data);
            $this->load->view('templates/footer');
        } else {
            $this->entity_model->add_route();
            redirect('entity/routes');
        }
    }


    //....................................................//
    /////////////// Faculties' Operations ////////////////// 
    //....................................................//


    public function showFaculties($offset = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $config['base_url'] = base_url() . 'entities/showFaculties/';
        $config['total_rows'] = $this->db->count_all('faculty');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['title'] = 'Manage';
        $data['faculties'] = $this->entity_model->get_faculties(FALSE, $config['per_page'], $offset);

        if (empty($data['faculty'])) {
            $data['not_found'] = 'Not Found!';
        }
        print_r($data['faculties']);
        $this->load->view('templates/header');
        $this->load->view('entities/facultyList', $data);
        $this->load->view('templates/footer');
    }

    public function viewFaculty($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['faculty'] = $this->entity_model->get_faculty($id);

        if (empty($data['faculty'])) {
            show_404();
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/viewFaculty', $data);
        $this->load->view('templates/footer');
    }

    public function getFacultyByName()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $facultyName = $this->input->post('searchFaculty');

        $data['faculties'] = $this->entity_model->get_faculty_by_name($facultyName);

        if (empty($data['faculties'])) {
            $this->session->set_flashdata('faculty_not_found', 'This Faculty with that name does not exist!');
            redirect('entities/showFaculties');
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/facultyList', $data);
        $this->load->view('templates/footer');
    }

    public function deleteFaculty($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->delete_faculty($id);
        redirect('entity/faculties');
    }

    public function editFaculty($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['faculty'] = $this->entity_model->get_faculty($id);
        if (empty($data['faculty'])) {
            show_404();
        }

        $data['title'] = 'Edit Faculty';

        $this->load->view('templates/header');
        $this->load->view('entities/editFaculty', $data);
        $this->load->view('templates/footer');
    }

    public function updateFaculty()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->update_faculty();
        redirect('entity/faculties');
    }

    public function addFaculty()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['title'] = 'Add Faculty';

        $this->form_validation->set_rules('first_name', 'First_Name', 'required|alpha');
        $this->form_validation->set_rules('last_name', 'Last_Name', 'required|alpha');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('email_address', 'Email_address', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('entities/addNewFaculty', $data);
            $this->load->view('templates/footer');
        } else {
            $this->entity_model->add_faculty();
            redirect('entity/faculties');
        }
    }


    //....................................................//
    ////////////// Buses' Routes' Operations /////////////// 
    //....................................................//


    public function showRoutesPlan($offset = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }


        $config['base_url'] = base_url() . 'entities/showRoutesPlan/';
        $config['total_rows'] = $this->db->count_all('bus_has_route');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['busesRoutes'] = $this->entity_model->get_buses_routes(FALSE, $config['per_page'], $offset);

        //print_r($data['busesRoutes']);
        $this->load->view('templates/header');
        $this->load->view('entities/viewBusesRoutes', $data);
        $this->load->view('templates/footer');
    }

    public function viewRoutePLan()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }


        $busId = $this->input->post('bus_id');
        $routeId = $this->input->post('route_id');
        $data['routePlan'] = $this->entity_model->get_route_plan($busId, $routeId);

        //print_r($routeId);
        if (empty($data['routePlan'])) {
            show_404();
        }

        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/viewRoutePlan', $data);
        $this->load->view('templates/footer');
    }

    public function addBusRoute()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $data['title'] = 'Add Route to Bus';
        $data['buses'] = $this->entity_model->get_buses();
        $data['routes'] = $this->entity_model->get_routes();

        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('starting_point', 'Starting_point', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('entities/addNewBusRoute', $data);
            $this->load->view('templates/footer');
        } else {

            $busId = $this->input->post('bus_id');
            $routeId = $this->input->post('route_id');
            $time = $this->input->post('time');

            $busRoute = $this->entity_model->bus_route_check($busId, $routeId);
            $busTime = $this->entity_model->bus_time_check($busId, $time);
            if (!$busRoute && !$busTime) {
                //try {
                $this->entity_model->add_route_bus();
                redirect('entity/busesRoutes');
                // } catch (Exception $e) {
                //     echo 'Message: ' . $e->getMessage();
                // }
            } else {
                $this->session->set_flashdata('busRouteRegistration_failed', ' This Route Plan already exists!');
                redirect('entities/showRoutesPlan');
            }
        }
    }

    public function deleteRoutePlan()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $busId = $this->input->post('bus_id');
        $routeId = $this->input->post('route_id');

        $this->entity_model->delete_route_bus($busId, $routeId);
        redirect('entity/busesRoutes');
    }

    public function editRoutePlan()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $busId = $this->input->post('bus_id');
        $routeId = $this->input->post('route_id');
        $data['routes'] = $this->entity_model->get_routes();
        $data['buses'] = $this->entity_model->get_buses();

        $data['routePlan'] = $this->entity_model->get_route_plan($busId, $routeId);

        $data['title'] = 'Edit Route Plan';
        $this->load->view('templates/header');
        $this->load->view('entities/editRoutePlan', $data);
        $this->load->view('templates/footer');
    }

    public function updateRoutePlan()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->entity_model->update_route_plan();
        redirect('entity/busesRoutes');
    }

    public function getRoutePlanViaBus()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $busReg = $this->input->post('searchBus');

        $data['busesRoutes'] = $this->entity_model->get_routeplan_via_bus($busReg);
        if (empty($data['busesRoutes'])) {
            $this->session->set_flashdata('bus_not_found', 'This Bus with that registration number does not exist!');
            redirect('entities/showRoutesPlan');
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/viewBusesRoutes', $data);
        $this->load->view('templates/footer');
    }

    public function getRoutePlanViaRoute()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $routeName = $this->input->post('searchRoute');

        $data['busesRoutes'] = $this->entity_model->get_routeplan_via_route($routeName);

        if (empty($data['busesRoutes'])) {
            $this->session->set_flashdata('route_not_found', 'This Route with that name does not exist!');
            redirect('entities/showRoutesPlan');
        }
        $data['title'] = 'Detail Info.';

        $this->load->view('templates/header');
        $this->load->view('entities/viewBusesRoutes', $data);
        $this->load->view('templates/footer');
    }
}
