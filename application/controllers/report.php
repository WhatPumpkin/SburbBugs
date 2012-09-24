<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    public function index() {
        redirect("/report/listing");
    }
    
    public function stats() {
        $fields = array("ip","browser","os","referrer");
        $data = array();
        $reports = new BugReport();
        $data["total"] = $reports->count();
        foreach($fields as $f) {
            $data[$f] = array();
            $values = $reports->select($f)->distinct()->order_by($f,"ASC")->get_iterated();
            foreach($values as $v) {
                $name = $v->{$f};
                $data[$f][$name] = $reports->where($f, $name)->count();
            }
        }
        $this->load->view("reportstats",$data);
    }
    
    public function listing() {
        $fields = array("ip","browser","os","referrer");
        $reports = new BugReport();
        $reports->select('id,ip,browser,os,referrer,report')->order_by('id','DESC');
        foreach($fields as $f) {
            if($this->input->get($f))
                $reports->where($f,$this->input->get($f));
        }
        $data = array(
            "reports" => $reports->get_iterated()
        );
        $this->load->view("reportlist",$data);
    }
    
    public function view($id = 0) {
        $report = new BugReport($id);
        if(!$report->exists()) {
            redirect("/report/listing");
        }
        
        $data = array(
            "id" => $report->id,
            "ip" => $report->ip,
            "browser" => $report->browser,
            "os" => $report->os,
            "referrer" => $report->referrer,
            "canvas" => "data:image/png;base64,".$report->canvas,
            "debugger" => $this->_json_dump(json_decode($report->debugger)),
            "save" => $report->save,
            "report" => $report->report
        );
        $this->load->view("report",$data);
    }
    
    public function version1() {
        header("Access-Control-Allow-Origin: *");
        $this->load->library('user_agent');
        
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser().' '.$this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        
        $report = new BugReport();
        $report->ip = $this->input->ip_address();
        $report->browser = $agent;
        $report->os = $this->agent->platform();
        $report->referrer = $this->input->post("url");
        $report->canvas = $this->input->post("canvas");
        $report->debugger = $this->input->post("debugger");
        $report->report = $this->input->post("report");
        $report->save = $this->input->post("save");
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
            $output .= "<span class='json_string'>".htmlspecialchars($v)."</span>";
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