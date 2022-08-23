
<!-- Homepage for our website-->
<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>InternIt!</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">InternIt!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home
                                <span class="visually-hidden"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dataBaseShowCase.php">Database Showcase</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="FindOpportunities.php">Find Opportunities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="FindApplicants.php">Find Applicants</a>
                        </li>
                        <li><button type="button" class="btn btn-outline-danger" onclick="openForm()">Sign In</button></li>
                        <!--<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#">Separated link</a>
</div>
</li>-->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END -- Add HTML code for the top menu section (navigation bar) -->
        <div class="jumbotron">
            <center><h1 class="display-3">Welcome to InternIt!</h1></center>
            <center><img src="logo.png" alt="Earth High Res Orb by climber07 on DeviantArt" jsname="HiaYvf" jsaction="load:XAeZkd;" class="n3VNCb" data-noaft="1" style="width: 383px; height: 383px; margin: 0px;"></center>
            <center><p>Find an opportunity that is right for you</p></center>
            <hr class="my-4">
            <h1>
                What is InternIt!?
            </h1>
            <p>InternIt! is service that strives to connect Computer Science majors with opportinutes that suit their interests and skill set. If your new, feel free to browse the availible opportunites by selecting the search option
            from the top of this page. There you can select parameters for your search and get immediate results allowing you to look into those opportunites. If you would like to use our service and get updates about
            opportunities in the future you can click on the sign up button below and make an account. On behalf of the InternIt team we would like to wish you good luck on securing an internship/position.
            </p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="signup.php" role="button">Don't have an account? Sign up!</a>
            </p>
        </div>
        <div class="form-popup" id="myForm">
            <form action="/action_page.php" class="form-container">
                <h1>Login</h1>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button type="submit" class="btn">Login</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>
        <style>
            {box-sizing: border-box;}

            /* Button used to open the contact form - fixed at the bottom of the page */
            .open-button {
                background-color: #555;
                color: white;
                padding: 16px 20px;
                border: none;
                cursor: pointer;
                opacity: 0.8;
                position: fixed;
                bottom: 23px;
                right: 28px;
                width: 280px;
            }

            /* The popup form - hidden by default */
            .form-popup {
                display: none;
                position: fixed;
                bottom: 0;
                right: 15px;
                border: 3px solid #f1f1f1;
                z-index: 9;
            }

            /* Add styles to the form container */
            .form-container {
                max-width: 300px;
                padding: 10px;
                background-color: white;
            }

            /* Full-width input fields */
            .form-container input[type=text], .form-container input[type=password] {
                width: 100%;
                padding: 15px;
                margin: 5px 0 22px 0;
                border: none;
                background: #f1f1f1;
            }

            /* When the inputs get focus, do something */
            .form-container input[type=text]:focus, .form-container input[type=password]:focus {
                background-color: #ddd;
                outline: none;
            }

            /* Set a style for the submit/login button */
            .form-container .btn {
                background-color: #04AA6D;
                color: white;
                padding: 16px 20px;
                border: none;
                cursor: pointer;
                width: 100%;
                margin-bottom:10px;
                opacity: 0.8;
            }

            /* Add a red background color to the cancel button */
            .form-container .cancel {
                background-color: red;
            }

            /* Add some hover effects to buttons */
            .form-container .btn:hover, .open-button:hover {
                opacity: 1;
            }
        </style>
        <script>
            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
        </script>
        
        <footer>
            @Copyright InternIt! 2021 - All Rights Reserved.
            <br>
            Authors: Mason, Rico, Osman, Kumiko "The BEST TCSS 445 Group Fall 2021!"
        </footer>
    </body>
</html>