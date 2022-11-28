<?php

require_once APPPATH . 'core/MY_apicontroller.php';
class Api extends MY_apicontroller {

    public function check(){
        $this->json_output(array(
            'result' => "hello",
        ));
    }

    public function register() {

        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

                $name = $this->input->post("name", true);
	            $email = $this->input->post("email", true);
                $mobile = $this->input->post("mobile", true);
                $password = $this->input->post("password", true);                

                if(empty($email)) {
                    throw new Exception("email cannot be blank");
                }
                if(empty($password)) {
                    throw new Exception("password cannot be blank");
                }
                if(empty($name)) {
                    throw new Exception("name cannot be blank");
                }
                if(empty($mobile)) {
                    throw new Exception("mobile cannot be blank");
                }
                

                $this->load->model("Member_model");

                $memberExist = $this->Member_model->get_one([
                    'member_email' => $email,
                    'is_deleted' => 0,
                ]);
                if(!empty($memberExist)) {
                    throw new Exception("Email has already been used");
                }

                $member_id = $this->Member_model->insert([
                    'member_name' => $name,
                    'member_email' => $email,
                    'member_mobile' => $mobile,
                    'member_password' => sha1($password),
                    'created_date' => date("Y-m-d H:i:s"),
                ]);

                //$member_id = 

                $this->json_output(array(
                    'member_id' => $member_id,
                ));

            } else {
                throw new Exception("Invalid param");
            }

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }


    }

    public function login(){

        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

	            $email = $this->input->post("email", true);
                $password = $this->input->post("password", true);
            

                if(empty($email)) {
                    throw new Exception("email cannot be blank");
                }
                if(empty($password)) {
                    throw new Exception("password cannot be blank");
                }
                

                $this->load->model("Member_model");

                $memberData = $this->Member_model->get_one([
                    'member_email' => $email,
                    'member_password' => sha1($password),
                    'is_deleted' => 0,
                ]);
                if(empty($memberData)) {
                    throw new Exception("Invalid Email or password");
                }

                $this->load->model("User_token_model");

                $token = sha1(date("YmdHis")."_".rand(1000,9999));

                $this->User_token_model->insert([
                    'member_id' => $memberData['member_id'],
                    'token' => $token,
                    'created_date' => date("Y-m-d H:i:s"),
                ]);

                $this->json_output(array(
                    'token' => $token,
                ));

            } else {
                throw new Exception("Invalid param");
            }

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }


    }


    public function GetMember($token){

        try {

            $this->load->model("User_token_model");
            $tokenData = $this->User_token_model->get_one([
                        'token' => $token,
                        'is_deleted' => 0,
            ]);
            if(empty($tokenData)) {
                throw new Exception("Invalid Token");
            }

            $this->load->model("Member_model");

            $memberExist = $this->Member_model->get_one([
                'member_id' => $tokenData['member_id'],
                'is_deleted' => 0,
            ]);
            if(empty($memberExist)) {
                throw new Exception("Member ID not exists");
            }

            $this->load->model("Check_out_model");

            $order_detail = $this->Check_out_model->get_where([
                'member_id'=>$memberExist['member_id'],
                'is_deleted' => 0,
            ]);
            $this->load->model("Payment_model");

            foreach($order_detail as $k => $v){

                $data1 = $this->Payment_model->get_where([
                    'bill_id'=>$v['bill_id'],
                    'is_deleted'=>0
                ]);

                $order_detail[$k]['order'] = $data1;
                
            }

            $this->json_output(array(
                'member' => $memberExist,
                'order_detail' => $order_detail,
            ));

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }

    }

    public function GetCart($token){

        try {

            $this->load->model("User_token_model");
            $tokenData = $this->User_token_model->get_one([
                        'token' => $token,
                        'is_deleted' => 0,
            ]);
            if(empty($tokenData)) {
                throw new Exception("Invalid Token");
            }

            $this->load->model("Member_model");

            $memberExist = $this->Member_model->get_one([
                'member_id' => $tokenData['member_id'],
                'is_deleted' => 0,
            ]);
            if(empty($memberExist)) {
                throw new Exception("Member ID not exists");
            }

            $this->load->model("Booking_model");

            $cart = $this->Booking_model->get_where([
                'member_id'=>$memberExist['member_id'],
                'is_deleted' => 0,
            ]);

            $final_amount =0;
            foreach($cart as $c){
            
                $final_amount = $final_amount + $c['quantity'] * $c['menu_price'];
        
            }
            if(!empty($cart)){
            $cart['final_amount']=$final_amount;
            }
            
            
            $this->data['cart']=$cart;

            $this->json_output(array(
                'member' => $memberExist,
                'cart' => $cart,
            ));

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }

    }

    public function Checkout(){

        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

                $token = $this->input->post("token", true);
                $name = $this->input->post("name", true);
                $email = $this->input->post("email", true);
                $mobile = $this->input->post("mobile", true);
                $person_qty = $this->input->post("person_qty", true);
	            $date = $this->input->post("date", true);
                $remark = $this->input->post("remark", true);
                $final_amount = $this->input->post("final_amount", true);

            
                if(empty($token)) {
                    throw new Exception("token cannot be blank");
                }
                
                if(empty($name)) {
                    throw new Exception("name cannot be blank");
                }
                if(empty($email)) {
                    throw new Exception("email cannot be blank");
                }
                if(empty($mobile)) {
                    throw new Exception("mobile cannot be blank");
                }
                if(empty($person_qty)) {
                    throw new Exception("person_qty cannot be blank");
                }
                if(empty($date)) {
                    throw new Exception("date cannot be blank");
                }
                if(empty($remark)) {
                    throw new Exception("remark cannot be blank");
                }
                

                $this->load->model("User_token_model");

                $tokenData = $this->User_token_model->get_one([
                    'token' => $token,
                    
                    'is_deleted' => 0,
                ]);
                if(empty($tokenData)) {
                    throw new Exception("Invalid Token");
                }

                $this->load->model("Member_model");

                $MemberData = $this->Member_model->get_one([
                    'member_id' => $tokenData['member_id'],
                    
                    'is_deleted' => 0,
                ]);

                $this->load->model("Booking_model");

                $booking_detail = $this->Booking_model->get_where([
                    'member_id' => $tokenData['member_id'],
                    
                    'is_deleted' => 0,
                ]);



                $this->load->model('Check_out_model');

                $bill_id = $this->Check_out_model->insert([

        
                    'member_id'=>$MemberData['member_id'],
                    'serial'=>time(),
                    'total_amount'=>$final_amount,
                    'date'=>$date,
                    'person_number'=>$person_qty,
                    'name'=>$name,
                    'email'=>$email,
                    'mobile'=>$mobile,
                    'remark'=>$remark,
                    'is_deleted'=>0,
                    'created_date'=>date('Y-m-d H:i:s')
                   ]);
            
                   foreach($booking_detail as $b){
                        $this->Payment_model->insert([
                        'bill_id'=>$bill_id,
                        'member_id'=>$MemberData['member_id'],
                        'menu_id'=>$b['menu_id'],
                        'menu_title'=>$b['menu_title'],
                        'menu_price'=>$b['menu_price'],
                        'menu_qty'=>$b['quantity'],
                        'is_deleted'=>0,
                        'created_date'=>date('Y-m-d H:i:s')
                
                       ]);
                   }
            
                   
            
                   
            
                   foreach($booking_detail as $v){
            
                        $this->Booking_model->update([
                            'booking_id'=>$v['booking_id']
                        ],[
                            'is_deleted'=>1
                        ]);
                   };

                
                $this->json_output(array(
                    'bill_id' => $bill_id,
                ));

            } else {
                throw new Exception("Invalid param");
            }

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }
    }

    public function GetMenu(){

        try {

            

            $this->load->model("Menu_model");

            $Menulist = $this->Menu_model->get_where([
                
                'is_deleted' => 0,
            ]);

            $this->load->model("Chef_model");

            $Cheflist = $this->Chef_model->get_where([
                
                'is_deleted' => 0,
            ]);

            $this->json_output(array(
                'Menulist' => $Menulist,
                'Cheflist'=>$Cheflist
            ));

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }
    }

    public function GetMenuDetail($menu_id){

        try {

            

            

            $this->load->model("Menu_model");

            $menu_detail = $this->Menu_model->get_one([
                
                'menu_id' => $menu_id,


                'is_deleted'=>0,
                

            ]);

            $this->json_output(array(
                'menu_detail' => $menu_detail,
                
            ));

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }

    }

}?>