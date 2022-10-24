<html>
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <style>
        body{
            font-family: arial, sans-serif;
            font-size: 15px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #c2c2c2;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #fff;
        }
    </style>

</head>

<body>
    <h2>Thông tin liên hệ từ khách hàng: </h2>
    <table style="font-size: 15px;">
        <tr>
            <td><b>Họ và tên</b>: </td>
            <td><?=htmlspecialchars($model->name)?></td>
        </tr>
        <tr>
            <td><b>Số điện thoại</b>: </td>
            <td><?=htmlspecialchars($model->phone)?></td>
        </tr>
        <tr>
            <td><b>Ngày chụp</b>: </td>
            <td><?=htmlspecialchars($model->photo_date)?></td>
        </tr>
        <tr>
            <td><b>Email</b>: </td>
            <td><?=htmlspecialchars($model->email)?></td>
        </tr>
        <tr>
            <td><b>Địa điểm chụp</b>: </td>
            <td><?=htmlspecialchars($model->place)?></td>
        </tr>
        <tr>
            <td><b>Gói chụp</b>: </td>
            <td><?=htmlspecialchars($model->pricing->title)?></td>
        </tr>
    </table>
    <hr>
    <h2>Nội dung liên hệ: </h2>
    <div style="font-size: 15px;"><?=nl2br($model->content)?></div>
</body>
</html>

