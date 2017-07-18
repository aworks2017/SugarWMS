<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.detail.php');

class jobsViewDetail extends ViewDetail 
{
 	/**
 	 * @see SugarView::display()
 	 */
 	public function display() 
 	{
		
		if($this->bean->restrict_start_days ==''){
			$this->bean->restrict_start_days = 'No restriction';
		}elseif($this->bean->restrict_start_days == 0){
			 $this->bean->restrict_start_days = 'Start and end same day';
		}elseif($this->bean->restrict_start_days == 1){
			$this->bean->restrict_start_days = '1 business day';
		}elseif($this->bean->restrict_start_days ==2){
			$this->bean->restrict_start_days = '2 business days';
		}elseif($this->bean->restrict_start_days ==3){
			$this->bean->restrict_start_days = '3 business days';
		} elseif($this->bean->restrict_start_days ==4){
			$this->bean->restrict_start_days = '4 business days';
		}elseif($this->bean->restrict_start_days ==5){
			$this->bean->restrict_start_days = '5 business days';
		}elseif($this->bean->restrict_start_days ==6){
			$this->bean->restrict_start_days = '6 business days';
		}elseif($this->bean->restrict_start_days ==7){
			$this->bean->restrict_start_days = '7 business days';
		} elseif($this->bean->restrict_start_days ==8){
			$this->bean->restrict_start_days = '8 business days';
		}elseif($this->bean->restrict_start_days ==9){
			$this->bean->restrict_start_days = '9 business days';
		} elseif($this->bean->restrict_start_days ==10){
			$this->bean->restrict_start_days = '10 business days';
		}else{
			$this->bean->restrict_start_days = '';
		}
 		parent::display();
 	}
}
