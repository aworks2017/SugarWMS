<?php
class queueHook {
    function addNoteIcon(&$bean, $event, $arguments){
		if(!empty($bean->notes)){
			$bean->notes = '<span id="notes_'.$bean->id.'" style="display:none;">'.$bean->notes.'</span><img title="Job Notes" width="15px;" style="cursor: pointer;" src="custom/themes/images/notepad.png" onclick="showNotes(\'notes_'.$bean->id.'\', \'notes\', \'Associate Notes\')">';
		}
		$bean->production_notes = '<span id="production_notes_'.$bean->id.'" style="display:none;">'.$bean->production_notes.'</span><img title="Job Notes" width="15px;" style="cursor: pointer;" src="custom/themes/images/notepad.png" onclick="showNotes(\'production_notes_'.$bean->id.'\', \'production_notes\', \'Production Notes\')">';
    }
}
