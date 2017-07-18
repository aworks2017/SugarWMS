$(document).ready(function(){
	$(document).delegate('.priority', 'click', function(e){
		var thisInstance= this;
		var pre_value = $(thisInstance).text();
		$(thisInstance).replaceWith(getDropdown(thisInstance,'priority'));
		$(thisInstance).val(pre_value);
		return false;
	});
	$(document).delegate('.assigned_user_id', 'click', function(e){
		var thisInstance= this;
		var id = $(thisInstance).attr('id');
		var user_id = $(thisInstance).attr('assigned-user-id');
		var user_name = $(thisInstance).text();
		var pre_value = $("#"+id).html();
			$.ajax({
			url: "index.php?module=jobs&action=get_users",
			type: "POST",
			contentType: "application/x-www-form-urlencoded",
			dataType: "text",
			data:"sugar_body_only=1&id="+$(thisInstance).attr('id'),						
			success : function (result){
				var result = jQuery.parseJSON(result);
				$(thisInstance).replaceWith(getDropdownUsers(id,user_id,user_name,result));
			}
		});
	});
});
var status_prv_val = '';
function setPrvVla(obj){
	status_prv_val = $(obj).val();
}
function getDropdown(thisInstance,field_name){
	var id = $(thisInstance).attr('id');
	if(field_name =='job_status'){
		var options = {"":"", "Ready": "Ready", "Not Ready": "Not Ready", "Started": "Started", "In Progress": "In Progress", "Completed": "Completed", "Issue": "Issue", "Special Handling": "Special Handling", "QA Check": "QA Check"};
	}
	if(field_name =='priority'){
		var options ={"normal": "Normal", "high": "High"};
	}
	var status_dd = "<select name= '"+field_name+"' id='"+id+"'  onChange='updateStatus(this);' pre_value='"+$(thisInstance).html()+"'>";
	for(var key in options){ 
		if(options[key]==$(thisInstance).html()){
			status_dd += '<option value="'+key+'" selected>'+options[key]+'</option>';    
		}else{
			status_dd += '<option value="'+key+'">'+options[key]+'</option>';    
		}    
	}
	status_dd +="</select>";
	return status_dd;
}
function getDropdownUsers(id,user_id,user_name,options){
	var status_dd = "<select name='assigned_user_id' id='"+id+"' onChange='updateUser(this);' pre_user_id='"+user_id+"' pre_user_name='"+user_name+"'>";
		if(user_id =='undefined'){
			status_dd += '<option value="" selected></option>';    
		}else{
			status_dd += '<option value="" ></option>';    
		}
		status_dd += '<option value="NULL" >NULL</option>';
	for(var key in options){ 
		if(key==user_id){
			status_dd += '<option value="'+key+'" selected>'+options[key]+'</option>';    
		}else{
			status_dd += '<option value="'+key+'">'+options[key]+'</option>';    
		}
	}
	status_dd +="</select>";
	return status_dd;
}
function updateStatus(obj){
	var msg_name = ($(obj).attr('name') == 'priority') ? "Priority" : "Status";
	var request ="";
	request += ($(obj).attr('name') == 'status') ? "status="+$(obj).val() : "";
	request += ($(obj).attr('name') == 'priority') ? "priority="+$(obj).val() : "";
	$.ajax({
		url: "index.php?module=jobs&action=change_status",
		type: "POST",
		contentType: "application/x-www-form-urlencoded",
		dataType: "text",
		data:"sugar_body_only=1&id="+$(obj).attr('id')+ "&"+request,						
		success : function (result){
			if(result == 2){
				alert('Job is currently assigned in Workflow Tool - no changes are allowed');
				$(obj).val(status_prv_val);
				return false;
			}
		}
	});
	return false;
}
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function updateUser(obj){
	var selected_id = $(obj).attr('id');
	var user_id = $(obj).val();
	var user_name = $(obj).find("option:selected").text();
	$.ajax({
		url: "index.php?module=jobs&action=change_assigned_user",
		type: "POST",
		contentType: "application/x-www-form-urlencoded",
		dataType: "text",
		data:"sugar_body_only=1&job_id="+selected_id+ "&assigned_user="+user_id,						
		success : function (result){
			if(result == 2){
				alert('Job is currently assigned in Workflow Tool - no changes are allowed');
				return false;
			}else{			
				var new_user = "<span id='"+$(obj).attr('id')+"' assigne-user-id="+user_id+" class='assigned_user_id'>"+user_name+"</span>";
				$(obj).replaceWith(new_user);
			}
		}
	});
	return false;
}