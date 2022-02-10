<?php
$search = $_GET['search'] ?? '';
$limit = 50;
$offset = $_GET['offset'] ?? 0;
$link = json_decode(file_get_contents("https://data.gov.lv/dati/lv/api/3/action/datastore_search?q={$search}&offset={$offset}&resource_id=d499d2f0-b1ea-4ba2-9600-2c701b03bd4a&limit={$limit}"));
//echo '<pre>';
//var_dump($link);die;
$tables = [];
foreach ($link as $data => $value){
    $tables[$data] = $value;
}
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
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .button {
            background-color: white;
            color: black;
            border: 2px solid #e7e7e7;
            border-radius: 4px;
            font-size: 16px;
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

        .button2 {
            background-color: white;
            color: black;
            border: 2px solid #008CBA;
            border-radius: 8px;
            font-size: 20px;
        }

        .button2:hover {
            background-color: #008CBA;
            color: white;
        }
    </style>
    <title>Covid-19 rezultāti</title>
    <link rel="icon" type="image/x-icon" href="https://cdn.discordapp.com/attachments/691041380688068648/941030539903791144/covid-19.png">
</head>
<body>

<form method="get" action="/">
    <label>
        <p1>from:</p1>
        <input type="date" name="search"/>
        <p1>to: </p1>
        <input type="date" name="search"/>
        <button class="button1" type="submit">Submit</button>
    </label>

</form>

<h1><p>Covid-19 rezultāti</p></h1>

<table>
    <thead>
    <th>
        id
    </th>
    <th>
        Datums
    </th>
    <th>
        Testu Skaits
    </th>
    <th>
        Apstiprinātie
    </th>
    <th>
        Īpatsvars
    </th>
    </thead>
    <?php foreach ($tables["result"]->records as $r): ?>
        <tr>
            <td>
                <?php echo $r->_id . "<br>" ?>
            </td>
            <td>
                <?php echo $r->Datums . "<br>" ?>
            </td>
            <td>
                <?php echo $r->TestuSkaits . "<br>" ?>
            </td>
            <td>
                <?php echo $r->ApstiprinataCOVID19InfekcijaSkaits . "<br>" ?>
            </td>
            <td>
                <?php echo $r->Ipatsvars . "<br>" ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<form method="get" action="/">
    <?php if($offset > 0): ?>
        <button class="button1" type="submit" name="offset" value="<?php echo $offset - $limit; ?>"><p1>Previous</p1></button>
    <?php endif; ?>

    <?php if(count($tables["result"]->records) >= $limit): ?>
        <button class="button2" type="submit" name="offset" value="<?php echo $offset + $limit; ?>"><p1>Next</p1></button>
    <?php endif; ?>
</form>
</body>
</html>

