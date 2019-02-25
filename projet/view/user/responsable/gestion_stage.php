<link rel="stylesheet" type="text/css" href="../../../public/css/style_commun.css">
<link rel="stylesheet" type="text/css" href="../../../public/css/style_table.css">
<link rel="stylesheet" type="text/css" href="../../../public/css/style_footer.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="../../../public/js/bootbox.min.js"></script>

<?php
session_start();
if($_SESSION['role'] != "admin"){
  exit();
}
?>
<?php
$title="Table of stages";
include("header_respon.php");
?>

<section>
  <div class="container">
    <div class="col-lg-12">
      <h1 class="page-header">La liste des stages </h1>
    </div>
    <div class="row">
      <div id="stage" class="col-lg-12">                            
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Stage ID</th>
              <th scope="col">Titre</th>
              <th scope="col">Description</th>
              <th scope="col">Entreprise</th>
              <th scope="col">Tuteur Entreprise</th>
              <th scope="col">Email Tuteur Entreprise</th>
              <th scope="col">Tuteur Pédagogique</th>
              <th scope="col">Date Début</th>
              <th scope="col">Date Fin</th>
              <th scope="col">Editer</th>
              <th scope="col">Supprimer</th>
            </tr>
          </thead>
          <tbody>                           
            <?php
            include_once ("../../../model/user/responsable_model.php");
            $mem = list_stage($_SESSION['annee']);
            foreach ($mem as $row){
              echo '<tr>';
              echo '<td>'.$row['sid'].'</td>';
              echo '<td>'.$row['titre'].'</td>';
              echo '<td>'.$row['description'].'</td>';
              echo '<td>'.$row['entreprise'].'</td>';
              echo '<td>'.$row['tuteurE'].'</td>';
              echo '<td>'.$row['emailTE'].'</td>';
              echo '<td>'.$row['nom_user'].' '.$row['prenom_user'].'</td>';
              echo '<td>'.$row['dateDebut'].'</td>';
              echo '<td>'.$row['dateFin'].'</td>';
              echo '<td>
              <a class="btn btn-small btn-primary"
              data-toggle="modal"
              data-target="#Stage_Modal"
              data-whatever="'.$row['sid'].' ">Editer</a>
              </td>';
              echo '<td> 
              <a class="delete_stage" data-id="'.$row['sid'].'" href="javascript:void(0)">
              <i class="glyphicon glyphicon-trash"></i>
              </a>
              </td>';
              echo '</tr>';
            }                                                             
            ?>
            <!-- edit stage modal -->
            <div class="modal fade" id="Stage_Modal" tabindex="-1" role="dialog" aria-labelledby="StageModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
                    <h4 class="modal-title" id="StageModalLabel">Edit Stage Detail</h4>
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

    <!-- Edit stage -->
    <script>
      $('#Stage_Modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'sid=' + recipient;
        $.ajax({
          type: "GET",
          url: "edit_table_stage.php",
          data: dataString,
          cache: false,
          success: function (data) {
            console.log(data);
            modal.find('.dash').html(data);
          },
          error: function(err) {
            console.log(err);
          }
        });  
      })
    </script>

    <!-- Delete Stage -->
    <script>
      $(document).ready(function(){
       $('.delete_stage').click(function(e){
        e.preventDefault();
        var sid = $(this).attr('data-id');
        var parent = $(this).parent("td").parent("tr");
        bootbox.dialog({
          message: "Voulez-vous vraiment supprimer ?",
          title: "<i class='glyphicon glyphicon-trash'></i> Supprimer !",
          buttons: {
           success: {
             label: "Non",
             className: "btn-danger",
             callback: function() {
               $('.bootbox').modal('hide');
             }
           },
           danger: {
             label: "Oui",
             className: "btn-success",
             callback: function() {
              $.ajax({
               type: 'POST',
               url: '../../../controller/user/responsable/delete_stage.php',
               data: 'delete='+sid
             })
              .done(function(response){
               bootbox.alert(response);
               parent.fadeOut('slow');
             })
              .fail(function(){
               bootbox.alert('Something Went Wrog ....');
             })
            }
          }
        }
      });
      });
     });
   </script>
 </section>

 <?php include("../../../footer.php"); ?>




