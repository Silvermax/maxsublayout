<?php
class PerexExtension extends DataExtension {
	
	static $db = array(
		'Perex' => 'HTMLText'	
	);
	
	public function updateCMSFields(FieldList $fields) {
		// Show In Extra Menu?	      
		$fields->addFieldToTab("Root.Perex", new HtmlEditorField("Perex","Perex"));
	}
	
	public function Perex() {
		return ($this->owner->Perex) ? $this->owner->Perex : $this->owner->Content;
	}
	
	public function hasReadMoreLink() {
		return ((($this->owner->Content && $this->owner->Perex) || ($this->owner instanceof RedirectorPage)) && Controller::curr()->ID != $this->owner->ID) ? 1 : 0;
	}
					
}
