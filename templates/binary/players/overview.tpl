<div class="row">
    <div class="col-md-12">
     <h2>Spieler&uuml;bersicht</h2>   
        <h5>Hier werden alle Spieler aufgelistet</h5>
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
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=uid&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Id{if $sortby eq "uid"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=playerid&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">PlayerId{if $sortby eq "playerid"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=name&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Name{if $sortby eq "name"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th>Aliases</th>
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=cash&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Cash{if $sortby eq "cash"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=bankacc&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Bank{if $sortby eq "bankacc"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=donatorlvl&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">Donator{if $sortby eq "donatorlvl"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=coplevel&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">CopLevel{if $sortby eq "coplevel"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=mediclevel&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">MedicLevel{if $sortby eq "mediclevel"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=rebellevel&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">RebelLevel{if $sortby eq "rebellevel"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                                <th><a href="index.php?page=players&amp;action=index&amp;sortby=adminlevel&amp;order={if $order eq "ASC"}DESC{else}ASC{/if}">AdminLevel{if $sortby eq "adminlevel"}<span class="glyphicon {if $order eq "ASC"}glyphicon-chevron-up{else}glyphicon-chevron-down{/if}" style=""></span>{/if}</a></th>
                            </tr>
                        </thead>
                        <tbody data-link="row" class="rowlink">
{if $players|@count eq 0}
                            <tr>
                                <td>-</td>
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
    {foreach from=$players item=plr}
        {if $plr->getAdminLevel() gt 0}
                            <tr class="warning">
        {elseif $plr->getDonatorLevel() gt 0}
                            <tr class="success">
        {elseif $plr->getRebLevel() gt 0}
                            <tr class="danger">
        {elseif $plr->getCopLevel() gt 0}
                            <tr class="info">
        {else}
                            <tr>
        {/if}
                                <td><a href="#" data-toggle="modal" data-id="{$plr->getUid()}" data-target="#playerModal"></a>{$plr->getUid()}</td>
                                <td>{$plr->getPlayerID()}</td>
                                <td>{$plr->getName()}</td>
                                <td>{$plr->parseAliases()}</td>
                                <td>{$plr->getCash()}</td>
                                <td>{$plr->getBankAcc()}</td>
                                <td>{$plr->getDonatorLevel()}</td>
                                <td>{$plr->getCopLevel()}</td>
                                <td>{$plr->getMedicLevel()}</td>
                                <td>{$plr->getRebLevel()}</td>
                                <td>{$plr->getAdminLevel()}</td>
                            </tr>
    {/foreach}
{/if}
                        </tbody>
                    </table>
                </div>
{include file='players/playerModal.tpl'}
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
<!-- /. ROW  -->