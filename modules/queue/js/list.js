function showNotes(note_id, field, label){
	var job_id = note_id.replace(field+"_", "");
	var notes_html = getNoteHtml($("#"+note_id).html(), job_id, field);
	YAHOO.SUGAR.MessageBox.show({msg: notes_html, title: label});
}
function editNote(job_id, field){
	var prev_note = $("#"+field+"_text").html();
	var updated_text = '<div id="'+field+'_edit" ><input type="hidden" name="job_id" id="job_id" value="'+job_id+'"><textarea id="'+field+'_updated" name="id="'+field+'_updated"">'+prev_note+'</textarea>';
	var updated_text =updated_text+ '<div class="btns"><input type="button" name="updateNote" value="Update" onclick="updateNote(\''+field+'\');"/></div></div>';
	$("#"+field).html(updated_text);
}
function updateNote(field){
	var note = $("#"+field+"_updated").val();
	var job_id = $("#job_id").val();
	var notes_html = getNoteHtml(note, job_id, field);
	$("#"+field+"_edit").html(notes_html);
	$("#"+field+"_"+job_id).html(note);
	$.ajax({
		url: "index.php?module=jobs&action=change_note",
		type: "POST",
		contentType: "application/x-www-form-urlencoded",
		dataType: "text",
		data:"sugar_body_only=1&job_id="+job_id+"&field="+field+"&field_val="+note,						
		success : function (result){
		}
	});
}
function getNoteHtml(notes, job_id, field){
	var notes_html = '<div id="'+field+'"><a href="javascript:editNote(\''+job_id+'\', \''+field+'\');"><img style="float: right;" src="themes/Sugar5/images/edit_inline.gif?v=cOMu0lKapcK3pXiPfO8l5w" border="0" alt="Edit"></a>&nbsp;&nbsp;<div id="'+field+'_text">'+notes+'</div></div>';
	return notes_html;
}