<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Custom_error extends MX_Controller {

    public function __construct() {

        parent::__construct();       
        
    }

    /*
     * Dashboard Implementation
     */
    public function error404Page() {       
        
        $data['title'] = "Page Not Found";
        $data['change_pass_model'] = $this->load->view('templates/admin_change_pass_view', '', true);
        $data['main_content'] = $this->load->view('404_view', $data, true);
        echo Modules::run('templates/admin_template', $data);        
    }
    
}

/* End of file example.php */
/* Location: ./application/controllers/example.php */