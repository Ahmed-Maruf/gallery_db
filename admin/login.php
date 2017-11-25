<?php require_once "includes/header.php";
if($session->get_signed_in()){header("Location: index.php");}
$the_message="";
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    echo $username  . ' ' . $password;
    $user_found = User::verify_user($username,$password);
//    var_dump($user_found);
    if($user_found){
        $session->login($user_found);
        redirect("index.php");
    }
    else{
        $the_message = "Your password or username are incorrect";
        redirect("login.php");
    }
}
else{
    echo 'Hahahah';
    $username = "";
    $password = "";
}

?>


<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger"><?php echo $the_message; ?></h4>

    <form id="login-id" action="login.php" method="POST">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username">

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">

        </div>


        <div class="form-group">
            <input type="submit" name="submit" value="submit" class="btn btn-primary">

        </div
    </form>


</div>
