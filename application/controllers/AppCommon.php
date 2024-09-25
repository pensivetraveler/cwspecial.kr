<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AppCommon extends MY_Controller_APP
{
    public bool $dev;
    public int $perPage;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->helper('html');

        $this->form_validation->set_error_delimiters('', '');

        $this->dev = true;
        $this->perPage = 5;
    }

    protected function viewApp($data)
    {
        $data['title'] = get_site_title(APP_NAME_EN, $this->titleList);
        $data['addCSS'] = $this->addCSS;
        $data['addJS'] = $this->addJS;
        $data['flashData'] = $this->session->flashdata();
        $data['class'] = $this->router->class;
        $data['method'] = $this->router->method;
        $data['titleList'] = $this->titleList;

        $data = array_merge($this->data, $data);
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        $this->load->view('app/layout/index', $data);
    }

    protected function getPaginationLinks($baseUrl, $totalRows, $perPage, $option = [])
    {
        $option = array_merge([
            'base_url' => $baseUrl,
            'total_rows' => $totalRows,
            'per_page' => $perPage,
            'page_query_string' => true,
            'full_tag_open' => '<div class="pagination">',
            'full_tag_close' => '</div>',
            'first_link' => false,
            'prev_link' => '<img src="'.base_url('/public/assets/app/img/button-before.png').'" alt="이전">',
            'next_link' => '<img src="'.base_url('/public/assets/app/img/button-next.png').'" alt="다음">',
            'last_link' => false,
            'reuse_query_string' => true,
        ], $option);

        $this->pagination->initialize($option);

        return $this->pagination->create_links();
    }

}