<?php
class ht_project_task_abilityHook {
    function changeAbilityLevel(&$bean, $event, $arguments){
		$bean->ability_level = "<span id='{$bean->id}' class='ability_level'>{$bean->ability_level}</span>";
    }
}
