var Event = function () {

    this.__construct = function () {
        console.log('Event created.');
        Result = new Result();
        create_todo();
        create_note();
        update_todo();
        update_note();
        delete_todo();
        delete_note();
        update_note_display();
        toggle_note();
    };

    // -------------------------------------------------------------------------
    var create_todo = function () {
        $('#create_todo').submit(function (evt) {
            evt.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    Result.success('Success adding Todo!');
                    var output = '';
                    output += Template.todo(o.data);
                    $('#list_todo').append(output);
                    $('#create_todo input[type=text]').val('');
                } else {
                    Result.error(o.error);
                }
            }, 'json');
        });
    };

    // -------------------------------------------------------------------------
    var create_note = function () {
        $('#create_note').submit(function (evt) {
            evt.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    Result.success('Success adding Todo!');
                    var output = '';
                    output += Template.note(o.data);
                    $('#list_note').append(output);
                    $('#create_note input[type=text]').val('');
                    $('#create_note textarea').val('');
                } else {
                    Result.error(o.error);
                }
            }, 'json');
        });
    };

    // -------------------------------------------------------------------------
    var update_todo = function () {
        $('body').on('click', '.todo_update', function (evt) {
            evt.preventDefault();
            var self = $(this);
            var url = $(this).attr('href');
            var postData = {
                todo_id: $(this).attr("data-id"),
                completed: $(this).attr("data-completed")
            };
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    //Result.success('Saved.');
                    if (postData.completed == 1) {
                        self.parent('div').addClass('todo_complete');
                        self.html('<i class="icon-share-alt"></i>');
                        self.attr('data-completed', 0);
                    } else {
                        self.parent('div').removeClass('todo_complete');
                        self.html('<i class="icon-flag"></i>');
                        self.attr('data-completed', 1);
                    }
                } else {
                    Result.error('Nothing updated.')
                }
            }, 'json')
        });
    };

    // -------------------------------------------------------------------------
    var update_note = function () {
        $('body').on('submit', '.note_edit_form', function (e) {
            e.preventDefault();
            var url = $(this).attr('action')
            var self = $(this);
            var postData = {
                title: $(this).find('.note_title_edit').val(),
                content: $(this).find('.note_content_edit').val(),
                note_id: $(this).find('.note_id').val(),
            };
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    Result.success('Successfully updated!');
                    $("#note_title_" + postData.note_id).html(postData.title);
                    $("#note_content_" + postData.note_id).html(postData.content);
                    self.remove();
                } else {
                    Result.error('Erorr saving!');
                }
            }, 'json');
        });

    };

    // -------------------------------------------------------------------------
    var delete_todo = function () {
        $('body').on('click', '.todo_delete', function (evt) {
            evt.preventDefault();
            var c = confirm('Are you sure you want to delete?');
            if (c == false) {
                return false;
            }
            var self = $(this);
            var url = $(this).attr('href');
            var postData = {
                'todo_id': $(this).attr('data-id')
            };
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    Result.success('Item deleted.');
                    self.parent('div').remove();
                } else {
                    //alert('Are we here?');
                    Result.error(o.msg);
                }
            }, 'json');
        });
    };

    // -------------------------------------------------------------------------
    var delete_note = function () {
        $('body').on('click', '.note_delete', function (evt) {
            evt.preventDefault();
            var c = confirm('Are you sure you want to delete?');
            if (c == false) {
                return false;
            }
            var self = $(this);
            var url = $(this).attr('href');
            var postData = {
                'note_id': $(this).attr('data-id')
            };
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    Result.success('Item deleted.');
                    self.parent('div').remove();
                } else {
                    //alert('Are we here?');
                    Result.error(o.msg);
                }
            }, 'json');
        });
    };

    // -------------------------------------------------------------------------
    var update_note_display = function () {
        $('body').on('click', '.note_update_display', function (e) {
            e.preventDefault();
            var note_id = $(this).data('id');
            var output = Template.note_edit(note_id);
            $("#note_edit_container_" + note_id).html(output);

            // Display data after the Template is created
            var title = $("#note_title_" + note_id).html();
            var content = $("#note_content_" + note_id).html();
            $("#note_edit_container_" + note_id).find('.note_title_edit').val(title);
            $("#note_edit_container_" + note_id).find('.note_content_edit').val(content);
        });
        $('body').on('click', '.note_edit_cancel', function (e) {
            e.preventDefault();
            $(this).parents('div .note_edit_container').html('');
        });
    };

    // -------------------------------------------------------------------------
    var toggle_note = function () {
        $("body").on("click", ".note_toggle", function (e) {
            e.preventDefault();
            var note_id = $(this).data('id');
            $("#note_content_" + note_id).toggleClass('hide');
        });
    };

    // -------------------------------------------------------------------------
    this.__construct();
};