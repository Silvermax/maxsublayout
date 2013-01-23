<?php
/**
 * A sublayoutpage redirects to parent when the page is visited.
 *
 * @package cms
 * @subpackage content
 */
class SublayoutPage extends Page {

	static $description = 'Redirects to parent page. This page is here only for holding some content. Doest have own page with url...';

	/**
	 * Returns this page if the redirect is external, otherwise
	 * returns the target page.
	 * @return SiteTree
	 */
	function ContentSource() {
		return $this->Parent();
	}
	
	/**
	 * Return the the link that should be used for this redirector page, in navigation, etc.
	 * If the redirectorpage has been appropriately configured, then it will return the redirection
	 * destination, to prevent unnecessary 30x redirections.  However, if it's misconfigured, then
	 * it will return a link to itself, which will then display an error message. 
	 */
	function Link() {
		if($link = $this->redirectionLink()) return $link;
		else return $this->regularLink();
	}
	
	/**
	 * Return the normal link directly to this page.  Once you visit this link, a 30x redirection
	 * will take you to your final destination.
	 */
	function regularLink($action = null) {
		return parent::Link($action);
	}
	
	/**
	 * Return the link that we should redirect to.
	 * Only return a value if there is a legal redirection destination.
	 */
	function redirectionLink() {
			return ($parent = $this->Parent()) ? $parent->Link() : false;
	}
	
	function MenuTitle() {
		return ($parent = $this->Parent()) ? $parent->Title : $this->Title;
	}
	
	function syncLinkTracking() {
			if($this->ParentID) {
				$this->HasBrokenLink = DataObject::get_by_id('SiteTree', $this->ParentID) ? false : true;
			} else {
				// An incomplete redirector page definitely has a broken link
				$this->HasBrokenLink = true;
			}
	}


	function getCMSFields() {
		//Requirements::javascript(CMS_DIR . '/javascript/RedirectorPage.js');
		
		$fields = parent::getCMSFields();
		$fields->removeByName('Perex');
		
		// Remove all metadata fields, does not apply for redirector pages
		$fields->removeByName('MetaTagsHeader');
		$fields->removeByName('MetaTitle');
		$fields->removeByName('MetaKeywords');
		$fields->removeByName('MetaDescription');
		$fields->removeByName('ExtraMeta');
			
		return $fields;
	}
	
	// Don't cache RedirectorPages
	function subPagesToCache() {
		return array();
	}
	
	function Perex() {
		return $this->Content;
	}
}

/**
 * Controller for the {@link RedirectorPage}.
 * @package cms
 * @subpackage content
 */
class SublayoutPage_Controller extends Page_Controller {

	function init() {
		parent::init();

		if($link = $this->redirectionLink()) {
			$this->redirect($link, 301);
			return;
		}
	}
	
	/**
	 * If we ever get this far, it means that the redirection failed.
	 */
	function Content() {
		return "<p class=\"message-setupWithoutRedirect\">" .
			_t('RedirectorPage.HASBEENSETUP', 'A redirector page has been set up without anywhere to redirect to.') .
			"</p>";
	}
}
