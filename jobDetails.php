<?php require 'includes/header.php'; ?>

<body>

<?php require 'includes/navigation.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php require 'includes/sidebar.php'; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Job Details</h1>
            <div class="table-responsive">

                <?php

                include("database/db.php");

                ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Visits</th>
                        <th>Job Title</th>
                        <th>First Access(d.m.y H:i:s)</th>
                        <th>Last Access(d.m.y H:i:s)</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    /* Result fetching from database */
                    if ($results = $mysqli->query("SELECT COUNT(job_id) AS job_id, job_title, MIN(date_time) AS first_access, MAX(date_time) AS last_access FROM job_details GROUP BY job_title")) {
                        if($results->num_rows > 0) {
                            while($jobDetails = $results->fetch_assoc())
                            {
                                ?>

                                <tr>
                                    <td><?php echo $jobDetails['job_id']; ?></td>
                                    <td><?php echo $jobDetails['job_title']; ?></td>
                                    <td><?php echo date('d.m.y H:i:s', strtotime($jobDetails['first_access'])); ?></td>
                                    <td><?php echo date('d.m.y H:i:s', strtotime($jobDetails['last_access'])); ?></td>
                                </tr>

                                <?php
                            }
                        }

                        /* free result set */
                        $results->close();
                    }

                    /* db connection close */
                    $mysqli->close();
                    ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

<?php require 'includes/footer.php'; ?>

