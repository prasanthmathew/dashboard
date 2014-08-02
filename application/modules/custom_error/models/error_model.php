<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends MY_Model  {  
    
   public $_table = '';

    function __construct() {
       parent::__construct();
       
       $this->opp_table = $this->config->item('TBL_OPPORTUNITY','DB_TABLES');
       $this->act_table = $this->config->item('TBL_ACTIVITY','DB_TABLES');
       $this->visit_table = $this->config->item('TBL_CUSTOMER_VISIT','DB_TABLES');
       $this->budget_table = $this->config->item('TBL_FINANCIAL_TARGET','DB_TABLES');
       
       $this->current_year = date('Y');
       $this->current_month = date('m');
       
       $start = $this->config->item('QUARTER_START');
       $curqrt = (($this->current_month - $start)/3)+1;
       $quart = 'Q'.$curqrt.'-'.$this->current_year;
       $this->current_quarter = $quart;
    }
    
    /**
     *  Calculate Opportunities - Orders Booked YTD
     */
    function getData_booked_ytd(){
        $data = 0;
            $this->db->select("SUM(contract_value) AS summary");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data = $row->summary;
            }
            if($data == "")
             $data = 0;
        return $data;
    }
    
    /**
     *  Calculate Opportunities - Orders Booked Current month
     */
    function getData_booked_curmonth(){
        $data = 0;
            $this->db->select("SUM(contract_value) AS summary");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('month(expected_award_date)', $this->current_month);
            $this->db->from($this->opp_table);
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data = $row->summary;
            }
            if($data == "")
             $data = 0;
        return $data;
    }
    
    /**
     *  Calculate Opportunities - Orders Booked Current Quarter
     */
    function getData_booked_curquart(){
        $data = 0;
                        
            $this->db->select("SUM(contract_value) AS summary");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('expected_award_quarter', $this->current_quarter);
            $this->db->from($this->opp_table);
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data = $row->summary;
            }
            if($data == "")
             $data = 0;
        return $data;
    }
    
    /**
     *  Calculate Opportunities - Orders Lost YTD
     */
    function getData_lost_ytd(){
        $data = 0;
            $this->db->select("SUM(contract_value) AS summary");
            $this->db->where('opportunity_status', 'Lost');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data = $row->summary;
            }
            if($data == "")
             $data = 0;
        return $data;
    }
    
    /**
     *  Get Opportunities - Top 6 Orders Booked 
     */
    function getData_booked_top(){
        $data = array();
            $this->db->select("TOP 6 opportunity_name,product_group,country_code,contract_value");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $this->db->order_by("contract_value", "desc"); 
            //$this->db->limit(6);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            }
        return $data;
    }
    
     /**
     *  Get Opportunities - Top 5 Orders Lost 
     */
    function getData_lost_top(){
        $data = array();
            $this->db->select("TOP 5 opportunity_name,product_group,country_code,contract_value");
            $this->db->where('opportunity_status', 'Lost');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $this->db->order_by("contract_value", "desc"); 
            //$this->db->limit(5);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            }
        return $data;
    }
    
     /**
     *  Data To Generate Opportunities Order Booked Pie Chart - Orders By ProductGroup By Year 
     */
    function pie_bookedorders_productgroup_year(){
        $data = array();
            $this->db->select("SUM(contract_value) AS summary,product_group");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $this->db->group_by("product_group"); 
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
        return $data;
    }
    
    /**
     *  Data To Generate Opportunities Order Booked Pie Chart - Orders By ProductGroup By Month 
     */
    function pie_bookedorders_productgroup_month(){
        $data = array();
            $this->db->select("SUM(contract_value) AS summary,product_group");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('month(expected_award_date)', $this->current_month);
            $this->db->from($this->opp_table);
            $this->db->group_by("product_group"); 
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
        return $data;
    }
    
    /**
     *  Data To Generate Opportunities Order Booked Pie Chart - Orders By ProductGroup By Quarter 
     */
    function pie_bookedorders_productgroup_quarter(){
        $data = array();
            $this->db->select("SUM(contract_value) AS summary,product_group");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('expected_award_quarter', $this->current_quarter);
            $this->db->from($this->opp_table);
            $this->db->group_by("product_group"); 
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
        return $data;
    }
    
    /**
     *  Data To Generate Opportunities Order Booked Pie Chart - Orders By Segment By Year 
     */
    function pie_bookedorders_segment_year(){
        $data = array();
            $this->db->select("SUM(contract_value) AS summary,enduser_industry_usage");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $this->db->group_by("enduser_industry_usage"); 
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
        return $data;
    }
    
    /**
     *  Data To Generate Opportunities Order Booked Pie Chart - Orders By Segment By Month 
     */
    function pie_bookedorders_segment_month(){
        $data = array();
            $this->db->select("SUM(contract_value) AS summary,enduser_industry_usage");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('month(expected_award_date)', $this->current_month);
            $this->db->from($this->opp_table);
            $this->db->group_by("enduser_industry_usage"); 
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
        return $data;
    }
    
    /**
     *  Data To Generate Opportunities Order Booked Pie Chart - Orders By Segment By Quarter 
     */
    function pie_bookedorders_segment_quarter(){
        $data = array();
            $this->db->select("SUM(contract_value) AS summary,enduser_industry_usage");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('expected_award_quarter', $this->current_quarter);
            $this->db->from($this->opp_table);
            $this->db->group_by("enduser_industry_usage"); 
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
        return $data;
    }
    
    /**
     *  Data To Generate Opportunities Order Booked Pie Chart - Orders By Channel By Year 
     */
    function pie_bookedorders_channel_year(){
        $data = array();
            $this->db->select("SUM(contract_value) AS summary,channel_type");
            $this->db->where('opportunity_status', 'Order Booked');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $this->db->group_by("channel_type"); 
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
        return $data;
    }
    
    /**
     *  Data To Generate Opportunities Order Lost Pie Chart - Orders By ProductGroup By Year 
     */
    function pie_lostorders_productgroup_year(){
        $data = array();
            $this->db->select("SUM(contract_value) AS summary,product_group");
            $this->db->where('opportunity_status', 'Lost');
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $this->db->group_by("product_group");
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
        return $data;
    }
    
    /**
     *  Calculate Activities - Customer Visits By Month
     */
    function act_customer_visit(){
        $data = 0;
            $this->db->select("COUNT(act_id) AS custcount");
            $this->db->where('activity_type', 'Appointment');
            $this->db->where('activity_status', 'Completed');
            $this->db->where('year(actual_end)', $this->current_year);
            $this->db->where('month(actual_end)', $this->current_month);
            $this->db->from($this->act_table);
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data = $row->custcount;
            }
            if($data == "")
             $data = 0;
            
        return $data;
    }
    
    /**
     *  Calculate Activities - Best Top 3 FES By Customer Visits 
     */
    function act_customer_best(){
        $data = array();
            $this->db->select("TOP 3 owner,COUNT(act_id) AS custcount");
            $this->db->where('activity_type', 'Appointment');
            $this->db->where('activity_status', 'Completed');
            $this->db->where('year(actual_end)', $this->current_year);
            $this->db->where('month(actual_end)', $this->current_month);
            $this->db->from($this->act_table);
            $this->db->group_by("owner");
            $this->db->order_by("custcount","desc");
            //$this->db->limit(3,1);
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }       
            
        return $data;
    }
    
    /**
     *  Calculate Activities - Worst Top 3 FES By Customer Visits 
     */
    function act_customer_worst(){
        $data = array();
            $this->db->select("TOP 3 owner,COUNT(act_id) AS custcount");
            $this->db->where('activity_type', 'Appointment');
            $this->db->where('activity_status', 'Completed');
            $this->db->where('year(actual_end)', $this->current_year);
            $this->db->where('month(actual_end)', $this->current_month);
            $this->db->from($this->act_table);
            $this->db->group_by("owner");
            $this->db->order_by("custcount","asc");
            //$this->db->limit(3);
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            } 
            
        return $data;
    }
    
    /**
     *  Data To Generate Activities Line/Bar Chart - Customer Visits 
     */
    function act_customer_month(){
         for($l=1;$l<=12;$l++){
             $data[$l] = 0;
         }
        
            $this->db->select("COUNT(act_id) AS custcount,month(actual_end) AS mnt");
            $this->db->where('activity_type', 'Appointment');
            $this->db->where('activity_status', 'Completed');
            $this->db->where('year(actual_end)', $this->current_year);
            $this->db->from($this->act_table);
            $this->db->group_by("month(actual_end)");
            $this->db->order_by("month(actual_end)","asc");
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[$row->mnt] = $row->custcount;
            }
            $dta = implode(',',$data);
            
        return $dta;
    }
    
    /**
     *  Data To Generate Opportunities Pipeline Analysis Pie Chart By Product Group
     */
    function pie_pipeline_productgroup_year(){
        $data = array();
            $opp_status = array('Budget Proposal Submitted', 'Lead', 'LOI Received', 'Tender Preparation', 'Early Pursuit', 'FEED', 'Tender Submitted', 'Tender On Hold', 'RFQ Issued', 'Pre Tender');      
            $this->db->select("SUM(contract_value) AS summary,product_group");      
            $this->db->where_in('opportunity_status', $opp_status);
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $this->db->group_by("product_group");
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
        return $data;
    }
    
    /**
     *  Calculate Pipeline Analysis - Prosales in total
     */
    function prosale_pipeline(){
        $pro_sum  =0;$op_val = 0;$con_val=0;
            $this->db->select("opportunity_value,contract_value"); 
            $this->db->where('year(expected_award_date)>=', $this->current_year);
            $this->db->from($this->opp_table);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $op_val = $row->opportunity_value;
                $con_val = $row->contract_value;
                if($con_val != ""){
                    $pro_sum +=$con_val;
                }else{
                    $pro_sum +=$op_val;
                }
                
            }
            return $pro_sum;
    }
    
    /**
     *  Calculate Pipeline Analysis - Prosales in current year
     */
    function prosale_pipeline_year(){
        $pro_sum  =0;$op_val = 0;$con_val=0;
            $this->db->select("opportunity_value,contract_value"); 
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $op_val = $row->opportunity_value;
                $con_val = $row->contract_value;
                if($con_val != ""){
                    $pro_sum +=$con_val;
                }else{
                    $pro_sum +=$op_val;
                }
                
            }
            return $pro_sum;
    }
    
    /**
     *  Calculate Pipeline Analysis - Prosales in current month
     */
    function prosale_pipeline_month(){
        $pro_sum  =0;$op_val = 0;$con_val=0;
            $this->db->select("opportunity_value,contract_value"); 
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('month(expected_award_date)', $this->current_month);
            $this->db->from($this->opp_table);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $op_val = $row->opportunity_value;
                $con_val = $row->contract_value;
                if($con_val != ""){
                    $pro_sum +=$con_val;
                }else{
                    $pro_sum +=$op_val;
                }
                
            }
            return $pro_sum;
    }
    
    /**
     *  Calculate Pipeline Analysis - Overdue Opportunities
     */
    function overdue_pipeline(){
            $pro_sum  =0;$op_val = 0;$con_val=0;
            $opp_status = array('Order Booked', 'Lost', 'Order Cancelled', 'Opportunity Cancelled', 'Cancelled Alternative', 'Taken over by another ABB unit');      
            $this->db->select("opportunity_value,contract_value");
            $this->db->where_not_in('opportunity_status', $opp_status);
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $op_val = $row->opportunity_value;
                $con_val = $row->contract_value;
                if($con_val != ""){
                    $pro_sum +=$con_val;
                }else{
                    $pro_sum +=$op_val;
                }
                
            }
            return $pro_sum;
    }
    
    /**
     *  Calculate Pipeline Analysis - Prosales
     */
    function pipeline_top(){
            $data = array();
            $opp_status = array('Order Booked', 'Lost', 'Order Cancelled', 'Opportunity Cancelled', 'Cancelled Alternative', 'Taken over by another ABB unit');      
            $this->db->select("TOP 6 opportunity_name,product_group,country_code,opportunity_value");
            $this->db->where_not_in('opportunity_status', $opp_status);
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->from($this->opp_table);
            $this->db->order_by("opportunity_value", "desc"); 
            $query = $this->db->get();
                        
            if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            }
        return $data;
    }
    
    /**
     *  Calculate Forecast By Month
     */
    function forecast_month(){
            $data = 0;
            $this->db->select("SUM(opportunity_value) AS summary"); 
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('month(expected_award_date)', $this->current_month);
            $this->db->where('opportunity_probability', '100%');
            $this->db->where('SUBSTRING(abb_probability,1,len(abb_probability)-1)>=', '70');
            $this->db->from($this->opp_table);
            $query = $this->db->get();
            
            foreach ($query->result() as $row) {
                $data = $row->summary;
            }
            if($data == "")
             $data = 0;
            
        return $data;
    }
    
    /**
     *  Calculate Forecast By Year
     */
    function forecast_year(){
            $data = 0;
            $this->db->select("SUM(opportunity_value) AS summary"); 
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('opportunity_probability', '100%');
            $this->db->where('SUBSTRING(abb_probability,1,len(abb_probability)-1)>=', '70');
            $this->db->from($this->opp_table);
            $query = $this->db->get();
            
            foreach ($query->result() as $row) {
                $data = $row->summary;
            }
            if($data == "")
             $data = 0;
            
        return $data;
    }
    
    
    /**
     *  Get Opportunities Business Unit hit rate and Gross Margin
     */
    function hitrate_businessunit(){
        $data = array();
        $i = 0;
            $this->db->select("business_unit");
            $this->db->from($this->opp_table);
            $this->db->group_by("business_unit"); 
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $bu = $row->business_unit;
                $data[$i]['business_unit'] = $bu;
                $this->db->select("SUM(contract_value) AS summary1");
                $this->db->where('opportunity_status', 'Order Booked');
                $this->db->where('business_unit', $bu);
                $this->db->where('year(expected_award_date)', $this->current_year);
                $this->db->from($this->opp_table);
                $q1 = $this->db->get();
                foreach ($q1->result() as $row1) {
                    $bu_val1 = $row1->summary1;
                    if($bu_val1 == "") $bu_val1 = 0;
                    $data[$i]['bu_selection_booked'] = $bu_val1;
                }
                
                $this->db->select("SUM(contract_value) AS summary2");
                $this->db->where('opportunity_status', 'Lost');
                $this->db->where('business_unit', $bu);
                $this->db->where('year(expected_award_date)', $this->current_year);
                $this->db->from($this->opp_table);
                $q2 = $this->db->get();
                foreach ($q2->result() as $row2) {
                    $bu_val2 = $row2->summary2;
                    if($bu_val2 == "") $bu_val2 = 0;
                    $data[$i]['bu_selection_lost'] = $bu_val2;
                }
                
                $this->db->select("SUM(contract_value) AS summary3");
                $this->db->where('opportunity_status', 'Order Booked');
                $this->db->where('business_unit', $bu);
                $this->db->where('year(expected_award_date)', $this->current_year);
                $this->db->like('LOWER(product_group)', 'service');
                $this->db->from($this->opp_table);
                $q3 = $this->db->get();
                foreach ($q3->result() as $row3) {
                    $bu_val3 = $row3->summary3;
                    if($bu_val3 == "") $bu_val3 = 0;
                    $data[$i]['bu_service_booked'] = $bu_val3;
                }
                
                $this->db->select("SUM(contract_value) AS summary4");
                $this->db->where('opportunity_status', 'Lost');
                $this->db->where('business_unit', $bu);
                $this->db->like('LOWER(product_group)', 'service');
                $this->db->where('year(expected_award_date)', $this->current_year);
                $this->db->from($this->opp_table);
                $q4 = $this->db->get();
                foreach ($q4->result() as $row4) {
                    $bu_val4 = $row4->summary4;
                    if($bu_val4 == "") $bu_val4 = 0;
                    $data[$i]['bu_service_lost'] = $bu_val4;
                }
                
                $this->db->select("SUM(contract_value) AS summary5,SUM(final_gross_margin) AS summary51");
                $this->db->where('business_unit', $bu);
                $this->db->where('year(expected_award_date)', $this->current_year);
                $this->db->from($this->opp_table);
                $q5 = $this->db->get();
                foreach ($q5->result() as $row5) {
                     $y = $row5->summary51;
                     $z = $row5->summary5;
                    if($z == ""){ $gr_m = 0;} else{ $gr_m = (($y)/($z));}
                   
                    if($gr_m == "") $gr_m = 0;
                    $data[$i]['gr_selection'] = $gr_m;
                }
                
                $this->db->select("SUM(contract_value) AS summary6,SUM(final_gross_margin) AS summary61");
                $this->db->where('business_unit', $bu);
                $this->db->like('LOWER(product_group)', 'service');
                $this->db->where('year(expected_award_date)', $this->current_year);
                $this->db->from($this->opp_table);
                $q6 = $this->db->get();
                foreach ($q6->result() as $row6) {
                     $y = $row6->summary61;
                     $z = $row6->summary6;
                    if($z == ""){ $gr_ms = 0;} else{ $gr_ms = (($y)/($z));}
                    if($gr_ms == "") $gr_ms = 0;
                    $data[$i]['gr_service'] = $gr_ms;
                }
                
                               
            $i++;
            }
            
        return $data;
    }
    
    /**
     *  Get Target Setting Data Customer Visits Current Month
     */
    function target_customer_visits(){
        $data = 0;
            $this->db->select("visit_perweak");
            $this->db->where('abb_year', $this->current_year);
            $this->db->where('abb_month', $this->current_month);
            $this->db->from($this->visit_table);
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data = $row->visit_perweak;
            }
            
        return $data;
    }
    
    /**
     *  Get Target Setting Data Customer Visits Current Month
     */
    function target_financial_budget(){
        $data = array();
        $i = 0;
            $this->db->select("product_group,business_unit");
            $this->db->from($this->budget_table);
            $this->db->group_by("product_group,business_unit"); 
            $this->db->order_by("business_unit,product_group"); 
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $bu = $row->business_unit;
                $pg = $row->product_group;
                $data[$i]['business_unit'] = $bu;
                $data[$i]['product_group'] = $pg;
            $this->db->select("abb_jan,abb_feb,abb_mar,abb_apr,abb_may,abb_jun,abb_jul,abb_aug,abb_sep,abb_oct,abb_nov,abb_dec");
            $this->db->where('year(expected_award_date)', $this->current_year);
            $this->db->where('month(expected_award_date)', $this->current_month);
            $this->db->where('business_unit', $bu);
            $this->db->where('product_group', $pg);
            $this->db->from($this->budget_table);
            $qu = $this->db->get();
          
            foreach ($qu->result() as $rw) {
                $data[$i][$bu][$pg]['Jan'] = $rw->abb_jan;
                $data[$i][$bu][$pg]['Feb'] = $rw->abb_feb;
                $data[$i][$bu][$pg]['Mar'] = $rw->abb_mar;
                /*$data[$i]['Apr'] = $rw->abb_apr;
                $data[$i]['May'] = $rw->abb_may;
                $data[$i]['Jun'] = $rw->abb_jun;
                $data[$i]['Jul'] = $rw->abb_jul;
                $data[$i]['Aug'] = $rw->abb_aug;
                $data[$i]['Sep'] = $rw->abb_sep;
                $data[$i]['Oct'] = $rw->abb_oct;
                $data[$i]['Nov'] = $rw->abb_nov;
                $data[$i]['Dec'] = $rw->abb_dec;*/
            }
        $i++;
            }    
        return $data;
    }
    
    function getBusiness_unit(){
        $data = array();
        
            $this->db->select("business_unit");
            $this->db->from($this->opp_table);
            $this->db->group_by("business_unit");
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row->business_unit;
            }
        return $data;
    }
    
    function getProduct_group($bu){
        $data = array();
        
            $this->db->select("product_group");
            $this->db->from($this->opp_table);
            $this->db->where('business_unit', $bu);
            $this->db->group_by("product_group");
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row->product_group;
            }
        return $data;
    }
    
    function getfinancial_target($bu){
        $data = array();
        
            $this->db->select("product_group");
            $this->db->from($this->opp_table);
            $this->db->where('business_unit', $bu);
            $this->db->group_by("product_group");
            $query = $this->db->get();
          
            foreach ($query->result() as $row) {
                $data[] = $row->product_group;
            }
        return $data;
    }
    
  }
  
  ?>
  