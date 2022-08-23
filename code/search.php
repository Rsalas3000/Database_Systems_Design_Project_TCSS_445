<!-- No longer used -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>InternIt: General Search</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">InternIt</a>
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
                            <a class="nav-link" href="FindOpportunities.php">Find Opportunities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="FindApplicants.php">Find Applicants</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1>
            Choose how you want to search:
        </h1>

        <div class="card mb-3">
            <h3 class="card-header">Search by Location</h3>
            <div class="card-body">
                <h5 class="card-title">Browse opportunites by locaiton</h5>
                <h6 class="card-subtitle text-muted">Find a good fit where you want to be</h6>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">image placeholder</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Some of our top locations include:</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Seattle WA</li>
                <li class="list-group-item">Orlando FL</li>
                <li class="list-group-item">Austin TX</li>
            </ul>
            <div class="card-body">
                <a href="location_search.php" class="card-link">Click here to start your search</a>
            </div>
            <div class="card-footer text-muted">
                last updated 11/27/21
            </div>
        </div>

        <div class="card mb-3">
            <h3 class="card-header">Search by Job Type</h3>
            <div class="card-body">
                <h5 class="card-title">Browse opportunites by posistion level</h5>
                <h6 class="card-subtitle text-muted">Find a good fit for your current level of experiance</h6>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">image placeholder</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Some of our avialible job types include:</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Internship Posistions</li>
                <li class="list-group-item">Entry Level Posistions</li>
                <li class="list-group-item">High Level Posistions</li>
            </ul>
            <div class="card-body">
                <a href="jobType_search.php" class="card-link">Click here to start your search</a>
            </div>
            <div class="card-footer text-muted">
                last updated 11/27/21
            </div>
        </div>
        
        <div class="card mb-3">
            <h3 class="card-header">Search by Salary</h3>
            <div class="card-body">
                <h5 class="card-title">Browse opportunites based on anual pay</h5>
                <h6 class="card-subtitle text-muted">This is most likley not the best way to search for the right opportunity, though it will give you a nice idea of what positions earn what amount</h6>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">image placeholder</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Average Pay based on Position:</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Average Internship Salary: $84,000</li>
                <li class="list-group-item">Average Entry/mid-level Salary: $77,000</li>
                <li class="list-group-item">Average High-level Salary: $91,250</li>
            </ul>
            <div class="card-body">
                <a href="salaryTable.php" class="card-link">Click here to start your search</a>
            </div>
            <div class="card-footer text-muted">
                last updated 11/27/21
            </div>
        </div>
        </div>
    </body>
</html>