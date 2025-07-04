<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resumen de Orden</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h2>Resumen de Orden #{{ $order->id }}</h2>
    <p><strong>Cliente:</strong> {{ $order->client->name }}<br>
       <strong>Email:</strong> {{ $order->client->email }}<br>
       <strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($order->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>${{ number_format($product->price * $product->pivot->quantity, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h4 style="text-align:right">Total: ${{ number_format($order->products->sum(fn($p) => $p->price * $p->pivot->quantity), 2) }}</h4>
</body>
</html>
