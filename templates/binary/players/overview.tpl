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
                                <th>Id</th>
                                <th>PlayerId</th>
                                <th>Name</th>
                                <th>Cash</th>
                                <th>Bank</th>
                                <th>Donator</th>
                                <th>CopLevel</th>
                                <th>MedicLevel</th>
                                <th>RebelLevel</th>
                                <th>AdminLevel</th>
                            </tr>
                        </thead>
                        <tbody>
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
        {elseif $plr->getRebelLevel() gt 0}
                            <tr class="danger">
        {elseif $plr->getCopLevel() gt 0}
                            <tr class="info">
        {else}
                            <tr>
        {/if}
                                <td>{$plr->getUid()}</td>
                                <td>{$plr->getPlayerID()}</td>
                                <td>{$plr->getName()}</td>
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
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
<!-- /. ROW  -->