<?php

class SubLayoutPageExtension extends DataExtension {
	
	function Sublayout() {		
		$p = $this->owner;
		if ($this->owner instanceof RedirectorPage) {
			if ($this->owner->RedirectionType == "Internal") {
				if ($p = $this->owner->LinkTo()) {
					$render_classes[] = $p->ClassName; 
				}
			}
		}
		
		if ($this->owner->ClassName != "Page") {
				$render_classes[] = $this->owner->ClassName;	
		}
		
		$render_classes[] = "Page";
		
		foreach ($render_classes as $rc) {
				$rcs[] = "Sublayout/sl_".$rc; 
		}

       	return $this->owner->customise(array("FinalData" => $p))->renderWith($rcs);

	}
	
	
}
