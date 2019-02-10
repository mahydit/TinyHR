<?php
class Admin
{
    public function __construct()
    {}

    public function get_all_members()
    {
        $handler = new MYSQLHandler(__USER_TABLE__);
        $data = $handler->search('isAdmin', 0);
        return $data;
    }

    public function search_member($name)
    {
        $handler = new MYSQLHandler(__USER_TABLE__);
        $data = $handler->search('name', trim($name));
        return $data;
    }

    public function get_member_information($index)
    {
        $handler = new MYSQLHandler(__USER_TABLE__);
        $data = $handler->get_record_by_id($index, __PRIMARY_KEY__);
        return $data;
    }

    public function get_online()
    {
        $handler = new MYSQLHandler(__USER_TABLE__);
        $data = $handler->search('is_online', 1);
        return $data;
    }

    public function export_excel()
    {
        ob_start();
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

    }

}
