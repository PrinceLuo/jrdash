var Template = function () {

    this.__construct = function () {
        console.log('Template created.');
    };

    // -------------------------------------------------------------------------
    this.todo = function (obj) {
        var output = '';
//        if(obj.completed===1){
//            output+='<div id="todo_"'+obj.todo_id+'" class="todo_complete">';
//        }else{
//            output+='<div id="todo_"'+obj.todo_id+'">';
//        }
//        output+='<span'+obj.content+'</span>';
//        output+='<span class="option">';
//        var data_completed=(obj.completed===1)?0:1;
//        var data_completed_text=(obj.completed===1)?'<i ':1;
        if (obj.completed == 1) {
            output += '<div id="todo_"' + obj.todo_id + '" class="todo_complete">';
        } else {
            output += '<div id="todo_"' + obj.todo_id + '">';
        }
        output += '<span>' + obj.content + '</span>';
        var data_completed = (obj.completed == 1) ? 0 : 1;
        var data_completed_text = (obj.completed == 1) ? '<i class="icon-share-alt"></i>' : '<i class="icon-flag"></i>';
        output += '<a href="api/update_todo" data-id="' + obj.todo_id + '" class="todo_update" data-completed="' + data_completed + '">' + data_completed_text + '</a>';

        output += '<a data-id="' + obj.todo_id + '" class="todo_delete" href="api/delete_todo"><i class="icon-trash"></i></a>';
        output += '</div>';
        return output;
    };

    // -------------------------------------------------------------------------
    this.note = function (obj) {
        var output = '';
        output += '<div id=note_"' + obj.note_id + '">';
        output += '<span><a id="note_title_' + obj.note_id + '" class="note_toggle" data-id="' + obj.note_id + '" href="#">' + obj.title + '</a></span> ';
        //output += '<span>' + obj.content + '</span>';
        output += '<a class="note_update_display" data-id="' + obj.note_id + '" href="#">Edit</a>';
        output += '<a data-id="' + obj.note_id + '" class="note_delete" href="api/delete_note"><i class="icon-trash"></i></a>';
        output += '<div class="note_edit_container" id="note_edit_container_' + obj.note_id + '"></div>';
        output += '<div id="note_content_' + obj.note_id + '" class="note_content hide">' + obj.content + '</div> ';
        output += '</div>';
        return output;
    };

    // -------------------------------------------------------------------------
    this.note_edit = function (note_id) {
        var output = '';
        output += '<form action="api/update_note" method="post" class="note_edit_form">';
        output += '<input class="note_title_edit" type="text" name="title" />';
        output += '<input class="note_id" type="hidden" name="note_id" value="' + note_id + '" />';
        output += '<textarea class="note_content_edit" name="content"></textarea>';
        output += '<input type="submit" class="note_edit_save" value="Save" />';
        output += '<input type="submit" class="note_edit_cancel" value="Cancel" />';
        output += '</form>';
        return output;
    }

    // -------------------------------------------------------------------------
    this.__construct();
};