<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Program koncertů</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Program Koncertů</h1>
        <nav>
            <a href="historie.php">Historie</a>
            <a href="administrace.php">Administrace</a>
        </nav>
    </header>
    <main>
        <?php
        include_once("koncerty.class.php");
        $koncerty = new Koncerty();

        // Získání aktuálního a příštího roku
        $aktualniRok = date("Y");
        $pristiRok = $aktualniRok + 1;

        // Koncerty pro aktuální rok
        echo "<h2>Koncerty v roce $aktualniRok</h2>";
        $koncerty2024 = $koncerty->vratBudouciKoncertyPodleRoku($aktualniRok);
        if (!empty($koncerty2024)) {
            echo "<table>";
            echo "<thead><tr><th>Datum</th><th>Čas</th><th>Místo</th><th>Poznámka</th></tr></thead>";
            echo "<tbody>";
            foreach ($koncerty2024 as $udalost) {
                echo "<tr>";
                echo "<td>{$udalost->datum}</td>";
                echo "<td>{$udalost->cas}</td>";
                echo "<td>{$udalost->kde}</td>";
                echo "<td>{$udalost->poznamka}</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>Žádné koncerty pro tento rok.</p>";
        }

        // Koncerty pro příští rok
        echo "<h2>Koncerty v roce $pristiRok</h2>";
        $koncerty2025 = $koncerty->vratBudouciKoncertyPodleRoku($pristiRok);
        if (!empty($koncerty2025)) {
            echo "<table>";
            echo "<thead><tr><th>Datum</th><th>Čas</th><th>Místo</th><th>Poznámka</th></tr></thead>";
            echo "<tbody>";
            foreach ($koncerty2025 as $udalost) {
                echo "<tr>";
                echo "<td>{$udalost->datum}</td>";
                echo "<td>{$udalost->cas}</td>";
                echo "<td>{$udalost->kde}</td>";
                echo "<td>{$udalost->poznamka}</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>Žádné koncerty pro příští rok.</p>";
        }
        ?>
    </main>
    <footer>
        <p>
            Sledujte nás:
            <a href="https://instagram.com/okeanelzy" target="_blank">Instagram</a> |
            <a href="https://youtube.com/user/okeanelzyofficial" target="_blank">YouTube</a>
        </p>
        <p>Stránku vytvořila Štěpa Mariya</p>
    </footer>
</body>
</html>
