<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{$title}</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="js/morris/morris-0.5.1.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="theme/{$theme}/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">{$username}</a> 
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                <a href="index.php?page=login&amp;action=logout" class="btn btn-danger square-btn-adjust">Logout</a>
            </div>
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="theme/{$theme}/img/find_user.png" class="user-image img-responsive"/>
                    </li>
                    <li>
                        <a href="index.php?page=index"{if $page == "index"} class="active-menu"{/if}><i class="fa fa-dashboard fa-3x"></i> &Uuml;bersicht</a>
                    </li>
                    <li>
                        <a href="index.php?page=vehicles"{if $page == "vehicles"} class="active-menu"{/if}><i class="fa fa-car fa-3x"></i> Fahrzeuge</a>
                    </li>
                    <li>
                        <a href="index.php?page=gangs"{if $page == "gangs"} class="active-menu"{/if}><i class="fa fa-group fa-3x"></i> Gangs</a>
                    </li>
                    <li>
                        <a href="index.php?page=houses"{if $page == "houses"} class="active-menu"{/if}><i class="fa fa-home fa-3x"></i> H&auml;user</a>
                    </li>
                    <li>
                        <a href="index.php?page=players"{if $page == "players"} class="active-menu"{/if}><i class="fa fa-male fa-3x"></i> Spieler</a>
                    </li>	
                    <li>
                        <a href="#"{if $page == "logs"} class="active-menu"{/if}><i class="fa fa-gavel fa-3x"></i> Logs<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="index.php?page=logs&action=money">Player Update Log</a>
                            </li>
                            <li>
                                <a href="index.php?page=logs&action=lastsync">Player Last Sync</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php?page=backup"{if $page == "backup"} class="active-menu"{/if}><i class="fa fa-book fa-3x"></i> Backups</a>
                    </li>
                </ul>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">