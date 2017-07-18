<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<script type="text/javascript" src="{sugar_getjspath file='cache/include/javascript/sugar_grp_yui_widgets.js'}"></script>
<script type="text/javascript" src="{sugar_getjspath file='modules/jobs/js/jobs.js'}"></script>

 <!--CSS -->
 <link rel="stylesheet" type="text/css" href="modules/jobs/css/style_jobqueue.css">
<title>Jobs Queue</title>
</head>
<body onUnload="window.location.reload();">
	<div  id="jobs_queue" style="display:inline">
		{if !$smarty.request.fromDashlet}
			<h3>Jobs Queue </h3>
		{/if}
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="list view">
			<tbody>
				<tr  role="presentation">
					<td colspan="20" align="right">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody>
							<tr>
							<td nowrap="" align="right">
								<select name="sort" id="sort" size="1" style="width: 150px"  onchange="getsort(this.value);">
									<option value=""></option>
									<option value="by_due_date">Deliverable By Due Date</option>
									<option value="by_name">Deliverable By Name</option>
									<option value="by_position">Jobs by Position</option>
								</select>
							</td>
							</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr height="20">
					<th scope="col" width="4%">
						<span sugar="slot0" style="white-space:normal;">
							<a>Position</a>
						</span>
					</th>
					<th scope="col" width="15%">
						<span sugar="slot0" style="white-space:normal;">
							<a>Task </a>
						</span>
					</th>
					<th scope="col" width="10%">
						<span sugar="slot0" style="white-space:normal;">
							<a>Status</a>
						</span>
					</th>
					<th scope="col" width="10%">
						<span  sugar="slot1" style="white-space:normal;">
							<a class="listViewThLinkS1">Time Remaining &nbsp;</a>
						</span>
					</th>
					<th scope="col" width="10%">
						<span sugar="slot2" style="white-space:normal;">
						<a class="listViewThLinkS1" >Start Time</a>
						</span>
					</th>
					<th scope="col" width="7.5%">
						<span sugar="slot3" style="white-space:normal;">
							<a class="listViewThLinkS1" >Est Stop Time </a>
						</span>
					</th>
					<th scope="col" width="7.5%">
						<span sugar="slot3" style="white-space:normal;">
							<a class="listViewThLinkS1" >Priority Ratio </a>
						</span>
					</th>
					<th scope="col" width="15%" >
					<span sugar="slot4" style="white-space:normal;">
					<a class="listViewThLinkS1" >Associate</a>
					</span>
					</th>
					<th scope="col" width="20%">
						<span sugar="slot5" style="white-space:normal;">
							<a class="listViewThLinkS1" >
							</a>
						</span>
					</th>
				</tr>
				{assign var="count_project" value='0'}
				{foreach key=id item=con from=$results}
				<tr id="" class="parentListRow">
					<td colspan="9">
						<div id="title_{$con.project_id}_{$count_project}" >
							<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formHeader h3Row">
								<tbody>
									<tr>
									<td nowrap="" width="60%">
										<h3>
										<span>
											<a name="{$con.project_id}_{$count_project}"> </a>
											<span id="show_link_{$con.project_id}_{$count_project}" style="display: inline ">
												<a href="#" class="utilsLink" onclick="queueSubPanel('{$con.project_id}_{$count_project}'); return false;">
												<img src="themes/Sugar5/images/advanced_search.gif?v=wnp0HbAFkNhCwf9l6DueSA" border="0" align="absmiddle" alt="Show">
												</a>
											</span>
											<span id="hide_link_{$con.project_id}_{$count_project}" style="display: none">
												<a href="#" class="utilsLink" onclick="queueSubPanel('{$con.project_id}_{$count_project}');return false;">
												<img src="themes/Sugar5/images/basic_search.gif?v=wnp0HbAFkNhCwf9l6DueSA" border="0" align="absmiddle" alt="Hide">
												</a>
											</span> {$con.project_name}&nbsp;
										</span>
										</h3>
									</td>
									<td width="20%">
									<h3>Tasks Remaining: {$con.total_time}</h3>
									</td>
									<td width="20%">
									<h3>Due: {$con.due}</h3>
									</td>
									
									</tr>
									
								</tbody>
							</table>	
						</div>
						<div id="list_{$con.project_id}_{$count_project}" style="display: none;"  >
						<table cellpadding="0" cellspacing="0" width="100%" border="0" class="list"  >
						<tbody>
						{foreach key=job_id item=jobs from=$con.jobs}
						<tr height="30" id="list" >
							<td scope="col" width="4%">
							{$jobs.order_number}	
							</td>
							<td scope="col" width="15%">
							{$jobs.job_name}	
							</td>
							<td scope="col" width="10%">
							{$jobs.status}	
							</td>
							<td scope="col" width="10%">
							{$jobs.time_remainig}	
							</td>
							{assign var="col" value="black"}
							{assign var="colors" value="black"}
							{if $jobs.start_time > $jobs.project_due_date}
							{assign var="col" value="red"}
							{/if}
							<td scope="col" width="10%" style="{$col}">
							{$jobs.start_time}	
							</td>
							{if $jobs.finish_time > $jobs.project_due_date}
							{assign var="colors" value="red"}
							{/if}
							<td scope="col" width="10%" style="color:{$colors}">
							{$jobs.finish_time}	
							</td>
							<td scope="col" width="5%">
							{$jobs.priority_ratio}
							</td>
							<td scope="col" width="5%">
							{$jobs.associate}
							</td>
							<td width="14%">
							<ul class="clickMenu fancymenu SugarActionMenu">
									<li class="single">
										<a id="reassign_button"  href="javascript:reassignDialog('{$jobs.job_id}','{$jobs.associate_id}','{$jobs.project_task_id}' );">Re&nbsp;assign</a>
									</li>
							</ul>
							</td>
							<td scope="col" width="16%" align="right">
							<ul class="clickMenu fancymenu SugarActionMenu">
									<li class="single">
										<a id="special_handling_button" href="javascript:specialHandleMsg('{$jobs.job_id}','{$jobs.job_name}');">Special&nbsp;Handling</a>
									</li>
							</ul>	
							</td>
						</tr>
						{/foreach}
						</tbody>
						</table>
						</div>
					</td>
				</tr>
				{assign var="count_project" value=$count_project+1}
				{/foreach}
				<tr>
					<td align="left" colspan="2">
						<ul class="clickMenu fancymenu SugarActionMenu">
							<li class="single">
								<form  method="post" name="form" id="">
								<a id="add_job_button" href="javascript:addJobDialog();">Add Job to Queue</a>
								</form>
							</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="add_job_dialog" style="display:none;" onload="">
	<h4>Loading...</h4>
	</div>
	<div id="reassign_dialog" style="display:none;" onload="">
	<h4>Loading...</h4>
	</div>	
	
</body>
</html>
