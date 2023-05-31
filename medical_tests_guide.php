<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medical_test = $_POST['medical_test'];
}

// Symulacja odpowiedzi od ChatGPT
$simulated_responses = [
    'MRI' => 'Przed badaniem MRI, powinniście unikać noszenia biżuterii lub innych metalowych przedmiotów, które mogą wpłynąć na wyniki badania. Zwykle nie jest wymagane specjalne przygotowanie, ale lekarz może Cię poinstruować inaczej.',
    'USG' => 'Przed badaniem USG, mogą być wymagane różne formy przygotowania w zależności od tego, jaka część ciała ma być badana. Na przykład, przed badaniem USG brzucha, możesz być poproszony o pozostanie na czczo przez kilka godzin.',
    'Kolposkopia' => 'Przed kolposkopią, powinnaś unikać stosowania tamponów, kremów dopochwowych, stosunków płciowych oraz douching na 24 godziny przed badaniem. Nie powinnaś też umawiać kolposkopii na czas menstruacji.'
];

if (array_key_exists($medical_test, $simulated_responses)) {
    $response = $simulated_responses[$medical_test];
    echo "<h2>Wskazówki dla badania: $medical_test</h2>";
    echo "<p>$response</p>";
} else {
    echo "<p>Nie znaleziono wskazówek dla wybranego badania.</p>";
}

?>