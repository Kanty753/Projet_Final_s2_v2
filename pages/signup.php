<?php
session_start();
if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = array();
    $_SESSION['error']['pseudo'] = 0;
    $_SESSION['error']['email'] = 0;
    $_SESSION['error']['pwd'] = 0;
    $_SESSION['error']['cpwd'] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iTalks New Account</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <div class="menu-fixe">
    <div class="all">
      
      <div class="nav">
        <ul>
          <li><a href="#home">Home</a></li>

        </ul>
        <a href="login.php">
          <div class="sub">Login</div>
        </a>
      </div>
    </div>
  </div>

  <div class="home" id="#Home">
    <div class="home-text">
      <form action="../treatment/signup_treatment.php" method="post">
        <div class="total">
          <div class="title">
            <h1>Sign up</h1>
          </div>
          <div class="all">
            <div class="input">
              <div class="info"><span> Nom:</span> <input type="text" name="pseudo" id="pseudo"></div>
              <?php 
              if($_SESSION['error']['pseudo'] == 1){?>
                  <div class="error"><p style=" color:red ; font-family:arial; font-size:small;"> Veuillez entrer votre nom </p></div>
                 <?php }?>
            </div>
            <div class="input">
              <div class="info"><span>Genre :</span> <select name="genre" id="genre">
                    <option value="h">HOMME</option>
                    <option value="f">FEMME</option>
                </select></div>
            </div>
            <div class="input">
              <div class="info"><span> E-Mail:</span><input type="text" name="email" id="email"></div>
              <?php 
              
                if ($_SESSION['error']['email'] == 1) {?>
                  <div class="error"><p style=" color:red ; font-family:arial; font-size:small;"> Veuillez remplir ce champ </p></div>
                 <?php }?>
                 <?php
               if ($_SESSION['error']['email'] == 2) {?>
                    <div class="error"><p style=" color:red ; font-family:arial; font-size:small;"> Cet E-mail a deja un compte <a href="main/acceuil.php">Se connecter ?</a> </p></div>
                   <?php }?>
            </div>
            <div class="input">
              <div class="info"><span> Password:</span><input type="password" name="pwd" id="pwd"></div>
              <?php 
              
                if ($_SESSION['error']['pwd'] == 1) {?>
                  <div class="error"><p style=" color:red ; font-family:arial; font-size:small;"> Veuillez remplir ce champ </p></div>
                 <?php }?>
            </div>
            <div class="input">
              <div class="info"><span> Confirm Password:</span><input type="password" name="cpwd" id="cpwd"></div>
              <?php 
                if ($_SESSION['error']['cpwd'] == 1) {?>
                  <div class="error"><p style=" color:red ; font-family:arial; font-size:small;"> Veuillez recomfirmer votre mot de passe  </p></div>
                 <?php }?>
            </div>
            <div class="input">
              <div class="info">
                <span> Date de naissance:</span><input type="date" name="birth" id="birth">
              </div>
            </div>
          </div>
          <div class="bouton">
            <button type="submit">Sign up</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>