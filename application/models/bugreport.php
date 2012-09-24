<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BugReport extends DataMapper
{
    public $table = "bugreports";

    public $validation = array(
        array(
            'field' => "id",
            'label' => 'ID',
            'rules' => array('trim')
        ),
        array(
            'field' => "ip",
            'label' => 'IP',
            'rules' => array('trim','valid_ip','required')
        ),
        array(
            'field' => "referrer",
            'label' => 'Referrer',
            'rules' => array('trim','required')
        ),
        array(
            'field' => "canvas",
            'label' => 'Canvas Image',
            'rules' => array('trim','valid_base64','required')
        ),
        array(
            'field' => "debugger",
            'label' => 'Debugger JSON',
            'rules' => array('trim','required')
        ),
        array(
            'field' => "save",
            'label' => 'Save State XML',
            'rules' => array('trim','required')
        ),
        array(
            'field' => "report",
            'label' => 'User Report',
            'rules' => array('trim')
        ),
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}