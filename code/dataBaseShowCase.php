<?php require_once('config.php'); ?>

<!-- Database Showcase Page-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Internit: Database Showcase</title>
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
                        <li class="nav-item active">
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
        <button  onclick="instruct3()" type="button1" class="btn btn-link">What's a Database Showcase?</button>
        <div class="listgroup">
            <!-- 1st table set -->
            <button  onclick="tableSet1()" type="button1" class="btn btn-link">More about these tables</button>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                <p class="mb-1" style="font-size: 1.5em">
                    <strong>It's important for applicants to know what a position offers.</strong>
                    <br>
                    <font size="-1">The table on the left provides general information about the availible positions. The table in the middle lists the companies that provide paid sick leave. The table on the right show the companies that provide health insurrance as well as paid time off or sick leave.</font>
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
                                <th class="top"  scope="col">Company</th>
                                <th class="top"  scope="col">Job Type</th>
                                <th class="top"  scope="col">Salary</th>
                                <th class="top"  scope="col">State/Region</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT JOB_ADS.Company, JOB_ADS.JobType, JOB_ADS.Salary,LOCATIONS.State_Region 
FROM JOB_ADS 
LEFT JOIN LOCATIONS on (JOB_ADS.Location = LOCATIONS.LocationId) 
UNION 	SELECT JOB_ADS.Company, JOB_ADS.JobType, JOB_ADS.Salary,LOCATIONS.State_Region 
		FROM JOB_ADS 
		RIGHT JOIN LOCATIONS on (JOB_ADS.Location = LOCATIONS.LocationId) 
		WHERE JOB_ADS.Company IS NOT NULL 
		ORDER BY Salary DESC";
                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t1results">
                            <td><?php echo $row['Company'] ?></td>
                            <td style="text-align: center"><?php echo $row['JobType'] ?></td>
                            <td style="text-align: center"><?php echo $row['Salary'] ?></td>
                            <td style="text-align: center"><?php echo $row['State_Region'] ?></td>
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
                                <th class="top"  scope="col">Company</th>
                                <th class="top"  scope="col">Job Type</th>
                                <th class="top"  scope="col">Salary</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT * 
FROM JOB_ADS 
WHERE BenefitNo IN (SELECT BenefitId 
					FROM BENEFITS 
					WHERE SickLeave = 'Yes') 
";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t2results">
                            <td><?php echo $row['Company'] ?></td>
                            <td style="text-align: center"><?php echo $row['JobType'] ?></td>
                            <td style="text-align: center"><?php echo $row['Salary'] ?></td>
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
                                <th class="top"  scope="col">Company</th>
                                <th class="top"  scope="col">Job Type</th>
                                <th class="top"  scope="col">Salary</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT JOB_ADS.*
FROM JOB_ADS, BENEFITS 
WHERE JOB_ADS.BenefitNo = BENEFITS.BenefitId AND
      BENEFITS.HealthInsurance = 'Yes' AND
	  (BENEFITS.PTO = 'Yes' OR
	   BENEFITS.SickLeave = 'Yes')";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t3results">
                            <td><?php echo $row['Company'] ?></td>
                            <td style="text-align: center"><?php echo $row['JobType'] ?></td>
                            <td style="text-align: center"><?php echo $row['Salary'] ?></td>
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

        <div class="listgroup">
            <!-- 2nd table set -->
            <button  onclick="tableSet2()" type="button1" class="btn btn-link">More about these tables</button>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                <p class="mb-1" style="font-size: 1.5em">
                    <strong>It's important for employers to know what the availible applicants offer.</strong>
                    <br>
                    <font size="-1">The table on the left shows the number of applicants in each state. The table in the middle shows applicants and their skills. The table on the right shows the date which their training was completed.</font>  
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
                                <th class="top"  scope="col">State</th>
                                <th class="top"  scope="col"># of availible applicants</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT 	LOCATIONS.State_Region, COUNT(APPLICANTS.PreferredLocation)
FROM	APPLICANTS, LOCATIONS
WHERE 	APPLICANTS.PreferredLocation = LOCATIONS.LocationId
GROUP BY LOCATIONS.State_Region";
                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t1results">
                            <td><?php echo $row['State_Region'] ?></td>
                            <td style="text-align: center"><?php echo $row['COUNT(APPLICANTS.PreferredLocation)'] ?></td>
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
                                <th class="top" scope="col">First Name</th>
                                <th class="top" scope="col">Last Name</th>
                                <th class="top" scope="col">Skills</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT 	APPLICANTS.FName, APPLICANTS.Lname, JOB_SKILLS.Skills 
FROM 	KSA_APPLICANT
JOIN 	APPLICANTS ON APPLICANTS.ApplicantId = KSA_APPLICANT.ApplicantId
JOIN 	JOB_SKILLS ON JOB_SKILLS.KSAnum = KSA_APPLICANT.KLogId";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t2results">
                            <td><?php echo $row['FName'] ?></td>
                            <td style="text-align: center"><?php echo $row['Lname'] ?></td>
                            <td style="text-align: center"><?php echo $row['Skills'] ?></td>
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
                                <th class="top"  scope="col">Date Completed</th>
                                <th class="top"  scope="col">Training Type</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT TRAINING_LOG.DateTrained, TRAINING_TYPE.Training
FROM  TRAINING_LOG
LEFT JOIN TRAINING_TYPE ON TRAINING_LOG.TrainID = TRAINING_TYPE.TrainingId
UNION
SELECT TRAINING_LOG.DateTrained, TRAINING_TYPE.Training
FROM  TRAINING_LOG
RIGHT JOIN TRAINING_TYPE ON TRAINING_LOG.TrainID = TRAINING_TYPE.TrainingId";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t3results">
                            <td class><?php echo $row['DateTrained'] ?></td>
                            <td style="text-align: center"><?php echo $row['Training'] ?></td>
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

        <div class="listgroup">
            <!-- 3rd Table set -->
            <button  onclick="tableSet3()" type="button1" class="btn btn-link">More about these tables</button>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                <p class="mb-1" style="font-size: 1.5em">
                    <strong>Employers may need applicants that meet certain criteria</strong>
                    <br>
                    <font size="-1">The table on the left shows the applicants above the average age of all applicants. The table in the middle shows the applicants that know javascript. The table on the right shows the applicants with high demand interest areas.</font>  
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
                                <th class="top"  scope="col">First Name</th>
                                <th class="top"  scope="col">Last Name</th>
                                <th class="top"  scope="col">Age</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT A.Fname, A.Lname, A.Age 
FROM APPLICANTS A 
WHERE A.Age > (	SELECT AVG(I.Age) 
				FROM APPLICANTS I 
				WHERE I.DEGREE_STATUS = A.DEGREE_STATUS);";
                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t1results">
                            <td><?php echo $row['Fname'] ?></td>
                            <td style="text-align: center"><?php echo $row['Lname'] ?></td>
                            <td style="text-align: center"><?php echo $row['Age'] ?></td>
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
                                <th class="top"  scope="col">First Name</th>
                                <th class="top"  scope="col">Last Name</th>
                                <th class="top"  scope="col">Phone #</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT APPLICANTS.Fname, APPLICANTS.Lname, APPLICANTS.PhoneNumber
FROM APPLICANTS, KSA_APPLICANT, JOB_SKILLS
WHERE APPLICANTS.ApplicantId = KSA_APPLICANT.ApplicantId AND 
	  KSA_APPLICANT.KLogId = JOB_SKILLS.KSAnum  AND 
	  JOB_SKILLS.Skills = 'JavaScript'";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t2results">
                            <td><?php echo $row['Fname'] ?></td>
                            <td style="text-align: center"><?php echo $row['Lname'] ?></td>
                            <td style="text-align: center"><?php echo $row['PhoneNumber'] ?></td>
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
                                <th class="top"  scope="col">First Name</th>
                                <th class="top"  scope="col">Last Name</th>
                                <th class="top"  scope="col">Preferred Country</th>
                                <th class="top"  scope="col">Preferred State</th>
                                <th class="top"  scope="col">Interest Area</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "SELECT APPLICANTS.Fname, APPLICANTS.Lname, LOCATIONS.Country, LOCATIONS.State_Region, INTEREST_AREA.Interest
FROM APPLICANTS, LOCATIONS, INTEREST_AREA, INTEREST_LOG
WHERE 	APPLICANTS.PreferredLocation = LOCATIONS.LocationId AND 
		INTEREST_LOG.UserId = APPLICANTS.ApplicantId AND 
		INTEREST_LOG.InterestId = INTEREST_AREA.InterestId AND
		INTEREST_AREA.Interest LIKE '%ems'
GROUP BY LOCATIONS.State_Region, LOCATIONS.Country, APPLICANTS.Lname, APPLICANTS.Fname, INTEREST_AREA.Interest;";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t3results">
                            <td class><?php echo $row['Fname'] ?></td>
                            <td style="text-align: center"><?php echo $row['Lname'] ?></td>
                            <td style="text-align: center"><?php echo $row['Country'] ?></td>
                            <td style="text-align: center"><?php echo $row['State_Region'] ?></td>
                            <td style="text-align: center"><?php echo $row['Interest'] ?></td>
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
        
        <div class="listgroup">
            <!-- 4th table set -->
            <button  onclick="tableSet4()" type="button1" class="btn btn-link">More about this table</button>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                <p class="mb-1" style="font-size: 1.5em">
                    <strong>Reminders Table</strong>
                    <br>
                    <font size="-1">Reminders are sent to users for a variety of reasons, we are able to see all the sent reminders as well as when they were sent and the recipients.</font>  
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
                    <table class="table2", style="width:1800px">
                        <thead>
                            <tr class="table-success">
                                <th class="top" scope="col">Reminder Message</th>
                                <th class="top" scope="col">Date Sent</th>
                                <th class="top" scope="col">Applicant First Name</th>
                                <th class="top" scope="col">Applicant Last Name</th>
                            </tr>
                        </thead>
                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        $sql = "    SELECT REMINDERS.Message, REMINDERS_SENT.DateSent, APPLICANTS.Fname, APPLICANTS.Lname 
FROM REMINDERS 
JOIN REMINDERS_SENT ON REMINDERS.MsgId = REMINDERS_SENT.MsgId
JOIN APPLICANTS ON REMINDERS_SENT.UserId = APPLICANTS.ApplicantId";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                        <tr class = "t2results">
                            <td><?php echo $row['Message'] ?></td>
                            <td style="text-align: center"><?php echo $row['DateSent'] ?></td>
                            <td style="text-align: center"><?php echo $row['Fname'] ?></td>
                            <td style="text-align: center"><?php echo $row['Lname'] ?></td>
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

        <div class="listgroup">
            <!-- 5th table set-->
            <button  onclick="tableSet5()" type="button1" class="btn btn-link">More about these tables</button>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                <p class="mb-1" style="font-size: 1.5em">
                    <strong>Choose from our large pool of opportunities by various categories.</strong>
                    <br>
                    <font size="-1">These tables are availible at the top of the Find Opportunities page</font>  
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

        <div class="listgroup">
            <!-- 6th table set -->
            <button  onclick="tableSet6()" type="button1" class="btn btn-link">More about these tables</button>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                <p class="mb-1" style="font-size: 1.5em">
                    <strong>Choose from our large pool of applicants by various categories.</strong>
                    <br>
                    <font size="-1">These tables are availible at the top of the Find Applicants page</font>  
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

    </body>
</html>