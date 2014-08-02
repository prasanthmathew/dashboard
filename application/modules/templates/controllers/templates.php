<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Templates extends MX_Controller {

    public function __construct() {

        parent::__construct();
        //$this->load->model('example_model');
        
    }

    public function admin_template($data = NULL) {
        
        //echo "Example module loaded";
        if($data==NULL){ $this->load->view('admin_template_view');}else{ $this->load->view('admin_template_view',$data);}
       
    }
    
    public function login_template($data = NULL) {
        
        //echo "Example module loaded";
        if($data==NULL){ $this->load->view('login_template_view');}else{ $this->load->view('login_template_view',$data);}
       
    }
	
	public function frontend_template($data = NULL) {
        
        //echo "Example module loaded";
        if($data==NULL){ $this->load->view('frontend_template_view');}else{ $this->load->view('frontend_template_view',$data);}
       
    }

}

/* End of file example.php */
/* Location: ./application/controllers/example.php */