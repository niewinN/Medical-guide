<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </script>
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

                <form action="medical_tests_guide.php" method="post"></form>
                <label for="medical_test" class="app_label">Jakie badanie musisz wykonać?</label>
                <select name="medical_test" id="medical_test" class="app_options">
                    <option value="">- wybierz badanie -</option>
                    <option value="Kew">Badanie krwi</option>
                    <option value="MRI">MRI (Rezonans magnetyczny)</option>
                    <option value="Kolposkopia">Kolposkopia</option>
                    <option value="Mammografia">Mammografia</option>
                    <option value="EKG">EKG</option>
                    <option value="Gastroskopia">Gastroskopia</option>
                    <option value="Spirometria">Spirometria</option>
                    <option value="Densytometria">Densytometria</option>


                </select>
                <button class="button" id="show_tips" type="submit">Pokaż zalecenia</button>
                <!-- <p class="app_text">*Pamiętaj, że są to ogólne wskazówki i zawsze powinno się kierować konkretnymi
                    instrukcjami lekarza lub personelu medycznego, który zna najbardziej aktualne i dokładne informacje
                    dotyczące przygotowania do konkretnego badania.</p> -->
                <div id="test_preparation"></div>
            </div>
        </div>
    </section>
    <!-- <form action="medical_tests_guide.php" method="post">
        <label for="medical_test">Wybierz badanie:</label>
        <select id="medical_test" name="medical_test">
            <option value="MRI">MRI</option>
            <option value="USG">USG</option>
            <option value="Kolposkopia">Kolposkopia</option>
            < Dodaj więcej badań według potrzeb -->
    <!-- </select>
    <button type="submit">Pokaż wskazówki dotyczące przygotowania</button>
    </form> -->
</body>

</html>