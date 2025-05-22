<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Naujas kontaktas</title>
</head>
<body>
    <h2>Gautas naujas kontaktas:</h2>
    <ul>
        <li><strong>Vardas:</strong> {{ $data['name'] }}</li>
        <li><strong>El. paštas:</strong> {{ $data['email'] }}</li>
        <li><strong>Telefonas:</strong> {{ $data['phone'] }}</li>
    </ul>
</body>
</html>
