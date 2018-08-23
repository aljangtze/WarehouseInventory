<!DOCTYPE html>
<?php
$page_title = 'Edit product';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
?>
<?php include_once('layouts/header.php'); ?>

<html>
<head>
    <title>Multiple Sort</title>
    <meta charset="utf-8">

    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
    <link rel="stylesheet" href="http://issues.wenzhixin.net.cn/bootstrap-table/assets/examples.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>
    <script src="libs/js/bootstrap-table-multiple-sort.js"></script>
    <script src="http://issues.wenzhixin.net.cn/bootstrap-table/ga.js"></script>-->
</head>
<body>
<div class="container">
    <h1>Multiple Sort</h1>
    <table id="table"
           data-toggle="table"
           data-flat="true"
           data-search="true"
           data-show-columns="true"
           data-show-multi-sort="true"
           data-sort-priority='[{"sortName": "github.count.forks","sortOrder":"desc"},{"sortName":"github.count.stargazers","sortOrder":"desc"}]'
           data-url="data3.json">
        <thead>
        <tr>
            <th data-field="github.name" data-sortable="true">Name</th>
            <th data-field="github.count.stargazers" data-sortable="true">Stargazers</th>
            <th data-field="github.count.forks" data-sortable="true">Forks</th>
            <th data-field="github.description" data-sortable="true">Description</th>
        </tr>
        </thead>
    </table>
</div>
<div class="row  col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="example" class="table table-bordered table-hover  table-condensed"
                   data-height="740"
                   data-show-multi-sort="true"
                   data-sort-priority='[{"sortName": "date","sortOrder":"asc"}]'
                   data-show-toggle="false"
                   data-show-fullscreen="true"
                   data-show-columns="true"
                   data-show-export="true"
                   data-url="data3.json"

                   data-toggle="table"

            >
                <thead>
                <tr>
                    <th data-field="github.name" data-sortable="true">Name</th>
                    <th data-field="github.count.stargazers" data-sortable="true">Stargazers</th>
                    <th data-field="github.count.forks" data-sortable="true">Forks</th>
                    <th data-field="github.description" data-sortable="true">Description</th>
                </tr>
                </thead>
                <tbody id="requestion_list" class="text-center">
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
<?php include_once('layouts/footer.php'); ?>