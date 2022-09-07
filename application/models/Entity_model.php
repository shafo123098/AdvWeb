<?php
class Entity_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    //....................................................//
    /////////////// Students' Operations ///////////////////
    //....................................................//

    public function get_students($limit = FALSE, $offset = FALSE)
    {

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $this->db->order_by('first_name', 'AESC');
        $query = $this->db->get('student');
        return $query->result_array();
    }

    public function get_student($id = NULL)
    {

        $this->db->where('id', $id);
        $q = $this->db->get('student');
        $data = $q->result_array();

        return $data;
    }

    public function check_student_exist($rollNo)
    {
        $this->db->where('roll_no', $rollNo);
        $result = $this->db->get('student');

        if ($result->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_student_by_name($rollNo)
    {

        $this->db->where('roll_no', $rollNo);
        $q = $this->db->get('student');
        $data = $q->result_array();

        return $data;
    }


    public function add_student()
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'age' => $this->input->post('age'),
            'roll_no' => $this->input->post('roll_no'),
            'email_address' => $this->input->post('email_address'),
            'address' => $this->input->post('address'),
            'gender' => $this->input->post('gender'),
            'route_id' => $this->input->post('route_id'),
        );

        return $this->db->insert('student', $data);
    }

    public function delete_student($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('student');
        return true;
    }

    public function update_student()
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'age' => $this->input->post('age'),
            'roll_no' => $this->input->post('roll_no'),
            'email_address' => $this->input->post('email_address'),
            'address' => $this->input->post('address'),
            'gender' => $this->input->post('gender'),
            'route_id' => $this->input->post('route_id'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('student', $data);
    }


    //....................................................//
    /////////////// Buses' Operations ////////////////////// 
    //....................................................//

    public function get_buses($slug = FALSE, $limit = FALSE, $offset = FALSE)
    {

        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('bus');
        return $query->result_array();
    }

    public function get_not_assigned_buses()
    {
        $this->db->where('assign_status', 'Not Assigned');
        $q = $this->db->get('bus');
        $data = $q->result_array();

        return $data;
    }

    public function get_buses_history($limit = FALSE, $offset = FALSE)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $this->db->select('*');
        $this->db->from('bus');
        $this->db->join('maintenance_history', 'maintenance_history.bus_id = bus.id');
        $data = $this->db->get();

        return $data->result_array();
    }

    public function get_bus_history($id)
    {

        $this->db->where('bus_id', $id);
        $q = $this->db->get('maintenance_history');
        $data = $q->result_array();

        return $data;
    }

    public function get_bus($id = NULL)
    {

        $this->db->where('id', $id);
        $q = $this->db->get('bus');
        $data = $q->result_array();

        return $data;
    }

    public function get_one_bus_history($id, $slug = FALSE, $limit = FALSE, $offset = FALSE)
    {

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $this->db->where('id', $id);
        $q = $this->db->get('maintenance_history');
        $data = $q->result_array();

        return $data;
    }

    public function get_driver_by_bus($busId)
    {

        $this->db->where('bus_id', $busId);
        $q = $this->db->get('driver');
        $data = $q->result_array();

        return $data;
    }

    public function get_bus_by_reg($reg)
    {

        $this->db->where('registration_no', $reg);
        $q = $this->db->get('bus');
        $data = $q->result_array();

        return $data;
    }

    public function get_bus_history_by_reg($regNo)
    {
        $this->db->where('registration_no', $regNo);
        $q1 = $this->db->get('bus');
        $temp1 = $q1->result_array();

        // $this->db->where('bus_id', $temp1[0]['id']);
        // $result = $this->db->get('maintenance_history');

        $this->db->select('*');
        $this->db->from('bus');
        $this->db->join('maintenance_history', 'maintenance_history.bus_id = bus.id');
        $this->db->where('bus_id', $temp1[0]['id']);
        $result = $this->db->get();

        return $result->result_array();
    }

    public function get_bus_history_by_date($date)
    {
        $convertDate = date("Y-m-d", strtotime($date));

        $this->db->select('*');
        $this->db->from('maintenance_history');
        $this->db->join('bus', 'bus.id = maintenance_history.bus_id');
        $this->db->where('created_at', $convertDate);
        $result = $this->db->get();

        return $result->result_array();
    }



    public function add_bus()
    {
        $data = array(
            'registration_no' => $this->input->post('registration_no'),
            'type' => $this->input->post('type'),
            'assign_status' => $this->input->post('assign_status'),
            'location_status' => "IN"
        );

        return $this->db->insert('bus', $data);
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

    public function add_bus_history()
    {
        $data = array(
            'description' => $this->input->post('description'),
            'cost' => $this->input->post('cost'),
            'bus_id' => $this->input->post('bus_id')
        );

        return $this->db->insert('maintenance_history', $data);
    }

    public function delete_bus($id)
    {
        $this->db->where('bus_id', $id);
        $this->db->delete('driver');

        $this->db->where('bus_id', $id);
        $this->db->delete('maintenance_history');

        $this->db->where('bus_id', $id);
        $this->db->delete('bus_has_route');

        $this->db->where('id', $id);
        $this->db->delete('bus');

        return true;
    }

    public function delete_bus_history($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('maintenance_history');
        return true;
    }

    public function update_bus_history()
    {
        $data = array(
            'description' => $this->input->post('description'),
            'cost' => $this->input->post('cost'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('maintenance_history', $data);
    }

    public function update_bus()
    {
        $data = array(
            'registration_no' => $this->input->post('registration_no'),
            'type' => $this->input->post('type'),
            'assign_status' => $this->input->post('assign_status'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('bus', $data);
    }

    //....................................................//
    /////////////// Drivers' Operations ////////////////////
    //....................................................//

    public function get_drivers($slug = FALSE, $limit = FALSE, $offset = FALSE)
    {

        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('first_name', 'AESC');
        $query = $this->db->get('driver');
        return $query->result_array();
    }

    public function get_driver($id = NULL)
    {

        $this->db->where('id', $id);
        $q = $this->db->get('driver');
        $data = $q->result_array();

        return $data;
    }

    public function get_driver_by_name($name)
    {

        $this->db->where('first_name', $name);
        $q = $this->db->get('driver');
        $data = $q->result_array();

        return $data;
    }

    public function update_driver()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'age' => $this->input->post('age'),
            'address' => $this->input->post('address'),
            'contact' => $this->input->post('contact'),
            'bus_id' => $this->input->post('bus_id'),
        );

        $oldBusId = $this->input->post('old_bus_id');

        $this->db->where('id', $oldBusId);
        $q1 = $this->db->get('bus');
        $temp1 = $q1->result_array();

        $oldBus = $temp1[0];
        $oldBus['assign_status'] = 'Not Assigned';
        $this->db->where('id', $this->input->post('old_bus_id'));
        $this->db->update('bus', $oldBus);

        $newBusId = $this->input->post('bus_id');
        $this->db->where('id', $newBusId);
        $q2 = $this->db->get('bus');
        $temp2 = $q2->result_array();

        $newBus = $temp2[0];
        $newBus['assign_status'] = 'Assigned';
        $this->db->where('id', $this->input->post('bus_id'));
        $this->db->update('bus', $newBus);

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('driver', $data);
    }

    public function add_driver()
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'age' => $this->input->post('age'),
            'contact' => $this->input->post('contact'),
            'address' => $this->input->post('address'),
            'bus_id' => $this->input->post('bus_id'),
        );

        $busId = $this->input->post('bus_id');
        $this->db->where('id', $busId);
        $q = $this->db->get('bus');
        $temp = $q->result_array();
        //print_r($temp);
        //print_r($data);
        $bus = $temp[0];
        print_r($bus);
        $bus['assign_status'] = 'Assigned';
        print_r($bus);
        $this->db->where('id', $this->input->post('bus_id'));
        $this->db->update('bus', $bus);

        return $this->db->insert('driver', $data);
    }

    public function delete_driver($id)
    {
        $this->db->where('id', $id);
        $q = $this->db->get('driver');
        $driver = $q->result_array();

        $busId = $driver[0]['bus_id'];
        $this->db->where('id', $busId);
        $q = $this->db->get('bus');
        $temp = $q->result_array();
        $bus = $temp[0];
        $bus['assign_status'] = 'Not Assigned';
        $this->db->where('id', $busId);
        $this->db->update('bus', $bus);

        $this->db->where('id', $id);
        $this->db->delete('driver');
        return true;
    }


    //....................................................//
    /////////////// Routes' Operations ///////////////////// 
    //....................................................//


    public function get_route($id)
    {
        $this->db->where('id', $id);
        $q = $this->db->get('route');
        $data = $q->result_array();

        return $data;
    }

    public function get_route_by_name($name)
    {

        $this->db->where('route_name', $name);
        $q = $this->db->get('route');
        $data = $q->result_array();

        return $data;
    }

    public function get_routes($slug = FALSE, $limit = FALSE, $offset = FALSE)
    {

        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('route');
        return $query->result_array();
    }

    public function add_route()
    {
        $data = array(
            'route_name' => $this->input->post('route_name'),
            'route_no' => $this->input->post('route_no'),
        );

        return $this->db->insert('route', $data);
    }

    public function delete_route($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('route');
        return true;
    }

    public function update_route()
    {
        $data = array(
            'route_name' => $this->input->post('route_name'),
            'route_no' => $this->input->post('route_no'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('route', $data);
    }


    //....................................................//
    /////////////// Faculties' Operations ///////////////////// 
    //....................................................//


    public function get_faculties($slug = FALSE, $limit = FALSE, $offset = FALSE)
    {

        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        if ($slug === FALSE) {
            $query = $this->db->get('faculty');
            return $query->result_array();
        }
        $query = $this->db->get_where('faculty', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_faculty($id)
    {
        $this->db->where('id', $id);
        $q = $this->db->get('faculty');
        $data = $q->result_array();

        return $data;
    }

    public function get_faculty_by_name($name)
    {
        $this->db->where('first_name', $name);
        $q = $this->db->get('faculty');
        $data = $q->result_array();

        return $data;
    }

    public function add_faculty()
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'address' => $this->input->post('address'),
            'contact' => $this->input->post('contact'),
            'email_address' => $this->input->post('email_address'),

        );

        return $this->db->insert('faculty', $data);
    }

    public function delete_faculty($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('faculty');
        return true;
    }

    public function update_faculty()
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'address' => $this->input->post('address'),
            'email_address' => $this->input->post('email_address'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('faculty', $data);
    }

    //....................................................//
    ////////////// Buses' Routes' Operations /////////////// 
    //....................................................//

    public function get_buses_routes($slug = FALSE, $limit = FALSE, $offset = FALSE)
    {

        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->select('*');
        $this->db->from('bus_has_route');
        $this->db->join('route', 'bus_has_route.route_id = route.id');
        $this->db->join('bus', 'bus_has_route.bus_id = bus.id');

        $this->db->order_by('time', 'AESC');
        $data = $this->db->get();

        return $data->result_array();
    }

    public function get_route_plan($busId, $routeId)
    {
        $this->db->select('*');
        $this->db->from('bus_has_route');
        $this->db->join('route', 'bus_has_route.route_id = route.id');
        $this->db->join('bus', 'bus_has_route.bus_id = bus.id');

        $this->db->where('bus.id', $busId);
        $this->db->where('route.id', $routeId);
        $query = $this->db->get();
        $data = $query->result_array();

        return $data;
    }

    public function bus_route_check($busId, $routeId)
    {

        $this->db->where('bus_id', $busId);
        $this->db->where('route_id', $routeId);

        $result = $this->db->get('bus_has_route');

        if ($result->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function bus_time_check($busId, $time)
    {

        $this->db->where('bus_id', $busId);
        $this->db->where('time', $time);

        $result = $this->db->get('bus_has_route');

        if ($result->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function add_route_bus()
    {
        $data = array(
            'bus_id' => $this->input->post('bus_id'),
            'route_id' => $this->input->post('route_id'),
            'time' => $this->input->post('time'),
            'status' => $this->input->post('status'),
            'starting_point' => $this->input->post('starting_point'),
            'via' => $this->input->post('via')
        );

        try {
            return $this->db->insert('bus_has_route', $data);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete_route_bus($busId, $routeId)
    {

        $this->db->select('*');
        $this->db->from('bus_has_route');
        $this->db->join('route', 'bus_has_route.route_id = route.id');
        $this->db->join('bus', 'bus_has_route.bus_id = bus.id');

        $this->db->where('bus_id', $busId);
        $this->db->where('route_id', $routeId);
        $this->db->delete('bus_has_route');

        return true;
    }

    public function update_route_plan()
    {
        $data = array(
            'bus_id' => $this->input->post('bus_id'),
            'route_id' => $this->input->post('route_id'),
            'starting_point' => $this->input->post('starting_point'),
            'time' => $this->input->post('time'),
            'status' => $this->input->post('status'),
            'via' => $this->input->post('via')

        );

        $this->db->where('bus_id', $this->input->post('bus_id'));
        $this->db->where('route_id', $this->input->post('route_id'));
        return $this->db->update('bus_has_route', $data);
    }

    public function get_routeplan_via_bus($reg)
    {

        $this->db->select('*');
        $this->db->from('bus_has_route');
        $this->db->join('route', 'bus_has_route.route_id = route.id');
        $this->db->join('bus', 'bus_has_route.bus_id = bus.id');

        $this->db->where('bus.registration_no', $reg);
        $query = $this->db->get();
        $data = $query->result_array();

        return $data;
    }

    public function get_routeplan_via_route($routeName)
    {

        $this->db->select('*');
        $this->db->from('bus_has_route');
        $this->db->join('route', 'bus_has_route.route_id = route.id');
        $this->db->join('bus', 'bus_has_route.bus_id = bus.id');

        $this->db->where('route.route_name', $routeName);
        $query = $this->db->get();
        $data = $query->result_array();

        return $data;
    }
}
