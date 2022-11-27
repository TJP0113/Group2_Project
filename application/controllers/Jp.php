<?php
class Jp extends MY_Controller {

    public function __construct(){

        parent::__construct();

        
        
        
        

    }

    public function member_portal(){

        
        $this->load->model('Member_model');
        $this->load->model('Check_out_model');
        $this->load->model('Payment_model');

        if(!empty($_SEESION['member_id'])){

            $member = $this->Member_model->get_one([

                'member_id'=>$_SESSION['member_id'],
                'is_deleted'=>0
            ]);

            $this->data['member'] = $member;

            

            $data = $this->Check_out_model->get_where([

                'member_id'=>$_SESSION['member_id'],
                
                'is_deleted'=>0
            ]);


            if(!empty($data)){


                foreach($data as $k => $v){

                    $data1 = $this->Payment_model->get_where([
                        'payment_id'=>$v['payment_id'],
                        'id_deleted'=>0
                    ]);

                    $data[$k]['order'] = $data1;
                    
                }
            }

            $this->data['data'] = $data;

        }

        




        $this->load->view('frontend/header');
        $this->load->view('frontend/member_portal',$this->data);
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
        $one=$this->input->post("one",true);



        $cheft_name=$this->input->post("cheft_name",true);
        $cheft_img=$this->input->post("cheft_img",true);
        $cheft_type=$this->input->post("cheft_type",true);
        $FB_link=$this->input->post("FB_link",true);
        $IG_link=$this->input->post("IG_link",true);
        $TWINTTER_link=$this->input->post("TWINTTER_link",true);
        $two=$this->input->post("two",true);


        $table_name=$this->input->post("table_name",true);
        $type=$this->input->post("type",true);
        $max_person=$this->input->post("max_person",true);
        $min_person=$this->input->post("min_person",true);
        $three=$this->input->post("three",true);
       



        $this->load->model('Member_model');
        $this->load->model('Chef_model');
        $this->load->model('Table_model');

        if(!empty($one)){

            $this->Member_model->insert([
                'name'=>$name,
                'email'=>$email,
                'mobile'=>$mobile,
                'password'=>$password,
                'is_deleted'=>0,
                'created_date'=>date("Y-m-d H:i:s")

            ]);

        }

        if(!empty($two)){

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
        
    
        }
            if(!empty($three)){
                $this->Table_model->insert([
                    
                    'table_name'=>$table_name,
                    'type'=>$type,
                    'max_person'=>$max_person,
                    'min_person'=>$min_person,
                    'is_deleted'=>0,
                    'created_date'=>date("Y-m-d H:i:s")

                ]);

                
            }

            redirect(base_url('adddetail'));

    }       

    public function checkout(){

        $this->load->model('Booking_model');
        $this->load->model('Member_model');

        $member_data = $this->Member_model->get_one([
            'member_id'=>$_SESSION['member_id'],
            'is_deleted'=>0
        ]);

        $booking_deteil = $this->Booking_model->get_where([
            'member_id'=>$_SESSION['member_id'],
            'is_deleted'=>0
        ]);

        foreach($booking_deteil as $v){
            $total_amount = $v['price'] * $v['qty'];
            $final_amount = $final_amount += $total_amount;

            $booking_dateil['total_amount'] = $total_amount;
            
        };
        $this->data['final_amount'] = $final_amount;

        $this->data['booking_detail'] = $booking_dateil;
        $this->data['member_data'] = $member_data;

        $this->load->view('frontend/header',$this->data);
        $this->load->view('frontend/checkout',$this->data);
        $this->load->view('frontend/footer',$this->data);

    }

    public function checkout_submit(){

       $name = $this->load->input('name',true);
       $email = $this->load->input('email',true);
       $mobile = $this->load->input('mobile',true);
       $payment_id = $this->load->input('payment_id',true);
       $qty = $this->load->input('qty',true);
       $date = $this->load->input('date',true);
       $remark = $this->load->input('remark',true);
       $final_amount = $this->load->input('final_amount',true);


       $this->load->model('Booking_model');
       $this->load->model('Payment_model');
       $this->load->model('Check_out_model');

       $booking_deteil = $this->Booking_model->get_where([
        'member_id'=>$_SESSION['member_id'],
        'is_deleted'=>0
       ]);

       $payment_id = $this->Payment_model->insert([

        'member_id'=>$_SESSION['member-id'],
        'menu_id'=>$booking_deteil['menu_id'],
        'menu_title'=>$booking_deteil['menu_title'],
        'menu_price'=>$booking_deteil['menu_price'],
        'menu_qty'=>$booking_deteil['menu_qty'],
        'is_deleted'=>0,
        'created_date'=>date('Y-m-d H:i:s')

       ]);

       $this->Check_out_model->insert([

        'payment_id'=>$payment_id,
        'member_id'=>$_SEESION['member_id'],
        'serial'=>time(),
        'total_amount'=>$final_amount,
        'date'=>$date,
        'person_number'=>$qty,
        'name'=>$name,
        'email'=>$email,
        'mobile'=>$mobile,
        'remark'=>$remark,
        'is_deleted'=>0,
        'created_date'=>date('Y-m-d H:i:s')
       ]);

       foreach($booking_deteil as $v){

            $this->Booking_model->update([
                'booking_id'=>$v['booking_id']
            ],[
                'is_deleted'=>1
            ]);
       };

       redirect(base_url('thank'));
       
    }

    public function thank(){

        $this->load->view('frontend/header');
        $this->load->view('frontend/thank');
        $this->load->view('frontend/footer');
    
    }

    public function member_edit_submit(){

        $name = $this->load->input('name',true);
        $email = $this->load->input('email',true);
        $mobile = $this->load->input('mobile',true);

        $this->load->model('Member_model');

        if(!empty($name)){
            $this->Member_model->update([
                'member_id'=>$_SESSION['member_id']
            ],[
                'member_name'=> $name,
                'modified_date'=>date('Y-m-d H:i:s')
            ]);
        }
        if(!empty($email)){
            $this->Member_model->update([

                'member_id'=>$_SESSION['member_id']
            ],[
                'member_email'=> $email,
                
                'modified_date'=>date('Y-m-d H:i:s')
            ]);
        }
        if(!empty($mobile)){
            $this->Member_model->update([

                'member_id'=>$_SESSION['member_id']
            ],[
                'member_mobile'=> $mobile,
                
                'modified_date'=>date('Y-m-d H:i:s')
            ]);
        }

        redirect(base_url('thank?updatesucess'));
    
    }

    public function checkout_delete($id){
        $this->load->model('Booking_model');

        $this->Booking_model->update([
            'menu_id'=>$id
        ],[
            'is_deleted'=>1
        ]);

        redirect(base_url('checkout'));
    }
    

}
?>