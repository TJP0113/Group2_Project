<?php
class Jp extends MY_Controller {

    public function __construct(){

        parent::__construct();

        
        
        
        

    }

    public function member_portal(){






        $this->load->view('frontend/header');
        $this->load->view('frontend/member_portal');
        $this->load->view('frontend/footer');
    }

    public function adddetail(){

        
        $this->load->view('frontend/adddetail');
        
    }

    public function adddetail_submit(){


        $name=$this->input->post("name",true);
        $email=$this->input->post("email",true);
        $mobile=$this->input->post("mobile",true);
        $password=$this->input->post("password",true);




        $cheft_name=$this->input->post("cheft_name",true);
        $cheft_img=$this->input->post("cheft_img",true);
        $cheft_type=$this->input->post("cheft_type",true);
        $FB_link=$this->input->post("FB_link",true);
        $IG_link=$this->input->post("IG_link",true);
        $TWINTTER_link=$this->input->post("TWINTTER_link",true);


        $table_name=$this->input->post("table_name",true);
        $type=$this->input->post("type",true);
        $max_person=$this->input->post("max_person",true);
        $min_person=$this->input->post("min_person",true);
       



        $this->load->model('Member_model');
        $this->load->model('Chef_model');
        $this->load->model('Table_model');

        $this->Member_model->insert([
            'name'=>$name,
            'email'=>$email,
            'mobile'=>$mobile,
            'password'=>$password,
            'is_deleted'=>0,
            'created_date'=>date("Y-m-d H:i:s")

        ]);

        $this->Chef_model->insert([
            'cheft_name'=>$cheft_name,
            'cheft_img'=>$cheft_img,
            'cheft_type'=>$cheft_type,
            'FB_link'=>$FB_link,
            'IG_link'=>$IG_link,
            'TWINTTER_link'=>$TWINTTER_link,
            'is_deleted'=>0,
            'created_date'=>date("Y-m-d H:i:s")

        ]);


        $this->Table_model->insert([
            
            'table_name'=>$table_name,
            'type'=>$type,
            'max_person'=>$max_person,
            'min_person'=>$min_person,
            'is_deleted'=>0,
            'created_date'=>date("Y-m-d H:i:s")

        ]);

        redirect(base_url('adddetail'));
    }

    

}
?>