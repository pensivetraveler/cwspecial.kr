<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller_ADM extends MY_Controller_WEB
{
	public array $pageConfig;
	public string $pageType;
	public bool $sideForm;
	public array $headerData;
	public string $href;
	public array $listConfig;
	public array $listColumns;
	public array $formConfig;
	public array $formColumns;
	public string $viewPath;


	public function __construct()
	{
		parent::__construct();

		$this->baseViewPath = 'admin/layout/index';

		$this->load->helper(['admin_web','admin_base','admin_form',]);
		$this->lang->load('admin_base', $this->config->item('language'));
		$this->lang->load('admin_nav', $this->config->item('language'));
		$this->lang->load('admin_form', $this->config->item('language'));
		$this->lang->load('form_validation', $this->config->item('language'));
		$this->lang->load('custom_form_validation', $this->config->item('language'));

		$this->titleList = ['Admin'];
		$this->pageConfig = [];
		$this->pageType = 'form';
		$this->sideForm = false;
		$this->headerData = [];
		$this->href = base_url('/admin/'.$this->router->class);
		$this->listConfig = $this->formConfig = [];
		$this->listColumns = $this->formColumns = [];
		$this->viewPath = '';
		$this->jsVars = [
			'TITLE' => $this->router->class,
			'API_URI' => '',
			'API_PARAMS' => [],
		];

		if($this->router->class !== 'common') $this->setProperties();
		if(ENVIRONMENT === 'development') $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		parent::index();

		if(empty($this->pageConfig)) {
			$data['subPage'] = '';
			$data['backLink'] = WEB_HISTORY_BACK;
			$this->viewApp($data);
		}else{
			$this->{"{$this->pageConfig['type']}"}();
		}
	}

	public function list()
	{
		$this->titleList[] = 'List';

		$this->addCSS[] = [
			base_url('public/assets/admin/vendor/libs/datatables-bs5/datatables.bootstrap5.css'),
			base_url('public/assets/admin/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css'),
			base_url('public/assets/admin/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css'),
			base_url('public/assets/admin/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/admin/vendor/libs/datatables-bs5/datatables-bootstrap5.js'),
		];

		if($this->sideForm) {
			$this->addCSS[] = [
				base_url('public/assets/admin/vendor/libs/tagify/tagify.css'),
				base_url('public/assets/admin/vendor/libs/@form-validation/form-validation.css'),
				base_url('public/assets/admin/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css'),
			];

			// wysiwig
			$this->addCSS[] = [
				base_url('public/assets/admin/vendor/libs/quill/typography.css'),
				base_url('public/assets/admin/vendor/libs/quill/katex.css'),
				base_url('public/assets/admin/vendor/libs/quill/editor.css'),
			];

			$this->addJS['tail'][] = [
				base_url('public/assets/admin/vendor/libs/autosize/autosize.js'),
				base_url('public/assets/admin/vendor/libs/tagify/tagify.js'),
				base_url('public/assets/admin/vendor/libs/@form-validation/popular.js'),
				base_url('public/assets/admin/vendor/libs/@form-validation/bootstrap5.js'),
				base_url('public/assets/admin/vendor/libs/@form-validation/auto-focus.js'),
				base_url('public/assets/admin/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js'),
				base_url('public/assets/admin/vendor/libs/jquery-repeater/jquery-repeater.js'),
				base_url('public/assets/admin/vendor/libs/sortablejs/sortable.js'),
			];

			// wysiwig
			$this->addJS['tail'][] = [
				base_url('public/assets/admin/vendor/libs/quill/katex.js'),
				base_url('public/assets/admin/vendor/libs/quill/quill.js'),
			];
		}

		$this->addJS['tail'][] = [
			base_url('public/assets/admin/js/app-page-list.js'),
		];

		$data['backLink'] = WEB_HISTORY_BACK;
		$data['columns'] = $this->jsVars['LIST_COLUMNS'];
		$data['formData'] = restructure_admin_form_data($this->jsVars['FORM_DATA'], $this->sideForm?'side':'page');

		$this->viewApp($data);
	}

	public function view($key = 0)
	{
		if($this->sideForm) show_404();

		if(!$key) alert_back('잘못된 접근입니다.');

		$this->phptojs->append(['KEY' => $key]);

		$this->titleList[] = 'View';

		$this->addJS['tail'][] = [
			base_url('public/assets/admin/js/app-page-view.js'),
		];

		$data['backLink'] = WEB_HISTORY_BACK;

		$this->viewApp($data);
	}

	public function add()
	{
		if($this->sideForm) show_404();

		$this->titleList[] = 'Add';

		$this->addCSS[] = [
			base_url('public/assets/admin/vendor/libs/tagify/tagify.css'),
			base_url('public/assets/admin/vendor/libs/@form-validation/form-validation.css'),
		];

		// wysiwig
		$this->addCSS[] = [
			base_url('public/assets/admin/vendor/libs/quill/typography.css'),
			base_url('public/assets/admin/vendor/libs/quill/katex.css'),
			base_url('public/assets/admin/vendor/libs/quill/editor.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/admin/vendor/libs/autosize/autosize.js'),
			base_url('public/assets/admin/vendor/libs/tagify/tagify.js'),
			base_url('public/assets/admin/vendor/libs/@form-validation/popular.js'),
			base_url('public/assets/admin/vendor/libs/@form-validation/bootstrap5.js'),
			base_url('public/assets/admin/vendor/libs/@form-validation/auto-focus.js'),
			base_url('public/assets/admin/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js'),
			base_url('public/assets/admin/vendor/libs/jquery-repeater/jquery-repeater.js'),
			base_url('public/assets/admin/vendor/libs/sortablejs/sortable.js'),
			base_url('public/assets/admin/js/app-page-add.js'),
		];

		// wysiwig
		$this->addJS['tail'][] = [
			base_url('public/assets/admin/vendor/libs/quill/katex.js'),
			base_url('public/assets/admin/vendor/libs/quill/quill.js'),
		];

		$data['backLink'] = WEB_HISTORY_BACK;
		$data['formData'] = restructure_admin_form_data($this->jsVars['FORM_DATA'], $this->sideForm?'side':'page');

		$this->viewApp($data);
	}

	public function edit($key = 0)
	{
		if($this->sideForm) show_404();

		if(!$key) alert_back('잘못된 접근입니다.');

		$this->phptojs->append(['KEY' => $key]);

		$this->titleList[] = 'Edit';

		$this->addCSS[] = [
			base_url('public/assets/admin/vendor/libs/tagify/tagify.css'),
			base_url('public/assets/admin/vendor/libs/@form-validation/form-validation.css'),
		];

		// wysiwig
		$this->addCSS[] = [
			base_url('public/assets/admin/vendor/libs/quill/typography.css'),
			base_url('public/assets/admin/vendor/libs/quill/katex.css'),
			base_url('public/assets/admin/vendor/libs/quill/editor.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/admin/vendor/libs/autosize/autosize.js'),
			base_url('public/assets/admin/vendor/libs/tagify/tagify.js'),
			base_url('public/assets/admin/vendor/libs/@form-validation/popular.js'),
			base_url('public/assets/admin/vendor/libs/@form-validation/bootstrap5.js'),
			base_url('public/assets/admin/vendor/libs/@form-validation/auto-focus.js'),
			base_url('public/assets/admin/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js'),
			base_url('public/assets/admin/vendor/libs/jquery-repeater/jquery-repeater.js'),
			base_url('public/assets/admin/vendor/libs/sortablejs/sortable.js'),
			base_url('public/assets/admin/js/app-page-edit.js'),
		];

		// wysiwig
		$this->addJS['tail'][] = [
			base_url('public/assets/admin/vendor/libs/quill/katex.js'),
			base_url('public/assets/admin/vendor/libs/quill/quill.js'),
		];

		$data['backLink'] = WEB_HISTORY_BACK;
		$data['formData'] = restructure_admin_form_data($this->jsVars['FORM_DATA'], $this->sideForm?'side':'page');

		$this->viewApp($data);
	}

	protected function viewApp($data)
	{
		if(!array_key_exists('subPage', $data)) {
			foreach ([$this->router->class, 'layout'] as $subdivide) {
				$path = get_path().DIRECTORY_SEPARATOR.$subdivide.DIRECTORY_SEPARATOR;
				$view = '';
				if($this->router->method === 'index') {
					foreach (['index', 'list'] as $method) {
						if(file_exists(VIEWPATH.$path.$method.'.php')) {
							$view = $method;
						}
					}
				}else{
					if(file_exists(VIEWPATH.$path.$this->router->method.'.php')) {
						$view = $this->router->method;
					}
				}
				if($view) break;
			}

			if(empty($view) || !file_exists(VIEWPATH.$path.$view.'.php')){
				trigger_error("viewApp : View file for {$this->router->class}:{$this->router->method} does not exist.", E_USER_ERROR);
			}else{
				$data['subPage'] = $path.$view;
			}
		}

		$data['hideBack'] = element('hideBack', $data);
		$data['headerData'] = $this->headerData;

		if(!file_exists(ADMIN_ASSET_JS_PATH.'view/'.strtolower($this->router->class).'.js')){
			$file = fopen(ADMIN_ASSET_JS_PATH.'view/'.strtolower($this->router->class).'.js',"w");
			if(!$file) trigger_error("viewApp : Unable to open file!", E_USER_ERROR);
			fclose($file);
		}

		$this->addJS['tail'][] = [
			base_url('public/assets/admin/js/view/'.strtolower($this->router->class).'.js'),
		];

		parent::viewApp($data);
	}

	protected function setProperties($data = [])
	{
		if(!is_empty($this->config->item('admin_page_config'), strtolower($this->router->class))){
			$this->pageConfig = array_merge(
				$this->config->get('admin_page_base_config', []),
				$this->config->get('admin_page_config')[strtolower($this->router->class)]);
		}

		$this->pageType = $this->pageConfig['type'];
		if($this->pageConfig['properties']['formExist']) $this->sideForm = $this->pageConfig['formProperties']['formType'] === 'side';

		if($this->pageConfig['properties']['formExist']) {
			$this->formColumns = $this->setFormColumns(
				$this->pageConfig['formProperties']['formConfig'] ? : strtolower($this->router->class)
			);
			$this->addJsVars([
				'IDENTIFIER' => $this->setIdentifier(),
				'FORM_DATA' => $this->setFormData(),
				'FORM_REGEXP' => $this->config->item('regexp'),
			]);
		}

		if($this->pageConfig['properties']['listExist']) {
			$this->addJsVars([
				'LIST_VIEW_URI' => $this->href,
				'LIST_COLUMNS' => $this->setListColumns(),
				'LIST_PLUGIN' => $this->pageConfig['listProperties']['listPlugin'],
			]);
		}

		if($this->pageConfig['properties']['formExist'] && $this->pageConfig['properties']['listExist']) {
			$this->addJsVars([
				'DETAIL_VIEW_URI' => $this->sideForm?'':$this->href.DIRECTORY_SEPARATOR.'view',
				'ADD_VIEW_URI' => $this->sideForm?'':$this->href.DIRECTORY_SEPARATOR.'add',
				'EDIT_VIEW_URI' => $this->sideForm?'':$this->href.DIRECTORY_SEPARATOR.'edit',
				'SIDE_FORM' => $this->sideForm,
			]);
		}

		$this->addJsVars($data);
	}

	protected function setFormColumns($name): array
	{
		$config = $this->config->item('form_'.$name.'_config');
		if(empty($config)){
			log_message('error', "setFormColumns : config {$name} does not exist.");
			trigger_error("setFormColumns : config {$name} does not exist.", E_USER_ERROR);
		}else{
			return array_reduce($config, function($carry, $item) {
				if(isset($item['field'])) {
					$item = array_merge(
						$this->getBaseFormData(),
						['label' => 'lang:'.$this->router->class.'.'.$item['field']],
						$item
					);

					if(sscanf($item['label'], 'lang:%s', $line) === 1)
						$item['label'] = $line;

					$item = $this->setColumnErrors($item);

					// list attributes
					$item['list_attributes'] = array_merge(
						$this->getBaseListAttributes(),
						$item['list_attributes']
					);

					// option attributes
					if(isset($item['option_attributes']) && count($item['option_attributes'])) {
						$item['option_attributes'] = array_merge(
							$this->getBaseOptionAttributes(),
							$item['option_attributes']
						);
						$item['options'] = $this->getFormOptions($item);
					}

					// form attributes
					$item['form_attributes'] = array_merge(
						$this->getBaseFormAttributes(),
						$item['form_attributes']
					);

					/**
					 * 예외 처리
					 */
					// textarea 가 wysiwyg quill 인 경우
					if($this->sideForm && $item['category'] === 'basic' && $item['type'] === 'textarea' && $item['subtype'] === 'quill'){
						$item['subtype'] = 'autosize';
					}

					if($item['type'] === $item['subtype']) $item['subtype'] = 'basic';

					$carry[] = $item;
				}
				return $carry;
			}, []);
		}
	}

	protected function setColumnErrors($item)
	{
		$rules = preg_split('/\|(?![^\[]*\])/', $item['rules']);

		if($matches = preg_grep('/^required$/', $rules)) {
			$item['attributes']['required'] = $matches[1];
		}

		if($matches = preg_grep('/^required_mod\[(.*?)\]$/', $rules)) {
			$option = reset($matches);
			if (preg_match('/^required_mod\[(.*?)\]$/', $option, $matches)) {
				$item['attributes']['required-mod'] = $matches[1];
				if(in_array($this->router->method, explode('|', $matches[1])))
					$item['rules'] = str_replace($matches[0], 'required', $item['rules']);
			}
		}

		// 전처리 이후 에러 메세지 셋업
		$rules = preg_split('/\|(?![^\[]*\])/', $item['rules']);

		$item['errors'] = array_reduce($rules, function($carry, $rule) use ($item) {
			$param = null;
			if(count(preg_split('/\[/', $rule)) > 1) {
				preg_match('/(.*?)\[(.*)\]/', $rule, $match);
				$rule = $match[1];
				$param = $match[2];
			}
			$this->lang->load('form_validation');
			$this->lang->load('custom_form_validation');
			if($error_msg = $this->form_validation->get_error_msg($rule, $item['label'], $param, $item['errors'])){
				$carry[$rule] = $error_msg;
			}
			return $carry;
		}, []);

		return $item;
	}

	protected function setIdentifier(): string
	{
		$idx = array_search('identifier', array_column($this->formColumns, 'subtype'));
		return $idx === false?'':$this->formColumns[$idx]['field'];
	}

	protected function setFormData(): array
	{
		$result = [];
		$groups = [];
		$attr = [];
		foreach ($this->formColumns as $i=>$item) {
			if (!$item['form']) continue;

			if ($item['subtype'] === 'identifier' && !in_array($this->router->method, ['index', 'list'])){
				// page type form 에 identifier default 값 부여
				if(end($this->uri->segments) !== $this->router->method)
					$item['default'] = end($this->uri->segments);
			}

			if ($item['category'] === 'group' && $item['group']) {
				if(!in_array($item['group'], $groups)) {
					$groups[] = $item['group'];
					$attr = array_merge($this->getBaseGroupAttributes(), $item['group_attributes']);
				}else{
					$attr = array_merge(
						$attr,
						$item['group_attributes'],
					);
				}
				$item['group_attributes'] = $attr;

				$item['id'] = get_group_field_id($item['group_attributes'], $item['group'], $item['field']);
				$item['id'] = ($this->sideForm?$this->config->item('form_side_prefix'):$this->config->item('form_page_prefix')).$item['id'];
				$item['name'] = get_group_field_name($item['group_attributes'], $item['group'], $item['field']);

				$item['form_attributes'] = array_merge(
					$item['form_attributes'],
					[
						'group_name' => $item['group'],
						'group_field' => $item['field'],
						'group_key' => $item['group_attributes']['key'],
					]
				);
			}else{
				// group category 예외처리
				$item['group'] = '';
				if($item['category'] === 'group') $item['category'] = 'basic';
				$item['group_attributes'] = [];

				// view type
				$item['view'] = $item['subtype'];

				$item['id'] = ($this->sideForm?$this->config->item('form_side_prefix'):$this->config->item('form_page_prefix')).$item['field'];
				$item['name'] = $item['field'];
			}

			$result[] = $item;
		}

		return $result;
	}

	protected function getListColumns($name = ''): array
	{
		if($name) {
			$config = $this->config->get($name, []);
		}else{
			if($name = $this->pageConfig['listProperties']['listConfig']) {
				$config = $this->config->get('list_'.$name.'_config', []);
			}else if($name = strtolower($this->router->class)) {
				$config = $this->config->get('form_'.$name.'_config', []);
			}else{
				$config = array_reduce($this->formColumns, function ($carry, $item) {
					if ($item['list']) $carry[] = $item;
					return $carry;
				}, []);
			}
		}

		if(empty($config)) {
			log_message('error', "setFormColumns : config {$name} does not exist.");
			trigger_error("setFormColumns : config {$name} does not exist.", E_USER_ERROR);
		}

		$this->listColumns = array_reduce($config, function ($carry, $item) {
			$carry[] = $item;
			return $carry;
		}, []);

		return array_reduce($this->listColumns, function ($carry, $item) {
			if ($item['list']) $carry[] = $item['field'];
			return $carry;
		}, []);
	}

	protected function setListColumns(): array
	{
		$list = array_reduce(array_keys($this->getListColumns()), function($carry, $key) {
			$attrs = [];
			if(is_int($key)){
				$field = $this->getListColumns()[$key];
				$idx = array_search($field, array_column($this->listColumns, 'field'));
			}else{
				// ['aaa', 'bbb', 'ccc'] 와 같이 개별 콘트롤러 내 getListColumns 메소드에서
				// 메뉴 구성을 필드 리스트 타입으로 return 한 경우
				$field = $key;
				$idx = array_search($field, array_column($this->listColumns, 'field'));
				$attrs = $this->getListColumns()[$idx];
			}

			$label = $this->router->class.'.'.$field;
			$formData = $idx === false?null:$this->listColumns[$idx];
			$list_attributes = $formData === null || empty($formData['list_attributes'])
				? $this->getBaseListAttributes()
				: array_merge($this->getBaseListAttributes(), $formData['list_attributes']);

			if($formData !== null) {
				$label = $formData['label'];

				if($this->lang->line_exists($formData['label'].'_list'))
					$label = $formData['label'].'_list';

				if(!empty($list_attributes) && element('label', $list_attributes))
					$label = $list_attributes['label'];
			}

			if(sscanf($label, 'lang:%s', $line) === 1)
				$label = $line;

			$carry[] = array_merge($list_attributes, $attrs, [
				'field' => $field,
				'label' => $label,
			]);

			return $carry;
		}, []);

		array_unshift($list,
			array_merge(
				$this->getBaseListAttributes(),
				[
					'label' => 'common.row_num',
					'format' => 'row_num',
				]
			)
		);

		$list[] = array_merge(
			$this->getBaseListAttributes(),
			[
				'label' => 'common.actions',
				'format' => 'actions',
			]
		);

		return $list;
	}

	protected function getBaseFormData(): array
	{
		return [
			'field' => '',
			'label' => '',
			'form' => true,
			'rules' => '',
			'errors' => [],
			'category' => 'basic',
			'type' => 'text',
			'subtype' => 'basic',
			'default' => '',
			'icon' => null,
			'form_text' => '',
			'attributes' => [],
			'form_attributes' => [],
			'option_attributes' => [],
			'group' => '',
			'group_attributes' => [],
			'list' => false,
			'list_attributes' => [],
		];
	}

	protected function getBaseListAttributes(): array
	{
		return $this->config->get('base_list_config', [
			'field' => '',
			'label' => '',
			'format' => 'text',
			'icon' => '',
			'text' => '',
			'classes' => [],
			'onclick' => [],
			'render' => [],
			'options' => [],
		]);
	}

	protected function getBaseOptionAttributes(): array
	{
		return [
			'option_type' => 'field',
			'option_data' => [],
			'render' => [],
			'option_stack' => 'vertical',
		];
	}

	protected function getBaseGroupAttributes(): array
	{
		return [
			'label' => '',
			'form_text' => '',
			'type' => 'base',
			'key' => '',
			'envelope_name' => false,
			'group_repeater' => false,
			'repeater_type' => 'manual',
			'repeater_id' => '',
		];
	}

	protected function getBaseFormAttributes(): array
	{
		return [
			'form_sync' => true,
			'reset_value' => true,
			'detect_changed' => true,
			'with_btn' => false,
			'with_list' => false,
			'list_sorter' => false,
			'list_onclick' => 'download',
			'list_delete' => false,
		];
	}
}
