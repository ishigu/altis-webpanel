<div class="row">
    <div class="col-md-12">
     <h2>Player Update Log</h2>   
        <h5>Hier werden alle alle Sync-Requests, bei deren Bargeld/Bankkonto &Auml;nderungen mit mindestens 50k$ enthalten sind</h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Log
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-4">
                            <input id="searchtext" name="search" class="form-control" placeholder="Suche nach Name/Alias/UID/PlayerID" type="text"{if $search} value="{$searchstring}"{/if}>
                        </div>
                        <button type="submit" class="btn btn-primary">Suchen</button>
                    </div>
                </form>
                {$pagination}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><a href="index.php?page=logs&amp;action=money&amp;sortby=uid&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Id{if $sortby eq "uid"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=logs&amp;action=money&amp;sortby=playerid&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">PlayerId{if $sortby eq "playerid"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=logs&amp;action=money&amp;sortby=name&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Name{if $sortby eq "name"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th>Aliases</th>
                                <th><a href="index.php?page=logs&amp;action=money&amp;sortby=updatetime&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Zeitstempel{if $sortby eq "updatetime"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=logs&amp;action=money&amp;sortby=cashdiff&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Bar Diff{if $sortby eq "cashdiff"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=logs&amp;action=money&amp;sortby=bankdiff&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Bank Diff{if $sortby eq "bankdiff"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=logs&amp;action=money&amp;sortby=moneydiff&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Gesamt Diff{if $sortby eq "moneydiff"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                            </tr>
                        </thead>
                        <tbody>
{if $logs|@count eq 0}
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>Keine</td>
                                <td>Eintr&auml;ge</td>
                                <td>gefunden</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
{else}
    {foreach from=$logs item=log}
                            <tr>
                                <td>{$log.uid}</td>
                                <td>{$log.playerid}</td>
                                <td>{$log.name}</td>
                                <td>{$log.aliases}</td>
                                <td>{$log.updatetime}</td>
                                <td>{$log.cashdiff}</td>
                                <td>{$log.bankdiff}</td>
                                <td>{$log.moneydiff}</td>
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