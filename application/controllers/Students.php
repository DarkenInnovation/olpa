<?php
    class Students extends CI_Controller {

        public function student(){
            $data['menu'] = 'student';
            $data['submenu'] = 'student';

            $this->load->view('templates/header', $data);
            $this->load->view('admin/student');
        }
        
        public function student_list()
        {
            $list = $this->student_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $student) {
                $no++;
                $row = array();
                $row[] = $student->student_id;
                $row[] = $student->firstname . ' ' .  $student->middlename . ' ' .  $student->lastname;
                $row[] = $student->email;
                $row[] = ucfirst($student->gender);
                $row[] = $student->dob;
                $row[] = $student->mobile;
                $row[] = $student->grade . ' - ' . $student->section;
                //add html for action
                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_student('."'".$student->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->student_model->count_all(),
                "recordsFiltered" => $this->student_model->count_filtered(),
                "data" => $data,
            );
            //output to json format
            echo json_encode($output);
        }

        public function student_create() {

            $this->_validate();

            $data = array(
                'student_id' => $this->input->post('student_id'),
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'gender' => $this->input->post('gender'),
                'dob' => $this->input->post('dob'),
                'mobile' => $this->input->post('mobile'),
                'grade_section_id' => $this->input->post('grade_section'),
                'password' => $this->input->post('password'),
                'status' => 'Active',
                'remarks' => 'Not Voted'
            );

            $this->student_model->create($data);

            echo json_encode(array("status" => TRUE));
        }

        public function student_edit($id)
        {
            $data = $this->student_model->get_by_id($id);
            echo json_encode($data);
        }

        public function student_update() {
            $this->_validate();

            $data = Array (
                'student_id' => $this->input->post('student_id'),
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'gender' => $this->input->post('gender'),
                'dob' => $this->input->post('dob'),
                'mobile' => $this->input->post('mobile'),
                'grade_section_id' => $this->input->post('grade_section')
            );
            $this->student_model->update(array('id' => $this->input->post('id')), $data);

            echo json_encode(array("status" => TRUE));
        }

        public function student_select()
        {
            $list = $this->student_model->get_list();
            $options = '<option value="">--Select Student--</option>';
            foreach ($list as $row) {
                $options .= '<option value="' . $row->id . '">' . $row->student_id . ' - ' . $row->lastname  . ', ' . $row->firstname . ' </option>';
            }
            $output = array(
                "success" => TRUE,
                "options" => $options,
            );
            //output to json format
            echo json_encode($output);
        }

        private function _validate()
        {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = TRUE;


            if($this->input->post('student_id') == '' && $this->input->post('type') != 'update')
            {
                $data['inputerror'][] = 'student_id';
                $data['error_string'][] = 'Student ID is required';
                $data['status'] = FALSE;
            }

            if($this->input->post('student_id') != '' && !is_numeric($this->input->post('student_id'))  && $this->input->post('type') != 'update')
            {
                $data['inputerror'][] = 'student_id';
                $data['error_string'][] = 'Please enter number only';
                $data['status'] = FALSE;
            }
            if($this->check_student_id_exists($this->input->post('student_id')) === FALSE && $this->input->post('type') != 'update')
            {
                $data['inputerror'][] = 'student_id';
                $data['error_string'][] = 'Sorry! Student ID is already on the list. Please choose a different one';
                $data['status'] = FALSE;
            }

            if($this->input->post('firstname') == '')
            {
                $data['inputerror'][] = 'firstname';
                $data['error_string'][] = 'First name is required';
                $data['status'] = FALSE;
            }

            if($this->input->post('middlename') == '')
            {
                $data['inputerror'][] = 'middlename';
                $data['error_string'][] = 'Middle name is required';
                $data['status'] = FALSE;
            }
            if($this->input->post('lastname') == '')
            {
                $data['inputerror'][] = 'lastname';
                $data['error_string'][] = 'Last name is required';
                $data['status'] = FALSE;
            }
            if($this->input->post('email') == '')
            {
                $data['inputerror'][] = 'email';
                $data['error_string'][] = 'Email Address is required';
                $data['status'] = FALSE;
            }
            if($this->input->post('email') != '' && !filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL))
            {
                $data['inputerror'][] = 'email';
                $data['error_string'][] = 'Invalid email format';
                $data['status'] = FALSE;
            }
            if($this->input->post('gender') == '')
            {
                $data['inputerror'][] = 'gender';
                $data['error_string'][] = 'Please select gender';
                $data['status'] = FALSE;
            }
            if($this->input->post('dob') == '')
            {
                $data['inputerror'][] = 'dob';
                $data['error_string'][] = 'Date of Birth is required';
                $data['status'] = FALSE;
            }
            if($this->input->post('mobile') == '')
            {
                $data['inputerror'][] = 'mobile';
                $data['error_string'][] = 'Mobile Number is required';
                $data['status'] = FALSE;
            }
            if($this->input->post('mobile') != '' && !is_numeric($this->input->post('mobile')))
            {
                $data['inputerror'][] = 'mobile';
                $data['error_string'][] = 'Please enter number only';
                $data['status'] = FALSE;
            }
            if($this->input->post('grade_section') == '')
            {
                $data['inputerror'][] = 'grade_section';
                $data['error_string'][] = 'Please select Grade & Section';
                $data['status'] = FALSE;
            }
            if($this->input->post('password') == '' && $this->input->post('type') != 'update')
            {
                $data['inputerror'][] = 'password';
                $data['error_string'][] = 'Password is required';
                $data['status'] = FALSE;
            }
            if($this->input->post('password2') == '' && $this->input->post('type') != 'update')
            {
                $data['inputerror'][] = 'password2';
                $data['error_string'][] = 'Password Confirmation is required';
                $data['status'] = FALSE;
            }

            if($this->input->post('password2') != '' && $this->input->post('password2') != $this->input->post('password') && $this->input->post('type') != 'update')
            {
                $data['inputerror'][] = 'password2';
                $data['error_string'][] = 'Password is not match';
                $data['status'] = FALSE;
            }

            if($data['status'] === FALSE)
            {
                echo json_encode($data);
                exit();
            }
        }

        //Check if exists
        public function check_student_id_exists($student_id){
            if($this->student_model->check_student_id_exists($student_id)){
                return true;
            } else {
                return false;
            }
        }
    }