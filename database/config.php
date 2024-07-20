<?php
// index.php

// Database configuration
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);
define('DB_NAME', $_ENV['DB_NAME']);

// Function to establish database connection
function getDbConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Function to create database if it doesn't exist
function createDatabaseIfNeeded() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $dbname = DB_NAME;
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    
    if ($conn->query($sql) == TRUE) {
    
    } else {
        die("Error creating database: " . $conn->error);
    }
    
    $conn->close();
}

// Function to execute SQL file
function executeSqlFile($file) {
    $conn = getDbConnection();
    
    // Read SQL file
    $sql = file_get_contents($file);

    // Execute multi-query (assuming the file has multiple queries)
    if ($conn->multi_query($sql)) {
        echo "SQL file '$file' imported successfully.<br>";
    } else {
        echo "Error importing SQL file '$file': " . $conn->error . "<br>";
    }

    // Close connection after execution
    $conn->close();
}

// // Check and create database
createDatabaseIfNeeded();

// // Import schema.sql and data.sql from the sql/ directory
// executeSqlFile(__DIR__ . '/sql/schema.sql');
// executeSqlFile(__DIR__ . '/sql/data.sql');

// // Additional application logic can go here


