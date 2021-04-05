<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <?php 
require "_connect.php";


$pdo = new \PDO(DSN, USER, PASS);
    $query = "SELECT * FROM friend";
    $statement = $pdo->query($query);
    $friend = $statement->fetchAll(); 
    
    foreach($friend as $frien)
    {
    echo $frien['firstname'] . ' ' . $frien['lastname'] . '<br>';
    } ?>

    <?php

if ($_POST){
        $errors = array();

      
        if(empty($_POST['firstname']) || strlen($_POST['firstname']) > 45)
            {
                $errors['firstname1'] = "Your first name cannot be empty or too long";
            }

        if(empty($_POST['lastname']) || strlen($_POST['lastname']) > 45)
            {
                $errors['lastname1'] = "Your last name cannot be empty or too long";
            }
        
         if(count($errors) == 0)
            {
    $data = array_map('trim', $_POST);
 
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    

    $query= "INSERT INTO friend (`firstname`, `lastname`) VALUES (:firstname,:lastname)";

    $statement = $pdo->prepare($query);
    $statement->bindValue(":firstname",$firstname);
    $statement->bindValue(":lastname",$lastname);
    $statement->execute();
    header('Location:index.php');
            }
}

?>
    <form method="post" action="">
        <label class="formFirstname" for="formFirstname">firstname :</label>
                <br>
        <input class="formFirstname" type="text" id="firstname" name="firstname" placeholder="firstname" />
         <p> 
        <?php if(isset($errors['firstname1'])) echo $errors['firstname1'];  ?>    
        </p>
        <br>

        <label class="formLastname" for="formLastname">lastname :</label>
                <br>
        <input class="formLastname" type="text" id="lastname" name="lastname" placeholder="lastname" />
        <p>
        <?php if(isset($errors['lastname1'])) echo $errors['lastname1'];  ?> 
        </p>
        <br>
        <input class="insert" type="submit" id="submit" name="submit">
    </form>
</body>
</html>
