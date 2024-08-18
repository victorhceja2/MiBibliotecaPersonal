<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "db";
$username = "root";
$password = "innovacionMovil2024*";
$dbname = "biblioteca";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $genero = $_POST['genero'];
        $anio = $_POST['anio'];

        $stmt = $conn->prepare("INSERT INTO libros (titulo, autor, genero, anio) VALUES (:titulo, :autor, :genero, :anio)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':anio', $anio);
        $stmt->execute();
    }

    $stmt = $conn->prepare("SELECT * FROM libros");
    $stmt->execute();
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mi Biblioteca Personal</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Mis Libros</h1>

    <form method="post" action="">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br>
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required><br>
        <label for="genero">Género:</label>
        <input type="text" id="genero" name="genero" required><br>
        <label for="anio">Año:</label>
        <input type="number" id="anio" name="anio" required><br>
        <input type="submit" value="Agregar Libro">
    </form>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Género</th>
                <th>Año</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($libro['autor']); ?></td>
                    <td><?php echo htmlspecialchars($libro['genero']); ?></td>
                    <td><?php echo htmlspecialchars($libro['anio']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>