#_____ DAVLOPER  : KALYAN KING ✔️

#_____ TELIGERM : KGF CYBER TEAM 🎉

#____ LINK : https://t.me/+DzGy2e840RJiOGZl

<?php

$phone_number = isset($_GET['phone']) ? $_GET['phone'] : '';

if (empty($phone_number)) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Phone number is required."], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

$cookieFile = tempnam(sys_get_temp_dir(), 'cookie');

$ch = curl_init("https://paksim.info/search.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_exec($ch);
curl_close($ch);

$ch = curl_init("https://paksim.info/sim-database-online-2022-result.php");
$postFields = http_build_query([
    'cnnum' => $phone_number
]);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postFields,
    CURLOPT_HTTPHEADER => [
        "User-Agent: Mozilla/5.0 (Linux; Android 14; 23053RN02A Build/UP1A.231005.007) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.7103.125 Mobile Safari/537.36",
        "Referer: https://paksim.info/search.php",
        "X-Requested-With: XMLHttpRequest"
    ],
    CURLOPT_COOKIEFILE => $cookieFile
]);

$response = curl_exec($ch);
curl_close($ch);
unlink($cookieFile);

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($response);
libxml_clear_errors();

$xpath = new DOMXPath($dom);
$rows = $xpath->query('//tr');

$data = [];
foreach ($rows as $row) {
    $cells = $row->getElementsByTagName('td');
    if ($cells->length == 2) {
        $key = strtolower(trim($cells->item(0)->nodeValue));
        $value = trim($cells->item(1)->nodeValue);
        $data[$key] = $value;
    }
}

$second_response_data = [
    "mobile" => $data["mobileno"] ?? "",
    "name" => $data["name"] ?? "",
    "cnic" => $data["cnic"] ?? "",
    "address" => $data["address"] ?? "",
    "operator" => $data["operator"] ?? "",
    "Telegram" => "KGF CYBER TEAM",
    "Developer" => "KALYAN KING"
];

header('Content-Type: application/json');
echo json_encode($second_response_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>