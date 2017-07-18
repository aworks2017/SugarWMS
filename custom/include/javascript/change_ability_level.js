$(document).ready(function(){
	$(document).delegate('.ability_level', 'click', function(){
		var id = $(this).attr('id');
		var pre_value = $("#"+id).html();
		$(this).replaceWith(getDropdown(id));
		$("#"+id).val(pre_value);
	});	
});
function getDropdown(id){
	var options = {"Primary": "Primary", "Secondary": "Secondary", "Excluded": "Excluded"};
	var ability_level_dd = "<select name= 'ability_level' id='"+id+"' onchange='updateAbilityLevel(this);' pre_value='"+$("#"+id).html()+"'>";
	for(var key in options){ 
		ability_level_dd += '<option value="'+key+'">'+options[key]+'</option>';    
	}
	ability_level_dd +="</select>";
	return ability_level_dd;
}
function updateAbilityLevel(obj){
	if(confirm('Do you want to change Ability Level?')){
		$.ajax({
			url: "index.php?module=jobs&action=change_ability_level",
			type: "POST",
			contentType: "application/x-www-form-urlencoded",
			dataType: "text",
			data:"sugar_body_only=1&id="+$(obj).attr('id')+ "&ability_level="+$(obj).val(),						
			success : function (result){
				var new_ability_level = "<span id='"+$(obj).attr('id')+"' class='ability_level'>"+$(obj).val()+"</span>";
				$(obj).replaceWith(new_ability_level);
			}
		});
	}else{
		var new_ability_level = "<span id='"+$(obj).attr('id')+"' class='ability_level'>"+$(obj).attr('pre_value')+"</span>";
		$(obj).replaceWith(new_ability_level);
	}
}