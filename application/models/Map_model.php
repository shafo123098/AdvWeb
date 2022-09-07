<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_locations()
    {

        $query = $this->db->get('bus_location');
        $data = $query->result_array();

        return $data;
    }

    public function track_bus_by_reg($reg)
    {

        $this->db->where('registration_no', $reg);
        $q = $this->db->get('bus');
        $bus = $q->result_array();
        if (!empty($bus)) {
            $busId = $bus[0]['id'];

            $this->db->where('bus_id', $busId);
            $q = $this->db->get('bus_location');
            $data = $q->result_array();

            return $data;
        } else {
            return $bus;
        }
    }

    public function check_bus_exist($regNo)
    {
        $this->db->where('registration_no', $regNo);
        $result = $this->db->get('bus');

        if ($result->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function add_bus_location()
    {
        $data = array(
            'lat' => $this->input->post('lat'),
            'lng' => $this->input->post('lng'),
            'speed' => $this->input->post('speed'),
            'bus_id' =>  22,
        );

        return $this->db->insert('bus_location', $data);
    }

    public function get_buses_in_out_history($slug = FALSE, $limit = FALSE, $offset = FALSE)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $this->db->select('*');
        $this->db->from('bus');
        $this->db->join('bus_in_out_history', 'bus_in_out_history.bus_id = bus.id');
        $data = $this->db->get();

        return $data->result_array();
    }

    public function delete_bus_in_out_history($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bus_in_out_history');
        return true;
    }

    public function get_in_out_history($regNo,$limit = FALSE, $offset = FALSE)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $this->db->select('*');
        $this->db->from('bus');
        $this->db->join('bus_in_out_history', 'bus_in_out_history.bus_id = bus.id');

        $this->db->where('registration_no', $regNo);

        $data = $this->db->get();

        return $data->result_array();
    }

    public function update_bus_status_in()
    {
        $data = array(
            'location_status' => 'IN',
        );

        $this->db->where('id', 22);
        return $this->db->update('bus', $data);
    }

    public function update_bus_status_out()
    {
        $data = array(
            'location_status' => 'OUT',
        );
        $this->db->where('id', 22);
        return $this->db->update('bus', $data);
    }

    public function update_bus_in_out_history()
    {
        $data = array(
            'status' => $this->input->post('status'),
            'bus_id' => 22
        );
        return $this->db->insert('bus_in_out_history', $data);
    }

    public function get_bus_in_out_history_by_date($date,$limit = FALSE, $offset = FALSE)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $convertDate = date("Y-m-d", strtotime($date));
        $this->db->select('*');
        $this->db->from('bus');
        $this->db->join('bus_in_out_history', 'bus_in_out_history.bus_id = bus.id');

        $this->db->where('created_at', $convertDate);

        $data = $this->db->get();

        return $data->result_array();
    }
}
