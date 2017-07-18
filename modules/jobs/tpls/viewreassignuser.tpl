<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<script type="text/javascript" src="{sugar_getjspath file='modules/jobs/js/jobs.js'}"></script>
 <!--CSS -->
 <link rel="stylesheet" type="text/css" href="modules/jobs/css/style_jobqueue.css">
<title>Jobs Queue</title>
</head>
<body onUnload="window.location.reload();">
	<input type="hidden" name="job_id" value="{$job_id}">
	<input type="hidden" name="pro_t_id" value="{$pro_t_id}">
	<table cellpadding="0" cellspacing="0" width="100%" border="0"  class="parentTable">
		<tbody>
			<tr  role="presentation">
				<td nowrap=""  width="214px">
					{html_options id=reassign name=reassignuser options=$option selected=$assign_id}
				</td>
				<td>
					<ul class="clickMenu fancymenu SugarActionMenu">
						<li class="single">
							<a id="refresh_button" href="javascript:reassignSubmit('{$job_id}');">Re-Assign</a>
						</li>
					</ul>	
				</td>
			</tr>
	</table>
</body>
</html>
