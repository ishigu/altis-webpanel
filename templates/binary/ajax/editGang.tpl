<form role="form" id="gangFormForm" action="index.php?page=ajax&action=editGang" method="POST">
    <div class="form-group">
        <label>Id</label>
        <input class="form-control" type="text" name="id" disabled="" value="{$gang->getId()}">
        <input type="hidden" name="id" value="{$gang->getId()}">
    </div>
    <div class="form-group">
        <label>Gruppenleiter</label>
        <input class="form-control" type="text" name="owner" value="{$gang->getOwner()}">
        <p>(Name: {$gang->getOwnerName()})</p>
    </div>
    <div class="form-group">
        <label>Gangname</label>
        <input class="form-control" type="text" name="name" value="{$gang->getName()}">
    </div>
    <div class="form-group">
        <label>Mitglieder</label>
        <input type="hidden" name="members" id="membersList" value="{$gang->getMembersList()|replace:", ":","}">
{assign var="membersArray" value=", "|explode:$gang->getMembersList()}
{assign var="membersNameArray" value=", "|explode:$gang->getMembersListNames()}
        <div>
{foreach from=$membersNameArray name=membersForeach item=memberName}
            <div class="btn-group" id="member{$membersArray[$smarty.foreach.membersForeach.index]}">
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                    {$memberName} <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" onclick="javascript:removeMember('{$membersArray[$smarty.foreach.membersForeach.index]}');">Entfernen</a></li>
                </ul>
            </div>
{/foreach}
        </div>
    </div>
    <div class="form-group">
        <label>Max. Mitgliederzahl</label>
        <input class="form-control" type="text" name="maxmembers" value="{$gang->getMaxMembers()}">
    </div>
    <div class="form-group">
        <label>Bankkonto</label>
        <input class="form-control" type="text" name="bank" value="{$gang->getBank()}">
    </div>
    <div class="form-group">
        <label><input type="checkbox" name="active"{if $gang->getActive() eq 1} checked{/if}>Aktiviert</label>
    </div>
</form>