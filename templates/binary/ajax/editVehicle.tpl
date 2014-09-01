<form role="form" id="vehFormForm" action="index.php?page=ajax&action=editVehicle" method="POST">
    <div class="form-group">
        <label>Id</label>
        <input class="form-control" type="text" name="id" disabled="" value="{$veh->getId()}">
        <input type="hidden" name="id" value="{$veh->getId()}">
    </div>
    <div class="form-group">
        <label>Seite</label>
        <select class="form-control" name="side">
{foreach from=$sides key=side item=sidestr}
            <option value="{$side}"{if $veh->getSide() eq $side} selected{/if}>{$sidestr}</option>
{/foreach}
        </select>
    </div>
    <div class="form-group">
        <label>Classname</label>
        <input class="form-control" type="text" name="classname" value="{$veh->getClassname()}">
    </div>
    <div class="form-group">
        <label>Typ</label>
        <input class="form-control" type="text" name="type" value="{$veh->getType()}">
    </div>
    <div class="form-group">
        <label>PlayerID</label>
        <input class="form-control" type="text" name="pid" value="{$veh->getPid()}">
    </div>
    <div class="form-group">
        <label>Kennzeichen</label>
        <input class="form-control" type="text" name="plate" value="{$veh->getPlate()}">
    </div>
    <div class="form-group">
        <label>Farbe/Skin</label>
        <select class="form-control" name="color">
{if $colors|@count eq 0}
            <option value="{$veh->getColor()}" selected>{$veh->getColor()}</option>
{else}
    {foreach from=$colors item=color name=vehcolor}
            <option value="{$smarty.foreach.vehcolor.index}"{if $veh->getColor() eq $smarty.foreach.vehcolor.index} selected{/if}>{$color}</option>
    {/foreach}
{/if}
        </select>
    </div>
    <div class="form-group">
        <label><input type="checkbox" name="alive"{if $veh->getAlive() eq 1} checked{/if}>Heile/Lebendig</label>
    </div>
    <div class="form-group">
        <label><input type="checkbox" name="active"{if $veh->getActive() eq 1} checked{/if}>Aktiv auf der Map</label>
    </div>
    <div class="form-group">
        <label><input type="checkbox" name="impound"{if $veh->getImpound() eq 1} checked{/if}>Beschlagnahmt</label>
    </div>
</form>