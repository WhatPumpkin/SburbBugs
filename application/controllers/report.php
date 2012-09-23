<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    public function version1() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        $this->load->library('user_agent');
        
        $report = new BugReport();
        $report->ip = $this->input->ip_address();
        $report->referrer = $this->agent->referrer();
        $report->canvas = $this->input->post("canvas");
        $report->debugger = $this->input->post("debugger");
        $report->report = $this->input->post("report");
        $report->save();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */