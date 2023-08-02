<?php
    try{
        session_start();

        if(isset($_POST['email']))
        {
            //udana walidacja
            $wszystko_OK=true;

            //nickname
            $nick = $_POST['nick'];

            //długość nickname
            if ((strlen($nick)<3) || (strlen($nick)>20))
            {
                $wszystko_OK = false;
                $_SESSION['e_nick'] = 'Nick musi posadać od 3 do 20 znaków';
            }

            if(ctype_alnum($nick)==false)
            {
                $wszystko_OK = false;
                $_SESSION['e_nick'] = "Nick może skaładać sie z liter i cyfr (bez polskich zanków)";
            }


            //sprawdź E-Mail

            $email = $_POST['email'];

            $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

            if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB != $email))
            {
                $wszystko_OK = false;
                $_SESSION['e_email'] = "Podaj poprawy adres E-Mail";

            }

            //Sparawdź Hasło

            $haslo1 = $_POST['haslo1'];
            $haslo2 = $_POST['haslo2'];

            if((strlen($haslo1)<8) || (strlen($haslo1)>20))
            {
                $wszystko_OK = false;
                $_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków";

            }

            if($haslo1!=$haslo2)
            {
                $wszystko_OK = false;
                $_SESSION['e_haslo'] = "Podane hasła nie są takie same";

            }

            $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
            
            //zapamiętaj wprowadzone dane 
            $_SESSION['fr_nick'] = $nick;
            $_SESSION['fr_eamil'] = $email;
            $_SESSION['fr_haslo1'] = $haslo1; 
            $_SESSION['fr_haslo2'] = $haslo2;
            




            require_once "connect.php";
            mysqli_report(MYSQLI_REPORT_STRICT);

            try
            {
                $polaczenie = new mysqli($host, $db_user, $db_password, $db_name );
                if($polaczenie->connect_errno!=0)
                {
                    throw new Exception(mysqli_connect_errno());
                }
                else
                {
                    //Czy email już istnieje 
                    $result = $polaczenie ->query("SELECT iduser FROM user WHERE email='$email'");

                    if(!$result) throw new Exception($polaczenie->error);

                    $_iemail = $result->num_rows;
                    if($_iemail>0)
                    {  
                        $wszystko_OK = false;
                        $_SESSION['e_email'] = "Instaniej już konto przypisane do tego adresu e-mail!"; 
                    }



                    //czy nick jest już zarezerwowany
                    $result = $polaczenie ->query("SELECT iduser FROM user WHERE user='$nick'");

                    if(!$result) throw new Exception($polaczenie->error);

                    $_inick = $result->num_rows;
                    if($_inick>0)
                    {  
                        $wszystko_OK = false;
                        $_SESSION['e_nick'] = "Istnieje już gracz o takim nick'u "; 
                    }

                    if($wszystko_OK == true)
                    {
                        //Wszytsko się udało
                        if ($polaczenie->query("INSERT INTO user VALUES (NULL, '$nick','$email', '$haslo_hash')"))
                        {
                            $_SESSION['udanarejstracja']=true;
                            header('Location:witam.php');
                        }
                        else
                        {
                            throw new Exception($polaczenie->error);
                        }
                    }

                    $polaczenie->close();
                }
            }
            catch(Exception $e)
            {
                echo '<span style = "color:red;">Błąd serwera! Przepraszam zarejestruj się w innym terminie :(</span>';
                echo '<br/>Informacja developerska: '.$e;
            }

        }

    }
    catch(Exception $e)
    {
        echo '<span style = "color:red;">Błąd serwera! Przepraszam zarejestruj się w innym terminie :(</span>';
        echo '<br/>Informacja developerska: '.$e;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/rejestracja.css">
</head>
<body>

<h1 class="register-heading">Rejestracja</h1>
    <form method="POST">
        <label for="nick"></label>
        <input type="text" id="nick" name="nick" minlength="3" maxlength="20" placeholder="Nick:" value="<?php 
        if(isset($_SESSION['fr_nick']))
        {
            echo $_SESSION['fr_nick'];
            unset($_SESSION["fr_nick"]);
        }
        
        ?>">
        <br>

        <label for="email"></label>
        <input type="email" id="email" name="email" placeholder="Email:" value="<?php 
        if(isset($_SESSION['fr_email']))
        {
            echo $_SESSION['fr_email'];
            unset($_SESSION["fr_email"]);
        }
        
        ?>">
        <br>

        <label for="haslo"></label>
        <input type="password" id="haslo" name="haslo1" minlength="8" maxlength="20" placeholder="Hasło:" value="<?php 
        if(isset($_SESSION['fr_haslo']))
        {
            echo $_SESSION['fr_haslo'];
            unset($_SESSION["fr_haslo"]);
        }
        
        ?>">
        <br>

        <label for="haslo2"></label>
        <input type="password" id="haslo" name="haslo2" minlength="8" maxlength="20" placeholder="Powtórz Hasło:" value="<?php 
        if(isset($_SESSION['fr_haslo2']))
        {
            echo $_SESSION['fr_haslo2'];
            unset($_SESSION["fr_haslo2"]);
        }
        
        ?>">
        <br>
        
        <button type="submit">Zarejestruj</button>
    </form>
</body>
</html>
