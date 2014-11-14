<?php

namespace ATPCore\View\Widget;

class Paginator extends \ATPCore\View\Widget
{
	protected $_template = "atp-core/widget/paginator.phtml";
	
	public function __construct()
	{
		parent::__construct();
		
		$this->perPage = 20;
		$this->perPageOptions = array(20,50,100);
		$this->maxPagesToShow = 7;
	}
	
	public function setPageCount($pages)
	{
		$this->pageCount = $pages;
	}
	
	public function setCurrentPage($page)
	{
		$this->currentPage = $page;
	}
	
	public function setUrl($url)
	{
		$this->url = $url;
	}
	
	public function setObjectCount($count)
	{
		$this->objectCount = $count;
	}
	
	public function setPerPage($perPage)
	{
		$this->perPage = $perPage;
	}
	
	public function setPerPageOptions($options)
	{
		$this->perPageOptions = $options;
	}
	
	public function getPages()
	{
		$pages = array();
		for($page = 1; $page <=$this->pageCount; $page++)
		{
			if(
				$page == 1 ||
				$page == $this->pageCount ||
				abs($page - $this->currentPage) <= $this->maxPagesToShow - 2
			)
			{
				$pages[] = $page;
			}
			else if(abs($page - $this->currentPage) == $this->maxPagesToShow - 1)
			{
				$pages[] = "...";
			}
		}
		
		return $pages;
	}
}
