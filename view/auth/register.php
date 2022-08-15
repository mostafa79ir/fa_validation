<?php require "../../vendor/autoload.php";

use App\Validation\ConstValid;
use App\Validation\Valid;

    $valid = new Valid();
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $valid= new Valid($_POST['email'],$_POST['password'],$_POST['name'],$_POST['username']);
        $valid->register_isvalid();

        //validation db
        if(!$valid->has_error()){
            $host = 'localhost:3306';
            $userdb = 'root';
            $passdb = '$z_j4far^Zcd4-y?';
            try {
                $connect = new PDO("mysql:host=$host",$userdb,$passdb);
                //prepare the statement
                $stmt = $connect->prepare("SELECT * FROM users.log WHERE email=? ");
                $stmt->bindParam(1,$_POST['email']);
                $stmt->execute(); 
                $user = $stmt->fetch();
                if ($user) {
                    $valid->add_error('email',ConstValid::EMAIL_EXIST_ERR);
                } else {
                    $stmt = $connect->prepare("SELECT * FROM users.log WHERE username=? ");
                    $stmt->bindParam(1, $_POST['username']);
                    $stmt->execute(); 
                    $user = $stmt->fetch();
                    if ($user) {
                        $valid->add_error('username',ConstValid::USERNAME_EXIST_ERR);
                    }else{
                        $stmt2 = $connect->prepare("INSERT INTO users.log (username, email, password, name) VALUES (?, ?, ?, ?);");
                        $stmt2->bindParam(1,$_POST['username']);
                        $stmt2->bindParam(2, $_POST['email']);
                        $stmt2->bindParam(3, $_POST['password']);
                        $stmt2->bindParam(4, $_POST['name']);
                        $stmt2->execute(); 
                     if ($stmt2->rowCount()) {
                        header("Location: /php2/oop/auth/login.php");
                        return;
                     }
                    }
                }
            } catch (Exception $th) {
                echo($th->getMessage());
            }

        }
    
            
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class=" bg-gray-700">
<div class="container mx-auto space-y-4">
    <div class="sm:mx-auto sm:w-full sm:max-w-md mt-10">
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
            Register your account
        </h2>
    </div>
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Name
                    </label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <?php foreach ($valid->get_error('name') as $error) { ?>
                        <span class="block text-sm font-medium gray-red-700" ><?=$error?></span>
                    <?php } ?>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">
                        Username
                    </label>
                    <div class="mt-1">
                        <input id="username" name="username" type="text" autocomplete="username" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <?php foreach ($valid->get_error('username') as $error) { ?>
                        <span class="block text-sm font-medium gray-red-700" ><?=$error?></span>
                    <?php } ?>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email address
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <?php foreach ($valid->get_error('email') as $error) { ?>
                        <span class="block text-sm font-medium gray-red-700" ><?=$error?></span>
                    <?php } ?>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <?php foreach ($valid->get_error('password') as $error) { ?>
                        <span class="block text-sm font-medium gray-red-700" ><?=$error?></span>
                    <?php } ?>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Register
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
</body>
</html>