<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WebCommon extends MY_Controller_WEB
{
    public int $perPage;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->helper('html');

        $this->form_validation->set_error_delimiters('', '');

        $this->perPage = 10;
        $this->addJS = ['head' => [], 'tail' => []];
    }

    protected function viewApp($data)
    {
        $data['title'] = get_site_title(APP_NAME_EN, $this->titleList);
        $data['addCSS'] = $this->addCSS;
        $data['addJS'] = $this->addJS;
        $data['dialog'] = $this->session->flashdata('dialog');
        $data['class'] = $this->router->class;
        $data['method'] = $this->router->method;
        $data['titleList'] = $this->titleList;

        $data = array_merge($this->data, $data);
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        if(!$this->config->item('error_occurs')) $this->load->view('admin/layout/index', $data);
    }
}