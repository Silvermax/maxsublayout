<?php

if (class_exists('GoogleSitemap')) {

class MyGoogleSitemap extends GoogleSitemap {
	
		protected function getPages() {
		if(!class_exists('SiteTree')) return new ArrayList();

		$filter = (self::$use_show_in_search) ? "\"ShowInSearch\" = 1" : "";
		$pages = Versioned::get_by_stage('SiteTree', 'Live', $filter);
		$output = new ArrayList();
		
		if($pages) {
			foreach($pages as $page) {
				$origpage = $page;
				$isSublayoutPage = false;
				if ($page instanceof RedirectorPage) {
					if ($page->RedirectionType == "Internal") {
						if ($p = $page->LinkTo()) {
							$page = $p;
						}
					}	
				} elseif ($page instanceof SublayoutPage) {
						if ($p = $page->Parent()) {
							$page = $p;
							$isSublayoutPage = true;
						}
				} 
				
				$pageHttp = parse_url($page->AbsoluteLink(), PHP_URL_HOST);
				$hostHttp = parse_url('http://' . $_SERVER['HTTP_HOST'], PHP_URL_HOST);
				
				if(($pageHttp == $hostHttp) && !($page instanceof ErrorPage)) {
					if($page->canView() && (!isset($page->Priority) || $page->Priority > 0)) {
						if ($f = $output->find("ID",$page->ID)) {
							// Change LastEdited date only for sublayoutpage...
							if ($f->LastEdited < $origpage->LastEdited && $isSublayoutPage) $f->LastEdited = $origpage->LastEdited;
						} else {
							$output->push($page);
						}
					}
				}
			}
		}

		return $output;
	}
	
}

}
