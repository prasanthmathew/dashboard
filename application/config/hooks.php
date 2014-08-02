<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	http://codeigniter.com/user_guide/general/hooks.html
  |
 */

$hook['post_controller'] = array(
    'class' => 'MY_Profiler',
    'function' => 'enable',
    'filename' => 'profiler.php',
    'filepath' => 'hooks'
);

$hook['pre_controller'][] = array(
    'class' => 'ExceptionHook',
    'function' => 'SetExceptionHandler',
    'filename' => 'ExceptionHook.php',
    'filepath' => 'hooks'
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */