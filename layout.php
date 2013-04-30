<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Simple CodeIgniter Layout Class
 *
 * This class enables use of simple layouts in CodeIgniter
 *
 * @category	Libraries
 * @author	Kiril "NoNameZ" Calkin
 * @link	https://github.com/nonamez/simple_ci_layout
 */

class Layout{

	private $_views;
	private $_views_data;
	private $_CI;

	function __construct(){
		$this->_CI =& get_instance();

		$this->_views = array(
			'head' => 'head',
			'before' => array(), 
			'after'  => array(),
			'bottom' => 'bottom'
		);

		$this->_views_data = array(
			'head' => array(),
			'before' => array(), 
			'after'  => array(),
			'bottom' => array()
		);
	}

	public function load($views = FALSE, $view_data = NULL, $head_data = FALSE, $bottom_data = FALSE){

		if($head_data)
			$this->setHeadData($head_data);

		if($bottom_data)
			$this->setBottomData($bottom_data);

		if($this->_views['head'])
			$this->_CI->load->view($this->_views['head'], $this->_views_data['head']);

		if(count($this->_views['before']) > 0)
			foreach($this->_views['before'] as $view)
				$this->_CI->load->view($view, $this->_views_data['before']);

		if(is_array($views)){
			foreach($views as $view)
				$this->_CI->load->view($view, $view_data);
		}
		else
			$this->_CI->load->view($views, $view_data);

		if(count($this->_views['after']) > 0)
			foreach($this->_views['after'] as $view)
				$this->_CI->load->view($view, $this->_views_data['after']);

		if($this->_views['bottom'])
			$this->_CI->load->view($this->_views['bottom'], $this->_views_data['bottom']);
	}

	public function setHeadData($data = FALSE){
		if(is_array($data))
			$this->_views_data['head'] = array_merge($this->_views_data['head'], $data);
	}

	public function setBottomData($data = FALSE){
		if(is_array($data))
			$this->_views_data['bottom'] = array_merge($this->_views_data['bottom'], $data);
	}

	public function setGlobalData($data = FALSE){
		if(is_array($data)){
			$this->setHeadData($data);
			$this->setBottomData($data);

			foreach($this->_views_data['before'] as &$value)
				$value = array_merge($value, $data);

			foreach($this->_views_data['after'] as &$value)
				$value = array_merge($value, $data);
		}
	}

	public function setDocumentHead($head = FALSE){
		if($head)
			$this->_views['head'] = (string)$head;
	}

	public function setDocumentBottom($bottom = FALSE){
		if($bottom)
			$this->_views['bottom'] = (string)$bottom;
	}

	public function setBeforeContent($before_content = FALSE){
		if($before_content)
			$this->_setView('before', (array)$before_content);
	}

	public function setAfterContent($after_content = FALSE){
		if($after_content)
			$this->_setView('after', (array)$after_content);
	}

	private function _setView($condition, $views){
		// iteration over array of views
		foreach($views as $key => $view_data){

			// checking if the view passed with or without data
			if(is_array($view_data))
				$view =  $key;
			else{
				$view = $view_data;
				$view_data = FALSE;
			}

			if(!array_key_exists($view, $this->_views[$condition]))
				// adding new view
				array_push($this->_views[$condition], $view);

			// adding view data if exists
			if($view_data){
				// creating view data array if not exists
				if(!isset($this->_views_data[$condition][$view]))
					$this->_views_data[$condition][$view] = array();

				$this->_views_data[$condition][$view] = array_merge($this->_views_data[$condition][$view], (array)$view_data);
			}
		}
	}
}
?>
