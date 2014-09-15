<form role="form" id="backupForm" action="index.php?page=backup&action=viewplayer" method="POST">
    <div class="col-md-4">
        <div class="form-group">
            <label>Backup</label>
            <select class="form-control" name="time">
{foreach from=$files item=file}
                <option value="{$file}">{$file}</option>
{/foreach}
            </select>
        </div>
        <div class="form-group">
            <label>PlayerID</label>
            <input class="form-control" type="text" name="pid" value="">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="backupSend">Suchen</button>
        </div>
    </div>
</form>