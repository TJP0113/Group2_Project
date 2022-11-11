<?php
class frontend extends MY_Controller {

    public function __construct(){

        parent::__construct();

        
        
        
        

    }

    public function index(){

    //   $this->load->view("frontend/auth");
      $this->load->view("frontend/header");
      $this->load->view("frontend/index");
      $this->load->view("frontend/footer");

    }

}
?>