<?php

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
 

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $gender = $_POST['gender'];

    //binin koneksi

    $koneksi = new mysqli('localhost' , 'root' , '' , 'elaundry');

    if($koneksi->connect_error){
        die('Connection Failed : '  .$koneksi->connect_error);
    }else{
        $state = $koneksi->prepare("insert into regis(email , pass , gender) values(?,?,?)");
        $state->bind_param("sss" , $email , $pass , $gender);
        $state->execute();
        debug_to_console("Account have been created");
        $state->close();
        $koneksi->close();
        header('Location: ../html/login.html');
        exit;
    }
?>