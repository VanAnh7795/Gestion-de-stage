<link rel="stylesheet" type="text/css" href="../../public/css/style_header.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://www.u-pec.fr/universite-paris-est-creteil-805685.kjsp" target="_blank">
                <img src="../../public/images/UPEC-logo.svg.png" width="80" height="35" alt="UPEC-logo">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="../../index.php"><span class="glyphicon glyphicon-home"></span>  HOME </a></li>
                <li><a href="add_etu_view.php">Formulaire inscription</a></li>
            </ul>
            <div class ="Chercher">
                <form class="navbar-form navbar-right" role="search" action="info_etu.php" method="GET">
                    <div class="form-group">
                        <input type="text" id="reference" name="reference" class="form-control" placeholder="Références dossier">
                    </div>
                    <button type="submit" id="search_button" name="search_button" class="btn btn-default">Chercher</button>
                </form>
            </div>
        </div>
    </div>
</nav>

