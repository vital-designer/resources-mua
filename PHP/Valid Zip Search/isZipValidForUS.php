<?php

if($_GET['zip'])
{
    if(!($fp = fsockopen('zip4.usps.com', 80, $errno, $errstr)))
        echo 'Could not connect to USPS! Error number: ' . $errno . '(' . $errstr . ')';

    else
    {
        $poststring =

            "GET /zip4/zcl_3_results.jsp?zip5=" . $_GET['zip'] . " HTTP/1.0\r\n" .
            "Connection: close\r\n\r\n";

        fputs($fp, $poststring);

        $buffer = '';

        while(!feof($fp))
            $buffer .= fgets($fp, 128);

        fclose($fp);

        preg_match('/Actual City name(.*)/s', $buffer, $match);

        $temp = explode('Not Acceptable', $match[1]);

        // Capture city/state combination for all valid cities

        preg_match_all('/headers="pre">(?:<b>)?([\w|\s]+), (\w+)/', $temp[0], $acceptable, PREG_SET_ORDER);

        $values = array();

        foreach($acceptable as $value)

            $values[] =

                array
                (
                    'city' => $value[1],
                    'state' => $value[2]
                );

        if(count($values) == 0)
            echo 'Zip could not be found in the database!';
		else
			print_r($values);
    }
}
else
    echo 'Please specify a zip!';

?>



