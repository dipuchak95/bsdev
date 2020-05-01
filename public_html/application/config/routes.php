<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'login'; 
$route['admin/tablero'] = 'admin/panel'; 
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



//new route
//$route['set-student'] = 'admin/set_student';
//$route['get-student'] ='admin/get_student';
//$route['set-barcode'] = 'admin/set_barcode';
//$route['book-issue'] = 'admin/book_issue';
//$route['retrn-book'] = 'admin/retrn_book';  
//$route['add-fee'] = 'admin/add_fee';
//$route['fee-type'] = 'admin/fee_type';
//$route['add-fees-insert'] = 'admin/add_fees_insert';

//new route
$route['set-student'] = 'admin/set_student';
$route['get-student'] ='admin/get_student';
$route['set-barcode'] = 'admin/set_barcode';
$route['book-issue'] = 'admin/book_issue';
$route['retrn-book'] = 'admin/retrn_book';  
$route['add-fee'] = 'admin/add_fee';
$route['fee-type'] = 'admin/fee_type';
$route['add-fees-insert'] = 'admin/add_fees_insert';
$route['add-concession-data'] = 'admin/add_concession_data';
$route['add-discount-data'] = 'admin/add_discount_data';