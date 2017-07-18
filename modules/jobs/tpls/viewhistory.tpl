<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<!--<link rel="stylesheet" href="modules/jobs/css/style.css" />
 DataTables CSS -->
<link rel="stylesheet" type="text/css" href="modules/jobs/css/style.css">
  
<!-- jQuery -->


<title>Job History</title>
</head>
<body onUnload="window.location.reload();">
<h3>Job: {$selected_records} </h3>
	<table class="" id="job_history">
		{if !empty($results)}
		<thead>
			<tr>
				<th scope="col" valign="top" align="left">
					Timestamp
				</th>
				<th scope="col" valign="top" align="left">
					Associate
				</th>
				<th scope="col" valign="top" align="left">
					Action
				</th>
				<th scope="col" valign="top" align="left">
					Info
				</th>
			</tr>
		</thead>
		{/if}
		<tbody>
		{foreach key=id item=con from=$results}
			<tr class="{$con.css_class}"  height="20">
				<td class="" valign="top" align="left">
					{$con.date_entered}	
				</td>
				<td class="" valign="top" align="left">
					{$con.name}	
				</td>
				<td class="" valign="top" align="left">
					{$con.action_job}	
				</td>
				<td class="" valign="top" align="left">
					{$con.action_info}	
				</td>
				</tr>
					{foreachelse}
				<tr>
				<td colspan="4" valign="top" align="left">
					No history exists for this job.
				</td>	
			</tr>
				 
		{/foreach}
		</tbody>
	</table>
</body>
</html>
