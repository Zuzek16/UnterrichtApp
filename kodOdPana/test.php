<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    $nauczyciele = [
        'A' => [
            [123, 'Imię Nazwisko 1'],
            [124, 'Imię Nazwisko 2'],
            [125, 'Imię Nazwisko 3'],
        ],
        'B' => [
            [223, 'Imię Nazwisko 4'],
            [224, 'Imię Nazwisko 5'],
            [125, 'Imię Nazwisko 3'],
        ],
    ];
    ?>
    <script>
        var nauczyciele = <?php echo json_encode($nauczyciele); ?>;
        console.log(nauczyciele);
    </script>
</head>

<body>
    <form action="#" method="POST">
        <table border="1">
            <tr>
                <th>PON</th>
                <th>WTO</th>
            </tr>
            <tr>
                <td>
                    <select name="pon[0][przedmiot]">
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                    <select name="pon[0][nauczyciel]" class="nauczyciel"></select>
                </td>
                <td>
                    <select name="wto[0][przedmiot]">
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                    <select name="wto[0][nauczyciel]" class="nauczyciel"></select>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="pon[1][przedmiot]">
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                    <select name="pon[1][nauczyciel]" class="nauczyciel"></select>
                </td>
                <td>
                    <select name="wto[1][przedmiot]">
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                    <select name="wto[1][nauczyciel]" class="nauczyciel"></select>
                </td>
            </tr>
        </table>
        <button type="submit">Wyślij</button>
    </form>
    <pre><?php var_dump($_POST); ?></pre>
    <script>
        let select = document.querySelectorAll("select");

        select.forEach(function(el) {
            el.addEventListener('change', function() {
                let form = '';
                nauczyciele[el.value].forEach(function(el) {
                    form += `<option value="${el[0]}">${el[1]}</option>`;
                });

                el.parentElement.querySelector('.nauczyciel').innerHTML = form;
            })
        })
    </script>
</body>

</html>