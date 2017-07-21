<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function index(){
            $this->load->view('templates/header');
            $this->load->view('admin/index');
        }

        // SSG Area
        public function ssg(){
            $data['menu'] = 'election';
            $data['submenu'] = 'ssg';

            $this->load->view('templates/header', $data);
            $this->load->view('admin/ssg');
        }

        public function ssg_list()
        {
            $list = $this->ssg_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $ssg) {
                $no++;
                $row = array();
                $row[] = $ssg->id;
                $row[] = $ssg->title;
                $row[] = $ssg->start_time;
                $row[] = $ssg->start_date;
                $row[] = $ssg->end_time;
                $row[] = $ssg->end_date;
                //add html for action
                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_ssg('."'".$ssg->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->ssg_model->count_all(),
                "recordsFiltered" => $this->ssg_model->count_filtered(),
                "data" => $data,
            );
            //output to json format
            echo json_encode($output);
        }

        public function ssg_create() {

            $this->_validate();

            $data = Array (
                'title' => $this->input->post('title'),
                'start_time' => $this->input->post('start_time'),
                'start_date' => $this->input->post('start_date'),
                'end_time' => $this->input->post('end_time'),
                'end_date' => $this->input->post('end_date'),
            );
            $this->ssg_model->create($data);

            echo json_encode(array("status" => TRUE));
        }

        public function ssg_edit($id)
        {
            $data = $this->ssg_model->get_by_id($id);
            echo json_encode($data);
        }

        public function ssg_update() {
            $this->_validate();

            $data = Array (
                'title' => $this->input->post('title'),
                'start_time' => $this->input->post('start_time'),
                'start_date' => $this->input->post('start_date'),
                'end_time' => $this->input->post('end_time'),
                'end_date' => $this->input->post('end_date')
            );
            $this->ssg_model->update(array('id' => $this->input->post('id')), $data);

            echo json_encode(array("status" => TRUE));
        }

        /////////////////////////////////// end of SSG

        // Position Area
        public function position(){
            $data['menu'] = 'election';
            $data['submenu'] = 'position';
            
            $this->load->view('templates/header', $data);
            $this->load->view('admin/position');
        }

        public function position_list()
        {
            $list = $this->position_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $position) {
                $no++;
                $row = array();
                $row[] = $position->id;
                $row[] = $position->name;
                //add html for action
                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_position('."'".$position->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->position_model->count_all(),
                "recordsFiltered" => $this->position_model->count_filtered(),
                "data" => $data,
            );
            //output to json format
            echo json_encode($output);
        }

        public function position_create() {

            $this->_validate();

            $data = Array (
                'name' => $this->input->post('position'),
            );
            $this->position_model->create($data);

            echo json_encode(array("status" => TRUE));
        }

        public function position_edit($id)
        {
            $data = $this->position_model->get_by_id($id);
            echo json_encode($data);
        }

        public function position_update() {
            $this->_validate();

            $data = Array (
                'name' => $this->input->post('position'),
            );
            $this->position_model->update(array('id' => $this->input->post('id')), $data);

            echo json_encode(array("status" => TRUE));
        }

        public function position_select()
        {
            $list = $this->position_model->get_list();
            $options = '<option value="">--Select Position--</option>';
            foreach ($list as $row) {
                $options .= '<option value="' . $row->id . '">' . $row->name . ' </option>';
            }
            $output = array(
                "success" => TRUE,
                "options" => $options,
            );
            //output to json format
            echo json_encode($output);
        }

        /////////////////////////////////// end of Position

        // Partylist Area

        public function partylist(){
            $data['menu'] = 'election';
            $data['submenu'] = 'partylist';

            $this->load->view('templates/header', $data);
            $this->load->view('admin/partylist');
        }

        public function partylist_list()
        {
            $list = $this->partylist_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $partylist) {
                $no++;
                $row = array();
                $row[] = $partylist->id;
                $row[] = $partylist->name;
                //add html for action
                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_partylist('."'".$partylist->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->partylist_model->count_all(),
                "recordsFiltered" => $this->partylist_model->count_filtered(),
                "data" => $data,
            );
            //output to json format
            echo json_encode($output);
        }

        public function partylist_create() {

            $this->_validate();

            $data = Array (
                'name' => $this->input->post('partylist'),
            );

            $this->partylist_model->create($data);

            echo json_encode(array("status" => TRUE));
        }

        public function partylist_edit($id)
        {
            $data = $this->partylist_model->get_by_id($id);
            echo json_encode($data);
        }

        public function partylist_update() {
            $this->_validate();

            $data = Array (
                'name' => $this->input->post('partylist'),
            );
            $this->partylist_model->update(array('id' => $this->input->post('id')), $data);

            echo json_encode(array("status" => TRUE));
        }

        public function partylist_select()
        {
            $list = $this->partylist_model->get_list();
            $options = '<option value="">--Select Party--</option>';
            foreach ($list as $row) {
                $options .= '<option value="' . $row->id . '">' . $row->name . ' </option>';
            }
            $output = array(
                "success" => TRUE,
                "options" => $options,
            );
            //output to json format
            echo json_encode($output);
        }

        ///////////////////////////////// end of Patylist


        // Grade Section Area

        public function gradesection(){
            $data['menu'] = 'student';
            $data['submenu'] = 'grade-section';

            $this->load->view('templates/header', $data);
            $this->load->view('admin/grade_section');
        }


        public function gradesection_list()
        {
            $list = $this->gradesection_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $gradesection) {
                $no++;
                $row = array();
                $row[] = $gradesection->id;
                $row[] = $gradesection->grade;
                $row[] = $gradesection->section;
                //add html for action
                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_gradesection('."'".$gradesection->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->gradesection_model->count_all(),
                "recordsFiltered" => $this->gradesection_model->count_filtered(),
                "data" => $data,
            );
            //output to json format
            echo json_encode($output);
        }

        public function gradesection_select()
        {
            $list = $this->gradesection_model->get_list();
            $options = '<option value="">--Select Grade & Section--</option>';
            foreach ($list as $row) {
                $options .= '<option value="' . $row->id . '">' . $row->grade . ' - ' .$row->section . ' </option>';
            }
            $output = array(
                "success" => TRUE,
                "options" => $options,
            );
            //output to json format
            echo json_encode($output);
        }

        public function gradesection_create() {

            $this->_validate();

            $data = Array (
                'grade' => $this->input->post('grade'),
                'section' => $this->input->post('section'),
            );

            $this->gradesection_model->create($data);

            echo json_encode(array("status" => TRUE));
        }

        public function gradesection_edit($id)
        {
            $data = $this->gradesection_model->get_by_id($id);
            echo json_encode($data);
        }

        public function gradesection_update() {
            $this->_validate();

            $data = Array (
                'grade' => $this->input->post('grade'),
                'section' => $this->input->post('section'),
            );
            $this->gradesection_model->update(array('id' => $this->input->post('id')), $data);

            echo json_encode(array("status" => TRUE));
        }

        ///////////////////////////////// end of Grade Section

        private function _validate()
        {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = TRUE;

            $position = $this->input->post('position');
            $partylist = $this->input->post('partylist');
            $grade = $this->input->post('grade');
            $section = $this->input->post('section');

            if(isset($position) && $position == '')
            {
                $data['inputerror'][] = 'position';
                $data['error_string'][] = 'Position name is required';
                $data['status'] = FALSE;
            }

            if(isset($position) && $this->check_position_exists($position) === FALSE)
            {
                $data['inputerror'][] = 'position';
                $data['error_string'][] = 'Sorry! That position is already on the list. Please choose a different one';
                $data['status'] = FALSE;
            }

            //////////////////////////////////

            if(isset($partylist) && $partylist == '')
            {
                $data['inputerror'][] = 'partylist';
                $data['error_string'][] = 'Partylist name is required';
                $data['status'] = FALSE;
            }

            if(isset($partylist) && $this->check_partylist_exists($partylist) === FALSE)
            {
                $data['inputerror'][] = 'partylist';
                $data['error_string'][] = 'Sorry! That Partylist is already on the list. Please choose a different one';
                $data['status'] = FALSE;
            }

            ////////////////////////////////
            if(isset($grade) && $grade == '')
            {
                $data['inputerror'][] = 'grade';
                $data['error_string'][] = 'Grade is required';
                $data['status'] = FALSE;
            }
            if(isset($section) && $section == '')
            {
                $data['inputerror'][] = 'section';
                $data['error_string'][] = 'Section is required';
                $data['status'] = FALSE;
            }

            if($data['status'] === FALSE)
            {
                echo json_encode($data);
                exit();
            }
        }

        //Check if exists
        public function check_position_exists($position){
            if($this->position_model->check_position_exists($position)){
                return true;
            } else {
                return false;
            }
        }

        //Check if exists
        public function check_partylist_exists($partylist){
            if($this->partylist_model->check_partylist_exists($partylist)){
                return true;
            } else {
                return false;
            }
        }
    }