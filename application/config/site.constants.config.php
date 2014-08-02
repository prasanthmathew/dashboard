<?php


 /**
 * Site constants
 * @package     ABB Dashboard
 * @subpackage  User Management controller
 * @author	ABB Dashboard Dev team <prasanth.mathew@verbat.com>
 * @copyright   Copyright (c) 2013, Verbat Technologies, Inc.
 * @since	Version 1.0, 16th July 2014
 * @filesource
 */
 
$config['SITE_NAME'] = 'ABB Dashboard'; // Site title
//$config['PATH_SEPERATOR'] = ''; // Site title
//$config['SITE_PATH'] = $_SERVER['DOCUMENT_ROOT'].$config['PATH_SEPERATOR'].'framework'; // Diractory path to the site root

//USER ROLE

$config['ADMIN'] = "ADMIN";
$config['USER'] =  "2";

//ADMIN ASSETS

$config['BACKEND_ASSETS'] = "assets/backend/";

//FRONTEND ASSETS

$config['FRONTEND_ASSETS'] = "assets/frontend/";

//FILE UPLOAD INFO

$config['EXT_ALLOWED_IMAGES'] = 'gif|jpg|png|jpeg';
$config['EXT_ALLOWED_VIDEOS'] = 'mp4|gif|jpg|png|jpeg';
$config['IMAGES_UPLOAD_SIZE'] = '200'; // 2100 KB
$config['VIDEOS_UPLOAD_SIZE'] = '10000'; // 10000 KB
$config['IMAGES_UPLOAD_PATH'] = 'uploads/images/';
$config['VIDEOS_UPLOAD_PATH'] = 'uploads/videos/';

$config['QUARTER_START'] = "1";

//EMAIL CONFIG INFO

$config['SEND_EMAIL_PENDING'] = 'pending';
$config['SEND_EMAIL_COMPLETED'] = 'completed';
$config['EMAIL_FROM_EMAIL'] = 'abbtestfrom@yopmail.com';
$config['EMAIL_FROM_NAME'] = 'testfrom';
$config['EMAIL_ALTERNATE_TO'] = 'abbtestto@yopmail.com';
$config['NOREPLY_EMAIL_FROM_NAME'] =  'noreply';
$config['NOREPLY_EMAIL_ALTERNATE_FROM'] = 'abbnoreplytest@yopmail.com';
$config['FEEDBACK_FROM_NAME'] =  'noreply';
$config['FEEDBACK_FROM_EMAIL'] = 'abbnoreplytest@yopmail.com';
//COPY RIGHT

$config['COPY_RIGHT']  = '&copy; ' . date("Y") . ' All rights reserved. Verbat Technologies';
$config['ENABLE_PROFILER'] = FALSE;

//Permission constants


$permission_data = array(
'MANAGE_USERS'=>1,
'MANAGE_FILE'=>2,
'DASHBOARD'=>3
//'controller name'=>'number',   
        );//set also in the database 

$config['PERMISSION']=$permission_data; 

$config['REGION_PASS_SALT'] = 17;

$opportunity_data = array('Opportunity ID','Opportunity Name','Customer Company','Customer Country','Customer Region','Customer Leading Business Partner Segment','End User Company','End User Country','End User Region','End User Industry Usage','End User Leading Business Partner Segment','Division','Business Unit','Product Group','LBU - Sales Unit 1','Country Code (LBU - Sales Unit 1)','Application','Channel Type','Opportunity Value KUSD (Opportunity_Financial)','Gross Margin % (Opportunity_Financial)','Contract Value KUSD (Opportunity_Financial)','Final Gross Margin% (Opportunity_Financial)','Opportunity Probability','ABB Probability','Expected Award Date','Expected Award Quarter','Opportunity Status','Reason For Lost','Winner','Opportunity Responsible','Created By','Created On','Modified By','Modified On','Currency (Opportunity_Financial)','(opportunityid)');
$activity_data = array('Activity Type','Subject','Regarding','Priority','Activity Status','Start Date','Actual End','Actual Start','Created By','Owner','Last Updated','Customer Company (Regarding)','Customer Country (Regarding)','End User Company (Regarding)','End User Country (Regarding)','Opportunity Name (Regarding)','Country of Employment (Owner)','Division (Owner)','BU (Owner)','Product Group (Owner)','Due Date','Date Created');

$config['opportunity_data'] = $opportunity_data; 
$config['activity_data'] = $activity_data; 
/* End of file site.constants.php */
/* Location: ./application/config/site.constants.php */
