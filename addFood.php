<?
//cURL nutritionix for added food data
$url1 = "https://api.nutritionix.com/v1_1/item?id=";
$url2 = "&appId=82868d5e&appKey=570ad5e7ef23f13c3e952eb71798b586";

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

$name = $food_info['item_name'];

$sql = "INSERT INTO foods (name, calories, fat, carbs, protein, user)
VALUES ('$name', {$food_info['nf_calories']}, {$food_info['nf_total_fat']}, {$food_info['nf_total_carbohydrate']}, {$food_info['nf_protein']}, 1)";

if (mysqli_query($conn, $sql)) {
    $message = 'success';
} else {
    $message = 'failed';

}

mysqli_close($conn);
header("Location: ./index.php");