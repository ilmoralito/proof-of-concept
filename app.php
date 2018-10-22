<?php

function loadDataset()
{
    $string = file_get_contents('./dataset.json');
    $dataset = json_decode($string, true);

    return $dataset;
}

function filter($startDate, $endDate)
{
    $dataset = loadDataset();

    $result = array_filter($dataset, function($data) use ($startDate, $endDate) {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        return strtotime($data['startDate']) >= $startDate && strtotime($data['endDate']) <= $endDate;
    });

    return $result;
}

$json = filter($_GET['startDate'], $_GET['endDate']);

header('Content-type: application/json');
echo json_encode($json);