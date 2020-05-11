<?php
require_once('functions.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fence Challenge</title>
</head>
<body>
<h1>Posts and Railings Challenge</h1>
<form action="." method="post">
    Fence Length (m): <input type="text" inputmode="decimal" pattern="[0-9.]*" name="fenceLengthInput"><br>
    Fence Length must be longer or equal to the length of 2 posts and 1 rail combined.
    <br><br> and/or <br> <br>
    Number of posts: <input type="text" inputmode="numeric" pattern="[0-9]*" name="postsInput" placeholder="Must be at least 2"><br>
    Number of rails: <input type="text" inputmode="numeric" pattern="[0-9]*" name="railsInput" placeholder="Must be at least 1"><br>
    <input type="submit">
    <p>Optional:</p>
    Post unit width: (m): <input type="text" inputmode="decimal" pattern="[0-9.]*" name="postUnitLength" placeholder="Default: 0.1m"><br>
    Rail unit length (m): <input type="text" inputmode="decimal" pattern="[0-9.]*" name="railUnitLength" placeholder="Default: 1.5m"><br>
</form>

</body>
</html>
<?php

if (empty($_POST['fenceLengthInput']) &&
(empty($_POST['railsInput']) || empty($_POST['postsInput']))){
    echo '<br> Please fill out information above';
    exit;
} elseif ((!is_numeric($_POST['fenceLengthInput'])) &&
(!is_numeric($_POST['railsInput'])) &&
(!is_numeric($_POST['postsInput'])) &&
(!is_numeric($_POST['railUnitLength'])) &&
(!is_numeric($_POST['postUnitLength']))) {
    echo '<br> What sneaky shit you tryin\'?! Only input numbers!! how hard is it???';
    exit;
} else {
    $fenceLengthInput = (float)$_POST['fenceLengthInput'];
    $fenceLengthInput = number_format($fenceLengthInput, 2, '.', '');

    $railsInput = (int)$_POST['railsInput'];
    $postsInput = (int)$_POST['postsInput'];
}

if ((!empty($_POST['railUnitLength'])) && (!empty($_POST['postUnitLength']))) {
    if ((($_POST['railUnitLength']) > 0) && (($_POST['postUnitLength']) > 0)) {
        $railUnitLength = (float)$_POST['railUnitLength'];
        $postUnitLength = (float)$_POST['postUnitLength'];
    } else {
        echo "<img src='https://i.giphy.com/media/l3q2K5jinAlChoCLS/200w.webp' alt='//////////DUMBASS ALERT/////////'> ";
        exit;
    }
} else {
    $railUnitLength = 1.5;
    $postUnitLength = 0.1;
}


if (minFenceLengthCheck($fenceLengthInput, $railUnitLength, $postUnitLength) || minQuantityCheck($railsInput, $postsInput))
{
    echo '<br> ======================================<br>Result: <br><br>';
    if (minQuantityCheck($railsInput, $postsInput))
    {
        if (($postsInput) > ($railsInput + 1))
        {
            $fenceLengthResult = fenceLengthCalc($railsInput, $railUnitLength, $postUnitLength);
            $postsWasted = ($postsInput) - (1 + $railsInput);
            echo 'Resulting fence length based on ' . $railsInput . ' rails and ' . $postsInput . ' posts is : ' .
                $fenceLengthResult . 'm' . "<br>" . $postsWasted .
                ' post(s) were not used due to a limiting amount of rails.' . "<br>";
        } elseif (($postsInput) < ($railsInput + 1))
        {
            $fenceLengthResult = fenceLengthCalc($postsInput - 1, $railUnitLength, $postUnitLength);
            $railsWasted = $railsInput - ($postsInput - 1);
            echo 'Resulting fence length based on ' . $railsInput . ' rails and ' . $postsInput . ' posts is : ' .
                $fenceLengthResult . 'm' . "<br>" . $railsWasted .
                ' rail(s) were not used due to a limiting amount of posts.' . "<br>";
        } else
            {
            $fenceLengthResult = fenceLengthCalc($railsInput, $railUnitLength, $postUnitLength);
            echo 'Resulting fence length based on ' . $railsInput . ' rails and ' . $postsInput . ' posts is : ' .
                $fenceLengthResult . 'm' . "<br>";
        }
    }
    if (minFenceLengthCheck($fenceLengthInput, $railUnitLength, $postUnitLength))
    {
        $railsRequired = pairsRequiredCalcDown($fenceLengthInput, $railUnitLength, $postUnitLength);
        $postsRequired = $railsRequired + 1;
        if ((fenceLengthCalc($railsRequired, $railUnitLength, $postUnitLength)) < $fenceLengthInput)
        {
            $railsRequired = pairsRequiredCalcUp($fenceLengthInput, $railUnitLength, $postUnitLength);
            $postsRequired = $railsRequired + 1;
            $fenceLengthResult = fenceLengthCalc($railsRequired, $railUnitLength, $postUnitLength);
        } else
            {
            $fenceLengthResult = fenceLengthCalc($railsRequired, $railUnitLength, $postUnitLength);
        }
        echo 'Number of rails and posts required based on a ' . $fenceLengthInput . 'm fence length are rails: ' . $railsRequired . ' and posts: ' . $postsRequired . " with a resulting length of: " . $fenceLengthResult . 'm' . "<br>";
    }
} else {
    echo "<br><a href='https://www.youtube.com/watch?v=UniPsEFWu3M'>Wow math is hard</a><br>" .
        'Minimum Fence Length must be at least: ' . (($postUnitLength * 2) + $railUnitLength) . 'm and minimum quantities must be at least 1 rail and 2 posts.';
    exit;
}
?>


