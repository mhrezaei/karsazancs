<!DOCTYPE html>

<html lang="fa">

    <head>
        <meta charset="utf-8">
        <title>Upload</title>
        <style>
            html, body{
                height: 100%;
            }
            body{
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    </head>

    <body>

    {!! Form::open([
        'url'	=> '/hadi' ,
        'method'=> 'post',
        'name' => 'registerForm',
        'id' => 'registerForm',
        'enctype' => 'multipart/form-data'
    ]) !!}

    <input type="file" name="avatar">
    <button type="submit">save!</button>

    {!! Form::close() !!}

    </body>

</html>