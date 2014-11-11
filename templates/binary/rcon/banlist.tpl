<div class="row">
    <div class="col-md-12">
     <h2>RCON Banliste</h2>   
        <h5>Hier werden die aktuellen Bans aufgelistet</h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Bans
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-4">
                            <input id="act" name="act" value="add" type="hidden">
                            <input id="identifier" name="id" class="form-control" placeholder="IP oder GUID" type="text">
                            <input id="time" name="time" class="form-control" placeholder="Anzahl in Stunden (0 = perm)" type="text">
                            <input id="reason" name="reason" class="form-control" placeholder="Grund" type="text">
                        </div>
                        <button type="submit" class="btn btn-success">Hinzuf&uuml;gen</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th></th>
                                <th>IP/GUID</th>
                                <th>Zeit</th>
                                <th>Grund</th>
                            </tr>
                        </thead>
                        <tbody data-link="row" class="rowlink">
{if $bans|@count eq 0}
                            <tr>
                                <td>-</td>
                                <td>Keine</td>
                                <td>Eintr&auml;ge</td>
                                <td>gefunden</td>
                            </tr>
{else}
    {foreach from=$bans item=ban}
                            <tr>
                                <td>
                                    <form class="form-horizontal" method="post">
                                        <input id="act" name="act" value="del" type="hidden">
                                        <input id="identifier" name="id" value="{$ban.identifier}" type="hidden">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                                <td>{$ban.identifier}</td>
                                <td>{if $ban.time eq -1}perm{else}{$ban.time|date_format:"%d.%m.%y %H:%M"}{/if}</td>
                                <td>{$ban.reason}</td>
                            </tr>
    {/foreach}
{/if}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
<!-- /. ROW  -->