{assign var="colCount" value=$DAYS|@count}
<link rel="stylesheet" type="text/css" href="{sugar_getjspath file='modules/Connectors/tpls/tabs.css'}"/>
<script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js"></script>
<form name="employeeAclTabs" id="employeeAclTabs" method="POST" action="#">
<input type="hidden" id="action" name="action" value="employee_acl">
<input type="hidden" id="module" name="module" value="Users">
<table id="dashletPanel" cellpadding='0' cellspacing='0' width='100%' border='0'>
	<thead>	
    <tr >
        <td colspan='{$colCount+1}' align='right'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                    <td align='left'>
						<div style='float: left; width: 20%;'>{$previous}
						</div>
							
					</td>
                    <td align='right'>
						<div style='float: right;'>{$next}
						</div>
					</td>
                </tr>
            </table>
			</form>

        </td>
    </tr>
	</thead></table>
	<table width="100%">
	<tbody>
		<tr>
			<td>
				<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('employeeAclTabs');_form.action.value = 'employee_acl'; if(check_form('employeeAclTabs'))SUGAR.ajaxUI.submitForm(_form); window.onbeforeunload = null;return false;" type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}" />
				<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button"  type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" onclick="SUGAR.ajaxUI.loadContent('index.php?module=Users&action=employee_schedule'); return false;">
			</td>
		</tr>
		<tr height='20' style="background-color:#F2F2F2;">
			<td width="2%">Employees</td>
				{foreach from=$DAYS key=day_name item=date}
			<td>{$day_name}<br>{$date}</td>
				{/foreach}
		</tr> 
	
		{foreach from=$EMPLOYEES key=fitter item=params}
			<tr style="border:1px dotted #000;">
				<td width="12%" style="background-color:#F2F2F2;">
					{$fitter}
				</td>
				{foreach from=$params key=day_name item=schedule_data}
					<td width="12%" style="border-left:1px dotted lightgray;border-right:1px dotted lightgray;border-top:1px dotted lightgray;border-bottom:1px dotted lightgray;">
						<div  class="scrollbar" id="scroll_id">
							<div id="{$day_name}_{$schedule_data.user_id}" style="display: none;">
								<select  name='dropdown_list_{$day_name}_{$schedule_data.user_id}' id = 'dropdown_list_{$day_name}_{$schedule_data.user_id}' onchange="document.getElementById('work_status_{$day_name}_{$schedule_data.user_id}').innerHTML=this.options[this.selectedIndex].text; aclviewer.toggleDisplay('{$day_name}','{$schedule_data.user_id}');">
									{html_options  options=$WORK_ENUM}
								</select>
							</div>
							{if $READONLY neq 1}
							{if !empty($schedule_data.work_status)}
								{if $schedule_data.work_status neq 'WORKING'}
									<div id="work_status_{$day_name}_{$schedule_data.user_id}"  onclick="aclviewer.toggleDisplay('{$day_name}','{$schedule_data.user_id}')"> 	{$schedule_data.work_status}</div>
								{elseif $schedule_data.work_status eq 'WORKING'}
									<div id="work_status_{$day_name}_{$schedule_data.user_id}"  onclick="aclviewer.toggleDisplay('{$day_name}','{$schedule_data.user_id}')">	{$schedule_data.time_stamp} </div>
								{/if}
								{else}
								<div id="work_status_{$day_name}_{$schedule_data.user_id}"  onclick="aclviewer.toggleDisplay('{$day_name}','{$schedule_data.user_id}')">{$schedule_data.work_status} </div>				
							{/if}
							{else}							
								{if !empty($schedule_data.work_status)}
									{if $schedule_data.work_status neq 'WORKING'}
										<div id="work_status_{$day_name}_{$schedule_data.user_id}"  > 	{$schedule_data.work_status}</div>
									{elseif $schedule_data.work_status eq 'WORKING'}
										<div id="work_status_{$day_name}_{$schedule_data.user_id}" >	{$schedule_data.time_stamp} </div>
									{/if}
									{else}
									<div id="work_status_{$day_name}_{$schedule_data.user_id}" >{$schedule_data.work_status} </div>				
								{/if}							
							{/if}
							<input type="hidden" id="schedule_date_{$day_name}_{$schedule_data.user_id}" name="schedule_date_{$day_name}_{$schedule_data.user_id}" value="{$day_name}">
							<input type="hidden" id="dropdown_{$day_name}_{$schedule_data.user_id}" name="dropdown_{$day_name}_{$schedule_data.user_id}" value="">
							<input type="hidden" id="date_start_{$day_name}_{$schedule_data.user_id}" name="date_start_{$day_name}_{$schedule_data.user_id}" value="{$schedule_data.start_date}">
							<input type="hidden" id="date_end_{$day_name}_{$schedule_data.user_id}" name="date_end_{$day_name}_{$schedule_data.user_id}" value="{$schedule_data.end_date}">
							<div id="note_dialog_{$day_name}_{$schedule_data.user_id}" style="display:none; background-color:white;">
								<div id="start_end_{$day_name}_{$schedule_data.user_id}"style="    position: relative; left: 38px; top: 2px;">
									<table>
										<tr>
											<td>Start:</td><td><input name="start_date_{$day_name}_{$schedule_data.user_id}" id="start_date_{$day_name}_{$schedule_data.user_id}" style="background: whitesmoke;" tabindex="2" maxlength="10" size="11" readonly="" type="text" value="{$day_name}">	
										<img src="themes/Sugar5/images/Calendar.gif" align="absmiddle" id="start_date_{$day_name}_{$schedule_data.user_id}_trigger" alt="Enter Date"></td><td><select  name='start_hours_{$day_name}_{$schedule_data.user_id}' id = 'start_hours_{$day_name}_{$schedule_data.user_id}'>{html_options  options=$HOURS selected=$default_hours}</select></td><td><select  name='start_minutes_{$day_name}_{$schedule_data.user_id}' id = 'start_minutes_{$day_name}_{$schedule_data.user_id}'>{html_options  options=$MINUTES selected=$default_minutes}</select></td><td><select  name='start_meridium_{$day_name}_{$schedule_data.user_id}' id = 'start_meridium_{$day_name}_{$schedule_data.user_id}'>{html_options  options=$meridium selected=$default_meridium}</select></td>
										</tr>
										<tr>
											<td>End:</td><td><input name="end_date_{$day_name}_{$schedule_data.user_id}" id="end_date_{$day_name}_{$schedule_data.user_id}"  style="background: whitesmoke;" tabindex="2" maxlength="10" size="11" readonly="" type="text" value="{$day_name}">	
											<img src="themes/Sugar5/images/Calendar.gif" align="absmiddle" id="end_date_{$day_name}_{$schedule_data.user_id}_trigger" alt="Enter Date"></td><td><select  name='end_hours_{$day_name}_{$schedule_data.user_id}' id = 'end_hours_{$day_name}_{$schedule_data.user_id}'>{html_options  options=$HOURS selected=$default_end_hours}</select></td><td><select  name='end_minutes_{$day_name}_{$schedule_data.user_id}' id = 'end_minutes_{$day_name}_{$schedule_data.user_id}'>{html_options  options=$MINUTES selected=$default_end_minutes}</select>	</td><td><select  name='end_meridium_{$day_name}_{$schedule_data.user_id}' id = 'end_meridium_{$day_name}_{$schedule_data.user_id}'>{html_options  options=$meridium selected=$default_end_meridium}}</select></td>	
										</tr>
									</table>
								</div>
							</div>
							<script type="text/javascript">
								{literal}
										$( document ).ready(function() {
												document.getElementById("dropdown_{/literal}{$day_name}_{$schedule_data.user_id}{literal}").value=document.getElementById("work_status_{/literal}{$day_name}_{$schedule_data.user_id}{literal}").innerHTML;			
											});
								Calendar.setup ({
									inputField : "start_date_{/literal}{$day_name}_{$schedule_data.user_id}{literal}",  
									ifFormat : "%m/%d/%Y %I:%M%P",
									daFormat : "%m/%d/%Y %I:%M%P",
									showsTime : false, 
									button : "start_date_{/literal}{$day_name}_{$schedule_data.user_id}{literal}_trigger", 
									singleClick : true, 
									step : 1, 
									startWeekday: "0", 
									weekNumbers:false
								});	
								Calendar.setup ({
									inputField : "end_date_{/literal}{$day_name}_{$schedule_data.user_id}{literal}",  
									ifFormat : "%m/%d/%Y %I:%M%P",
									daFormat : "%m/%d/%Y %I:%M%P",
									showsTime : false, 
									button : "end_date_{/literal}{$day_name}_{$schedule_data.user_id}{literal}_trigger", 
									singleClick : true, 
									step : 1, 
									startWeekday: "0", 
									weekNumbers:false
								});	
								{/literal}
							</script>
							
						</div>
					</td>	
				{/foreach}
				</tr>
		{/foreach}
    </tbody> 
</table>
<div id="svbsjd" style="background-color: rgb(246, 245, 229);">
<div id="dialogForURL" ><div id="" ></div></div>
</div>	
</form>
<span id='_dropdown_value' style="display:none;">{html_options options=$WORK_ENUM}</span>
	{literal}
	<script type="text/javascript">
	var aclviewer = function() {
    var lastDisplay = '';
    return {
        toggleDisplay: function(day,id) {
			document.getElementById("dropdown_"+day+"_"+id).value=document.getElementById("work_status_"+day+"_"+id).innerHTML;
            if (aclviewer.lastDisplay != '' && typeof(aclviewer.lastDisplay) != 'undefined') {
                aclviewer.hideDisplay(day,id);
            }
            if (aclviewer.lastDisplay != day+'_'+id) {
                aclviewer.showDisplay(day,id);
                aclviewer.lastDisplay = day+'_'+id;
            } else {
                aclviewer.lastDisplay = '';
            }
        },
        hideDisplay: function(day,id) {
            document.getElementById(day+'_'+id).style.display = 'none';
            document.getElementById("work_status_"+day+"_"+id).style.display = '';
			work_status=document.getElementById("work_status_"+day+"_"+id).innerHTML;
			if(work_status=="WORKING"){
				addNote(id,day);
			}
        },
        showDisplay: function(day,id) {
            document.getElementById(day+'_'+id).style.display = '';
            document.getElementById("work_status_"+day+"_"+id).style.display = 'none';
        }
    };
}();
	function addNote(user_id,day){
		document.getElementById("note_dialog_"+day+"_"+user_id).style.display = 'block';	
		var quickEditDialog = new YAHOO.widget.Dialog('note_dialog_'+day+"_"+user_id, {
			 width: "40em",
			fixedcenter: true,
			modal: true
		
		});

		var handleCancel = function() {
			this.cancel();
		};
		var handleSubmit = function() {
			start_date = document.getElementById("start_date_"+day+"_"+user_id).value;
			start_hour = document.getElementById("start_hours_"+day+"_"+user_id).value;
		    start_min = document.getElementById("start_minutes_"+day+"_"+user_id).value || '00';
			start_meridium = document.getElementById("start_meridium_"+day+"_"+user_id).value;
			if(start_meridium == 'am' || (start_meridium == 'pm' && start_hour==12)){
				start_hour = start_hour;
			}else{
				start_hour = parseInt(start_hour, 10)+12;
				if(start_hour >= 24){
					start_hour = 00;	
				}
			}
			end_date = document.getElementById("end_date_"+day+"_"+user_id).value;
			end_hour = document.getElementById("end_hours_"+day+"_"+user_id).value;
			end_min = document.getElementById("end_minutes_"+day+"_"+user_id).value || '00';
			end_meridium = document.getElementById("end_meridium_"+day+"_"+user_id).value;
			if(end_meridium == 'am'  || (end_meridium == 'pm' && end_hour == 12)){
				end_hour = end_hour;
			}else{
				end_hour=parseInt(end_hour, 10)+12;
				if(end_hour>=24){
					end_hour=00;	
				}
			}
			date_start = start_date+" "+start_hour+":"+start_min+":00";
			date_end = end_date+" "+end_hour+":"+end_min+":00";
			document.getElementById("date_start_"+day+"_"+user_id).value=date_start;
			document.getElementById("date_end_"+day+"_"+user_id).value=date_end;
			this.hide();
		};
		var myButtons = [
			{ text: "Save", handler: handleSubmit, isDefault: true },
			{ text: "Cancel", handler: handleCancel }
		];

		quickEditDialog.cfg.queueProperty("buttons", myButtons);
		quickEditDialog.setHeader("Working Dates")
		 
		quickEditDialog.render(document.body);	
		quickEditDialog.show();		
	}	

	
	</script>
		<style>
		.scrollbar {
		margin-left: 5px;
		float: left;
		height: 25px;
		width: 90%;
		background: #FFF;
		margin-bottom: 5px;
	}	
	#scroll_id::-webkit-scrollbar-track
	{
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		border-radius: 10px;
		background-color: #FFF;
	}	
		</style>
	{/literal}
	
