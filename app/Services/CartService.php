<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use App\Models\Addon;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Illuminate\Support\Collection;
use App\Models\Tax;
/**
 * Description of CartService
 *
 * @author rk
 */
class CartService
{
    private $model;

    /**
     * CartRepository constructor.
     * @param ShoppingCart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }
    
    
    public function refresh()
    {
        if ( \Auth::check() ) {
            $user       = \Auth::user();
            $state_id = $user->billing_state ?? null;
            $country_id = $user->billing_country->id ?? null;
            
            $this->updateTax($country_id, $state_id);
        }
    }

    /**
     * @param Product $product
     * @param int $int
     * @param array $options
     * @return CartItem
     */
    public function addToCart($id, $name, $int, $price, $options = []) : CartItem
    {
        return $this->model->add($id, $name, $int, $price, $options);
    }
    
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCartItems() : Collection
    {
        return $this->model->content();
    }
    
    /**
     * @param string $rowId
     *
     * @throws ProductInCartNotFoundException
     */
    public function removeToCart(string $rowId)
    {
        try {
            $this->model->remove($rowId);
        } catch (InvalidRowIDException $e) {
            throw $e;
        }
    }
    
    /**
     * Count the items in the cart
     *
     * @return int
     */
    public function countItems() : int
    {
        return $this->model->count();
    }
    
    /**
     * Get the sub total of all the items in the cart
     *
     * @param int $decimals
     * @return float
     */
    public function getSubTotal(int $decimals = 2)
    {
        return $this->model->subtotal($decimals, '.', '');
    }
    
    public function getSubTotalFormatted()
    {
        return ch_format_price($this->getSubTotal());
    }
    
    /**
     * Get the final total of all the items in the cart minus tax
     *
     * @param int $decimals
     * @param float $shipping
     * @return float
     */
    public function getTotal(int $decimals = 2, $shipping = 0.00)
    {
        return $this->model->total($decimals, '.', '', $shipping);
    }
    
    public function getTotalFormatted()
    {
        return ch_format_price($this->getTotal());
    }
    
    /**
     * @param string $rowId
     * @param int $quantity
     * @return CartItem
     */
    public function updateQuantityInCart(string $rowId, int $quantity) : CartItem
    {
        return $this->model->update($rowId, $quantity);
    }
    
    /**
     * Return the specific item in the cart
     *
     * @param string $rowId
     * @return \Gloudemans\Shoppingcart\CartItem
     */
    public function findItem(string $rowId) : CartItem
    {
        return $this->model->get($rowId);
    }
    
    /**
     * Returns the tax
     *
     * @param int $decimals
     * @return float
     */
    public function getTax(int $decimals = 2)
    {
        return $this->model->tax($decimals);
    }
    
    public function getTaxFormatted()
    {
        return ch_format_price($this->getTax());
    }
    
    public function updateTax($country_id = null, $state_id = null) 
    {
        // check if tax is enebaled.
        if (setting('taxes.enabled', 'no') == 'no') {
            return;
        }

        $tax_rate = 0;

        // Check if user is logged in.

        $tax_row = null;
        
        if ( ($country_id && $country_id != 0) && ($state_id && $state_id != 0) ) {
            $tax_row = Tax::where('state_id', $state_id)
                ->where('country_id', $country_id)
                ->where('country_wide', "0")
                ->first();
            
        }

        // check if tax row is still null and user has country selected.
        if (is_null($tax_row) && $country_id) {
            $tax_row = Tax::where('country_id', $country_id)
                    ->where('country_wide', "1")
                    ->first();
           
        }

        // check if admin has not setup the tax for 
        // the current user country and state.
        if (!is_null($tax_row)) {
            $tax_rate = $tax_row->rate;
        } else {
            $tax_rate = setting('cart.tax', 0);
        }

        config()->set('cart.tax', $tax_rate);
        
        if ($this->countItems()) {
            foreach ( $this->model->content() as $row ) {
                $this->model->setTax($row->rowId, $tax_rate);  
            }
        }   
    }

    /**
     * @param Courier $courier
     * @return mixed
     */
    public function getShippingFee(Courier $courier)
    {
        return number_format($courier->cost, 2);
    }
    
    /**
     * Clear the cart content
     */
    public function clearCart()
    {
        $this->model->destroy();
    }
    
    /**
     * @param Customer $customer
     * @param string $instance
     */
    public function saveCart(Customer $customer, $instance = 'default')
    {
        $this->model->instance($instance)->store($customer->email);
    }
    
    /**
     * @param Customer $customer
     * @param string $instance
     * @return Cart
     */
    public function openCart(Customer $customer, $instance = 'default')
    {
        $this->model->instance($instance)->restore($customer->email);
        return $this->model;
    }
    
    /**
     * @return Collection
     */
    public function getCartItemsTransformed() : Collection
    {
        return $this->getCartItems()->map(function ($item) {
            if (strpos($item->name, 'Addon:') === false) {
                $item->associate(Product::class);
            } else {
                $item->associate(Addon::class);
            }
            return $item;
        });
    }
}
