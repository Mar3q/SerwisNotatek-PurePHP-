 <?php /*
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}*/
?> 
<?php
    require 'database.php';
    $id = null;
    if (!empty($_GET['id'])) 
	{
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) 
	{
        header("Location: PanelNotatek.php");
		
	} 
	else 
	{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM notatki where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<!--<script src="https://en.js.cx/libs/animate.js"></script>-->
	<script src="akcje.js"></script> 
	
</head>

<body >
<style>
		body {background: url("notatka.jpg") no-repeat fixed center;  opacity: 0.9;}
		#textExample,#textExample2,#textExample3 {font-size : 1vw;}
		.control-label {font-size : 1.5vw;}
		h3 {font-size : 3vw;}
		
	
</style>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3 >Notatka</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Temat</label>
                        <div class="controls">
                            <label  class="checkbox">
							 <textarea id="textExample" rows="2" cols="100">
<?php echo $data['temat'];?>	
							</textarea> 
							
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Treść  </label>
                        <div class="controls">
                            <label class="checkbox">
							 <textarea id="textExample2" rows="10" cols="100">
 <?php echo $data['tresc'];?>		
							</textarea> 
                               
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Data utworzenia:</label>
                        <div class="controls">
                            <label class="checkbox">
							<textarea id="textExample3" rows="2" cols="100">
<?php echo $data['data'];?>	
							</textarea> 
                                
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
						
                           <a class="btn btn-info" href="PanelNotatek.php">Cofnij</a>
                        </div>
                    
                      
                     </div>
                 </div>
                 
     </div> <!-- /container -->
   </body>
 </html>

