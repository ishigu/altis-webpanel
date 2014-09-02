<form role="form" id="houseFormForm" action="index.php?page=ajax&action=editHouse" method="POST">
    <div class="form-group">
        <label>Id</label>
        <input class="form-control" type="text" name="id" disabled="" value="{$house->getId()}">
        <input type="hidden" name="id" value="{$house->getId()}">
    </div>
    <div class="form-group">
        <label>Besitzer</label>
        <input class="form-control" type="text" name="pid" value="{$house->getPid()}">
        <p>(Name: {$house->getOwnerName()})</p>
    </div>
    <div class="form-group">
        <label>Position</label>
        <input class="form-control" type="text" name="pos" value="{$house->getPos()}">
    </div>
    <div class="form-group">
        <label>Z-Inventar</label>
        <input class="form-control" type="text" name="inventory" id="membersList" value="{$house->getInventory()|replace:"\"":""}">
    </div>
    <div class="form-group">
        <label>I-Inventar</label>
        <input class="form-control" type="text" name="containers" value="{$house->getContainers()|replace:"\"":""}">
    </div>
    <div class="form-group">
        <label><input type="checkbox" name="owned"{if $house->getOwned() eq 1} checked{/if}>Im Besitz(Verkauft?)</label>
    </div>
</form>