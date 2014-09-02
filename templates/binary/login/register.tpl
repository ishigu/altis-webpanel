<div class="row">
    <div class="col-md-12">
     <h2>Westerland Webpanel Registrierung</h2>   
        <h5>Bitte geben Sie ihre Benutzerinformationen ein</h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-6">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Registrierung
            </div>
            <div class="panel-body">
{if $error eq 1}
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Fehler!</strong><br> Benutzername existiert bereits!
                </div>
{/if}
                <div class="col-md-12">
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="inputUsername" class="col-sm-2 control-label">Benutzername</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="username" id="inputUsername" placeholder="Bitte deinen Benutzernamen eingeben">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label">Passwort</label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Bitte dein Passwort eingeben">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPlayerID" class="col-sm-2 control-label">PlayerID</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="playerid" id="inputPlayerID" placeholder="Bitte deine PlayerID eingeben">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Registrieren</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
<!-- /. ROW  -->