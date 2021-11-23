<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
 
    $email = $_POST['email'];
    $password = $_POST['password'];

    $koneksi = new mysqli("localhost" , "root" ,"" ,"elaundry");

    if($koneksi->connect_error){
        die("failed to connect : ").$koneksi->connect_error; 
    }else{
        $state = $koneksi->prepare("select * from regis where email = ?");
        $state -> bind_param("s" , $email);
        $state ->execute();
        $state_result = $state->get_result();
            if($state_result->num_rows > 0){
                $data = $state_result->fetch_assoc();
                    if($data['pass'] == $password){
                        debug_to_console("succesfull login");
                        header('Location: ../html/landing.html');
                    }else{
                        debug_to_console("login failed");
                    }
            }
            else{
                
                debug_to_console("login failed");
            }

    }
?>