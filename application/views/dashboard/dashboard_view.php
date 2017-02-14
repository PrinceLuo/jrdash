<div class="row">
    <div id="dashboard-side" class="span4">
        <form id="create_todo" action="<?= site_url("api/create_todo") ?>" method="POST">
            <input type="text" name="content" placeholder="Create New Todo Item">
            <input type="submit" value="Create">
        </form>
        <div id="list_todo"><!-- Dynamic --></div>
    </div>
    <div id="dashboard-main" class="span8">
        <form id="create_note" action="<?= site_url("api/create_note") ?>" method="POST">
            <input type="text" name="title" placeholder="Note Title">
            <textarea rows="4" cols="50" name="content"></textarea>
            <input type="submit" value="Create">
        </form>
    </div>
</div>
Dashboard