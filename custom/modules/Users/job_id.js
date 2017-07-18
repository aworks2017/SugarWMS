function updateJobId(user_id,job_id){
	if(confirm('do you want to change current_job_id to Null?')){
		$.ajax({
			url: "index.php?module=Users&action=update_current_job_id",
			type: "POST",
			contentType: "application/x-www-form-urlencoded",
			dataType: "text",
			data:"id="+user_id+"&job_id="+job_id,						
			success : function (result){
				$("#"+user_id).html('');
			}
		});
	}
	return false;
}