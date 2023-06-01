<?php
session_start();

$medicalTest = null;
$response = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['medical_test'])) {
    $medicalTest = $_POST['medical_test'];

    // Tutaj można skonfigurować połączenie z ChatGPT API i uzyskać wskazówki dla badania medycznego

    // Symulowane odpowiedzi od ChatGPT
    $simulated_responses = [
        'Badanie krwi' => '<ul>
                            <li>W przypadku badań krwi na czczo, nie jedz ani nie pij przez 8-12 godzin przed pobraniem próbki krwi.</li>
                            <li>Przed badaniem unikaj nadmiernej aktywności fizycznej, stresu lub palenia papierosów, które mogą wpływać na wyniki.</li>
                            <li>Jeśli bierzesz jakiekolwiek leki, skonsultuj się z lekarzem, czy powinieneś je zażywać przed badaniem.</li>
                        </ul>',
        'MRI' => '<ul>
                    <li>Przed badaniem MRI, powinniście unikać noszenia biżuterii lub innych metalowych przedmiotów, które mogą wpłynąć na wyniki badania.</li>
                    <li>Jeśli stosujesz jakiekolwiek urządzenia medyczne, takie jak protezy, stenty lub implanty, powinieneś poinformować o tym lekarza przed badaniem.</li>
                    <li>Zwykle nie jest wymagane specjalne przygotowanie, ale lekarz może Cię poinstruować inaczej.</li>
                </ul>',
        'Kolposkopia' => '<ul>
                            <li>Przed kolposkopią, powinnaś unikać stosowania tamponów, kremów dopochwowych, stosunków płciowych oraz douching na 24 godziny przed badaniem.</li>
                            <li>Nie powinnaś też umawiać kolposkopii na czas menstruacji.</li>
                            <li>Jeśli masz jakieś pytania lub obawy, skonsultuj się z lekarzem przed badaniem.</li>
                         </ul>',
        'Mammografia' => '<ul>
                        <li>Unikaj stosowania dezodorantów, kremów, balsamów lub talku w okolicy piersi i pach.</li>
                        <li>Nie nosź biżuterii ani innych metalowych przedmiotów w okolicy klatki piersiowej podczas badania.</li>
                        <li>Jeśli jesteś w ciąży lub podejrzewasz, że jesteś w ciąży, poinformuj o tym technika wykonującego badanie.</li>
                    </ul>',
        'EKG' =>    '<ul>
                        <li>Przygotuj się, zapewniając dostęp do skóry na klatce piersiowej, brzuchu i kończynach.</li>
                        <li>Wyeliminuj stosowanie kosmetyków na te obszary, takich jak kremy, olejki lub lotiony.</li>
                        <li>Zdejmij biżuterię i metalowe przedmioty, które mogą wpływać na odczyty EKG.</li>
                    </ul>',
        'Gastroskopia' => '<ul>
                            <li>Przed badaniem na 6 godzin przed nie jedz ani nie pij.</li>
                            <li>Unikaj stosowania leków, które mogą wpływać na wyniki badania, chyba że lekarz inaczej zalecił.</li>
                            <li>Na czas badania zorganizuj osobę, która Cię odwiezie, ponieważ mogą wystąpić efekty uboczne po zastosowaniu znieczulenia.</li>
                        </ul>',
        'Spirometria' => '<ul>
                            <li>Nie jedz ciężkiego posiłku ani nie pij kofeiny na co najmniej dwie godziny przed badaniem.</li>
                            <li>Unikaj używania leków rozszerzających oskrzela, chyba że lekarz inaczej zalecił.</li>
                            <li>Przed badaniem nie pal papierosów przez co najmniej godzinę.</li>
                        </ul>',
        'Densytometria' => '<ul>
                        <li>Unikaj suplementów wapnia, witaminy D i innych leków na kilka dni przed badaniem, chyba że lekarz zalecił inaczej.</li>
                        <li>W dniu badania nie nosź ubrań z metalowymi elementami, które mogą wpływać na wyniki.</li>
                        <li>Skonsultuj się z lekarzem w przypadku stosowania leków, które mogą wpływać na wyniki badania.</li>
                    </ul>'
    ];

    if (array_key_exists($medicalTest, $simulated_responses)) {
        $response = $simulated_responses[$medicalTest];
        $_SESSION['medical_test'] = $medicalTest; // Zapisanie wybranego badania do sesji
    }
} elseif (isset($_SESSION['medical_test'])) {
    $medicalTest = $_SESSION['medical_test'];
    $response = $simulated_responses[$medicalTest];
}

// Usunięcie zapisanego badania po odświeżeniu strony
if (!isset($_POST['medical_test']) && !isset($_SESSION['medical_test'])) {
    unset($_SESSION['medical_test']);
    $medicalTest = null;
    $response = '';
}


?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical guide</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#show_tips').on('click', function() {
                var medicalTest = $('#medical_test').val();
                $.ajax({
                    url: 'medical_tests_guide.php',
                    type: 'post',
                    data: { medical_test: medicalTest },
                    success: function(response) {
                        $('#test_preparation').html(response);
                    }
                });
            });
        });
    </script> -->
    <!-- <script>
        $(document).ready(function() {
            $('#show_tips').on('click', function() {
                $('.medical_tips').classList.toggle('show');
            });
        });
    </script> -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="header">
        <h1 class="header_title">Telemedi - zadanie techniczne</h1>
    </header>
    <section class="app">
        <div class="wrapper">
            <div class="app_box">
                <div class="app_box--top">
                    <h2 class="app_title">Przewodnik przygotowania do badań medycznych</h2>
                </div>

                <form method="post" action="index.php">
                    <label for="medical_test" class="app_label">Jakie badanie musisz wykonać?</label>
                    <select name="medical_test" id="medical_test" class="app_options">
                        <option value="">- wybierz badanie -</option>
                        <option value="Badanie krwi">Badanie krwi (pełna morfologia)</option>
                        <option value="MRI">MRI (Rezonans magnetyczny)</option>
                        <option value="Kolposkopia">Kolposkopia</option>
                        <option value="Mammografia">Mammografia</option>
                        <option value="EKG">EKG</option>
                        <option value="Gastroskopia">Gastroskopia</option>
                        <option value="Spirometria">Spirometria</option>
                        <option value="Densytometria">Badanie densytometryczne (DXA)</option>


                    </select>
                    <button class="button" id="show_tips" type="submit">Pokaż zalecenia</button>
                </form>
                <?php if ($medicalTest && $response) : ?>
                    <h3 class="medical_tips--title">Zalecenia: <?php echo $medicalTest; ?></h3>
                    <div class="medical_tips"><?php echo $response; ?></div>
                <?php elseif ($medicalTest && !$response) : ?>
                    <p>Nie znaleziono wskazówek dla wybranego badania.</p>
                <?php endif; ?>

                <?php unset($_SESSION['medical_test']); // Usunięcie zapisanego badania po odswiezeniu 
                ?>


                <!-- <div id="test_preparation"></div> -->
            </div>
        </div>
        <img src="img/heart-solid.svg" class="icon icon-heart" alt="">
        <img src="img/star-of-life-solid.svg" class="icon icon-star" alt="">
        <img src="img/stethoscope-solid.svg" class="icon icon-stethoscope" alt="">
        <img src="img/vial-solid.svg" class="icon icon-vial" alt="">
    </section>
    <footer class="footer">
        <p class="footer_text">&copy Piotr Niewiński</p>
    </footer>



</body>

</html>