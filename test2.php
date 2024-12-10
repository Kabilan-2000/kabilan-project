<?php
// JSON data from your JavaScript object
$jsonData = '{
    "success": true,
    "data": {
        "name": "SOS Bags",
        "webproduct_id": 104,
        "store_code": "shopify",
        "type": "upload_personalization_configuration",
        "product_type": "upload_personalization_configuration",
        "quantity": "100",
        "options": { },
        "productparts": [
            {
                "code": "pp_sos_bags",
                "label": "SOS Bags",
                "page_options": {
                    "paper": {
                        "label": "Material",
                        "default_value": ["paper_kraft_kraft"],
                        "type": "single",
                        "values": [
                            { "label": "White Paper", "value": "paper_white_white", "attributes": { "weight": "115 g/m2", "packing_value": "0.06", "packing_paper_color": "rgb(255,255,255)" } },
                            { "label": "Kraft Paper", "value": "paper_kraft_kraft", "attributes": { "weight": "115 g/m2", "packing_value": "0.06", "packing_paper_color": "rgb(255,255,255)" } }
                        ]
                    },
                    "format": {
                        "label": "Capacity",
                        "default_value": ["sos_bags_2_lb"],
                        "type": "single",
                        "values": [
                            { "label": "2 lb - 2.36\" x 8.66\"", "value": "sos_bags_2_lb", "attributes": { "height": "8.66", "width": "2.36" } },
                            { "label": "4 lb - 3.15\" x 9.45\"", "value": "sos_bags_4_lb", "attributes": { "height": "9.45", "width": "3.16" } },
                            { "label": "6 lb - 3.54\" x 10.63\"", "value": "sos_bags_6_lb", "attributes": { "height": "10.63", "width": "3.54" } },
                            { "label": "8 lb - 4\" x 11.8\"", "value": "sos_bags_8_lb", "attributes": { "height": "11.8", "width": "4.01" } }
                        ]
                    }
                }
            }
        ]
    }
}';

// Decode JSON to PHP associative array
$data = json_decode($jsonData, true);

// Extract productparts
$productParts = $data['data']['productparts'];

echo "<table border='1' cellspacing='0' cellpadding='5'>";
echo "<tr><th>Option</th><th>Label</th><th>Values</th></tr>";

// Loop through product parts and display page options
    foreach ($productParts as $part) {
    foreach ($part['page_options'] as $optionKey => $option) {
        echo "<tr>";
        echo "<td>{$optionKey}</td>";
        echo "<td>{$option['label']}</td>";
        echo "<td>";
        foreach ($option['values'] as $value) {
            echo $value['label'] . "<br>";
        }
        echo "</td>";
        echo "</tr>";
    }
}

echo "</table>";
?>


