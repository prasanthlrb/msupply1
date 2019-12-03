<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$posts['title']}}</title>
</head>
<body>
    <div class="container">
    <h1>{{$posts['title']}}</h1>
    <div class="image-box">
    <img src="/post_image/{{$posts['image']}}" alt="">
    
    </div>
    <div class="content">
    <p>{{$posts['content']}}</p>
    </div>
    </div>
</body>
</html>