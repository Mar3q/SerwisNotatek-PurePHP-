<?php //error_reporting(0); ?>   
<?php
session_start();
require 'database.php';

    if ( ($_POST['nickRejstracja']!=null) AND ($_POST['hasloRejstracja']!=null)) 
	{
      
        // keep track post values
        $nickRejstracja = $_POST['nickRejstracja'];
        $hasloRejstracja = $_POST['hasloRejstracja'];
      
        $valid = true;
         
		 
         
			// insert data
			if ($valid) 
			{
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO student (nick,haslo) VALUES(?,?)";
				$q = $pdo->prepare($sql);
				try
				{
					$q->execute(array($nickRejstracja,$hasloRejstracja));
					Database::disconnect();
					unset($_SESSION['bladRejstracji']);
					header("Location: index.php");
					$_SESSION['udanaRejstracja'] = "Utworzono konto o nicku: " .$nickRejstracja;
					
				}
				catch (Exception $e)
				{
					
					$_SESSION['bladRejstracji'] = '<span style="color:red">Nick jest zajęty!</span>';
					unset($_SESSION['udanaRejstracja']);
					header('Location: zarejstruj.php');
				}
				finally
				{
					echo "First finally.\n";
					header("Location: index.php");
					Database::disconnect();
					
				}
			}
			
			
    }
	else
	{
		header("Location: index.php");
		$_SESSION['bladRejstracji'] = '<span style="color:red">Podaj nick i hasło!</span>';
		unset($_SESSION['udanaRejstracja']);
	}
?>