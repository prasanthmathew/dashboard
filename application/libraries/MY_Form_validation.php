<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
    function run($module = NULL, $group = '') {
        if (is_object($module)) $this->CI =& $module;
        return parent::run($group);
    }
}

/* End of file MY_Form_validation.php */
/* Location: application/libraries/MY_Form_validation.php */  