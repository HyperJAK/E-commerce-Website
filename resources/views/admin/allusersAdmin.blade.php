@extends('layouts.layoutforAdmin')
@section('content')

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            width: 95%;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .table-container-buyer, .table-container-sellers {
            margin-bottom: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        caption {
            caption-side: top;
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>



    @if(isset($id))

        <div class="form-container">
            <h2>All Users</h2>

            <div class="table-container-buyer" id="div1">
                <table>
                    <caption>Buyers</caption>
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    @foreach($buyers as $buyer)
                        <tbody>
                        <tr>
                            <td>{{ $buyer->username }}</td>
                            <td>{{ $buyer->email }}</td>
                            <td>{{ $buyer->address }}</td>
                            <td>{{ $buyer->phone }}</td>
                            <td><a href="{{ route('updateUser', ['id' => $id, 'idUser' => $buyer->user_id]) }}">Update</a></td>
                            <td><a href="{{ route('deleteUser', ['id' => $id, 'idUser' => $buyer->user_id]) }}">Delete</a></td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>

            <div class="table-container-sellers" id="div2">
                <table>
                    <caption>Sellers</caption>
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    @foreach($sellers as $seller)
                        <tbody>
                        <tr>

                            <td>{{ $seller->username }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->address }}</td>
                            <td>{{ $seller->phone }}</td>
                            <td><a href="{{ route('updateUser', ['id' => $id, 'idUser' => $seller->user_id]) }}">Update</a></td>
                            <td><a href="{{ route('deleteUser', ['id' => $id, 'idUser' => $seller->user_id]) }}">Delete</a></td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>

    @endif
@endsection
