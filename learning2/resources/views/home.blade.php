<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>This is home page. {{!! $topic !!}}</h1>
    <h2>The current timestamp is {{ now() }}</h2>
    <x-alert slot="This message is passed from a variable"></x-alert>
</body>
</html>