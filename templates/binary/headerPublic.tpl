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
                <a class="navbar-brand" href="index.php">Gast</a> 
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
                        <a href="index.php?page=login&action=login"{if $action == "login"} class="active-menu"{/if}><i class="fa fa-exchange fa-3x"></i> Login</a>
                    </li>
                    <li>
                        <a href="index.php?page=login&action=register"{if $action == "register"} class="active-menu"{/if}><i class="fa fa-pencil fa-3x"></i> Registrieren</a>
                    </li>
                </ul>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">