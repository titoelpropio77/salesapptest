@component('mail::message')
# ¡Gracias por tu compra, {{ $order->client->name }}!

Te enviamos un resumen de tu orden:

@component('mail::table')
| Producto       | Cantidad | Precio Unitario | Subtotal  |
| -------------- | -------- | ---------------- | ---------:|
@foreach ($order->products as $product)
| {{ $product->name }} | {{ $product->pivot->quantity }} | ${{ number_format($product->price, 2) }} | ${{ number_format($product->price * $product->pivot->quantity, 2) }} |
@endforeach
@endcomponent

**Total:** ${{ number_format($order->products->sum(fn($p) => $p->price * $p->pivot->quantity), 2) }}

Gracias por confiar en nosotros.<br>
Modesto
@endcomponent
