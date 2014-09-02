<div class="row">
    <div class="col-md-12">
     <h2>Haus&uuml;bersicht</h2>   
        <h5>Hier werden alle H&auml;user aufgelistet</h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                H&auml;user
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-4">
                            <input id="searchtext" name="search" class="form-control" placeholder="Suche nach Id/Besitzer(PlayerID)/Inventar" type="text"{if $search} value="{$searchstring}"{/if}>
                        </div>
                        <button type="submit" class="btn btn-primary">Suchen</button>
                    </div>
                </form>
                {$pagination}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><a href="index.php?page=houses&amp;action=index&amp;sortby=id&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Id{if $sortby eq "id"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=houses&amp;action=index&amp;sortby=pid&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Besitzer{if $sortby eq "pid"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=houses&amp;action=index&amp;sortby=pos&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Position{if $sortby eq "pos"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=houses&amp;action=index&amp;sortby=inventory&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Z-Inventar{if $sortby eq "inventory"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=houses&amp;action=index&amp;sortby=containers&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">I-Inventar{if $sortby eq "containers"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=houses&amp;action=index&amp;sortby=owned&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">ImBesitz?{if $sortby eq "owned"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                            </tr>
                        </thead>
                        <tbody data-link="row" class="rowlink">
{if $houses|@count eq 0}
                            <tr>
                                <td>-</td>
                                <td>Keine</td>
                                <td>Eintr&auml;ge</td>
                                <td>gefunden</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
{else}
    {foreach from=$houses item=house}
        {if $house->getOwned() eq 0}
                            <tr class="warning">
        {else}
                            <tr>
        {/if}
                                <td><a href="#" data-toggle="modal" data-id="{$house->getId()}" data-target="#houseModal"></a>{$house->getId()}</td>
                                <td>{$house->getOwnerName()}</td>
                                <td>{$house->getPos()}</td>
                                <td>{$house->getInventoryList()}</td>
                                <td>{$house->getContainersList()}</td>
                                <td>{$house->getOwned()}</td>
                            </tr>
    {/foreach}
{/if}
                        </tbody>
                    </table>
                </div>
{include file='houses/houseModal.tpl'}
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
<!-- /. ROW  -->