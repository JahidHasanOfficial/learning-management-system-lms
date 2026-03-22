<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Str;

class PaymentService
{
    /**
     * Process checkout and calculate final price.
     */
    public function calculateFinalPrice(Course $course, $couponCode = null)
    {
        $price = $course->price;
        $discount = 0;

        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->where('status', 'active')->where('expires_at', '>', now())->first();
            if ($coupon) {
                if ($coupon->type == 'percentage') {
                    $discount = ($price * $coupon->value) / 100;
                } else {
                    $discount = $coupon->value;
                }
                $price -= $discount;
                $coupon->increment('used_count');
            }
        }

        return [
            'total' => max(0, $price),
            'discount' => $discount,
            'original' => $course->price
        ];
    }

    /**
     * Create a payment record.
     */
    public function createPayment($userId, $courseId, $amount, $gateway, $transactionId, $details = null)
    {
        $payment = Payment::create([
            'user_id' => $userId,
            'course_id' => $courseId,
            'amount' => $amount,
            'gateway' => $gateway,
            'transaction_id' => $transactionId,
            'payment_details' => $details,
            'status' => 'completed'
        ]);

        $this->generateInvoice($payment);

        return $payment;
    }

    /**
     * Generate an invoice for a payment.
     */
    public function generateInvoice(Payment $payment)
    {
        return Invoice::create([
            'invoice_no' => 'INV-' . strtoupper(Str::random(8)),
            'user_id' => $payment->user_id,
            'payment_id' => $payment->id,
            'subtotal' => $payment->amount,
            'discount' => 0, // Simplified for now
            'total' => $payment->amount
        ]);
    }
}
