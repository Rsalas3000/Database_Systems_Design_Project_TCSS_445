<?php require_once('config.php'); ?>

<!-- Find Applicants Page-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Find Applicants</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
        <link rel="stylesheet" href = FindApplicantsStyle.css>
        <script src ="code.js"></script>
    </head>

    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">InternIt!</a>
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
                        <li class="nav-item active">
                            <a class="nav-link" href="FindApplicants.php">Find Applicants</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- __________________________________ -->
        <!-- This is for the top set of tables. -->
        <!-- __________________________________ -->

        <div class="listgroup">
            <!-- This sets the header of the page -->
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                <p class="mb-1" style="font-size: 1.5em">
                    <strong>Choose from our large pool of applicants by various categories.</strong>
                    <br>
                    Below are the number of current applications based on the degree they have, their interest area, and preferred location.  
                </p>
            </a>

            <!-- This puts the tables in the first part square. -->
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-10 justify-content-between">

                    <?php
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    ?>
                    <table class="table1">
                        <thead>
                            <tr class="table-success">
                                <th class="top"  scope="col">Degree Status</th>
                                <th class="top"  scope="col"># Applicants</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT D.Degree, Count(A.Degree_Status)
                                            FROM APPLICANTS A, DEGREE_STATUS D
                                            WHERE A.Degree_Status = D.DegreeID
                                            GROUP BY A.Degree_Status";
                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t1results">
                            <td><?php echo $row['Degree'] ?></td>
                            <td style="text-align: center"><?php echo $row['Count(A.Degree_Status)'] ?></td>
                        </tr>
                        <?php
                            }
                            // release the memory used by the result set
                            mysqli_free_result($result);
                        }
                        ?>
                    </table>

                    <?php
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    ?>
                    <table class="table2">
                        <thead>
                            <tr class="table-success">
                                <th class="top" scope="col">Interest Area</th>
                                <th class="top" scope="col"># Applicants</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT IA.Interest, Count(*)
                                            FROM APPLICANTS A, INTEREST_LOG IL, INTEREST_AREA IA
                                            WHERE 	A.ApplicantId = IL.UserID AND
		                                            IL.InterestID = IA.InterestId
                                            GROUP BY IA.InterestId;";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t2results">
                            <td><?php echo $row['Interest'] ?></td>
                            <td style="text-align: center"><?php echo $row['Count(*)'] ?></td>
                        </tr>
                        <?php
                            }
                            // release the memory used by the result set
                            mysqli_free_result($result);
                        }
                        ?>
                    </table>


                    <?php
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    ?>
                    <table class="table3">
                        <thead>
                            <tr class="table-success">
                                <th class="top"  scope="col">Preferred Location</th>
                                <th class="top"  scope="col"># Applicants</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT State_Region, Count(*)
                                        FROM APPLICANTS A, LOCATIONS L
                                        WHERE 	A.PreferredLocation = L.LocationId
                                        GROUP BY A.PreferredLocation;";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t3results">
                            <td class><?php echo $row['State_Region'] ?></td>
                            <td style="text-align: center"><?php echo $row['Count(*)'] ?></td>
                        </tr>
                        <?php
                            }
                            // release the memory used by the result set
                            mysqli_free_result($result);
                        }
                        ?>
                    </table>
                </div>
            </a>
        </div>

        <!-- __________________________________ -->
        <!-- This is for the Searches. -->
        <!-- __________________________________ -->
        <div class="searchArea">
            <h2 class="searchHeader" onclick="instruct1"><strong>Search for your next computer scientist!</strong></h2>
            <button  onclick="instruct1()" type="button1" class="btn btn-link">Instructions</button>

            <div class="searchApplicants">
                <button  onclick="window.location.href='FindApplicants.php'" type="button" class="btn btn-primary btn-lg">Degree Status</button>
                <button onclick="window.location.href='#'"  type="button" class="btn btn-primary btn-lg">Interest Area</button>
                <button onclick="window.location.href='faLocation.php'"  type="button" class="btn btn-primary btn-lg">Preferred Location</button>

                <form id="degreeForm" method="GET" >
                    <select  name="interestS" onchange='this.form.submit()'>
                        <option selected>Select an Interest Area</option>
                        <?php
                        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }
                        $sql = "select * FROM INTEREST_AREA  ";
                        if ($result = mysqli_query($connection, $sql))
                        {
                            // loop through the data
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '<option value="' . $row['InterestId'] . '">';
                                echo $row['Interest'];
                                echo "</option>";
                            }
                            // release the memory used by the result set
                            mysqli_free_result($result);
                        }
                        ?>
                    </select>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET")
                    {
                        if (isset($_GET['interestS']) )
                        {
                    ?>
                    <p>&nbsp;</p>
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>
                        <?php
                            if ( mysqli_connect_errno() )
                            {
                                die( mysqli_connect_error() );
                            }

                            $sql = "    SELECT  FName, LName, PhoneNumber, Email
                                        FROM    APPLICANTS A, INTEREST_LOG IL
                                        WHERE   IL.InterestID = {$_GET['interestS']} AND
                                                IL.UserID = A.ApplicantId";

                            if ($result = mysqli_query($connection, $sql))
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                        ?>
                        <tr>
                            <td><?php echo $row['FName'] ?></td>
                            <td><?php echo $row['LName'] ?></td>
                            <td><?php echo $row['PhoneNumber'] ?></td>
                            <td><?php echo $row['Email'] ?></td>
                        </tr>
                        <?php
                                }
                                // release the memory used by the result set
                                mysqli_free_result($result);
                            }
                        } // end if (isset)
                    } // end if ($_SERVER)
                        ?>
                    </table>
                </form>



            </div>
        </div>






    </body>
</html>