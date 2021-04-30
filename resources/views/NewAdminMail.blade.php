<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin baru</title>
</head>
<body>
    <h2>Hai, {{ $personData['nama'] }}</h2>
    <p>
        Email ini telah terdaftar sebagai {{ $personData['$role'] }}.
        <br>
        Kata sandimu adalah
        <br><br>
        {{ $personData['password'] }}
        <br><br>
        Segera login dan ubah kata sandimu melalui menu Pengaturan.
    </p>
</body>
</html>