<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderSummary;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function store(StoreOrderRequest $request)
    {

        $client = Client::firstOrCreate(
            ['name' => $request->client['name']],
            ['email' => $request->client['email']]
        );

        $order = $client->orders()->create();
        $syncData = [];
        foreach ($request->products as $prod) {
            $syncData[$prod['id']] = ['quantity' => $prod['quantity']];
        }
        $order->products()->sync($syncData);
        Mail::to($client->email)->send(new OrderSummary($order));
        return response()->json([
            'message' => 'Orden creada exitosamente',
            'order_id' => $order->id,
        ], 201);
    }
}
