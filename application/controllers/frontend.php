<?php
class Backend extends MY_Controller {

    public function index(){

      $this->load->view("frontend/auth");
      $this->load->view("frontend/header");
      $this->load->view("frontend/index");
      $this->load->view("frontend/footer");

    }

}
?>