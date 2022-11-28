<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_apicontroller extends CI_Controller {

    public $data = array();

    public function __construct() {
            parent::__construct();
        
            $this->data['starttime'] = microtime(true);
            header('Content-Type: application/json; charset=utf-8');
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

            $this->selfConstruct();
    }

    public function selfConstruct(){

	}
	

	public function sampleCode(){

		header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

	            

                $this->json_output(array(
                    'token' => $token,
                    'expired_date' => time()+7*24*3600,
                ));

            } else {
                throw new Exception("Invalid param");
            }

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }


	}

    //成功讀取
    protected function json_output($result){
    	$this->data['endtime'] = microtime(true);
    	$timediff = ($this->data['endtime'] - $this->data['starttime']);
    	header('Content-Type: application/json; charset=utf-8');
		header("Access-Control-Allow-Origin: *");
    	echo json_encode(array(
    		'status'	=> "OK",
    		'result'	=> $result,
    		'comment'	=> "",
    		'duration'	=> $timediff,
    	));
    }

    //如果出現錯誤就用這個
    protected function json_output_error($result){
    	$this->data['endtime'] = microtime(true);
    	$timediff = ($this->data['endtime'] - $this->data['starttime']);
    	header('Content-Type: application/json; charset=utf-8');
		header("Access-Control-Allow-Origin: *");
    	echo json_encode(array(
    		'status'	=> "ERROR",
    		'result'	=> $result,
    		'comment'	=> "",
    		'duration'	=> $timediff,
    	));
    }

}
?>
