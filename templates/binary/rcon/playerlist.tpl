<div class="row">
    <div class="col-md-12">
     <h2>RCON Spieler&uuml;bersicht</h2>   
        <h5>Hier werden alle aktuellen Spieler aufgelistet</h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Spieler
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>IP</th>
                                <th>Port</th>
                                <th>Ping</th>
                                <th>GUID</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody data-link="row" class="rowlink">
{if $players|@count eq 0}
                            <tr>
                                <td>-</td>
                                <td>Keine</td>
                                <td>Eintr&auml;ge</td>
                                <td>gefunden</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
{else}
    {foreach from=$players item=plr}
                            <tr>
                                <td>{$plr.num}</td>
                                <td>{$plr.ip}</td>
                                <td>{$plr.port}</td>
                                <td>{$plr.ping}</td>
                                <td>{$plr.guid}</td>
                                <td>{$plr.name}</td>
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