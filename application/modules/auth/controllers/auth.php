<?php

/**
 * User Management
 * @package     247 LAW
 * @subpackage  User Management controller
 * @author	247 Dev team <aravind.m@yukoglobal.com,prasanth.mathew@yukoglobal.com>
 * @copyright   Copyright (c) 2013, Yuko Global Technologies, Inc.
 * @license	www.yukoglobal.com/user_guide/license.html
 * @since	Version 1.0, 16th July 2013
 * @filesource
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends MX_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        //$this->load->model('auth_model');
        $this->load->library('ion_auth');
        $this->load->helper('language');
        $this->load->helper('url');
        $this->load->helper('string');
        $this->load->helper('email');
        $this->load->helper('form');
    }

    //log the user in
    function login() {
        $this->data['title'] = "Login";

        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert_pad">', '<a class="close" href="#" data-dismiss="alert">&times;</a></div>');

        if ($this->form_validation->run() == true) {
            //check to see if the user is logging in
            //check for "remember me"
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the home page                
                $this->ci_alerts->set('success', $this->ion_auth->messages());
                redirect('/', 'refresh');
            } else {
                //if the login was un-successful
                //redirect them back to the login page
                $this->ci_alerts->set('error', $this->ion_auth->errors());
                redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            //the user is not logging in so display the login page
            //set the flash data error message if there is one
            $this->data['message'] =  validation_errors();       

            //validation_errors() == "" ? "" : $this->ci_alerts->set('error', validation_errors());
            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
                'class' => 'form-control',
            );
            $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
            );

            echo Modules::run('templates/login_template', $this->data, true);
        }
    }

    function forgot_password() {
        if ($this->ion_auth->logged_in()) {
            //$this -> ci_alerts -> set('error', $this -> ion_auth -> errors());
            redirect('dashboard');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('forget_pass_view');
        } else {
            // get identity for that email
            $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            if (empty($identity)) {

                $this->ci_alerts->set('error', 'Entered email not found in our database');
                redirect("auth/forgot_password");
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                //if there were no errors
                //$this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->ci_alerts->set('success', 'A mail with password reset link is send to your Email ID');
                redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                //$this->session->set_flashdata('message', $this->ion_auth->errors());
                $this->ci_alerts->set('error', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }
        }
    }

    function change_password() {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
            //display the form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
            );
            $this->data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
            );

            //render
            $this->_render_page('auth/change_password', $this->data);
        } else {
            $identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/change_password', 'refresh');
            }
        }
    }

    /**
     * Logout process
     */
    public function logout() {
        //log the user out
        $this->ion_auth->logout();
        $this->ci_alerts->set('success', 'Sucessfully Logged out.');
        //$redirect_to_site = TRUE;
        redirect('auth/login', 'refresh');
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
