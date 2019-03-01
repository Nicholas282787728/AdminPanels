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
|	https://codeigniter.com/user_guide/general/routing.html
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
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/




$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['panels/supermacdaddy']	= 'panels/supermacdaddy/dashboard';
$route['careers']	= 'Home/careers';
$route['affiliate']	= 'Home/affiliate';
$route['affiliate-form']	= 'Home/affiliateForm';
$route['market-usa']	= 'Home/marketUsa';
$route['term-condition']	= 'Home/term_condition';

//mobile routs
$route['my-profile']	= 'WebService/getAllProfiles';
$route['online-users']	= 'WebService/onlineusers';
$route['friend-request']	= 'WebService/friendRequest';
//$route['ondemand-payments/(:any)']	= 'WebService/ondemandPayments';
$route['ondemand-payments']	= 'WebService/ondemandPayments';
$route['coins-stored']	= 'WebService/storeCoins';
$route['get-coins-stored']	= 'WebService/getCoins';
//$route['get-coins-stored/(:any)']	= 'WebService/getCoins';
$route['get-payout-details']	= 'WebService/payoutDetails';
//$route['get-payout-details/(:any)']	= 'WebService/payoutDetails';
$route['get-advertisemnet']	= 'WebService/getAdvertisement';
$route['complimentry-advertisemnet']	= 'WebService/complimentryAd';
$route['platinum-advertisement']	= 'WebService/platinumad';
$route['complimentary']	= 'WebService/complimentary';
$route['weekly-specials']	= 'WebService/weeklySpecials';

$route['reservations']	= 'WebService/reservations';
$route['appointments']	= 'WebService/appointments';
$route['notification-history']	= 'WebService/notificationHistory';
//$route['notification-history/(:any)']	= 'WebService/notificationHistory';
$route['user-verfication-individual']	= 'WebService/individualusers';
$route['gps-icon-activated']	= 'WebService/gpsIconActivated';
$route['online-drivers']	= 'WebService/onlineDrivers';
$route['get-gps-location']	= 'WebService/gpslocation';
$route['user-gps-location']	= 'WebService/usergpslocation';
$route['documemt-verify']	= 'WebService/documentVerfication';
$route['admin-permission-documemt-verify']	= 'WebService/adminpermision';

$route['online-stores']	= 'WebService/onlineStores';
$route['online-doctors']	= 'WebService/onlineDoctors';
$route['products']	= 'WebService/getProducts';
$route['add-cart']	= 'WebService/addCart';
$route['user-reservations']	= 'WebService/userReservations';
$route['get-friend-request']	= 'WebService/getFriendRequest';
$route['user-friend-or-not']	= 'WebService/userFriendOrNOt';
$route['confrim-request']	= 'WebService/confrimRequest';
$route['get-cart-product/(:num)']	= 'WebService/getCartProduct';
$route['remove-cart/(:num)']	= 'WebService/removeCart';



//storefronts
$route['storefronts-admin']	= 'panels/supermacdaddy/Storefronts/index';
$route['storefronts-visibility']	= 'panels/supermacdaddy/Storefronts/visibility';
$route['storefronts-auth-user']	= 'panels/supermacdaddy/Storefronts/auth_user';
$route['storefronts-sales']	= 'panels/supermacdaddy/Storefronts/sales';
$route['storefronts-products']	= 'panels/supermacdaddy/Storefronts/products';
$route['storefronts-liveOrders']	= 'panels/supermacdaddy/Storefronts/liveOrders';
$route['storefronts-subcategories']	= 'panels/supermacdaddy/Storefronts/subcategories';
$route['storefronts-support-tickets']	= 'panels/supermacdaddy/Storefronts/support_tickets';
$route['storefronts-tranasction-orders']	= 'panels/supermacdaddy/Storefronts/orders';
$route['storefronts-notifications']	= 'panels/supermacdaddy/Storefronts/notifications';
$route['storefronts-get-notifications']	= 'panels/supermacdaddy/Storefronts/notification';
$route['storefronts-notificationcount']	= 'panels/supermacdaddy/Storefronts/notificationcount';
$route['storefronts-tasknotification']	= 'panels/supermacdaddy/Storefronts/tasknotification';
$route['storefronts-tasknotificationcount']	= 'panels/supermacdaddy/Storefronts/tasknotificationcount';
$route['storefronts-msgnotification']	= 'panels/supermacdaddy/Storefronts/msgnotification';
$route['storefronts-msgnotificationcount']	= 'panels/supermacdaddy/Storefronts/msgnotificationcount';
$route['storefronts-tasks']	= 'panels/supermacdaddy/Storefronts/tasks';
$route['storefronts-setting']	= 'panels/supermacdaddy/Storefronts/setting';
$route['storefronts-verification']	= 'panels/supermacdaddy/Storefronts/verification';
$route['storefronts-history']	= 'panels/supermacdaddy/Storefronts/history';
$route['storefronts-logout']	= 'panels/supermacdaddy/Storefronts/logout';
$route['storefronts-signupdocuments']	= 'panels/supermacdaddy/Storefronts/signupdocuments';
$route['storefronts-editproduct']	= 'panels/supermacdaddy/Storefronts/edit_product';
$route['storefronts-editpromo']	= 'panels/supermacdaddy/Storefronts/edit_promo';
$route['storefronts-autusers']	= 'panels/supermacdaddy/Storefronts/aut_users';
$route['storefronts-editcategory']	= 'panels/supermacdaddy/Storefronts/edit_category';
$route['storefronts-editticket']	= 'panels/supermacdaddy/Storefronts/edit_ticket';
$route['storefronts-promo-list']	= 'panels/supermacdaddy/Storefronts/promo_list';
$route['storefronts-payouts']	= 'panels/supermacdaddy/Storefronts/payouts';
$route['storefronts-complimentaryAd']	= 'panels/supermacdaddy/Storefronts/complimentaryAd';
$route['storefronts-composemail']	= 'panels/supermacdaddy/Storefronts/composemail';



//frontend routes
$route['general-sales']	= 'Dashboard/general_sales';
$route['general-sales-trash/(:num)']	= 'Dashboard/generalSalesTrash';
$route['general-trash-all']	= 'Dashboard/generalTrashAll';
$route['general-sales/(:num)']	= 'Dashboard/general_sales';
$route['general-sales-note']	= 'Dashboard/generalSalesNote';
$route['general-sales-update']	= 'Dashboard/generalSalesUpdate';
$route['super-admin']	= 'Dashboard/admin';
$route['authorized-users']	= 'Dashboard/users';
$route['authorized-users/(:num)']	= 'Dashboard/users';
$route['attachment-zip']	= 'Dashboard/attachment_zip';
$route['distribution-zone']	= 'Dashboard/distributionZone';
$route['sales']	= 'Dashboard/sales';
$route['categories']	= 'Dashboard/categories';
$route['subcategories']	= 'Dashboard/subcategories';
$route['standard-services']	= 'Dashboard/standard_services';
$route['premium-services']	= 'Dashboard/premium_services';
$route['ondemand-services']	= 'Dashboard/on_demand_services';
$route['faq']	= 'Dashboard/faq_ask_que';
$route['opt']	= 'Dashboard/opt';
$route['our-team']	= 'Dashboard/our_team';
$route['background-image']	= 'Dashboard/background_image';
$route['web-tos']	= 'Dashboard/web_tos';
$route['app-tos']	= 'Dashboard/app_tos';
$route['loyalty-tos']	= 'Dashboard/loyalty_tos';
$route['ondemand-tos']	= 'Dashboard/on_demand_tos';
$route['support-tickets']	= 'Dashboard/support_tickets';
$route['promo-list']	= 'Dashboard/promo_list';
$route['referralCode']	= 'Dashboard/referralCode';
$route['pending-providers']	= 'Dashboard/pending_providers';
$route['pending-interviews']	= 'Dashboard/pending_interviews';
$route['pending-affiliate']	= 'Dashboard/pending_affiliate';
$route['super-profile']	= 'Dashboard/setting';
$route['user-verification']	= 'Dashboard/user_verification';
$route['notifications']	= 'Dashboard/notifications';
$route['count-notifications']	= 'Dashboard/notification';
$route['msg-notification']	= 'Dashboard/msgnotification';
$route['logout']	= 'Dashboard/logout';
$route['task-list']	= 'Dashboard/task_list';
$route['advertismentSales']	= 'Dashboard/advertismentSales';
$route['certifiedProviders']	= 'Dashboard/certifiedProviders';


//sales

$route['sales-admin']	= 'sales/index';
$route['sales-attachment-zip']	= 'sales/attachment_zip';
$route['sales-ticket-managment']	= 'sales/ticket_managment';
$route['sales-setting']	= 'sales/setting';
$route['sales-logout']	= 'sales/logout';
$route['sales-sign-updocuments']	= 'sales/signupdocuments';
$route['sales-general-sales']	= 'sales/general_sales';
$route['sales-promo-list']	= 'sales/promo_list';
$route['sales-notifications']	= 'sales/notifications';
$route['sales-notification-message']	= 'sales/notification';
$route['sales-task-notification']	= 'sales/tasknotification';
$route['sales-update-notification']	= 'sales/update_notification';
$route['sales-msg-notification']	= 'sales/msg_notification';
$route['sales-edit-promo']	= 'sales/edit_promo';
$route['sales-edit-attachemnt-sale']	= 'sales/edit_attachemnt_sale';
$route['sales-edit-adrv-sale']	= 'sales/edit_adrv_sale';
$route['sales-edit-general-sale']	= 'sales/edit_general_sale';
$route['sales-advertisement-sales']	= 'sales/advertisement_sales';
$route['sales-updatePassword']	= 'sales/updatePassword';


//ondemand
$route['ondemand-admin']	= 'ondemand/index';
$route['ondemand-drivers']	= 'ondemand/drivers';
$route['ondemand-visibility']	= 'ondemand/visibility';
$route['ondemand-categories']	= 'ondemand/categories';
$route['ondemand-visibility']	= 'ondemand/visibility';
$route['ondemand-products']	= 'ondemand/products';
$route['ondemand-liveOrders']	= 'ondemand/liveOrders';
$route['ondemand-subcategories']	= 'ondemand/subcategories';
$route['ondemand-support-tickets']	= 'ondemand/support_tickets';
$route['ondemand-visibility-list']	= 'ondemand/visibility_list';
$route['ondemand-orders']	= 'ondemand/orders';
$route['ondemand-history']	= 'ondemand/history';


//doctor
$route['doctor-admin']	= 'doctor/index';

$route['panels/supermacdaddy']	= 'panels/supermacdaddy/dashboard';
$route['careers']	= 'Home/careers';
$route['affiliate']	= 'Home/affiliate';
$route['affiliate-form']	= 'Home/affiliateForm';
$route['market-usa']	= 'Home/marketUsa';
$route['term-condition']	= 'Home/term_condition';

///affiliate-partners

$route['affiliate-partners']	= '/panels/supermacdaddy/affiliatepartner';
$route['affiliate-attachment_zip']	= '/panels/supermacdaddy/affiliatepartner/attachment_zip';
$route['affiliate-distributionZone']	= '/panels/supermacdaddy/affiliatepartner/distributionZone';
$route['affiliate-history']	= '/panels/supermacdaddy/affiliatepartner/history';
$route['affiliate-signupdocuments']	= '/panels/supermacdaddy/affiliatepartner/signupdocuments';
$route['affiliate-payouts']	= '/panels/supermacdaddy/affiliatepartner/payouts';
$route['affiliate-notifications']	= '/panels/supermacdaddy/affiliatepartner/notifications';
$route['affiliate-setting']	= '/panels/supermacdaddy/affiliatepartner/setting';
$route['affiliate-pending_providers']	= '/panels/supermacdaddy/affiliatepartner/pending_providers';
$route['affiliate-pending_interviews']	= '/panels/supermacdaddy/affiliatepartner/pending_interviews';
$route['affiliate-message']	= '/panels/supermacdaddy/affiliatepartner/message';


$route['affiliate-pending_affiliate']	= '/panels/supermacdaddy/affiliatepartner/pending_affiliate';
$route['affiliate-logout']	= '/panels/supermacdaddy/affiliatepartner/logout';







