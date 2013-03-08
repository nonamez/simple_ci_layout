<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layout{

  private $_document_head;
	private $_document_bottom;
	private $_document_head_data;
	private $_document_bottom_data;
	private $_CI;

	function __construct(){
		$this->_CI =& get_instance();
		$this->_document_head = 'head';
		$this->_document_bottom = 'bottom';
	}

	public function load($views = FALSE, $view_data = NULL, $head_data = FALSE, $bottom_data = FALSE){

		if($head_data)
			$this->setHeadData($head_data);

		if($bottom_data)
			$this->setBottomData($bottom_data);

		if($this->_document_head)
			$this->_CI->load->view($this->_document_head, $this->_document_head_data);

		if(is_array($views))
			foreach ($views as $view)
				$this->_CI->load->view($view, $view_data);
		else
			$this->_CI->load->view($views, $view_data);

		if($this->_document_bottom)
			$this->_CI->load->view($this->_document_bottom, $this->_document_bottom_data);
	}

	public function setHeadData($data){
		if(is_null($this->_document_head_data))
			$this->_document_head_data = (array)$data;
		else
			$this->_document_head_data = array_merge($this->_document_head_data, (array)$data);
	}

	public function setBottomData($data){
		if(is_null($this->_document_bottom_data))
			$this->_document_bottom_data = (array)$data;
		else
			$this->_document_bottom_data = array_merge($this->_document_bottom_data, (array)$data);
	}

	public function setDocumentHead($head){
		$this->_document_head = $head;
	}

	public function setDocumentBottom($bottom){
		$this->_document_bottom = $bottom;
	}
}
?>
