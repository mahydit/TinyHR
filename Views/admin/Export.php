<?php
defined("_ALLOW_ACCESS") or die ("Access not allowed.");
$handler = new MYSQLHandler(__USER_TABLE__);
$productResult = $handler->data_to_export('isAdmin', 0);
$filename = "Export_excel.xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
$isPrintHeader = false;
if (!empty($productResult)) {
    foreach ($productResult as $row) {
        if (!$isPrintHeader) {
            echo implode("\t", array_keys($row)) . "\n";
            $isPrintHeader = true;
        }
        echo implode("\t", array_values($row)) . "\n";
    }
}
exit();
?>
