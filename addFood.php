<?
//cURL nutritionix for added food data

session_start();

$url1 = "localhost/NutritionAPI/api/foodById.php?id=";
$url2 = "&api_key=1";

$item_id = $_GET['id'];

$lookupURL = $url1 . $item_id . $url2;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $lookupURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

$food_info = curl_exec($ch);
curl_close($ch);

$food_info = json_decode(trim($food_info), true);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liftapp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$food_info = $food_info[0];

$sql = "INSERT INTO foods (name, calories, fat, carbs, protein, user) VALUES ('{$food_info['name']}', {$food_info['calories']}, {$food_info['fat']}, {$food_info['carbohydrate']}, {$food_info['protein']}, {$_SESSION['id']})";

if (mysqli_query($conn, $sql)) {
    $message = 'success';
} else {
    $message = 'failed';
}

$_SESSION['message'] = $message;

mysqli_close($conn);
header("Location: ./index.php");