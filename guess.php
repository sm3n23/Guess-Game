<?php
    session_start();
    
    //création d'un tableau contenant des niveaux avec leur quantité correspondante de suppositions et de scores 
    $levels = array(
        'easy' => array('min' => 1, 'max' => 10, 'guesses' => 5, 'score' =>4),
        'medium' => array('min' => 1, 'max' => 50, 'guesses' => 10, 'score'=>2),
        'hard' => array('min' => 1, 'max' => 100, 'guesses' => 20,'score' =>1),
    );

    
    //vérifier si l'utilisateur a fait une supposition, sinon nous configurons le jeu
    if(!isset($_POST["guess"])){
        // Stocke le niveau, le nom, le nombre aléatoire le nombre initial de suppositions et le nombre de score dans des sessions 
        $_SESSION["level"] = $_POST['level'];
        $_SESSION['guesses'] = $levels[$_SESSION["level"]]['guesses'];
        $_SESSION['score']=20;
        $_SESSION['user']=$_POST["username"];
        $_SESSION['random']=rand($levels[$_SESSION["level"]]['min'],$levels[$_SESSION["level"]]['max']);

        setcookie("difficulty",$_POST["level"],time()+3600);
        setcookie("user",$_POST["username"],time()+3600);

        
        $message = 'Enter your guess';
        
        //changer le nom du bouton
        $buttontype="Guess";
        $stylecolor="#6F8FAF";
    }
    //mettre en place les conditions du jeu
    else if(($_POST["guess"] > $_SESSION['random']) && $_SESSION['guesses']>1 ){
        $message = "Your guess (".$_POST["guess"].") is too high!";
        // Décrémente le nombre de suppositions restantes stockées dans la session, lorsque l'utilisateur se trompe
        $_SESSION["guesses"]--;
        //Décrémente le score
        $_SESSION['score']-=$levels[$_SESSION['level']]['score'];
        $buttontype="Guess";
        $stylecolor="#9684b0";
        
        

    }else if (($_POST["guess"] < $_SESSION['random']) && $_SESSION['guesses']>1 ) { 
        $message = "Your guess (".$_POST["guess"].") is too low!";
        $_SESSION["guesses"]--; 
        $_SESSION['score']-=$levels[$_SESSION['level']]['score'];
        $buttontype="Guess";
        $stylecolor="#0096FF";

    }else if (($_POST["guess"] == $_SESSION['random']) && $_SESSION['guesses']>=1) { 
        $_SESSION["guesses"]--;
        $message = "Well done! You guessed the right number!. Your Score is :".$_SESSION["score"] ; 
        $_SESSION['score']=0;
        $buttontype="Restart";
        $stylecolor="#088F8F";

    }else   {
        $message="You Lost .";
        $_SESSION['guesses']=0;
        $_SESSION['score']=0;
        $buttontype="Restart";
        $stylecolor="#C70039";

    }
    //si l'utilisateur clique sur le bouton "restart", nous redémarrons le jeu avec le nombre correspondant de suppositions et de score
    if(isset($_POST['Restart']) ){
        $buttontype="Guess";
        $_SESSION['guesses'] = $levels[$_SESSION["level"]]['guesses'];
        $_SESSION['score']=20;
        $_SESSION['random']=rand($levels[$_SESSION["level"]]['min'],$levels[$_SESSION["level"]]['max']);
        $message = 'Enter your guess';
        $stylecolor="#6F8FAF";

    }






?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
    
    <title>Guess Game</title>
</head>
<body>
    <style>
        .message{
            background-color: <?php echo $stylecolor; ?>;
            padding: 10px;
            margin: 25px;
            text-align: center;
            justify-content: center;
            width: 400px;
            position: absolute;
            left: 490px;
            border:solid black 2px;
            border-radius:20px;
            color:white;
        }
        input{
            width: 400px;
        }
        body{
            position: relative;
            margin: 50px;
            text-align: center;
            font-size:  1.5em;
            font-family: 'Noto Serif', serif;
            background-color: #F0FFFF;
        }
        .level{
            color:#0d6efd;
        }
        
        button{
            margin:20px;
            width: 400px;
            
        }
    </style>
        <div class="container">
        <form action="" method="POST">
                
                    <h2 class=level><a href="level.php"> GUESS THE  NUMBER</a></h2><br>

                    <p>Welcome <u class=level> <?php echo $_SESSION['user'] ?></u> .</p>
                    <p>You have choosed the difficulty : <u><?php echo $_SESSION["level"] ?></u> .</p>
                    <p><?php 
                        echo "You still have :<u>" .$_SESSION["guesses"]." guesses</u>  ";?>.<br> <br>
                        <label for="guess">Guess the number (between <?php echo $levels[$_SESSION["level"]]['min']; ?> and <?php echo $levels[$_SESSION["level"]]['max']; ?>):</label><br><br>
                        <input type="number" id="guess" name="guess" value=<?php if(isset($_POST['guess']) ){ echo $_POST['guess'];}  ?> min="<?php echo $levels[$_SESSION["level"]]['min']; ?>" max="<?php echo $levels[$_SESSION["level"]]['max']; ?>">
                        <br>
                        <button type=submit class="btn btn-primary btn-lg" name=<?php echo $buttontype; ?> ><?php echo  $buttontype; ?></button></p>
                        <!-- pour verification -->
                        <p><?php echo $_SESSION['random']; ?></p>
                    
                    
                    
                    <div class="message">
                    <h4><?php echo $message;?></h4>
                    </div>

                    
                
        </form>
        </div>
</body>