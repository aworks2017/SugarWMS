<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<script type="text/javascript" src="{sugar_getjspath file='cache/include/javascript/sugar_grp_yui_widgets.js'}"></script>

 <!--CSS -->
 <link rel="stylesheet" type="text/css" href="modules/jobs/css/style_jobqueue.css">
<title></title>
</head>
<body onUnload="window.location.reload();">
	<div  id="jobs_queue" class="jobs_queue" style="display:inline">
		<div class="action_btns">
			<input type="button" name="select_all" value="Select All" onclick="$('.tasks_checkboxes').prop('checked', true);">
			<input type="button" name="unselect_all" value="Unselect All" onclick="$('.tasks_checkboxes').prop('checked', false);">
		</div>
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="yui3-skin-sam edit view panelContainer">
			<tbody>
				{foreach key=id item=con from=$results}
				{assign var="TASK_ID" value=$con.task_id}
				<tr id="" class="parentListRow">
					<td colspan="7">
						<div id="title_{$TASK_ID}" >
							<table width="100%" height="245" >
								<tr>
									<td width="63">
										<input title="Select this Task" type="checkbox" class="checkbox tasks_checkboxes" name="tasks[]" value="{$con.task_id}" checked>
									</td>
									<td colspan="2">
										{$con.task_name}
										<input type="hidden" id="task_name_{$TASK_ID}" name="task_name_{$TASK_ID}" value="{$con.task_name}"/>
									</td>
									<td width="145"></td>
									<td width="147">
										
									</td>
								</tr>
								<tr>
									<td rowspan="5">&nbsp;</td>
									<td width="131">Status</td>
									<td width="150">
										<slot>
											{html_options name="task_status$TASK_ID" options=$JOB_STATUS_DOM }
										</slot>	
									</td>
								</tr>	
								<tr>
									
									<td width="50">Assigned To</td>
									<td width="40">
										<slot>
											{html_options name="assigned_user_id_drop_$TASK_ID" options=$ASSIGN_USERS[$TASK_ID]}
										</slot>	
											&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" value="1" id="other_users_{$TASK_ID}" class="checkbox" onclick="showAllUsers('{$TASK_ID}');">
											<input type="hidden" value="0" id="other_users_{$TASK_ID}" class="checkbox">Others:</label></td><td width="40"><div id="disbaled_user_selct_{$TASK_ID}" style="display:none;">
											<input type="text" name="assigned_user_name_{$TASK_ID}" class="sqsEnabled yui-ac-input automation_queue_user" tabindex="0" id="assigned_user_name_{$TASK_ID}" size="" value="" title="" autocomplete="on">
											<div id="EditView_assigned_user_name_results_{$TASK_ID}" class="yui-ac-container">
												<div class="yui-ac-content" style="display: none;">
													<div class="yui-ac-hd" style="display: none;">
													</div>
													<div class="yui-ac-bd">
														<ul>
														<li style="display: none;">
														</li>
														<li style="display: none;">
														</li>
														<li style="display: none;">
														</li><li style="display: none;">
														</li><li style="display: none;">
														</li><li style="display: none;">
														</li><li style="display: none;">
														</li><li style="display: none;">
														</li><li style="display: none;">
														</li><li style="display: none;">
														</li>
														</ul>
													</div>
													<div class="yui-ac-ft" style="display: none;">
													</div>
												</div>
											</div>
											<!---test commit-->
											<input type="hidden" class="automation_queue_user_id" name="assigned_user_id_{$TASK_ID}" id="assigned_user_id_{$TASK_ID}" value="">
											
												<button type="button" name="btn_assigned_user_name_{$TASK_ID}" id="btn_assigned_user_name_{$TASK_ID}" tabindex="0" title="Select User" class="button firstChild" value="Select User" onclick="open_popup(
												'Users', 
												600, 
												400, 
												'', 
												true, 
												false, 
												{ldelim}'call_back_function':'call_back_getusers','form_name':'CreatView','field_to_name_array':{ldelim}'id':'assigned_user_id_{$TASK_ID}','user_name':'assigned_user_name_{$TASK_ID}'{rdelim}{rdelim}, 
												'single', 
												true
												);">
												<img src="themes/default/images/id-ff-select.png?v=wnp0HbAFkNhCwf9l6DueSA">
												</button>
												<button type="button" name="btn_clr_assigned_user_name_{$TASK_ID}" id="btn_clr_assigned_user_name_{$TASK_ID}" tabindex="0" title="Clear User" class="button lastChild" onclick="SUGAR.clearRelateField(this.form, 'assigned_user_name_{$TASK_ID}', 'assigned_user_id_{$TASK_ID}');" value="Clear User">
												<img src="themes/default/images/id-ff-clear.png?v=wnp0HbAFkNhCwf9l6DueSA">
												</button>
											
											</div>
									</td></td>
								<script type="text/javascript">
									extendSqs('{$con.sqs_data}');
								</script>	
								</tr>
								<tr>
									<td >Estimated Effort</td>
									<td colspan="3">
										<slot><input type="text" name="estimated_minutes_{$TASK_ID}" id="estimated_minutes_{$TASK_ID}"  value="{$con.estimated_effort}" title=""></slot>
									</td>
								</tr>	
								<tr>
									<td >Production Notes </td>
									<td colspan="3">
										<slot><textarea name='production_notes_{$con.task_id}' tabindex='1' cols="50" rows="4">{$con.production_notes}</textarea></slot>
									</td>
								</tr>
							</table>	
						</div>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
	<div id="add_job_dialog" style="display:none;" onload="">
	<h4>Loading...</h4>
	</div>	
	{literal}
		<script type="text/javascript">
	function showAllUsers(id){
		$('#other_users_'+id).change(function(){
		if(this.checked)
			$('#disbaled_user_selct_'+id).fadeIn('slow');
		else
			$('#disbaled_user_selct_'+id).fadeOut('slow');
		}); 	
	}	
		enableQS();
		</script>	
	{/literal}	
</body>
</html>

