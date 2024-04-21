<?php
header('Content-Type: application/json');  // To indicate that the returned data is JSON formatted

$host = "localhost";
$dbname = "rrlpsyjk_faster";
$username = "rrlpsyjk_faster";
$password = "Theway_2500";

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['tracking_number'])) {
        $tracking_number = $_POST['tracking_number'];

        $query = "SELECT * FROM PackageTracker WHERE tracking_number = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$tracking_number]);

        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            $details = "";  // Format this as per your requirements
            foreach ($record as $key => $value) {
                $details .= "<strong>" . ucfirst($key) . ":</strong> " . htmlspecialchars($value) . "<br>";
            }
            echo json_encode(['success' => true, 'details' => $details]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
}
?>
