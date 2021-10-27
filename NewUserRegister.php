<?php
    //creates session for each user
    session_start();
    //when user submits the form on clicking the Register button ,below code is executed in order to validate and create new user in the database.
    if(isset($_POST['register'])) 
    { 
        //To validate if any of the fields are empty.  
        if (empty($_POST['user_name']) || empty($_POST['password']) || empty($_POST['first_name']) || empty($_POST['last_name'])){
            echo "<font color='red'><h4 style = 'text-align:center;margin-top:8px'>Please enter all details to register!</h4></font>";
            
            
        }
        //if not extract all info submitted and store in variables.
        else {
            $user_name = $_POST['user_name'];
            $password = $_POST['password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $conn=connectDB();
            // to check if user with same username already exists.
            $query="select * from user where user_name='{$user_name}';";
            $result=mysqli_query($conn,$query);            
            if(mysqli_num_rows($result) > 0 ){
                
                echo "<font color='red'><h4 style = 'text-align:center;margin-top:8px'>User name already used! Please try another username.</h4></font>";
            }
            // if the username does not exist create an entry for the new user registered.
            else {
                $query = "INSERT INTO user (user_name, password, first_name, last_name) VALUES ('{$user_name}', '{$password}', '{$first_name}', '{$last_name}')";
               
                if (!mysqli_query($conn, $query))
                {
                    $error = mysqli_error($conn);
                    echo $error;
                }
                include 'registersuccess.html';
                // echo "";
                // echo "";
                // echo "</p>"
                
               return;
            }       
        }
     
    }
    //function to connect to the db with login details and the database selection.
    //Modify the localhost,username,password,database name as per individual credentials.
    function connectDB()
    {
        $conn = mysqli_connect("localhost:3306", "root", "", "dbproject");   
        //echo"connected DB"     ;
        if (!$conn) 
        {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        return $conn;
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="loginpagefe.css">
        <title>New user registration</title>
        <script>
        //script to load new user registration page on click of sign up button.
        function LoginPage() {
                window.location.assign("LoginPage.php");
        }
    </script>
        
    </head>
    <body>
    <!--Form contains the registration details and action:SELF to load the same page after the form is submitted on Register button.-->
    <form name="newuser_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h1 id="hl">New User Registration</h1>
    <div id="login_container">
        <label ><b>Username</b></label> <br>          
        <input type="text" id="Uname" name="user_name" placeholder="Enter your username" class="table"/><br><br>
        <label ><b>Password</b></label><br>
        <input type="password" id="Uname" name="password" placeholder="Enter your password" class="table"/> <br><br>  
        <label ><b>First Name</b></label><br>
        <input type="text" id="Uname" name="first_name" placeholder="Enter your First Name" class="table"/> <br><br>
        <label ><b>Last Name</b></label><br>
        <input type="text" id="Uname" name="last_name" placeholder="Enter your Last Name" class="table"> <br>
        <br/><br/>
        <input type="submit" value="Register" name="register" class="table"> <br><br>
        <label>Already have an account? &nbsp;&nbsp;<button type="button" onclick ="javasript:LoginPage()">Log in</button></label>
        </div>
     </form>
     </body>
</html>
