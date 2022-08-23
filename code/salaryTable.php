<?php require_once('config.php'); ?>

<!-- No longer used-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Assignment 4 Demo</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">internIt!</a>
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
                            <a class="nav-link" href="search.php">Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="jobType_search.php">Job Type</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="project.php">Project</a>
                        </li>
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
        <p>&nbsp;</p>
        <table class="table table-hover">
            <thead>
                <tr class="table-success">
                    <th scope="col">Job Title</th>
                    <th scope="col">Company</th>
                    <th scope="col">Job Type</th>
                    <th scope="col">Salary</th>
                    <th scope="col">State/Region</th>
                    <th scope="col">Country</th>
                </tr>
            </thead>
            <?php
            $sql = " SELECT State_Region, Country, Title, Company, JobType, Salary
 FROM JOB_ADS JOIN LOCATIONS ON Location = LocationId
 Order By salary";
            <tr>
                <td><?php echo $row['Title'] ?></td>
                <td><?php echo $row['Company'] ?></td>
                <td><?php echo $row['JobType'] ?></td>
                <td><?php echo $row['Salary'] ?></td>
                <td><?php echo $row['State_Region'] ?></td>
                <td><?php echo $row['Country'] ?></td>
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
    </body>
</html>