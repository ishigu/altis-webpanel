<div class="row">
    <div class="col-md-12">
     <h2>Gang&uuml;bersicht</h2>   
        <h5>Hier werden alle Gangs aufgelistet</h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Gangs
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-4">
                            <input id="searchtext" name="search" class="form-control" placeholder="Suche nach Id/Besitzer(PlayerID)/Name/Mitglied(PlayerID)" type="text"{if $search} value="{$searchstring}"{/if}>
                        </div>
                        <button type="submit" class="btn btn-primary">Suchen</button>
                    </div>
                </form>
                {$pagination}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><a href="index.php?page=gangs&amp;action=index&amp;sortby=id&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Id{if $sortby eq "id"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=gangs&amp;action=index&amp;sortby=owner&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Besitzer{if $sortby eq "owner"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=gangs&amp;action=index&amp;sortby=name&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Name{if $sortby eq "name"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=gangs&amp;action=index&amp;sortby=members&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Mitglieder{if $sortby eq "members"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=gangs&amp;action=index&amp;sortby=maxmembers&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">MitgliederLimit{if $sortby eq "maxmembers"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=gangs&amp;action=index&amp;sortby=bank&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Bank{if $sortby eq "bank"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=gangs&amp;action=index&amp;sortby=active&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Aktiv?{if $sortby eq "active"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                            </tr>
                        </thead>
                        <tbody>
{if $gangs|@count eq 0}
                            <tr>
                                <td>-</td>
                                <td>Keine</td>
                                <td>Eintr&auml;ge</td>
                                <td>gefunden</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
{else}
    {foreach from=$gangs item=gang}
        {if $gang->getActive() eq 0}
                            <tr class="warning">
        {else}
                            <tr>
        {/if}
                                <td>{$gang->getId()}</td>
                                <td>{$gang->getOwnerName()}</td>
                                <td>{$gang->getName()}</td>
                                <td>{$gang->getMembersListNames()}</td>
                                <td>{$gang->getMaxMembers()}</td>
                                <td>{$gang->getBank()}</td>
                                <td>{$gang->getActive()}</td>
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