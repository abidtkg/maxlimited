<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Report</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: small
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header h2 {
            margin: 5px 0;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Max Speed</h1>
        <h2>Expense Report</h2>
        <p>Kaligong, Bangabondhu Hat, Jaldhaka Nilphamari</p>
        <p>Contact: +880 9639005330 - Website: www.maxspeed.net.bd</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Amount</th>
                <th>Note</th>
                <th>Date</th>
                <th>Person</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
            <tr>
                <td>{{ $expense->category->name }}</td>
                <td>{{ $expense->amount }}</td>
                <td>{{ $expense->note }}</td>
                <td>{{ date('d M Y h:i A', strtotime($expense->created_at)) }}</td>
                <td>{{ $expense->user->name }}</td>
            </tr>
            @endforeach
            <tr>
                <td>Total</td>
                <td>{{ $total_amount }}</td>
                <td colspan="3"></td>
            </tr>
        </tbody>
    </table>
    <div>
        <center style="margin-top: 75px; float: left">
            <div style="border-top: 2px solid black; width: 120px;"></div>
            <p style="width: 120px;">Approved By</p>
        </center>
    </div>
</body>
</html>