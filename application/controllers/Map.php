<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{


    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->load->library('googlemaps');
        $data['buses'] = $this->entity_model->get_buses();

        $this->googlemaps->initialize();
        $data['map'] = $this->googlemaps->create_map();
        $data['locations'] = [];
        print_r($data['locations']);
        $this->load->view('templates/header');
        $this->load->view('map/gMap', $data);
        $this->load->view('templates/footer');
    }

    public function trackBusByRegNo()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $busReg = $this->input->post('trackBus');
        if (empty($busReg)) {
            redirect('map/index');
        }

        $data['buses'] = $this->entity_model->get_buses();
        $data['locations'] = $this->map_model->track_bus_by_reg($busReg);
        $data['locatedBus'] = $this->entity_model->get_bus($data['locations'][0]['bus_id']);
        //$data['locations'] = end($data['locations']);
        if (empty($data['locations'])) {
            $this->session->set_flashdata('bus_location_not_found', 'This Bus with that registration number does not exist!');
            redirect('map/index');
        }

        $data['title'] = 'Detail Info.';
        foreach($data['locations'] as $locat){
            $data['locations'] = $locat;
            
        }
        //print_r($data['locations']);


        $this->load->view('templates/header');
        $this->load->view('map/gMap', $data);
        $this->load->view('templates/footer');
    }

    public function addBusLocation()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        // foreach ($this->session->userdata('roles') as $role) {
        //     if ($role['role'] == 'Gate Keeper') {
        //         redirect(base_url());
        //     }
        // }

        $data['title'] = 'Add Bus Location';

        $this->map_model->add_bus_location();

        //redirect("map/index");
    }

    public function busesInOutHistory($offset = 0)
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $config['base_url'] = base_url() . 'map/busesInOutHistory/';
        $config['total_rows'] = $this->db->count_all('bus_in_out_history');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['title'] = 'Buses In Out History';
        $data['inOutHistories'] = $this->map_model->get_buses_in_out_history(FALSE, $config['per_page'], $offset);

        //print_r($data['inOutHistories']);
        $this->load->view('templates/header');
        $this->load->view('map/busesInOutHistoryList', $data);
        $this->load->view('templates/footer');
    }

    public function deleteBusInOutHistory($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        foreach ($this->session->userdata('roles') as $role) {
            if ($role['role'] == 'Gate Keeper') {
                redirect(base_url());
            }
        }

        $this->map_model->delete_bus_in_out_history($id);
        redirect('map/busesInOutHistory');
    }

    public function getInOutHistoryByBus($offset = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $busReg = $this->input->post('searchByBus');
        if (empty($busReg)) {
            redirect('map/busesInOutHistory');
        }

        $config['base_url'] = base_url() . 'map/busesInOutHistory/';
        $config['total_rows'] = $this->db->count_all('bus_in_out_history');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        $data['inOutHistories'] = $this->map_model->get_in_out_history($busReg, FALSE, $config['per_page'], $offset);
        if (empty($data['inOutHistories'])) {
            $this->session->set_flashdata('bus_in_out_history_not_found', 'This Bus with that registration number does not exist!');
            redirect('map/busesInOutHistory');
        }

        $data['title'] = 'Buses In Out History';

        //print_r($data['inOutHistories']);
        $this->load->view('templates/header');
        $this->load->view('map/busesInOutHistoryList', $data);
        $this->load->view('templates/footer');
    }

    public function updateBusStatusIn()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->map_model->update_bus_status_in();
    }

    public function updateBusStatusOut()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->map_model->update_bus_status_out();
    }

    public function updateBusInOutHistory()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->map_model->update_bus_in_out_history();
    }

    public function getInOutBusHistoryByDate()
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

        $data['busesInOutHistory'] = $this->map_model->get_bus_in_out_history_by_date($date);

        if (empty($data['busesInOutHistory'])) {
            $this->session->set_flashdata('bus_history_not_found_by_date', 'There is no Maintenance History according to this date!');
            redirect('map/busesInOutHistory');
        }
        //print_r($data['busesHistory']);
        $data['title'] = 'Detail Info.';
        $this->load->view('templates/header');
        $this->load->view('map/busesInOutHistoryList', $data);
        $this->load->view('templates/footer');
    }
}
