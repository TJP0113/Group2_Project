<?php
class MY_Model extends CI_Model {

    protected $table_name = "blog";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function record_count($where=[]){

        //SELECT * FROM 
        $this->db->select("count(*) AS total");

        $this->db->where($where);
        $query = $this->db->get($this->table_name);
        $row = $query->row_array();
        $total = !empty($row['total'])?$row['total']:0;
        return $total;

    }

    //SELECT * FROM blog WHERE is_deleted = 0 LIMIT 0,10
    public function fetch($where=[], $limit=10, $start=0, $order_by="", $ascdesc=""){

        if(!empty($order_by)) {

            //ORDER BY xxxx ASC / DESC
            $this->db->order_by($order_by, $ascdesc);

        }

        $this->db->limit($limit, $start);
        $this->db->where($where);
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function get_where($where=[]){

        $this->db->where($where);
        $query = $this->db->get($this->table_name);
        return $query->result_array();

    }

    public function get_one($where=[]) {

        $this->db->where($where);
        $query = $this->db->get($this->table_name);
        return $query->row_array();

    }    

    public function insert($insert_array=[]) {
        
        $this->db->insert($this->table_name, $insert_array);
        return $this->db->insert_id();

    }

    public function update($where=[], $update_array=[]) {

        $this->db->where($where);    
        $this->db->update($this->table_name, $update_array);

    }


    public function softdelete($where=[]) {

        $this->update($where,['id_deleted'=>1,'modified_date'=>date("Y-m-d H:i:s")]);
        
    }

    public function get_like($where=[],$like=[]) {

        
        $this->db->like($where);
        $query = $this->db->get($this->table_name);
        return $query->result_array();

    }    

}
?>