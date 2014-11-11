<form role="form" id="backupPlayerForm">
    <div class="form-group">
        <h4>Zeitpunkt: {$time}</h4>
    </div>
    <div class="form-group">
        <label>UID</label>
        <input class="form-control" type="text" name="uid" disabled="" value="{$player->getUID()}">
        <input type="hidden" name="uid" value="{$player->getUID()}">
    </div>
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" type="text" name="name" value="{$player->getName()}">
    </div>
    <div class="form-group">
        <label>Aliases</label>
        <input class="form-control" type="text" name="aliases" value="{$player->getAliases()|replace:"\"":""}">
    </div>
    <div class="form-group">
        <label>PlayerID</label>
        <input class="form-control" type="text" name="playerid" value="{$player->getPlayerID()}">
    </div>
    <div class="form-group">
        <label>Cash</label>
        <input class="form-control" type="text" name="cash" value="{$player->getCash()}">
    </div>
    <div class="form-group">
        <label>Bank</label>
        <input class="form-control" type="text" name="bankacc" value="{$player->getBankAcc()}">
    </div>
    <div class="form-group">
        <label>Donator-Level</label>
        <input class="form-control" type="text" name="donatorlvl" value="{$player->getDonatorLevel()}">
    </div>
    <div class="form-group">
        <label>Cop-Level</label>
        <input class="form-control" type="text" name="coplevel" value="{$player->getCopLevel()}">
    </div>
    <div class="form-group">
        <label>Medic-Level</label>
        <input class="form-control" type="text" name="mediclevel" value="{$player->getMedicLevel()}">
    </div>
    <div class="form-group">
        <label>Rebel-Level</label>
        <input class="form-control" type="text" name="rebellevel" value="{$player->getRebLevel()}">
    </div>
    <div class="form-group">
        <label>Admin-Level</label>
        <input class="form-control" type="text" name="adminlevel" value="{$player->getAdminLevel()}">
    </div>
    <div class="form-group">
        <label>Cop Lizenzen</label>
        <input class="form-control" type="text" name="cop_licenses" value="{$player->getCopLicenses()|replace:"\"":""}">
    </div>
    <div class="form-group">
        <label>Civ Lizenzen</label>
        <input class="form-control" type="text" name="civ_licenses" value="{$player->getCivLicenses()|replace:"\"":""}">
    </div>
    <div class="form-group">
        <label>Medic Lizenzen</label>
        <input class="form-control" type="text" name="med_licenses" value="{$player->getMedLicenses()|replace:"\"":""}">
    </div>
    <div class="form-group">
        <label>Cop Inventar</label>
        <input class="form-control" type="text" name="cop_gear" value="{$player->getCopGear()|replace:"\"":""}">
    </div>
    <div class="form-group">
        <label>Civ Inventar</label>
        <input class="form-control" type="text" name="civ_gear" value="{$player->getCivGear()|replace:"\"":""}">
    </div>
    <div class="form-group">
        <label>Rebell Inventar</label>
        <input class="form-control" type="text" name="reb_gear" value="{$player->getRebGear()|replace:"\"":""}">
    </div>
    <div class="form-group">
        <label><input type="checkbox" name="arrested"{if $player->getArrested() eq 1} checked{/if}>Im Knast</label>
    </div>
    <div class="form-group">
        <label><input type="checkbox" name="blacklist"{if $player->getBlacklist() eq 1} checked{/if}>Blacklisted</label>
    </div>
</form>