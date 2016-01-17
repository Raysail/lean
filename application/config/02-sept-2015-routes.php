<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class 
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments. 
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method 
*/

/*$route['default_controller'] = 'welcome';*/


$route['default_controller'] = 'home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**  ADMIN URLS **/
$route['administrator'] = "admin/login";
$route['administrator/dashboard'] = "admin/login/dashboard";

$route['administrator/signout'] =  'admin/login/signout';

$route['administrator/change-password'] =  'admin/login/change_password';
$route['administrator/change-password-action'] =  'admin/login/change_password_action';

	/*setting */
$route['administrator/general-setting'] = 'admin/setting/general_setting';
$route['administrator/social-icon'] = 'admin/setting/social_icon';
$route['administrator/social-form']='admin/setting/social_form';
$route['administrator/social-form/(:any)']='admin/setting/social_form/$1';
$route['administrator/social-action'] = 'admin/setting/social_action';

	/* CONTENT */
$route['administrator/pages-list']  =  'admin/content/pages_list';
$route['administrator/pages/(:any)']  =  'admin/content/pages_list/$1';
$route['administrator/pages-form']='admin/content/pages_form';
$route['administrator/pages-form/(:any)']='admin/content/pages_form/$1';
$route['administrator/pages-action'] = 'admin/content/pages_action';


$route['administrator/channel-list']  =  'admin/content/pages_list';
$route['administrator/channel/(:any)']  =  'admin/content/pages_list/$1';
$route['administrator/channel-form']='admin/content/pages_form';
$route['administrator/channel-form/(:any)']='admin/content/pages_form/$1';
$route['administrator/channel-action'] = 'admin/content/pages_action';


$route['administrator/articletype-list']  =  'admin/article/atricle_type_list';
$route['administrator/articletype-list/(:any)']  =  'admin/article/atricle_type_list/$1';
$route['administrator/articletype-form']='admin/article/atricle_type_form';
$route['administrator/articletype-form/(:any)']='admin/article/atricle_type_form/$1';
$route['administrator/articletype-action'] = 'admin/article/atricle_type_action';


$route['administrator/articlesubmi-list']  =  'admin/article/atricle_submision_list';
$route['administrator/articlesubmi-list/(:any)']  =  'admin/article/atricle_submision_list/$1';
$route['administrator/articlesubmi-form']='admin/article/atricle_submision_form';
$route['administrator/articlesubmi-form/(:any)']='admin/article/atricle_submision_form/$1';
$route['administrator/articlesubmi-action'] = 'admin/article/atricle_submision_action';


$route['administrator/author-list']  =  'admin/user/auhtor_list';
$route['administrator/editor-list']  =  'admin/user/editor_list';
$route['administrator/reviewer-list']  =  'admin/user/reviewer_list';
$route['administrator/publisher-list']  =  'admin/user/publisher_list';

$route['administrator/author-form']  =  'admin/user/user_form';
$route['administrator/editor-form']  =  'admin/user/user_form';
$route['administrator/reviewer-form']  =  'admin/user/user_form';
$route['administrator/publisher-form']  =  'admin/user/user_form';

$route['administrator/author-form/(:any)']  =  'admin/user/user_form/$1';
$route['administrator/editor-form/(:any)']  =  'admin/user/user_form/$1';
$route['administrator/reviewer-form/(:any)']  =  'admin/user/user_form/$1';
$route['administrator/publisher-form/(:any)']  =  'admin/user/user_form/$1';

$route['administrator/user-action']='admin/user/user_action';
$route['administrator/articlesubmi-form/(:any)']='admin/article/atricle_submision_form/$1';
$route['administrator/articlesubmi-action'] = 'admin/article/atricle_submision_action';






/* FRONT SITE ROUTE*/
$route['page-detail/(:any)'] = 'home/page_detail/$1';
$route['login'] = 'general_login/login';
$route['sign-up'] = 'general_login/sign_up';
$route['sign-out']='general_login/logout';
$route['set-activation/(:any)']='general_login/user_activation';


$route['forgot-password']  = "general_login/forgot_password";
$route['change-password']  = "general_login/change_password";





$route['user-dashboard'] = 'user/user_dashboard';

$route['update-password']  = "user/change_password";



$route['update-author-profile']='user/edit_profile';
$route['update-editor-profile']='user/edit_profile';
$route['update-reviewer-profile']='user/edit_profile';
$route['update-publisher-profile']='user/edit_profile';


$route['viewsubmission/(:any)']="user/view_submission_pdf/$1";



/* ATUHOR SECTION ROUTE*/

$route['author-guide']="article/author_guide";

$route['post-manuscript']="article/new_article";
$route['update-mainscript/(:any)']="article/update_article/$1";

$route['view_project/(:any)']="article/view_article/$1";
















$route['incomplete-manuscript']="article/incomplete_article";
$route['incomplete-manuscript/(:any)']="article/incomplete_article/$1";

$route['beprocess-manuscript']="article/beprocess_article";
$route['beprocess-manuscript/(:any)']="article/beprocess_article/$1";

$route['completed-manuscript']="article/complete_article";
$route['completed-manuscript/(:any)']="article/complete_article/$1";



$route['revision-mainscript/(:any)']="article/revision_article/$1";

/*1-SEPT-2015*/


$route['send-message-editor/(:any)']="article/send_message_box/$1";




/* EDITOR SECTION ROUTE*/
$route['received-manuscript']="editor/received_article";
$route['received-manuscript/(:any)']="editor/received_article/$1";
$route['editor-email/(:any)']="editor/new_received_email/$1";


$route['backto-manuscript']="editor/backto_author";
$route['backto-manuscript/(:any)']="editor/backto_author/$1";

$route['reviewer-manuscript']="editor/reviewer_article";
$route['reviewer-manuscript/(:any)']="editor/reviewer_article/$1";


$route['agree-reviewer']="editor/agree_reviewer";
$route['agree-reviewer/(:any)']="editor/agree_reviewer/$1";

$route['reviewer-feedback']="editor/reviewer_feedback";
$route['reviewer-feedback/(:any)']="editor/reviewer_feedback/$1";


$route['make-decision/(:any)']="editor/make_decision/$1";

$route['decision-list']="editor/decision_list";
$route['decision-list/(:any)']="editor/decision_list/$1";


$route['further-revision']="editor/revision_article";
$route['further-revision/(:any)']="editor/revision_article/$1";


$route['make-revission-decision/(:any)']="editor/make_revission_decision/$1";



/*AFTER NEW CHNEGAES */


$route['editor_view_project/(:any)']="editor/editor_view_project/$1";
$route['assign-reviewer/(:any)']="editor/assign_reviewer/$1";
$route['send-author/(:any)']="editor/send_message_box/$1";
$route['decline/(:any)']="editor/send_message_box/$1";
$route['send-message/(:any)']= "editor/send_message_box/$1";





/* REVIEWER SECTION ROUTE*/

$route['new-reviewer']="reviewer/newassign_article";
$route['new-reviewer/(:any)']="reviewer/newassign_article/$1";


$route['article-progress']="reviewer/progress_article";
$route['article-progress/(:any)']="reviewer/progress_article/$1";

$route['submit-review/(:any)']="reviewer/submit_review/$1";



/*PUBLISHER SECTION ROUTE*/

$route['accept-manuscript']="publisher/accept_manuscript";
$route['accept-manuscript/(:any)']="publisher/accept_manuscript/$1";


$route['proof-manuscript']="publisher/proof_manuscript";
$route['proof-manuscript/(:any)']="publisher/proof_manuscript/$1";



$route['proof-author/(:any)']="publisher/proof_author_email/$1";

$route['complete-manuscript']="publisher/complete_proof_manuscript";
$route['complete-manuscript/(:any)']="publisher/complete_proof_manuscript/$1";

$route['proof-waiting-manuscript']="publisher/proof_waiting_manuscript";
$route['proof-waiting-manuscript/(:any)']="publisher/proof_waiting_manuscript/$1";



$route['publish-mainscript/(:any)']="publisher/publish_manuscript/$1";

$route['publish-continue/(:any)']="publisher/publish_continue/$1";
$route['article_preview/(:any)']="publisher/preview_article/$1";
$route['article_fulltext/(:any)']="publisher/preview_article_fulltext/$1";

$route['complete-paper']="publisher/complete_paper";
$route['complete-paper/(:any)']="publisher/complete_paper/$1";





