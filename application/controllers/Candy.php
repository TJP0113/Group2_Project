<?php
class Candy extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();
    }

    public function signup()
    {
        $this->load->view("frontend/header");
        $this->load->view("frontend/signup");
        //$this->load->view("frontend/footer");


    }

    public function signup_submit()
    {

        $pagetitle = "Registration";
        $this->load->model('Member_model');

        $member_name = $this->input->post('member_name', true);
        $member_email = $this->input->post('member_email', true);
        $member_mobile = $this->input->post('member_mobile', true);
        $member_password = $this->input->post('member_password', true);
        $created_date = date('Y-m-d H:i:s');
        $modified_date = date('Y-m-d H:i:s');



        // define new user data not same as previous user data


        $member_data = $this->Member_model->get_where([
            "is_deleted" => 0
        ]);

        foreach ($member_data as $i) {
            if ($i['member_email'] == $member_email || $i['member_password'] == $member_password) {
                redirect(base_url('signup?errorMessage'));
            } 
        }


        $this->Member_model->insert([
            "member_name" => $member_name,
            "member_email" => $member_email,
            "member_mobile" => $member_mobile,
            "member_password" => $member_password,
            "created_date" => date('Y-m-d H:i:s')

        ]);

        redirect(base_url("login"));
    }


    public function login()
    {

        $this->load->view("frontend/header");
        $this->load->view("frontend/login");
        //$this->load->view("frontend/footer");


    }

    public function login_submit()
    {

        $member_email    = $this->input->post("member_email", true);
        $member_password       = $this->input->post("member_password", true);
        // $remember   = $this->input->post("remember", true);
        // if (!empty($remember)) {
        //     $this->load->helper('cookie');
        //     set_cookie('member_email', $member_email, 30 * 24 * 3600);
        //     set_cookie('member_password', $member_password, 30 * 24 * 3600);
        // }

        $this->load->model("Member_model");

        $memberData = $this->Member_model->get_one([
            'member_email'         => $member_email,
            'member_password'           => $member_password,
            'is_deleted'    => 0,
        ]);


        if (!empty($memberData)) {
            $_SESSION['member_name'] = $memberData['member_name'];
            $_SESSION['member_id'] = $memberData['member_id'];

            redirect(base_url("index"));
        } else {
            redirect(base_url('login'));
        }
    }

    public function signout()
    {

        redirect(base_url('login'));
    }
}
