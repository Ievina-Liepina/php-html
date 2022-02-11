<?php
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$limit = 1000;
$offset = $_GET['offset'] ?? 0;
$link = json_decode(file_get_contents("https://data.gov.lv/dati/lv/api/3/action/datastore_search?&offset=$offset&resource_id=d499d2f0-b1ea-4ba2-9600-2c701b03bd4a&limit=$limit"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        p {
            font-family: "Times New Roman", sans-serif;
            color:MediumSeaGreen;
            font-weight: bold;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .button1 {
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
            border-radius: 8px;
            font-size: 20px;
        }

        .button1:hover {
            background-color: #4CAF50;
            color: white;
        }
      }
    </style>
    <title>Covid-19 rezultāti</title>
    <link rel="icon" type="image/x-icon" href="https://cdn.discordapp.com/attachments/691041380688068648/941030539903791144/covid-19.png">
</head>
<body>
    <form method="get" action="/">
        <label>
            <p1>from:</p1>
            <input type="date" name="from" value="<?=$from;?>"/>
            <p1>to: </p1>
            <input type="date" name="to" value="<?=$to;?>"/>
            <button class="button1" type="submit" data-value="<?=$from;?>" value="<?=$to;?>">Submit</button>
        </label>
    </form>
<h1><p>Covid-19 rezultāti</p></h1>
<table>
    <tr>
        <th>id</th>
        <th>Datums</th>
        <th>Testu Skaits</th>
        <th>Apstiprinātie</th>
        <th>Īpatsvars</th>
    </tr>
    <?php foreach ($link->result->records as $tests): ?>
    <?php if(strtotime($tests->Datums) >= strtotime($from) && strtotime($tests->Datums) <= strtotime($to)): ?>
        <tr>
            <td><?php echo $tests->_id; ?></td>
            <td><?php echo date_format(date_create(substr($tests->Datums, 0, "10")), "d-m-Y"); ?></td>
            <td><?php echo $tests->TestuSkaits; ?></td>
            <td><?php echo $tests->ApstiprinataCOVID19InfekcijaSkaits; ?></td>
            <td><?php echo $tests->Ipatsvars; ?></td>
        </tr>
    <?php endif; ?>
    <?php endforeach; ?>
</table>
</body>
</html>

