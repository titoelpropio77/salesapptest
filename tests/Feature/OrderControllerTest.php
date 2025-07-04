<?php
namespace Tests\Feature;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\OrderSummary;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_order_and_sends_email()
    {
        Mail::fake(); // Evita que se envíe realmente el correo

        // Crear productos de prueba
        $product1 = Product::factory()->create(['price' => 20.00]);
        $product2 = Product::factory()->create(['price' => 35.50]);

        $payload = [
            'client' => [
                'name' => 'Juan Pérez',
                'email' => 'juan@example.com',
            ],
            'products' => [
                [ 'id' => $product1->id, 'quantity' => 2 ],
                [ 'id' => $product2->id, 'quantity' => 1 ],
            ]
        ];

        $response = $this->postJson('/api/orders', $payload);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'message',
                     'order_id',
                 ]);

        $this->assertDatabaseHas('clients', [
            'email' => 'juan@example.com',
        ]);

        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseCount('order_product', 2);

        Mail::assertSent(OrderSummary::class, function ($mail) use ($payload) {
            return $mail->order->client->email === $payload['client']['email'];
        });
    }
}
