<?php
class PerexExtension extends DataExtension {
	
	static $db = array(
		'Perex' => 'HTMLText'	
	);
	
	public function updateCMSFields(FieldList $fields) {
		// Show In Extra Menu?	      
		$fields->addFieldToTab("Root.Perex", new HtmlEditorField("Perex","Perex"));
	}
	
	/***
	 * No perex means, Content is used as Perex. hasReadmoreLink() rerutns false in this screnario!  
	 */
	public function Perex() {
		return ($this->owner->Perex) ? $this->owner->Perex : $this->owner->Content;
	}
	
	/*** 
	 * This is too generic method. Use custom version on your page classes
	 */
	public function hasReadMoreLink() {
		return ((($this->owner->Content && $this->owner->Perex) || ($this->owner instanceof RedirectorPage) || $this->owner->Children()) && Controller::curr()->ID != $this->owner->ID) ? true : false;
	}
					
}
