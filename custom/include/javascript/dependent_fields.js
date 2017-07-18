function dependent_field_logic(){
	if(typeof(module_fields)!='undefined') {
		$.each(module_fields, function( index, field ) {
			if(typeof(field['dependent_field']) != 'undefined'){
				if(module_view == 'EditView') {
					$("#" + field['dependent_field']).change(function () {
						configureEditView(field);
					});
					configureEditView(field);
				}else{
					configureDetailView(field);
				}
			}
		});
		if(module_view == 'DetailView') {
			if(typeof(hide_fal_type) !='undefined' && hide_fal_type){
				$("#fal_type").parent().hide();
				$("#fal_type").parent().prev().hide();
			}
		}
	}
	else
		setTimeout('dependent_field_logic()', 500);
}
$(document).ready(function(){
	dependent_field_logic();
});
SUGAR.util.doWhen("typeof $ != 'undefined'", function(){
	dependent_field_logic();
});
function configureEditView(field){
	if((module_fields[field['dependent_field']]['type'] !='bool' && $("#"+field['dependent_field']).val() == field['dependent_field_value']) || (module_fields[field['dependent_field']]['type'] !='bool' && $("#"+field['dependent_field']).val() == field['dependent_field_value_another']) || jQuery.inArray($("#"+field['dependent_field']).val(), field['dependent_field_value_another']) != '-1' || $("#"+field['dependent_field']).is(":checked")){
       var selected = '';
	   if($("#"+field['dependent_field']).val() == 'weekly')
	   {
			$("#"+field['name']).html('');
			var days = ["", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
			$.each(days , function( key, value ) {
				if(typeof(recurring_value_c) !='undefined' && recurring_value_c == value){
					selected = 'selected';
				}else{
					selected = '';
				}
				$("#"+field['name']).append('<option id="' + key + '" '+selected+'>' + value +'</option>');
			});
		}
	   if($("#"+field['dependent_field']).val() == 'monthly')
	   {
			$("#"+field['name']).html('');
			for (i = 1; i < 32; i++)  {
				if(typeof(recurring_value_c) !='undefined' && recurring_value_c == i){
					selected = 'selected';
				}else{
					selected = '';
				}
				$("#"+field['name']).append('<option id="' + i + '" '+selected+'>' + i +'</option>');
			}
		}
		$("#"+field['name']).closest("td").show();
        $("#"+field['name']+"_label").show();
		if(field['type'] == 'enum'){
			$("#"+field['name']).change();
		}
		if(typeof(field['required']) !='undefined' && field['required'] == true){
			removeFromValidate('EditView', field['name']);			
			addToValidate('EditView', field['name'] , field['type'], true, $("#"+field['name']+"_label").html());
		}
    }else{
		if(field['type'] == 'enum'){
			$("#"+field['name']).val('');
			$("#"+field['name']).change();
		}
		if(typeof(field['name']) !='undefined'){
			removeFromValidate('EditView', field['name']);
		}
        $("#"+field['name']).closest("td").hide();
        $("#"+field['name']+"_label").hide();
    }
}
function configureDetailView(field){
    if($("#"+field['dependent_field']).val() != field['dependent_field_value'] && jQuery.inArray($("#"+field['dependent_field']).val(), field['dependent_field_value']) == '-1' && !$("#"+field['dependent_field']).is(":checked")){
		$("#"+field['name']).closest('td').prev().empty();
		$("#"+field['name']).closest('td').empty();
    }
}