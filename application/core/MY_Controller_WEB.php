<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller_WEB extends MY_Controller
{
    protected string $table;
    protected string $identifier;
    protected array $primaryKeyList;
    protected array $uniqueKeyList;
    protected array $notNullList;
    protected array $nullList;
    protected array $strList;
    protected array $intList;
    protected array $fileList;
    protected array $validateMessages;
    protected array $validateCallback;

    public array $data;
    public array $titleList;
    public array $addCSS;
    public array $addJS;
    public array $jsVars;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('html');

        if($this->router->class === 'common') redirect('/welcome');

        $this->load->library('Authorization_token', ['config' => 'extra/jwt_config']);

        $this->identifier = '';
        $this->validateMessages = [];
        $this->validateCallback = [];

        $this->data = [];
        $this->titleList = [];
        $this->addCSS = [];
        $this->addJS['head'] = [];
        $this->addJS['tail'] = [];
        $this->jsVars = [];
    }

    protected function validateToken()
    {
        $token = $this->input->post('token')?:$this->session->userdata('token');
        if(is_empty($token)){
            $this->response([
                'code' => EMPTY_TOKEN,
                'msg' => "TOKEN 값이 없습니다.",
                'data' => ['token' => $token,],
            ], RestController::HTTP_UNAUTHORIZED);
        }else{
            $decodedToken = $this->authorization_token->tokenParamCheck($token);
            if($decodedToken['status'] === FALSE){
                switch ($decodedToken['message']) {
                    case 'Token Time Expire.':
                        $this->response([
                            'code' => TOKEN_EXPIRED,
                            'msg' => "TOKEN 유효 시간이 지났습니다.",
                            'data' => ['token' => $token,],
                        ], RestController::HTTP_UNAUTHORIZED);
                    default:
                        $this->response([
                            'code' => WRONG_TOKEN,
                            'msg' => "올바른 TOKEN 값이 아닙니다.",
                            'data' => ['token' => $token,],
                        ], RestController::HTTP_UNAUTHORIZED);
                }
            }else{
                $this->session->set_userdata('token', $token);
                return $decodedToken['data'];
            }
        }
    }

    protected function setTitleList($data = [])
    {
        $this->titleList = $data;
    }

    /**
     * 페이징 함수를 함수를 이용해서 가공해준다.
     * @param $url       유지할 URI
     * @param $totalRow  총 Row 수
     * @param $perPage   한번에 보여줄 페이징 수
     * @param $config    페이징 환경설저
     * @return mixed     가공된 Paging 정보
     */
    public function getPaging($url, $totalRow, $perPage, $config = []) {
        $this->load->library('pagination');

        $page = $this->input->get('page');
        $page = $page ? intVal($page) : 1;

        $numLinks = ($page <= 4) ? (9 - $page) : 4;

        if($this->_isMobile)
            $numLinks = 1;

        // 페이징 환경설정
        $pagingConfig = [
            'base_url' => base_url($url),    // 각페이지 지정변수 : 현재 페이지 URL
            'total_rows' => $totalRow,       // 각페이지 지정변수 : 전체 목록갯수
            'per_page' => $perPage,          // 각페이지 지정변수 : 한번에 보여줄 갯수
            'num_links' => $numLinks,        // 페이징 좌우 노출 갯수
            'use_page_numbers' => true,     // 페이징번호로 파라메터 넘김
            'page_query_string' => true,    // 페이징 넘버 쿼리형태로
            'reuse_query_string' => true,   // 기존 파라메터 유지
            'first_link' => '&lt;&lt;',
            'last_link' => "&gt;&gt;",
            'query_string_segment' => 'page',
            'first_tag_open' => '<div class="nc-paging-first">',
            'first_tag_close' => '</div>',
            'prev_tag_open' => '<div class="nc-paging-prev">',
            'prev_tag_close' => '</div>',
            'next_tag_open' => '<div class="nc-paging-next">',
            'next_tag_close' => '</div>',
            'last_tag_open' => '<div class="nc-paging-last">',
            'last_tag_close' => '</div>',
        ];

        $config = array_merge($pagingConfig, $config);

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }
}