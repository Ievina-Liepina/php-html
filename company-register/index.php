<?php
$search = $_GET['search'] ?? '';
$limit = 50;
$offset = $_GET['offset'] ?? 0;
$data = json_decode(file_get_contents("https://data.gov.lv/dati/lv/api/3/action/datastore_search?q={$search}&offset={$offset}&resource_id=25e80bf3-f107-4ab4-89ef-251b5b9374e9&limit={$limit}"));
//echo '<pre>';
//var_dump($data);die;
$results = [];
foreach ($data as $item => $value){
    $results[$item] = $value;
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
            border-radius: 8px;
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
    <title>Uzņēmumu reģistrs</title>
</head>
<body>

<form method="get" action="/">
    <label>
       <p1>Search:</p1>
        <input class="button" name="search" placeholder="Company name"/>
    </label>
    <button class="button1" type="submit">Submit</button>
</form>

<h1><p>Uzņēmumu reģistrs</p></h1>
<link rel="icon" type="image/x-icon" href="https://cdn.discordapp.com/attachments/691041380688068648/941031040095490068/company.png">
<table>
    <thead>
        <th>
            Company Name
        </th>
        <th>
            Registration Number
        </th>
        <th>
            ID
        </th>
    </thead>
    <?php foreach ($results["result"]->records as $r): ?>
        <tr>
            <td>
                <?php echo $r->name . "<br>" ?>
            </td>
            <td>
                <?php echo $r->regcode . "<br>" ?>
            </td>
            <td>
                <?php echo $r->type . "<br>" ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<br>
<form method="get" action="/">
    <?php if($offset > 0): ?>
    <button class="button1" type="submit" name="offset" value="<?php echo $offset - $limit; ?>"><p1>Previous</p1></button>
    <?php endif; ?>

    <?php if(count($results["result"]->records) >= $limit): ?>
    <button class="button2" type="submit" name="offset" value="<?php echo $offset + $limit; ?>"><p1>Next</p1></button>
    <?php endif; ?>
</form>
</body>
</html>

