<?php
 class Candidate_model extends CI_Model {

     var $table = 'candidate';
     var $column_order = array('id','student_id','position_id','party_id','time_added','date_added',null); //set column field database for datatable orderable
     var $column_search = array('title'); //set column field database for datatable searchable just firstname , lastname , address are searchable
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

         $this->db->select('candidate.*', FALSE);
         $this->db->select('student.student_id as student_id_number, student.firstname, student.lastname', FALSE);
         $this->db->select('position.name as position', FALSE);
         $this->db->select('partylist.name as partylist', FALSE);
         $this->db->join('student', 'candidate.student_id = student.id');
         $this->db->join('position', 'candidate.position_id = position.id');
         $this->db->join('partylist', 'candidate.partylist_id = partylist.id');
         $this->db->where('candidate.status','active');
         $query = $this->db->get($this->table);
         return $query->result();
     }


     function count_filtered()
     {
         $this->_get_datatables_query();
         $query = $this->db->get($this->table);
         return $query->num_rows();
     }

     public function count_all()
     {
         $this->db->from($this->table);
         return $this->db->count_all_results();
     }

     public function create($data) {
         $this->db->set('time', 'NOW()', FALSE);
         $this->db->set('date', 'NOW()', FALSE);
         $this->db->insert($this->table, $data);
         return $this->db->insert_id();
     }

     public function get_by_id($id){
         $this->db->select('candidate.*', FALSE);
         $this->db->select('student.student_id as student_id_number, student.firstname, student.lastname', FALSE);
         $this->db->select('position.name as position', FALSE);
         $this->db->select('partylist.name as partylist', FALSE);
         $this->db->join('student', 'candidate.student_id = student.id');
         $this->db->join('position', 'candidate.position_id = position.id');
         $this->db->join('partylist', 'candidate.partylist_id = partylist.id');
         $this->db->where('candidate.id',$id);
         $this->db->where('candidate.status','active');
         $query = $this->db->get($this->table);
         return $query->row();
     }

     public function update($where, $data)
     {
         $this->db->update($this->table, $data, $where);
         return $this->db->affected_rows();
     }

     //check username exists
     public function check_student_id_exists($student_id){
         $query = $this->db->get_where($this->table, array(
             'student_id' => $student_id,
             'status' => 'active'
         ));
         if(empty($query->row_array())){
             return true;
         } else {
             return false;
         }
     }
 }