<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    public function view($id) {
        $report = new BugReport($id);
        if(!$report->exists()) {
            redirect("/report/list");
        }
        
        $data = array(
            "ip" => $report->ip,
            "referrer" => $report->referrer,
            "canvas" => "data:image/png;base64,".$report->canvas,
            "debugger" => $this->_json_dump(json_decode($report->debugger)),
            "report" => $report->report
        );
        $this->load->view("report",$data);
    }
    
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
    
    
    private function _json_value($v) {
        $output = "";
        if(is_array($v) || is_object($v)) {
            $output .= $this->_json_dump($v);
        } else if(is_string($v)) {
            $output .= "<span class='json_string'>$v</span>";
        } else if(is_bool($v)) {
            $output .= "<span class='json_bool'>".($v?"true":"false")."</span>";
        } else if(is_null($v)) {
            $output .= "<span class='json_null'>null</span>";
        } else if(is_numeric($v)) {
            $output .= "<span class='json_number'>$v</span>";
        } else {
            $output .= "<span class='json_unknown'>unknown</span>";
        }
        return $output;
    }

    private function _json_dump($obj) {
        $output = "";
        if(is_object($obj)) {
            $output .= "<span class='json_object'>Object<ul>";
            foreach($obj as $k => $v) {
                $output .= "<li><strong>$k</strong>: ";
                $output .= $this->_json_value($v);
                $output .= "</li>";
            }
        } else if(is_array($obj)) {
            $len = count($obj);
            $output .= "<span class='json_array'>Array[" . $len . "]<ul>";
            for($k = 0; $k < $len; $k++) {
                $output .= "<li><strong>$k</strong>: ";
                $output .= $this->_json_value($obj[$k]);
                $output .= "</li>";
            }
        } else {
            $output .= "<span class='json_unknown'>Unknown<ul>";
        }
        $output .= "</ul></span>";
        return $output;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */