
<!-- signup.php-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>InternIt: Sign Up</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
        <link rel="stylesheet" href="searchStyleSheet.css">
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
                        <li class="nav-item">
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
                    </ul>
                </div>
            </div>
        </nav>

        <form action="applicantInsert.php" id="userInformation">
            <fieldset id="userInfo">
                <h1>Sign-up Page</h1>
                <div class="form-group">
                    <label for="fname" class="form-label mt-4"><strong>Enter your first name here:</strong><span>*</span> </label>
                    <input type="text" class="form-control" id="fname" name="firstname" placeholder="first name">
                </div>
                <div class="form-group">
                    <label for="lname" class="form-label mt-4"> <strong>Enter your last name here:</strong><span>*</span> </label>
                    <input type="text" class="form-control" id="lname" name="lastname" placeholder="last name">
                </div>
                <div class="form-group">
                    <label for="emails" class="form-label mt-4"><strong>Enter your e-mail address here:</strong><span>*</span>  </label>
                    <input type="email" class="form-control" id="emails" name="email" placeholder="example@gmail.com">
                </div>
                <div class="form-group">
                    <label for="pswd" class="form-label mt-4"> <strong>Enter your password here:</strong><span>*</span>  </label>
                    <input type="password" class="form-control" id="pswd" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="dob" class="form-label mt-4"><strong>Enter your date of birth:</strong> </label>
                    <input type="text" class="form-control" id="dob" name="dateofbirth" placeholder="2000-01-01">
                </div>
                <div class="form-group">
                    <label for="phonenum" class="form-label mt-4"> <strong>Enter your phone number: </strong> </label>
                    <input type="tel" class="form-control" id="phonenum" name="phonenum" placeholder="206-111-2222">
                </div>
                <div class="form-group">
                    <label for="degree" class="form-label mt-4"> <strong>Enter your last degree earned: </strong> </label>
                    <select class="form-control" id="degree" name="degree">
                        <option value = "1">High School Diploma</option>
                        <option value = "2">Associate of Arts </option>
                        <option value = "3">Associate of Science </option>
                        <option value = "4">Bachelor of Arts </option>
                        <option value = "5">Bachelor of Science </option>
                        <option value = "6">Master of Arts </option>
                        <option value = "7">Master of Science </option>
                        <option value = "8">Ph.D.</option>
                        <option value = "9">Technical Degree </option>
                        <option value = "10">Certificate </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="location" class="form-label mt-4"> <strong>Enter your preferred location: </strong> </label>
                    <select class="form-control" id="location" name="location">
                        <option value = "1">WA</option>
                        <option value = "2">FL </option>
                        <option value = "3">OH</option>
                        <option value = "4">TX</option>
                        <option value = "5">HI</option>
                        <option value = "6">AK </option>
                        <option value = "7">NV</option>
                        <option value = "8">AB</option>
                        <option value = "9">BC </option>
                        <option value = "10">CUL </option>
                    </select>
                </div>
                <input type="submit" value = "Submit" />
            </fieldset>
        </form>
    </body>
</html>