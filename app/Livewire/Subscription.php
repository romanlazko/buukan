<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Reactive;
use App\Models\Product;
use App\Models\Company;
use Laravel\Cashier\Cashier;
use Livewire\Attributes\On;

class Subscription extends Component
{
    use Traits\Modal;

    public Company $company;

    public $product = null;

    public $price_id;

    public $total_price;

    public function render()
    {
        if ($this->product) {
            $stripe = Cashier::stripe();
            
            $this->product->prices = $stripe->prices->all(['product' => $this->product->product_id, 'active' => true]);

            if ($this->price_id) {
                $price = $stripe->prices->retrieve($this->price_id);
                $this->total_price = $price->unit_amount / 100 . " {$price->currency} / {$price->recurring->interval}";
            }
        }

        return view('livewire.subscription');
    }

    #[On('set-data')]
    public function setData($data = [])
    {
        $this->reset('product', 'price_id', 'total_price');
        $this->product = Product::find($data['product_id']);
    }
}
