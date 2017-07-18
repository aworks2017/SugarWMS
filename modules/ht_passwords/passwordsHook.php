<?php
class passwordsHook {
    function copyPassword(&$bean, $event, $arguments){
		if(isset($_REQUEST['module']) && $_REQUEST['module'] == 'Project')
		$bean->password = '<input type="button" class="copy_password_btn" value="Copy" data-clipboard-demo="" data-clipboard-action="copy" data-clipboard-text="'.$bean->password.'">';
	}
}
