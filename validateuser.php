<?php
require_once 'config.php';
session_start();
require_once 'model/users.php';


if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $username     = trim($_POST['username']);
    $password     = trim($_POST['password']);
    $firstName    = trim( $_POST['firstname']);
    $lastName     = trim( $_POST['lastname']);
    $gender       = $_POST['gender'];
    $address      = trim( $_POST['address']);
    $error        = [];
    $oldData      = [];
    $allowedImg   = ['jpg','jpeg','png','svg'];
    $userImg      = $_FILES['userimg'];
    $imgPath      = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'img' .DIRECTORY_SEPARATOR;
    $imgName      = '';

    // check if user send img to handle it
    if( !empty( $userImg['name'] ) ) {

        // Get image extenstion
        $extenstion = explode('.',$userImg['name'])[1];
        // Check img extenstion
        if( !in_array( $extenstion, $allowedImg ) ) {
            $error['badimg'] = 'sorry file format not allowd';
        } else {
            $imgeName = $userImg['name'];
            $img = $imgPath.$userImg["name"];
            move_uploaded_file( $userImg['tmp_name'], $img );

        }

    }

    // Check if address is empty or less than five character
    if( empty($username) || strlen($username) < 5  ) {
        $error['username'] = "username must not be empty and greater than 5 charater";
    }

    if( empty( $password ) || strlen($password) < 5) {
        $error['password'] = "password must not be empty and greater than 5 charater";
    }

    // Check if firstname is empty or contain digit
    if( empty($firstName) || preg_match('/\d/', $firstName)  ) {
        $error['firstname'] = "first name is required and only character";
    }
    // Check if lastname is empty or contain digit
    if( empty($lastName) || preg_match('/\d/', $lastName)  ) {
        $error['lastname'] = "last name is required and only character";
    }
    // Check if address is empty or less than five character
    if( empty($address) || strlen($address) < 5  ) {
        $error['address'] = "address must not be empty and greater than 5 charater";
    }


    // Send error back to user form if error array not empty
    if( count($error) > 0 ) {

        // Send error and old data to user with json format
        $errorString = json_encode( $error );
        $oldData = json_encode( $_POST );

        if( isset($_GET['id']) ) {
            header("location:./edit.php?id={$_GET['id']}&error=".$errorString);

        } else {
            header("location:./adduser.php?error=".$errorString."&olddata=".$oldData);
        }


    } else {
        // insert or update data into file

            // the action is to edit user
            if( isset($_GET['id']) ) {
                $userId = intval($_GET['id']);
                $user = Users::getUser($userId);
                $user->firstname = $firstName;
                $user->lastname  = $lastName;
                $user->address = $address;
                $user->gender = $gender;
                $user->username = $username;
                $user->password = $password;
                $user->img = $imgeName;

                if( $user->updateUser() ) {
                    $_SESSION['message'] = "User updated success";
                    header('location:users.php');
                }

            } else {

                // Send query to check if user exist
                $userChecked = Users::checkUserexist( $username );
                // Userexist
                // true mean user exist
                if( $userChecked ) {
                    $_SESSION['message'] = "sorry this username is exist";
                    $oldData = json_encode( $_POST );
                    header('location:adduser.php?olddata='.$oldData);

                } else {
                    $user = new Users($firstName,$lastName,$address,$gender,$username,$password,$imgName);
                    
                    if( $user->insertUser()) {
                        
                        $_SESSION['message'] = 'user saved successfully';
                        header('location:users.php');

                    }
                }


            }

        }

} else {
    header('location:users.php');
}
?>

