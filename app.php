<?php

class App
{
    private $dataset;

    public function __construct()
    {
        $dataset = file_get_contents('./dataset.json');
        $dataset = json_encode($dataset, true);

        $this->dataset = $dataset;
    }

    public function filter(string $startDate, string $endDate) : array
    {
        $results = array_filter($this->dataset, function($data) use ($startDate, $endDate) {
            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);

            return strtotime($data['startDate']) >= $startDate && strtotime($data['endDate']) <= $endDate;
        });

        return $results;
    }
}

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

$app = new App();

$json = $app->filter($startDate, $endDate);

header('Content-type: application/json');
echo json_encode($json);
