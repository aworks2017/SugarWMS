<?php
 // created: 2015-05-01 07:11:02
$layout_defs["ProjectTask"]["subpanel_setup"]['projecttask_projecttask_1projecttask_ida'] = array (
  'order' => 100,
  'module' => 'ProjectTask',
  'subpanel_name' => 'preTask_subpanel',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_PROJECTTASK_PROJECTTASK_1_FROM_PROJECTTASK_R_TITLE',
  'get_subpanel_data' => 'projecttask_projecttask_1projecttask_ida',
  'top_buttons' => 
  array (
/*    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),*/
    1 => 
    array (
		'widget_class' => 'SubPanelTopSelectButton',
		'mode' => 'MultiSelect',
		'initial_filter_fields' => array(
			'project_name' => 'project_name_advanced',
			'project_id' => 'project_id_advanced',
			'id' => 'id'
		),
	),
  ),
);
