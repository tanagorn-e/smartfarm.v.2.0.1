<?php
    session_start();
    require "connectdb.php";
    
        if($_POST["theme"] == "light-theme" || $_POST["theme"] == "dark-theme" || $_POST["theme"] == "semi-dark" || $_POST["theme"] == "minimal-theme"){
            $postdata = $_POST["theme"];
        }else if(explode(" ",$_POST["theme"])[0] == "color-sidebar"){
            $postdata = $_POST["theme"];
        }else {
            if(explode(" ",$_SESSION['login_theme'])[0] == "color-sidebar"){
                if(explode(" ",$_POST["theme"])[1] == "color-header"){
                    $postdata = $_SESSION['login_theme']." ".explode(" ",$_POST["theme"])[1].' '.explode(" ",$_POST["theme"])[2];
                }
            }else if(explode(" ",$_SESSION['login_theme'])[0] == "light-theme" || explode(" ",$_SESSION['login_theme'])[0] == "dark-theme" || explode(" ",$_SESSION['login_theme'])[0] == "semi-dark" || explode(" ",$_SESSION['login_theme'])[0] == "minimal-theme"){
                $postdata = explode(" ",$_SESSION['login_theme'])[0]." ".explode(" ",$_POST["theme"])[1].' '.explode(" ",$_POST["theme"])[2];
            }else{
                $postdata = $_POST["theme"];
            }
        }
    
    
    // echo $postdata;
    // exit();
    $data = [
        'theme' => $postdata,
        'id'=>$_SESSION['user_id']
    ];
    $stmt = "UPDATE `tb2_login` SET `login_theme`=:theme WHERE `login_id`=:id";
    if ($dbcon->prepare($stmt)->execute($data) === TRUE) {
// echo "OK";
    }else{echo "NO";}
    $_SESSION['login_theme'] = $postdata;
    echo $_SESSION['login_theme'];