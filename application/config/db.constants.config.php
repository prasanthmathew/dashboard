<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Local server Data Base configuration
 * 
 * @package		ABB Dashboard
 * @author		Prasanth Mathew <prasanth.mathew@verbat.com>
 * @copyright           Copyright (c) 2014, Verbat Techonologies, Inc.
 * @license		www.verbat.com//user_guide/license.html
 * @since		Version 1.0
 * @filesource
 */


//TABLE INFO


$database_tables = array(
    'HOSTNAME' => 'localhost',
    'USERNAME' => 'root',
    'PASSWORD' => '',
    'DATABASE' => 'dashboard',
    'TBL_AAUTH_GROUPS' => 'abb_groups',
    'TBL_AAUTH_PERM_TO_GROUP_LANGUAGES' => 'abb_perm_to_group',
    'TBL_AAUTH_PERMS' => 'abb_perms',
    'TBL_AAUTH_PM' => 'abb_pm',
    'TBL_AAUTH_USER_TO_GROUP' => 'abb_user_to_group',
    'TBL_AAUTH_USERS' => 'abb_users',
    'TBL_FILEUPLOAD_MASTER' => 'abb_fileupload_details',
    'TBL_OPPORTUNITY_DUMP' => 'abb_opportunity_dump',
    'TBL_OPPORTUNITY' => 'abb_opportunity',
    'TBL_ACTIVITY_DUMP' => 'abb_activities_dump',
    'TBL_ACTIVITY' => 'abb_activity',
    'TBL_REGION' => 'abb_region',
    'TBL_COUNTRY' => 'abb_country',
    'TBL_CUSTOMER_VISIT' => 'abb_target_setting_activity',
    'TBL_FINANCIAL_TARGET' => 'abb_target_setting_budget',
);

$config['DB_TABLES'] = $database_tables;

/* End of file db.constants.php */
/* Location: ./application/config/db.constants.php */