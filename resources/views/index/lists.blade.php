
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
</head>
<body>

    <table>
        @foreach($data as $v)
        <tr>
            <td>{{$v->name}}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>