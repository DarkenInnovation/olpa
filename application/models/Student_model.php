<?php
    class Student_model extends CI_Model{

        public function __construct()
        {
            $this->load->database();
        }

        var $column_order = array('id','student_id','lastname','email','gender','dob','mobile','grade_section_id',null); //set column field database for datatable orderable
        var $column_search = array('student_id','firstname','middlename','lastname','email','gender','dob','mobile','grade_section_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        var $order = array('id' => 'desc'); // default order

        private function _get_datatables_query()
        {
            $i = 0;

            foreach ($this->column_search as $item) // loop column
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {

                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }

            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables()
        {
            $this->_get_datatables_query();
            if($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);

            $this->db->select('student.*', FALSE);
            $this->db->select('grade_section.grade, grade_section.section', FALSE);
            $this->db->join('grade_section', 'student.grade_section_id = grade_section.id');
            $query = $this->db->get('student');
            return $query->result();
        }



        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get('student');
            return $query->num_rows();
        }

        public function count_all()
        {
            $this->db->from('student');
            return $this->db->count_all_results();
        }

        public function create($data) {
            $this->db->insert('student', $data);
            return $this->db->insert_id();
        }

        public function get_by_id($id){
            $this->db->where('id',$id);
            $query = $this->db->get('student');
            return $query->row();
        }

        public function update($where, $data)
        {
            $this->db->update('student', $data, $where);
            return $this->db->affected_rows();
        }

        function get_list()
        {
            $query = $this->db->get('student');
            return $query->result();
        }

        //check username exists
        public function check_student_id_exists($student_id){
            $query = $this->db->get_where('student', array(
                'student_id' => $student_id
            ));
            if(empty($query->row_array())){
                return true;
            } else {
                return false;
            }
        }
    }