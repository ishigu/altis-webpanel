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
                {$pagination}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>uid</th>
                                <th>Name</th>
                                <th>Cash</th>
                                <th>Bank</th>
                                <th>Donator</th>
                                
                            </tr>
                        </thead>
                        <tbody>
{if $players|@count eq 0}
                            <tr>
                                <td>-</td>
                                <td>Keine</td>
                                <td>Eintr&auml;ge</td>
                                <td>gefunden</td>
                                <td>-</td>
                            </tr>
{else}
    {foreach from=$players item=plr}
                            <tr>
                                <td>{$plr->getUid()}</td>
                                <td>{$plr->getName()}</td>
                                <td>{$plr->getCash()}</td>
                                <td>{$plr->getBankAcc()}</td>
                                <td>{$plr->getDonatorLevel()}</td>
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