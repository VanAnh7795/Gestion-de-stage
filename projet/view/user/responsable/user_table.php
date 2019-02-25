<link rel="stylesheet" type="text/css" href="../../../public/css/style_commun.css">
<link rel="stylesheet" type="text/css" href="../../../public/css/style_table.css">
<link rel="stylesheet" type="text/css" href="../../../public/css/style_footer.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php
session_start();
if ($_SESSION['role'] != "admin") {
    exit();
} ?>
<?php
$title = "Tableau des users";
include("header_respon.php");
?>

<section>
    <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#addUserModal"><i class="glyphicon glyphicon-plus"></i>Ajouter User</button>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">La liste des users </h1>
            </div>
        </div>
        <div class="row">
            <div id="member" class="col-lg-12">                            
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Login</th>
                            <th scope="col">Mot de passe</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actif</th>
                            <th scope="col">Action</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>                           
                        <?php
                        $mem = list_user();
                        foreach ($mem as $row) {
                            $actif = "Inactif";
                            if ($row['actif'] == 1) {
                                $actif = "Actif";
                            }
                            echo '<tr>';
                            echo '<td>' . $row['uid'] . '</td>';
                            echo '<td>' . $row['nom'] . '</td>';
                            echo '<td>' . $row['prenom'] . '</td>';
                            echo '<td>' . $row['login'] . '</td>';
                            echo '<td>' . $row['mdp'] . '</td>';
                            echo '<td>' . $row['role'] . '</td>';
                            echo '<td>' . $actif . '</td>';
                            echo '<td>
                            <a class="btn btn-small btn-primary"
                            data-toggle="modal"
                            data-target="#change_mdp"
                            data-whatever="' . $row['login'] . ' ">Changer Mdp</a>
                            </td>';
                            echo '<td>     
                            <button type="button" class="btn btn-small btn-primary"><p style="font-size: 14px" class="activer" name = "activer" data-id="' . $row['login'] . '">Activer/Désactiver</p></button>
                            </td>';
                            echo '</tr>';
                        }
                        ?>

                        <!-- Add User Modal -->                     
                        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="Add User" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="memberModalLabel">Add User</h4>
                                    </div>                  
                                    <div class="addUser">
                                        <form action="../../../controller/user/responsable/adduser.php" method="post">   
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="login">Login</label>
                                                    <input type="text" class="form-control" id="login" name="login"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nom">Nom</label>
                                                    <input type="text" class="form-control" id="nom" name="nom"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prenom">Prénom</label>
                                                    <input type="text" class="form-control" id="prenom" name="prenom"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mdp">Mot de passe</label>
                                                    <input type="password" class="form-control" id="mdp" name="mdp" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="mdp2">Répéter mot de passe</label>
                                                    <input type="password" class="form-control" id="mdp2" name="mdp2" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select id="role" name ="role" class="form-control">
                                                        <option selected>Choix...</option>
                                                        <option>Admin</option>
                                                        <option>User</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-primary" name="addUser" value="Ajouter User" />&nbsp;
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Change mdp modal -->
                        <div class="modal fade" id="change_mdp" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="memberModalLabel">Changer mot de passe</h4>
                                    </div>
                                    <div class="dash">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- changer mdp--> 
    <script>
        $('#change_mdp').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var recipient = button.data('whatever') 
            var modal = $(this);
            var dataString = 'login=' + recipient;
            $.ajax({
                type: "GET",
                url: "edit_table_user.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        })
    </script>

    <!-- change actif -->
    <script>
        $(document).ready(function(){
            $('.activer').click(function(e){
                e.preventDefault();
                var login = $(this).attr('data-id');
                var parent = $(this).parent("td").parent("tr");
                $.ajax({
                    type: 'POST',
                    url: '../../../controller/user/responsable/change_actif.php',
                    data: 'actif=' + login
                })
                window.location.reload();
            })
        })
    </script>
</section>

<?php include("../../../footer.php"); ?> 