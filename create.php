<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>
<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $email = $_POST['email'];
      
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Wpisz Treść';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Wpisz Temat';
            $valid = false;
		}
         
         
			// insert data
			if ($valid) {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO notatki (tresc,temat,user_id) VALUES(?,?,(SELECT id from student WHERE nick='".$_SESSION['user']."'))";
				$q = $pdo->prepare($sql);
				$q->execute(array($email,$name));
				Database::disconnect();
				header("Location: PanelNotatek.php");
			}
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Utwórz notatke</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Temat</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Temat" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
						
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Treść</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Treść" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Utwórz</button>
                          <a class="btn" href="PanelNotatek.php">Cofnij</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>