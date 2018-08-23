<head>
    <meta charset="utf-8">
    <title>Vue Bootstrap Table Demo</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
</head>
<body>
<div class="container-fluid">
    <h1>Vue Bootstrap Table Demo</h1>
    <div id="app">
        <div class="row">
            <div class="col-sm-12">
                <button v-on:click="addItem" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add an item</button>
                <button v-on:click="toggleFilter" class="btn btn-default">Toggle Filter</button>
                <button @click="togglePicker" class="btn btn-default">Toggle Column Picker</button>
                <button @click="togglePagination" class="btn btn-default">Toggle Pagination</button>
            </div>
            <br/><br>
            <vue-bootstrap-table
                    :columns="columns"
                    :values="values"
                    :show-filter="showFilter"
                    :show-column-picker="showPicker"
                    :paginated="paginated"
                    :multi-column-sortable="multiColumnSortable"
                    :ajax="ajax"
            >
            </vue-bootstrap-table>
        </div>
        <h2>Events Received</h2>
        <div>
            {{ logging }}
        </div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.bootcss.com/spin.js/2.3.2/spin.min.js"></script>
<script type="text/javascript" src="libs/js/functions.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script type="text/javascript" src="libs/js/vue-bootstrap-table.min.js"></script>
<!--<script src="vue2-bootstrap-table/trunk/dist/vue-bootstrap-table.js"></script>-->
<!--<script src="vue2-bootstrap-table/trunk/examples/01-basic.js"></script>-->
<script src="libs/js/01-basic.js"></script>
</body>