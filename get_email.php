<?php 
include("./conn.php");

if(isset($_GET["email"])){
    $email=$_GET["email"];
    $sql="select email from team_members where email='$email'";
    $res=mysqli_query($conn, $sql)->fetch_assoc();
    if($res){
        $msg = "Email already registered";
        $color = "text-danger";
        $disable = true;
    }else{
        $msg = "Email can be registered";
        $color = "text-success";
        $disable = false;
    }
    $arr = array('msg' => $msg, 'color' => $color, 'disable' => $disable);
    echo json_encode($arr);
}

if(isset($_GET["name"])){
    $name=$_GET["name"];
    $sql="select team_name from teams where team_name='$name'";
    $res=mysqli_query($conn, $sql)->fetch_assoc();
    if($res){
        $msg = "Name already registered";
        $color = "text-danger";
        $disable = true;
    }else{
        $msg = "Name can be registered";
        $color = "text-success";
        $disable = false;
    }
    $arr = array('msg' => $msg, 'color' => $color, 'disable' => $disable);
    echo json_encode($arr);
}
?>