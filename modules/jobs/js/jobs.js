$( document ).ready(function() {
    $( "#btn_clr_project_name" ).click(function() {
		$('.jobs_queue').remove();
	});
	$( "#account_id" ).change(function(){
		if($("#account_id").val()){
			getDeliverables($("#account_id" ).val());
		}
	});
	$( "#project_id" ).change(function() {
		$('.jobs_queue').remove();
		if($("#project_id" ).val()){
			getDeliverablesFields($("#project_id" ).val());
			call_back_deliverable('','',true);
		}
	});
	$('#CreateView_tabs').append("<div id='jobs_edit_tasks' class='jobs_edit_tasks'></div>");
	var $select = $('#account_id');
	$select.attr('style','font-family:"Courier New", Courier, monospace');
	var spacesToAdd = 1;
	var biggestLength = 0;
	$("#account_id option").each(function(){
		var len = $(this).text().length;
		if(len > biggestLength){
			biggestLength = len;
		}
	});
	var padLength = biggestLength + spacesToAdd;
	var account_options = '';
	$("#account_id option").each(function(){
		var this_instance = this;
		var parts = $(this_instance).text().split('|');
		var strLength = parts[0].length;
		for(var x=0; x<(padLength-strLength); x++){
			parts[0] = parts[0]+' '; 
		}
		if(typeof(parts[1]) =='undefined') parts[1]='';
		aa = parts[0].replace(/ /g, '\u00a0')+''+parts[1];
		account_options += '<option value="'+$(this_instance).val()+'">'+aa+'</option>';
	});
	$("#account_id").html(account_options);
});
function queueSubPanel(id) {
	$("#list_"+id).toggle();
	$("#hide_link_"+id).toggle();
	$("#show_link_"+id).toggle();
    return false;     
}
function populateDate(id) {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	if(dd<10) {
	dd='0'+dd
	} 
	if(mm<10) {
	mm='0'+mm
	}
	today = mm+'/'+dd+'/'+yyyy;
	$("#job_due_date_"+id).val(today);   
}
function refresh(){
	SUGAR.ajaxUI.showLoadingPanel();
	var sortBy = $("#sort").val();
		$.ajax({
			url: "index.php?module=jobs&action=queue&refresh_queue=1&sugar_body_only=true&sortBy="+sortBy,
			success: function(result){
				SUGAR.ajaxUI.hideLoadingPanel();
				location.reload();
			}
		});
	return true;
}
function getsort(sortBy){
	SUGAR.ajaxUI.showLoadingPanel();
	
	$( "#jobs_queue" ).load( "index.php?module=jobs&action=queue&sugar_body_only=true&sortBy="+sortBy, function( response, status, xhr ) {
		SUGAR.ajaxUI.hideLoadingPanel();
		$( "#sort" ).val(sortBy);
	}); 
	return false;	
}
function addJobDialog(){
	
	$("#add_job_dialog").load("index.php?module=jobs&action=CreateView&return_module=jobs&return_action=queue&sugar_body_only=true" ,function( response, status, xhr ) {
		$("#CreateView").append('<input type="hidden" name="jobqueueform" value="jobqueueformsubmit">');
		$(".utils").toggle();
		$(".moduleTitle").toggle();
	}).dialog({ 
		title: "Add Jobs to Queue",
		width: "70%", 
		modal: true,
   	});
	return false;	
}
function reassignDialog(job_id,asso_id,p_t_id){
	$("#reassign_dialog").load("index.php?module=jobs&action=reassign&sugar_body_only=true&job_id="+job_id+"&assign_id="+asso_id+"&pt_id="+p_t_id ,function( response, status, xhr ) {
	}).dialog({ 
		title: "Re-Assign Associate",
		width: 359, 
		height: 150,
		modal: true,
   	});
	return false;
}
function reassignSubmit(job_id){
	$("#reassign_dialog").dialog('close');
	YAHOO.SUGAR.MessageBox.show({msg: "Updating queue: Reassign job id="+jobs_id, title: 'Re-Assigning...'} );
	$.ajax({
			url: "index.php?module=jobs&action=specialHandling&sugar_body_only=true&job_id="+job_id+"&assigned_user_id="+$("#reassign").val(), 
			success: function(result){
			YAHOO.SUGAR.MessageBox.hide();
			if(result!='success'){
					alert(result);
				}
			}
		});
	return false;
}
function specialHandleMsg(job_id,job_name){
	YAHOO.SUGAR.MessageBox.show({msg: '<b style="margin:10px;">Special Handling job id=</b>'+job_id, title: 'Updating Queue...' , type: 'plain'});
	$.ajax({
			url: "index.php?module=jobs&action=specialHandling&sugar_body_only=true&job_id="+job_id, 
			success: function(result){
			YAHOO.SUGAR.MessageBox.hide();
			}
		});
	return false;
}
function getDeliverables(account_id){
	$('#project_id').html("");
	var $select = $('#project_id');
	$select.attr('style','font-family:"Courier New", Courier, monospace');
	$.ajax({
		url: "index.php?module=jobs&action=getDeliverables&sugar_body_only=true&account_id="+account_id+"&status=Published", 
		 dataType:'JSON',
		success: function(result){
			$('#project_id').empty();
			$.each(result, function(key, val){ 
				$select.append('<option value="' + val.value + '">' + val.label + '</option>');
			});
			var spacesToAdd = 1;
			var biggestLength = 0;
			$("#project_id option").each(function(){
			var len = $(this).text().length;
				if(len > biggestLength){
					biggestLength = len;
				}
			});
			var padLength = biggestLength + spacesToAdd;
			$("#project_id option").each(function(){
				var parts = $(this).text().split('|');
				var strLength = parts[0].length;
				for(var x=0; x<(padLength-strLength); x++){
					parts[0] = parts[0]+' '; 
				}
				$(this).text(parts[0].replace(/ /g, '\u00a0')+''+parts[1]).text;
			});
		}
	});
}
function getDeliverablesFields(deliverable_id){
	$.ajax({
		url: "index.php?module=jobs&action=getDeliverablesFields&sugar_body_only=true&deliverable_id="+deliverable_id, 
		dataType:'JSON',
		success: function(result){
			$.each(result, function(key, val){ 
				$("#parameter_1").val(val.parameter_1);
				$("#parameter_2").val(val.parameter_2);
				$("#restrict_start_days").val(val.restrict_start_days);
				//$("#activity_driver").val(val.activity_driver);
			})
		}
	});
}
function call_back_deliverable(collection, field_id,qs){
	var deliverable_id = $( "#project_id" ).val();
	if(qs){
		var deliverable_id = $( "#project_id" ).val();
	}else if(!qs){
		var deliverable_id = collection.name_to_value_array.project_id;
	}
	SUGAR.ajaxUI.showLoadingPanel();
	$.ajax({
		url: "index.php?module=jobs&action=deliverable_tasks&sugar_body_only=true&deliverable_id="+deliverable_id, 
		success: function(result){
			
			$("#jobs_edit_tasks").html(result);
			$(".automation_queue_user_id").val('');
			SUGAR.ajaxUI.hideLoadingPanel();
		}
	});
	if(!qs){
		set_return(collection, field_id);
	}if(qs){
		return;
	}
}
function call_back_getusers(collection, field_id){
	for(var key in collection['name_to_value_array']) {
		$("#"+key).val(collection['name_to_value_array'][key]);
	}
}
function extendSqs(obj){
	
	$.extend(sqs_objects, JSON.parse(obj));
}
