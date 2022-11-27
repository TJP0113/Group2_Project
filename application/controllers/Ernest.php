<?php
class Ernest extends MY_Controller {

    public function __construct(){

        parent::__construct();   
    }

    public function index(){  
      $this->load->model("Menu_model");
      $this->load->model("Booking_model");
      $this->load->model("Chef_model");


      
      $menu = $this->Menu_model->get_where([
        'is_deleted'=>0
      ]);

      $chef = $this->Chef_model->get_where([
        'is_deleted'=>0
      ]);

      // $booking = $this->Booking_model->get_where([
      //   'member_id' =>$_SESSION['member_id'],
      //   'is_deleted'=>0
      // ]);
      
      $this->data['menu']=$menu;
      $this->data['chef']=$chef;

      // $this->data['booking']=$booking;


    //   $this->load->view("frontend/auth");
      $this->load->view("frontend/header",$this->data);
      $this->load->view("frontend/index" ,$this->data);
      $this->load->view("frontend/footer",$this->data);

    }

    public function add_cart(){
      $menu_title=$this->input->post("menu_title",true);
      $menu_id=$this->input->post("menu_id",true);
      $price=$this->input->post("price",true);
      $qty=$this->input->post("qty",true);


      $this->load->model('Booking_model');

      $booking = $this->Booking_model->insert([
        'booking_name'  => $_SESSION['member_name'],
        'member_id'     => $_SESSION['member_id'],
        'menu_title'    => $menu_title,
        'menu_id'       => $menu_id,
        'price'         => $price,
        'qty'           => $qty
    
      ]);
      redirect(base_url('index'));

    }
    
    public function menu_detail($menu_id){
      
      $this->load->model("Menu_model");

      $menu_detail = $this->Menu_model->get_one([
        
        'menu_id' => $menu_id,


        'is_deleted'=>0,
        

      ]);

      $this->data['menu_detail']=$menu_detail;

      $this->load->view("frontend/header",$this->data);
      $this->load->view("frontend/menu_detail" ,$this->data);
      $this->load->view("frontend/footer",$this->data);



    }



}
?>