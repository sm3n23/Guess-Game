

<html lang="en">
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
        left: 460px;
        border:solid black 2px;
        border-radius:20px;
        color:white;
    }
    input[type=text]{
        width: 400px;
        font-size:  1em;
    }
    input[type=radio]{
        position: relative;
        
        left:450px;
    }
    
    
    body{
        position: relative;
        margin: 50px;
        text-align: center;
        font-size:  1.5em;
        font-family: 'Noto Serif', serif;
        background-color: #F0FFFF;
    }
    
    button{
        margin:20px;
        width: 400px;
        
    }
    fieldset{
        position: relative;
    }

    .level{
        color:#0d6efd;
    }
    .username{
        opacity: 0.7;
        position: absolute;
        left:400px;
        font-size:  0.8em;
    }





</style>
    <h1></h1>
    <div class="container">
    <form action="guess.php" method="POST">
    <div data-role="fieldcontain">
    <fieldset data-role="controlgroup">
            <legend class=level><h2><u> GUESS THE  NUMBER</u></h2> </legend><br>
            <br>
            <div class="form-floating mb-3 mt-3 d-flex justify-content-center">
            <input type="text" class="form-control" name="username" id="floatingInput" placeholder="Username" value='<?php if(isset($_COOKIE['user'])){echo $_COOKIE['user'];} ?>' required>
            
            </div><br>
            


            <fieldset class="row mb-3 ">
                <legend class="col-form-label col-sm-11 mb-3  "><h2>Choose Your Level :</h2></legend>
                    <br>
                    <div class="col-sm-14  justify-content-center">
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="level" id="easy" value="easy" <?php if(!isset($_COOKIE['difficulty']) || $_COOKIE['difficulty']=='easy'){echo 'checked';}  ?> >
                        <label class="form-check-label" for="easy">
                        Easy (1-10) with 5 guesses
                        </label>
                    </div><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="level" id="medium" value ="medium" <?php if(isset($_COOKIE['difficulty'])&& $_COOKIE['difficulty']=='medium'){echo 'checked';}  ?>>
                        <label class="form-check-label" for="medium">
                        Medium (1-50) with 10 guesses
                        </label>
                    </div><br>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="level" id="hard" value="hard" <?php if(isset($_COOKIE['difficulty'])&& $_COOKIE['difficulty']=='hard'){echo 'checked';}  ?>>
                        <label class="form-check-label" for="hard">
                        Hard (1-100) with 20 guesses
                        </label>
                    </div>
                    </div>
            </fieldset>
            
            
            <button type="submit" class="btn btn-primary btn-lg" >Start</button>

            
        </fieldset>
    </form>
    </div>
</body>
</html>
