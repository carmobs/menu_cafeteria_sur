<?php
// This is a utility file to check if images exist in the expected paths

$imageBase = __DIR__ . '/assets/imagenes categorias/';

$images = [
    'jugos y licuados.jpg',
    'bebidas.jpg',
    'BOWLS.jpeg',
    'ensaladas.jpeg',
    'tacos.webp',
    'baguettes.jpg',
    'tortas.jpg',
    'hamburguesa.jpeg',
    'sandwich.jpg',
    'Molletes.jpeg',
    'quesadillas.jpeg',
    'desayuno del dia.jpeg',
    'menu del dia.jpeg'
];

echo "<h1>Image Path Check</h1>";
echo "<p>Base Path: " . $imageBase . "</p>";
echo "<ul>";

foreach ($images as $image) {
    $fullPath = $imageBase . $image;
    if (file_exists($fullPath)) {
        echo "<li style='color:green'>✓ " . htmlspecialchars($image) . " exists</li>";
    } else {
        echo "<li style='color:red'>✗ " . htmlspecialchars($image) . " does NOT exist</li>";
        // Check if there's a case sensitivity issue
        $files = scandir(dirname($fullPath));
        $potentialMatches = array_filter($files, function($file) use ($image) {
            return strtolower($file) === strtolower($image);
        });
        if (!empty($potentialMatches)) {
            echo "<ul>";
            foreach ($potentialMatches as $match) {
                echo "<li style='color:orange'>→ Found similar: " . htmlspecialchars($match) . "</li>";
            }
            echo "</ul>";
        }
    }
}

echo "</ul>";
?>
