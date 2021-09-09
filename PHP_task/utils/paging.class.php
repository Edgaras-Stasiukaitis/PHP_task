<?php

class paging {
	
	public $first;
	public $size;
	public $totalRecords;
	public $totalPages;
	public $data = array();
	
	public function __construct($rowsPerPage) {
		$this->size = $rowsPerPage;
	}
	
	public function process($total, $currentPage) {
		$pageCount = ceil($total / $this->size);
		$this->totalRecords = (int) $total;
		$this->totalPages = (int) ($pageCount) ? $pageCount : 1;
		$this->first = ($currentPage - 1) * $this->size;
		for($i = 1; $i <= $pageCount; $i++) {
			$row['isActive'] = ($i == $currentPage) ? 1 : 0;
			$row['page'] = $i;
			$this->data[] = $row;
		}
	}
	
	function get_pagination_links($total, $currentPage, $data, $url)
	{
		$links = "";
		if ($total >= 1 && $currentPage <= $total) {
			$links .= "<li class='page-item".($data[0]['isActive'] == 1 ? ' active' : '')."'><a class='page-link' href='{$url}&page=1'>1</a></li>";
			$i = max(2, $currentPage - 5);
			if ($i > 2)
				$links .= "<li class='page-item'><a class='page-link'>...</a></li>";
			for (; $i < min($currentPage + 6, $total); $i++) {
				$links .= "<li class='page-item".($data[$i-1]['isActive'] == 1 ? ' active' : '')."'><a class='page-link' href='{$url}&page={$i}'>{$i}</a></li>";
			}
			if ($i != $total && $total > 5){
				$links .= "<li class='page-item'><a class='page-link'>...</a></li>";
			}
			if ($total != 1)
				$links .= "<li class='page-item".($data[count($data)-1]['isActive'] == 1 ? ' active' : '')."'><a class='page-link' href='{$url}&page={$total}'>{$total}</a></li>";
		}
		return $links;
	}
}

?>