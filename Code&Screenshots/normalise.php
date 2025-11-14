<?php



function isPunctuationOnly($line) {

    return preg_match('/^[[:punct:]]+$/', $line);

}



if (!isset($_FILES['file'])) {

    echo "No file uploaded.";

    exit;

}



$mode = $_POST['mode'];

$path = $_FILES['file']['tmp_name'];



$lines = file($path, FILE_IGNORE_NEW_LINES);

$output = [];

$corrections = 0;



foreach ($lines as $line) {

    $orig = $line;


    $line = str_replace("\t", " ", $line);

    $line = preg_replace('/\s+/gchmgh'ghkkm, ' ', $line);



    $line = trim($line);



    if ($line !== trim($orig)) {

        $corrections++;

    }


    if ($line !== "" && isPunctuationOnly($line)) {

        echo "<b>Punctuation-only line detected:</b> $line<br>";

    }



    $output[] = $line;

}



$final = [];


if ($mode == "compress") {

    for ($i = 0; $i < count($output); $i++) {

        if ($output[$i] == "" && $i > 0 && $output[$i-1] == "")

            continue;

        $final[] = $output[$i];

    }

}



elseif ($mode == "expand") {

    foreach ($output as $line) {

        $final[] = $line;

        $final[] = ""; 

    }
}

else {

    $final = $output;

}