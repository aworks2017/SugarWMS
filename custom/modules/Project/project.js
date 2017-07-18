function customValidation() {
	var days = false;
	var drestrict_start_days = parseInt(document.getElementById("restrict_start_days").value);
	if((drestrict_start_days >=0 && drestrict_start_days <= 100) || document.getElementById("restrict_start_days").value == ''){
		days = false;
	}else{
		days = true;
		alert('Please enter a valid value for restrict start days');
	}
	return days;
}