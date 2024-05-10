<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        /* Basic resets */
        body, h1, p, form {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        /* Container for content */
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #0056b3;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Styling for event display */
        .event {
            padding: 15px;
            border-bottom: 1px solid #ccc;
            transition: background-color 0.3s ease;
        }

        .event:last-child {
            border-bottom: none;
        }

        .event:hover {
            background-color: #f9f9f9;
        }

        /* Form styling */
        form {
            display: grid;
            grid-gap: 10px;
            padding: 20px;
            background-color: #fafafa;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        label {
            margin-bottom: 5px;
        }

        input[type=text],
        input[type=datetime-local],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type=submit] {
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type=submit]:hover {
            background-color: #004494;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>All Events:</h1>
    <div>
        @foreach ($events as $event)
            <div class="event">
                <p>Event {{ $event->event_id }}: {{ $event->name }}</p>
            </div>
        @endforeach
    </div>
    <form action="{{ route('addevent') }}" method="post">
        @csrf
        <input type="hidden" id="store_id" name="store_id" value="{{$storeid}}" required>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>

        <label for="start_date">Start Date:</label>
        <input type="datetime-local" id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="datetime-local" id="end_date" name="end_date" required>

        <label for="product_id">Choose a product:</label>
        <select name="product_id">
            @foreach ($products as $product)
                <option value="{{ $product->product_id }}">{{ $product->name }}</option>
            @endforeach
        </select>
        <label for="starting_price">Starting Price:</label>
        <input type="number" id="starting_price" name="starting_price" step="0.01" required>

        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>
