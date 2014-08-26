<div class="row">
    <div class="col-md-12">
     <h2>Fahrzeug&uuml;bersicht</h2>   
        <h5>Hier werden alle Fahrzeuge aufgelistet</h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Fahrzeuge
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-4">
                            <input id="searchtext" name="search" class="form-control" placeholder="Suche nach Id/Seite/Modell/Typ/PlayerID" type="text"{if $search} value="{$searchstring}"{/if}>
                        </div>
                        <button type="submit" class="btn btn-primary">Suchen</button>
                    </div>
                </form>
                {$pagination}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=id&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Id{if $sortby eq "id"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=side&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Seite{if $sortby eq "side"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=classname&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Modell{if $sortby eq "classname"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=type&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Typ{if $sortby eq "type"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=pid&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">PlayerId{if $sortby eq "pid"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=alive&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Heile?{if $sortby eq "alive"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=active&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Aktiv?{if $sortby eq "active"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=plate&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">KZ{if $sortby eq "plate"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=color&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Farbe{if $sortby eq "color"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=vehicles&amp;action=index&amp;sortby=impound&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Beschlagnahmt?{if $sortby eq "impound"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                            </tr>
                        </thead>
                        <tbody>
{if $vehicles|@count eq 0}
                            <tr>
                                <td>-</td>
                                <td>Keine</td>
                                <td>Eintr&auml;ge</td>
                                <td>gefunden</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
{else}
    {foreach from=$vehicles item=veh}
        {if $veh->getAlive() eq 0}
                            <tr class="danger">
        {elseif $veh->getActive() gt 0}
                            <tr class="warning">
        {else}
                            <tr>
        {/if}
                                <td>{$veh->getId()}</td>
                                <td>{$veh->getSide()}</td>
                                <td>{$veh->getClass()}</td>
                                <td>{$veh->getType()}</td>
                                <td>{$veh->getPid()}</td>
                                <td>{$veh->getAlive()}</td>
                                <td>{$veh->getActive()}</td>
                                <td>{$veh->getPlate()}</td>
                                <td>{$veh->getColor()}</td>
                                <td>{$veh->getImpound()}</td>
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