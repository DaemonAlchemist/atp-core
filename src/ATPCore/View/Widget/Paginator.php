<?php

namespace ATPCore\View\Widget;

class Paginator extends \ATPCore\View\Widget
{
	protected $_template = "atp-core/widget/paginator.phtml";
	
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
}
