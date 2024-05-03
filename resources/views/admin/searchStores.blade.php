@extends('layouts.layoutforAdmin')
@section('content')

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background: white;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .user-box {
            margin-bottom: 20px;
            position: relative;
        }

        .user-box input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
        }

        .user-box label {
            position: absolute;
            top: -20px;
            left: 10px;
            color: #666;
            transition: all 0.3s;
        }

        .user-box input[type="text"]:focus {
            border-color: #0056b3;
        }

        button {
            padding: 10px 20px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #003580;
        }

        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            margin-top: 20px;
            border-radius: 4px;
        }

        .alert ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
    </style>


    @if(isset($id))

        <div class="form-container">
            <h2>Search Stores</h2>

            <form method="post" action="{{ route('searchStores', ['id' => $id]) }}">
                @csrf

                <div class="user-box">
                    <input type="text" id="name" name="name" required autocomplete="off">
                    <label for="name">Name:</label>
                </div>

                @if($errors->any())
                    <div class="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit">Search</button>
            </form>

            @if(isset($stores))
                <div class="table-container">
                    <table>
                        <thead>
                        <tr>
                            <th>Store Id</th>
                            <th>Store Name</th>
                            <th>Store Description</th>
                            <th>Activation</th>
                            <th>Owner Id</th>
                            <th>Edit Activation</th>
                            <th>Delete Store</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stores as $store)
                            <tr>
                                <td>{{ $store->store_id }}</td>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->description }}</td>
                                <td>{{ $store->approved ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $store->user_id }}</td>
                                <td><a href="{{ route('storeActivate', ['id' => $id, 'idStore' => $store->store_id]) }}">Edit Activation</a></td>
                                <td><a href="{{ route('deleteStore', ['id' => $id, 'idStore' => $store->store_id]) }}">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>

    @endif
@endsection
