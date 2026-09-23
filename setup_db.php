<?php
require_once 'config/database.php';

try {
    // Read and execute database.sql
    echo "Importing database schema...<br>";
    $sql = file_get_contents('database.sql');
    $pdo->exec($sql);
    echo "Schema imported successfully.<br><br>";

    // Read and execute seed.sql
    echo "Importing dummy data...<br>";
    $seed = file_get_contents('database/seed.sql');
    $pdo->exec($seed);
    echo "Dummy data imported successfully.<br><br>";

    echo "<b>Database Setup Complete!</b> <a href='index.php'>Go to Home</a>";
    
    // Self destruct (optional)
    // unlink(__FILE__);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
