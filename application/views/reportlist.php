<!doctype html>
<html>
    <head>
        <title>Bug Report List</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IP Address</th>
                    <th>Referrer</th>
                    <th>Report</th>
                    <th></th>
                </tr>
            <thead>
            <tbody>
<?php foreach($reports as $r) { ?>
                <tr>
                    <td><?php echo $report->id; ?></td>
                    <td><?php echo $report->ip; ?></td>
                    <td><?php echo $report->referrer; ?></td>
                    <td><?php echo $report->report; ?></td>
                    <td><a href="/report/view/<?php echo $report->id; ?>">View</a></td>
                </tr>
<?php } ?>
            </tbody>
        </table>
    </body>
</html>