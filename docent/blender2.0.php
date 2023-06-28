<?php
$conn = new mysqli("localhost", "kartel", "bremankartel", "kartel");
$pull = $conn->query("SELECT * FROM leerling");
$students_array = [];
$teller = 0;
while ($row = $pull->fetch_assoc()) {
    ++$teller;
    array_unshift($students_array, $row["naam"]);
}
$counter = 0;
foreach ($students_array as $l) {++$counter;}//Get amount of ppl in class
$g = 5;
echo $g . "<br><br>";
shuffle($students_array);

$class_groups = $g;
$groups = [];

foreach ($students_array as $key => $student) {

    $assigned_group = $key % $class_groups;
    $groups[$assigned_group][] = $student;
}
//Mae an array with kids that stay off grid
$restArr = [];
foreach ($students_array as $leerling) {
    $check = 0;
    foreach ($groups as $ll) {
        if ($leerling == $ll) {
            $check = 1;
        }
    }
    if ($check == 1) {
        $check = 0;
        array_unshift($restArr, $leerling);
    }
}
for ($i = 0; $i < $g; $i++) {
    foreach ($groups as $groep) {
        echo $groep[$i] . " ";
    }
    echo "<br><br>";
}
echo "<br><br>";
echo "Aantal leerlingen in totaal: " . $teller . "<br><br>";
print_r($restArr);
?>