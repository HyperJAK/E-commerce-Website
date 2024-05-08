<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
</head>
<body>
    <h1>Currency Converter</h1>

    <form method="post" action="{{ route('currency_converter.convert') }}">
        @csrf
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required><br>

        <label for="from_currency">From Currency:</label>
        <select id="from_currency" name="from_currency" required>
            @foreach($currencies as $currency)
                <option value="{{ $currency }}">{{ $currency }}</option>
            @endforeach
        </select><br>

        <label for="to_currency">To Currency:</label>
        <select id="to_currency" name="to_currency" required>
            @foreach($currencies as $currency)
                <option value="{{ $currency }}">{{ $currency }}</option>
            @endforeach
        </select><br>

        <button type="submit">Convert</button>
    </form>

    @isset($convertedAmount)
        <p>Converted Amount: {{ $convertedAmount }}</p>
    @endisset
</body>
</html>
