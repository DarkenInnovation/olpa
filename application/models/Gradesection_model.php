<?php
 class Gradesection_model extends CI_Model {

     var $column_order = array('id','grade','section',null); //set column field database for datatable orderable
     var $column_search = array('grade','section'); //set column field database for datatable searchable just firstname , lastname , address are searchable
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

         $query = $this->db->get('grade_section');
         return $query->result();
     }

     function get_list()
     {
         $query = $this->db->get('grade_section');
         return $query->result();
     }

     function count_filtered()
     {
         $this->_get_datatables_query();
         $query = $this->db->get('grade_section');
         return $query->num_rows();
     }

     public function count_all()
     {
         $this->db->from('grade_section');  
         return $this->db->count_all_results();
     }

     public function create($data) {
         $this->db->set('time', 'NOW()', FALSE);
         $this->db->set('date', 'NOW()', FALSE);
         $this->db->insert('grade_section', $data);
         return $this->db->insert_id();
     }

     public function get_by_id($id){
         $this->db->where('id',$id);
         $query = $this->db->get('grade_section');
         return $query->row();
     }

     public function update($where, $data)
     {
         $this->db->update('grade_section', $data, $where);
         return $this->db->affected_rows();
     }
 }