@extends('layouts.layoutforAdmin')
@section('content')

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .buttonContainer button {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .buttonContainer a {
            color: white;
            text-decoration: none;
        }

        .table-container {
            overflow-x: auto;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        .alert {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
            padding: 10px;
            margin-top: 20px;
        }

        .alert ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
    </style>


    @if(isset($id))
        <div class="form-container">
            <h2>Stores</h2>

            <div class="buttonContainer">
                <button><a href="{{ route('searchStores',['id'=>$id]) }}" id="searchBut">Search</a></button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>Store Id</th>
                        <th>Store Name</th>
                        <th>Store Description</th>
                        <th>Activation</th>
                        <th>Owner Id</th>
                        <th>Edit Status</th>
                        <th>Delete Store</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stores as $store)
                        <tr>
                            <td>{{$store->store_id}}</td>
                            <td>{{$store->name}}</td>
                            <td>{{$store->description}}</td>
                            <td>{{ $store->status ? 'Active' : 'Inactive' }}</td>
                            <td>{{$store->user_id}}</td>
                            <td><a href="{{route('storeActivate',['id'=>$id, 'idStore'=>$store->store_id])}}">Edit Activation</a></td>
                            <td><a href="{{route('deleteStore',['id'=>$id, 'idStore'=>$store->store_id])}}">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif
@endsection
