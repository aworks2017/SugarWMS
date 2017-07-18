{*
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

*}
{{capture name=display_size assign=size}}{{$displayParams.size|default:6}}{{/capture}}
{html_options id='{{$vardef.name}}' name='{{$vardef.name}}[]' options={{sugarvar key='options' string=true}} size="{{$size}}" style="width: 150px" {{if $size > 1}}multiple="1"{{/if}} selected={{sugarvar key='value' string=true}}}
{{if $vardef.name=='assigned_user_id_basic' && $smarty.request.module=='queue'}}
<button type="button" name="btn_clr_assigned_to" title="Clear" class="button lastChild" onclick="this.form.assigned_user_id_basic.value = '';" value="Clear"><img src="themes/default/images/id-ff-clear.png?v=sBDcZOFEUK5EFFANy8vBhg" alt=""></button>
{{/if}}
{{if $vardef.name=='status_basic' && ($smarty.request.module=='queue' || $smarty.request.module=='jobs')}}
<button type="button" name="btn_clr_status" title="Clear" class="button lastChild" onclick="this.form.status_basic.value = '';" value="Clear"><img src="themes/default/images/id-ff-clear.png?v=sBDcZOFEUK5EFFANy8vBhg" alt=""></button>
{{/if}}
{{if $vardef.name=='status_advanced' && ($smarty.request.module=='queue' || $smarty.request.module=='jobs')}}
<button type="button" name="btn_clr_status" title="Clear" class="button lastChild" onclick="this.form.status_advanced.value = '';" value="Clear"><img src="themes/default/images/id-ff-clear.png?v=sBDcZOFEUK5EFFANy8vBhg" alt=""></button>
{{/if}}