<?php
class Pagination{
	
	private $totalItems;					// Tổng số phần tử
	private $totalItemsPerPage		= 2;	// Tổng số phần tử xuất hiện trên một trang
	private $pageRange				= 3;	// Số trang xuất hiện
	private $totalPage;						// Tổng số trang
	private $currentPage			= 1;	// Trang hiện tại
	
	public function __construct($totalItems, $pagination){
		$this->totalItems			= $totalItems;
		$this->totalItemsPerPage	= $pagination['totalItemsPerPage'];
		
		if($pagination['pageRange'] %2 == 0) $pagination['pageRange'] = $pagination['pageRange'] + 1;
		
		$this->pageRange			= $pagination['pageRange'];
		$this->currentPage			= $pagination['currentPage'];
		$this->totalPage			= ceil($totalItems/$pagination['totalItemsPerPage']);
	}
	
	public function getTotalPage(){
		return $this->totalPage;
	}
	
	public function showPagination($link = null){
		// Pagination
		$paginationHTML = '';
		if($this->totalPage > 1){
			$start 	= '<li class="disabled"><a href="#">«</a></li>';
			$prev 	= '<li class="disabled"><a href="#">‹</a></li>';
			if($this->currentPage > 1){
				$page = $this->currentPage-1;
				
				if ($_GET['url']=="activeRecord") {
					$start 	= '<li><a href="#"  onclick="javascript:changePageActiveRecord(1)">«</a></li>';
					$prev 	= '<li><a href="#"  onclick="javascript:changePageActiveRecord('.$page.')">‹</a></li>';
				}else if ($_GET['url']=="business") {
					$start 	= '<li><a href="#"  onclick="javascript:changePageBusiness(1)">«</a></li>';
					$prev 	= '<li><a href="#"  onclick="javascript:changePageBusiness('.$page.')">‹</a></li>';
				}else if ($_GET['url']=="userMNMT") {
					$start 	= '<li><a href="#"  onclick="javascript:changePageUserMNMT(1)">«</a></li>';
					$prev 	= '<li><a href="#"  onclick="javascript:changePageUserMNMT('.$page.')">‹</a></li>';
				}else if ($_GET['url']=="unit") {
					$start 	= '<li><a href="#"  onclick="javascript:changePageUnit(1)">«</a></li>';
					$prev 	= '<li><a href="#"  onclick="javascript:changePageUnit('.$page.')">‹</a></li>';
				}else if ($_GET['url']=="municipality") {
					$start 	= '<li><a href="#"  onclick="javascript:changePageMunicipality(1)">«</a></li>';
					$prev 	= '<li><a href="#"  onclick="javascript:changePageMunicipality('.$page.')">‹</a></li>';
				}else if ($_GET['url']=="display_data") {
					$start 	= '<li><a href="#"  onclick="javascript:changePageDisplay_data(1)">«</a></li>';
					$prev 	= '<li><a href="#"  onclick="javascript:changePageDisplay_data('.$page.')">‹</a></li>';
				}else if ($_GET['url']=="display_data/historyExport") {
					$start 	= '<li><a href="#"  onclick="javascript:changePageDisplay_dataEX(1)">«</a></li>';
					$prev 	= '<li><a href="#"  onclick="javascript:changePageDisplay_dataEX('.$page.')">‹</a></li>';
				}else if ($_GET['url']=="userMNMT/List") {
					$start 	= '<li><a href="#"  onclick="javascript:changePageList(1)">«</a></li>';
					$prev 	= '<li><a href="#"  onclick="javascript:changePageList('.$page.')">‹</a></li>';
				}
			}
		
			$next 	= '<li class="disabled"><a href="#">›</a></li>';
			$end 	= '<li class="disabled"><a href="#">»</a></li>';
			if($this->currentPage < $this->totalPage){
				$page = $this->currentPage+1;
				if ($_GET['url']=="activeRecord") {
					$next 	= '<li><a href="#"  onclick="javascript:changePageActiveRecord('.$page.')">›</a></li>';
					$end 	= '<li><a href="#"  onclick="javascript:changePageActiveRecord('.$this->totalPage.')">»</a></li>';
				}else if ($_GET['url']=="business") {
					$next 	= '<li><a href="#"  onclick="javascript:changePageBusiness('.$page.')">›</a></li>';
					$end 	= '<li><a href="#"  onclick="javascript:changePageBusiness('.$this->totalPage.')">»</a></li>';
				}else if ($_GET['url']=="userMNMT") {
					$next 	= '<li><a href="#"  onclick="javascript:changePageUserMNMT('.$page.')">›</a></li>';
					$end 	= '<li><a href="#"  onclick="javascript:changePageUserMNMT('.$this->totalPage.')">»</a></li>';
				}else if ($_GET['url']=="unit") {
					$next 	= '<li><a href="#"  onclick="javascript:changePageUnit('.$page.')">›</a></li>';
					$end 	= '<li><a href="#"  onclick="javascript:changePageUnit('.$this->totalPage.')">»</a></li>';
				}else if ($_GET['url']=="municipality") {
					$next 	= '<li><a href="#"  onclick="javascript:changePageMunicipality('.$page.')">›</a></li>';
					$end 	= '<li><a href="#"  onclick="javascript:changePageMunicipality('.$this->totalPage.')">»</a></li>';
				}else if ($_GET['url']=="display_data") {
					$next 	= '<li><a href="#"  onclick="javascript:changePageDisplay_data('.$page.')">›</a></li>';
					$end 	= '<li><a href="#"  onclick="javascript:changePageDisplay_data('.$this->totalPage.')">»</a></li>';
				}else if ($_GET['url']=="display_data/historyExport") {
					$next 	= '<li><a href="#"  onclick="javascript:changePageDisplay_dataEX('.$page.')">›</a></li>';
					$end 	= '<li><a href="#"  onclick="javascript:changePageDisplay_dataEX('.$this->totalPage.')">»</a></li>';
				}else if ($_GET['url']=="userMNMT/List") {
					$next 	= '<li><a href="#"  onclick="javascript:changePageList('.$page.')">›</a></li>';
					$end 	= '<li><a href="#"  onclick="javascript:changePageList('.$this->totalPage.')">»</a></li>';
				}
			}
		
			if($this->pageRange < $this->totalPage){
				if($this->currentPage == 1){
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				}else if($this->currentPage == $this->totalPage){
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				}else{
					$startPage		= $this->currentPage - ($this->pageRange-1)/2;
					$endPage		= $this->currentPage + ($this->pageRange-1)/2;
		
					if($startPage < 1){
						$endPage	= $endPage + 1;
						$startPage = 1;
					}
		
					if($endPage > $this->totalPage){
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			}else{
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = '';
			for($i = $startPage; $i <= $endPage; $i++){
				if($i == $this->currentPage) {
					$listPages .= '<li class="active"><a href="#">'.$i.'</a></li>';
				}else{
					if ($_GET['url']=="activeRecord") {
						$listPages .= '<li><a href="#" onclick="javascript:changePageActiveRecord('.$i.')">'.$i.'</a></li>';
					}else if ($_GET['url']=="business") {
						$listPages .= '<li><a href="#" onclick="javascript:changePageBusiness('.$i.')">'.$i.'</a></li>';
					}else if ($_GET['url']=="userMNMT") {
						$listPages .= '<li><a href="#" onclick="javascript:changePageUserMNMT('.$i.')">'.$i.'</a></li>';
					}else if ($_GET['url']=="unit") {
						$listPages .= '<li><a href="#" onclick="javascript:changePageUnit('.$i.')">'.$i.'</a></li>';
					}else if ($_GET['url']=="municipality") {
						$listPages .= '<li><a href="#" onclick="javascript:changePageMunicipality('.$i.')">'.$i.'</a></li>';
					}else if ($_GET['url']=="display_data") {
						$listPages .= '<li><a href="#" onclick="javascript:changePageDisplay_data('.$i.')">'.$i.'</a></li>';
					}else if ($_GET['url']=="display_data/historyExport") {
						$listPages .= '<li><a href="#" onclick="javascript:changePageDisplay_dataEX('.$i.')">'.$i.'</a></li>';
					}else if ($_GET['url']=="userMNMT/List") {
						$listPages .= '<li><a href="#" onclick="javascript:changePageList('.$i.')">'.$i.'</a></li>';
					}
				}
			}
			$paginationHTML .= '<ul class="pagination pull-right">' .$start.$prev . $listPages . $next . $end.'</ul>';
		}
		return $paginationHTML;
	}


}