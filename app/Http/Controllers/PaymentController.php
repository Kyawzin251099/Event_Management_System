<?php

namespace App\Http\Controllers;

//require 'vendor/autoload.php';

use App\Contracts\PaymentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentInterface $paymentInterface,
    ) {
        $this->paymentInterface = $paymentInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //call booking index api
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('success') . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('cancel'),
        ]);

        return redirect($session->url);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->session_id;

        try {
            $session =  \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException();
            }
            $customer = \Stripe\Customer::retrieve($session->customer);
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

        return 'success';
    }

    public function cancel()
    {
        return 'cancel';
    }
}
