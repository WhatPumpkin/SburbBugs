<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    public function version1() {
        header("Access-Control-Allow-Origin: *");
        $this->load->library('user_agent');
        
        $report = new BugReport();
        $report->ip = $this->input->ip_address();
        $report->referrer = $this->input->post("url");
        $report->canvas = $this->input->post("canvas");
        $report->debugger = $this->input->post("debugger");
        $report->report = $this->input->post("report");
        $success = $report->save();
        
        $out = array();
        $out["success"] = $success;
        if(!$success) {
            $out["errors"] = $report->error->all;
        }
        print(json_encode($out));
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */