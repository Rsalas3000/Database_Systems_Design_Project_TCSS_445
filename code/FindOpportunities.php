<?php require_once('config.php'); ?>

<!-- Find Opportunities Page-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Internit: Find Opportunities</title>
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
                        <li class="nav-item active">
                            <a class="nav-link" href="FindOpportunities.php">Find Opportunities</a>
                        </li>
                        <li class="nav-item">
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
                    <strong>Choose from our large pool of opportunities by various categories.</strong>
                    <br>
                    Below are the number of current positions based on the type of job, the salary it offers, and the location where it is offered.  
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
                                <th class="top"  scope="col">Job Type</th>
                                <th class="top"  scope="col"># of availible positions</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT ja.JobType, Count(ja.JobType)
                                            FROM JOB_ADS ja

                                            GROUP BY ja.JobType";
                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t1results">
                            <td><?php echo $row['JobType'] ?></td>
                            <td style="text-align: center"><?php echo $row['Count(ja.JobType)'] ?></td>
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
                                <th class="top" scope="col">Salary Range</th>
                                <th class="top" scope="col"># of availible positions</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT 
                                        CASE
                                            WHEN Salary between 60000 and 80000 then '1. $60,000-$80,000'
                                            WHEN Salary between 80000 and 100000 then '2. $80,000-$100,000'
                                            ELSE '3. $100,000+' END AS 'test',
                                            count(*) as 'numOfPos'
                                            FROM JOB_ADS
                                            GROUP BY test";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t2results">
                            <td><?php echo $row['test'] ?></td>
                            <td style="text-align: center"><?php echo $row['numOfPos'] ?></td>
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
                                <th class="top"  scope="col">Location</th>
                                <th class="top"  scope="col"># of availible positions</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT State_Region, Count(*)
                                        FROM JOB_ADS A, LOCATIONS L
                                        WHERE 	A.Location = L.LocationId
                                        GROUP BY A.Location;";

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
            <h2 class="searchHeader" onclick="instruct2"><strong>Search for your next big opportunity!</strong></h2>
            <button  onclick="instruct2()" type="button1" class="btn btn-link">Instructions</button>

            <div class="searchApplicants">
                <button  onclick="window.location.href='#'" type="button" class="btn btn-primary btn-lg">Job Type</button>
                <button onclick="window.location.href='foSalary.php'"  type="button" class="btn btn-primary btn-lg">Salary Range</button>
                <button onclick="window.location.href='foLocation.php'" type="button" class="btn btn-primary btn-lg">Location</button>

                <form id="degreeForm" method="GET" >
                    <select  name="jobS" onchange='this.form.submit()'>
                        <option selected>Select a Job Type</option>
                        <?php
                        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }
                        $sql = "select Distinct JobType FROM JOB_ADS  ";
                        if ($result = mysqli_query($connection, $sql))
                        {
                            // loop through the data
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '<option value="' . $row['JobType'] . '">';
                                echo $row['JobType'];
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
                        if (isset($_GET['jobS']) )
                        {
                    ?>
                    <p>&nbsp;</p>
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">Company</th>
                                <th scope="col">Title</th>
                                <th scope="col">Job Type</th>
                                <th scope="col">Salary</th>
                                <th scope="col">Time Commitment Per Week</th>
                                <th scope="col">State/Region</th>
                                <th scope="col">Country</th>
                                <th scope="col">Website URL</th>
                            </tr>
                        </thead>
                        <?php
                            if ( mysqli_connect_errno() )
                            {
                                die( mysqli_connect_error() );
                            }

                            $sql = "    SELECT  JOB_ADS.*, LOCATIONS.*
                                        FROM    JOB_ADS JOIN LOCATIONS ON JOB_ADS.Location = LOCATIONS.LocationId
                                        WHERE   JOB_ADS.JobType = '{$_GET['jobS']}'";

                            if ($result = mysqli_query($connection, $sql))
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                        ?>
                        <tr>
                            <td><?php echo $row['Company'] ?></td>
                            <td><?php echo $row['Title'] ?></td>
                            <td><?php echo $row['JobType'] ?></td>
                            <td><?php echo $row['Salary'] ?></td>
                            <td><?php echo $row['TimeCommit'] ?></td>
                            <td><?php echo $row['State_Region'] ?></td>
                            <td><?php echo $row['Country'] ?></td>
                            <td><?php echo $row['URL'] ?></td>
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