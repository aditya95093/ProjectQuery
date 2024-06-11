<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .controls {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            width: 80%;
            max-width: 800px;
        }

        .controls input, .controls select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 48%;
        }

        .controls input:focus, .controls select:focus {
            outline: none;
            border-color: #009879;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        th, td {
            padding: 12px 15px;
        }

        tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            text-decoration: none;
        }

        .btn:hover {
            color: #fff;
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <h2>All Users</h2>
    <div class="controls">
        <input type="text" id="searchInput" placeholder="Search for names.." title="Type in a name">
        <select id="rowSelect">
            <option value="5">Show 5 rows</option>
            <option value="10">Show 10 rows</option>
            <option value="15">Show 15 rows</option>
            <option value="20">Show 20 rows</option>
            <option value="all">Show all rows</option>
        </select>
    </div>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>City</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody id="userTable">
            @foreach ($data as $id => $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->city }}</td>
                    <td><a href="{{ route('view.user', $user->id) }}" class="btn">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const rowSelect = document.getElementById('rowSelect');
            const table = document.getElementById('userTable');
            const rows = Array.from(table.getElementsByTagName('tr'));

            function filterTable() {
                const query = searchInput.value.toLowerCase();
                let rowCount = 0;
                const maxRows = rowSelect.value === 'all' ? rows.length : parseInt(rowSelect.value);

                rows.forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    const name = cells[1].textContent.toLowerCase();
                    const matches = name.indexOf(query) > -1;

                    if (matches && (rowCount < maxRows || rowSelect.value === 'all')) {
                        row.style.display = '';
                        rowCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
            rowSelect.addEventListener('change', filterTable);

            filterTable(); // Initial filter
        });
    </script>
</body>
</html>
