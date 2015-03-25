<?php
/*
 * Author : Nishant raj
 */
class Leave_menu_model extends CI_Model{
    
    function __construct()
    {
            // Calling the Model parent constructor
            parent::__construct();
    }
    
    function getMenu(){
        
        $menu = array();
        
        $menu['emp'] = array();
        $menu['emp']['Leave Management'] = array();
        $menu['emp']['Leave Management']['Apply For Leave'] = site_url('leave/leave_application');
        $menu['emp']['Leave Management']['Station Leave'] = array();
        $menu['emp']['Leave Management']['Station Leave']['Apply for Station Leave'] = site_url('leave/leave_station');
        $menu['emp']['Leave Management']['Station Leave']['Station Leave History'] = site_url('leave/leave_station/stationLeaveHistory');
        $menu['emp']['Leave Management']['Leave History'] = site_url('leave/leave_history');
        $menu['emp']['Leave Management']['Cancle Leave'] = site_url('leave/leave_cancel');

        $menu['hod']['Leave Management']['Station Leave'] = array();
        $menu['hod']['Leave Management']['Station Leave']['Pending Leave for Approval/Disapproval'] = site_url('leave/leave_station/pendingStationLeaveStatus');

        $menu['deo']['Leave Management'] =array();
        $menu['deo']['Leave Management']['Leave Entry by Employee ID']=site_url('leave/leave_deo');
        $menu['deo']['Leave Management']['View Leave History'] = site_url('leave/leave_deo/leave_administration');
        
        $menu['est_ar']['Leave Management'] =array();
        $menu['est_ar']['Leave Management']['View Leave History'] = site_url('leave/leave_deo/leave_administration');
        
        $menu['astreg']['Leave Management'] =array();
        $menu['astreg']['Leave Management']['View Leave History'] = site_url('leave/leave_deo/leave_administration');
        
        $menu['dir']['Leave Management'] =array();
        $menu['dir']['Leave Management']['View Leave History'] = site_url('leave/leave_deo/leave_administration');
        
        $menu['dyreg']['Leave Management'] =array();
        $menu['dyreg']['Leave Management']['View Leave History'] = site_url('leave/leave_deo/leave_administration');
        
        return $menu;
    }
}

