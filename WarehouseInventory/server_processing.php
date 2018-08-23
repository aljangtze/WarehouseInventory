<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'datatables_demo';

// Table's primary key
$primaryKey = 'id';

$json = '{"checkboxStatus":true, "name":"First", "name2":"First", "Position": "Position", "Office" :"Office", "start" : "Start Date", "Salary":"Salary"}';
//echo $json;
//$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
$json = json_decode($json);

echo json_encode(array(
	"draw"            => isset ( $request['draw'] ) ?
	intval( $request['draw'] ) :
	0,
	"recordsTotal"    => 12,
	"recordsFiltered" => 2,
	"data"            => [$json, $json, $json, $json, $json, $json, $json, $json, $json,$json, $json, $json, $json, $json, $json, $json, $json, $json]
	));

//['First', 'Last', 'Position', 'Office', 'Start Date', 'Salary'],['First', 'Last', 'Position', 'Office', 'Start Date', 'Salary'],['First', 'Last', 'Position', 'Office', 'Start Date', 'Salary'],['First', 'Last', 'Position', 'Office', 'Start Date', 'Salary'],
//        ['First', 'Last', 'Position', 'Office', 'Start Date', 'Salary'],['First', 'Last', 'Position', 'Office', 'Start Date', 'Salary'],['First', 'Last', 'Position', 'Office', 'Start Date', 'Salary'];
return;
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'first_name', 'dt' => 0 ),
	array( 'db' => 'last_name',  'dt' => 1 ),
	array( 'db' => 'position',   'dt' => 2 ),
	array( 'db' => 'office',     'dt' => 3 ),
	array(
		'db'        => 'start_date',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return date( 'jS M y', strtotime($d));
		}
	),
	array(
		'db'        => 'salary',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return '$'.number_format($d);
		}
	)
);

// SQL server connection information
$sql_details = array(
	'user' => '',
	'pass' => '',
	'db'   => '',
	'host' => ''
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require('ssp.class.php');

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);


