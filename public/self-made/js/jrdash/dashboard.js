var Dashboard = function () {

    var self = this;

    this.__construct = function () {
        console.log('Dashboard created.');
        Template = new Template();
        Event = new Event();
        //Result = new Result(); // Inside the Event it has been created
        load_todo();
        load_note();
    };

    // -------------------------------------------------------------------------
    var load_todo = function () {
        $.get('api/get_todo', function (o) {
            var output = '';
            for (var i = 0; i < o.length; i++) {
                output += Template.todo(o[i]);
            }
            $('#list_todo').html(output);
        }, 'json');
    };

    // -------------------------------------------------------------------------
    var load_note = function () {
        $.get('api/get_note', function (o) {
            var output = '';
            for (var i = 0; i < o.length; i++) {
                // note
                var output = '';
                for (var i = 0; i < o.length; i++) {
                    output += Template.note(o[i]);
                }
            }
            $('#list_note').html(output);
        }, 'json');
    };

    // -------------------------------------------------------------------------
    this.__construct();
};