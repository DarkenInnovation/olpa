<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//URL = Controller

//Admin Routes
$route['admin'] = 'admin/index';
$route['admin/poll-dashboard'] = 'admin/index';

$route['admin/student'] = 'students/student';
$route['admin/student/list'] = 'students/student_list';
$route['admin/student/create'] = 'students/student_create';
$route['admin/student/update'] = 'students/student_update';
$route['admin/student/edit/(:any)'] = 'students/student_edit/$1';
$route['admin/student/select'] = 'students/student_select';

$route['admin/candidate-list'] = 'admin/index';
$route['admin/add-candidate'] = 'admin/index';

$route['admin/ssg'] = 'admin/ssg';
$route['admin/ssg/list'] = 'admin/ssg_list';
$route['admin/ssg/create'] = 'admin/ssg_create';
$route['admin/ssg/update'] = 'admin/ssg_update';
$route['admin/ssg/edit/(:any)'] = 'admin/ssg_edit/$1';

$route['admin/candidate'] = 'candidates/index';
$route['admin/candidate/list'] = 'candidates/candidates_list';
$route['admin/candidate/create'] = 'candidates/create';
$route['admin/candidate/update'] = 'candidates/update';
$route['admin/candidate/edit/(:any)'] = 'candidates/edit/$1';

$route['admin/position'] = 'admin/position';
$route['admin/position/list'] = 'admin/position_list';
$route['admin/position/create'] = 'admin/position_create';
$route['admin/position/update'] = 'admin/position_update';
$route['admin/position/edit/(:any)'] = 'admin/position_edit/$1';
$route['admin/position/select'] = 'admin/position_select';

$route['admin/partylist'] = 'admin/partylist';
$route['admin/partylist/create'] = 'admin/partylist_create';
$route['admin/partylist/list'] = 'admin/partylist_list';
$route['admin/partylist/update'] = 'admin/partylist_update';
$route['admin/partylist/edit/(:any)'] = 'admin/partylist_edit/$1';
$route['admin/partylist/select'] = 'admin/partylist_select';

$route['admin/grade-section'] = 'admin/gradesection';
$route['admin/grade-section/create'] = 'admin/gradesection_create';
$route['admin/grade-section/list'] = 'admin/gradesection_list';
$route['admin/grade-section/select'] = 'admin/gradesection_select';
$route['admin/grade-section/update'] = 'admin/gradesection_update';
$route['admin/grade-section/edit/(:any)'] = 'admin/gradesection_edit/$1';

$route['admin/polling-question'] = 'admin/index';
$route['admin/add-polling'] = 'admin/index';
$route['admin/coc-request'] = 'admin/index';
$route['admin/total-votes'] = 'admin/index';
$route['admin/year-and-section-votes'] = 'admin/index';


$route['default_controller'] = 'admin';
$route['404_override'] = '';
$route['(:any)'] = 'pages/view/$1';
$route['translate_uri_dashes'] = FALSE;
