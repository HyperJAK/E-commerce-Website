@extends('layouts.layoutforAdmin')
@section('content')

    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .main-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        .header {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .description {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        .additional-content {
            margin-top: 20px;
            /* Placeholder for additional content styles */
        }
    </style>



    <div class="main-content">
        <div class="header">Welcome to the Admin Dashboard</div>
        <div class="description">
            Manage your application's data efficiently from here. Utilize the navigation links to access different sections of the admin panel.
        </div>
        <div class="additional-content">
            <!-- Additional content goes here -->
        </div>
    </div>
@endsection
