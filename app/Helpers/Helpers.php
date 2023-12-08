<?php


if (!function_exists('print_dd')) {
    /**
     * @param ...$variables
     * @return void
     */
    function print_dd(...$variables)
    {
        if (!request()->wantsJson()) {
            dd($variables);
        }
        $delimiter = "----------------\n";
        $i = 0;
        $total = count($variables);
        foreach ($variables as $var) {
            $i++;
            print_r($var);
            echo "\n";
            if ($i != $total && $total > 1) {
                echo $delimiter;
            }
        }
        exit();
    }

}
