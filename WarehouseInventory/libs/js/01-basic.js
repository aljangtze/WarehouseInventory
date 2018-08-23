//Vue.config.debug = true;
//Vue.config.devtools = true;

var vm = new Vue({
    el: '#app',
    components: {
        VueBootstrapTable: VueBootstrapTable
    },
    data: {
        logging: [],
        showFilter: true,
        showPicker: true,
        paginated: true,
        select:true,
        multiColumnSortable: true,
        ajax: {
            enabled: true,
            url: "server_processing.php",
            method: "POST",
            delegate: false,
        },
        columns: [
            {
                render:"123",
                title:"id",
                visible: true,
                editable: false,
            },
            {
                title:"Name",
                name: "name",
                visible: true,
                editable: true,
            },
            {
                title:"Age",
                name: "name2",
                visible: true,
                editable: true,
            },
            {
                title:"Country",
                name: "Position",
                visible: true,
                editable: true,
            }
        ],
        values: [
        ]
    },
    created: function () {
        var self = this;
        this.$on('cellDataModifiedEvent',
            function( originalValue, newValue, columnTitle, entry) {
                self.logging.push("cellDataModifiedEvent - Original Value : " + originalValue +
                                         " | New Value : " + newValue +
                                         " | Column : " + columnTitle +
                                         " | Complete Entry : " +  entry );
            }
        );
        this.$on('ajaxLoadedEvent',
            function( data ) {
                this.logging.push("ajaxLoadedEvent - data : " + JSON.stringify(data) );
            }
        );
        this.$on('ajaxLoadingError',
            function( error ) {
                this.logging.push("ajaxLoadingError - error : " + error );
            }
        );
    },
    methods: {
        addItem: function() {
            var self = this;
            var item = {
                "id" : this.values.length + 1,
                "name": "name " + (this.values.length+1),
                "name2": "Portugal",
                "Position": 26,
            };
            this.values.push(item);
        },
        toggleFilter: function() {
            this.showFilter = !this.showFilter;
        },
        togglePicker: function() {
            this.showPicker = !this.showPicker;
        },
        togglePagination: function () {
            this.paginated = !this.paginated;
        }
    },
});