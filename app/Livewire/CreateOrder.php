<?php

namespace App\Livewire;

use Livewire\Component;
use app\Models\Product;
use app\Models\Customer;
use app\Models\ProductLocation;
use app\Models\ShelfProduct;
use app\Models\ShelfStockLog;
use app\Models\Order;
use app\Models\OrderDetails;
use app\Models\Debt;
use app\Enums\OrderStatus; // Add this import
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CreateOrder extends Component
{
    public $products;
    public $shelfProducts;
    public $customers;
    public $activeTab = 1;
    public $purchaseDate;
    public $selectedCustomers = [];
    public $searchProduct = '';
    public $searchCustomer = '';
    public $customProductName;
    public $customProductQuantity;
    public $customProductPrice;
    public float $taxRate = 0;
    public $shelfQuantities = [];
    public $productView = 'all';
    public $cartQty = [];
    public $cartDiscounts = [];
    public $locationSelections = [];
    public $showLocationModal = false;
    public $currentProductId;
    public $currentShelfProductId;
    public $customLocationId;

    // Payment Modal
    public $showPaymentModal = false;
    public $paymentType = 'HandCash';
    public $amountPaid = 0;
    public $change = 0;
    public $dueDate = '';
    public $customerSet = 'Order Goods';

    // Toast
    public $toastMessage = '';
    public $toastType = 'success';
    public $showToast = false;

    protected $listeners = [
        'closeAddProductModal' => 'resetCustomProductForm',
        'hideToast' => 'hideToastNotification',
    ];

    public function mount()
    {
        $this->loadProducts();
        $this->customers = Customer::where('account_id', auth()->user()->account_id)
            ->get()
            ->sortBy('name');

        $this->purchaseDate = now()->format('Y-m-d');
        $this->taxRate = auth()->user()->account->tax_rate ?? 0;

        // Initialize tabs and restore carts from session
        for ($i = 1; $i <= 5; $i++) {
            $this->selectedCustomers[$i] = session()->get("selected_customer_{$i}", 'pass_by');

            // Restore cart from session if exists
            if (session()->has("cart_content_{$i}")) {
                Cart::instance('customer' . $i)->destroy();
                $savedContent = session()->get("cart_content_{$i}");
                foreach ($savedContent as $item) {
                    Cart::instance('customer' . $i)->add(
                        $item['id'],
                        $item['name'],
                        $item['qty'],
                        $item['price'],
                        $item['options'] ?? []
                    );
                }
            } else {
                Cart::instance('customer' . $i)->destroy();
            }
        }

        $this->syncCartState();
    }

    private function syncCartState()
    {
        $currentCart = Cart::instance('customer' . $this->activeTab)->content();

        $this->cartQty = [];
        $this->cartDiscounts = [];
        $this->locationSelections = [];

        foreach ($currentCart as $item) {
            $this->cartQty[$item->rowId] = $item->qty;
            $this->cartDiscounts[$item->rowId] = $item->price;

            if (isset($item->options['location_id'])) {
                $this->locationSelections[$item->rowId] = $item->options['location_id'];
            }
        }
    }

    private function saveCartToSession()
    {
        for ($i = 1; $i <= 5; $i++) {
            $cart = Cart::instance('customer' . $i);
            if ($cart->count() > 0) {
                $content = [];
                foreach ($cart->content() as $item) {
                    $content[] = [
                        'id'      => $item->id,
                        'name'    => $item->name,
                        'qty'     => $item->qty,
                        'price'   => $item->price,
                        'options' => $item->options,
                    ];
                }
                session()->put("cart_content_{$i}", $content);
                session()->put("selected_customer_{$i}", $this->selectedCustomers[$i] ?? 'pass_by');
            } else {
                session()->forget(["cart_content_{$i}", "selected_customer_{$i}"]);
            }
        }
    }

    public function switchTab($tab)
    {
        $this->saveCartToSession();
        $this->activeTab = $tab;
        $this->searchProduct = '';
        $this->searchCustomer = '';
        $this->syncCartState();
        $this->resetPaymentForm();
    }

    public function toggleProductView($view)
    {
        $this->productView = $view;
        $this->searchProduct = '';
        $this->loadProducts();
    }

    public function updatedSearchProduct()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        if ($this->productView === 'shelf') {
            $query = ShelfProduct::where('account_id', auth()->user()->account_id)
                ->with('product')
                ->whereHas('product');

            if (!empty($this->searchProduct)) {
                $query->whereHas('product', fn($q) => $q->where('name', 'like', '%' . $this->searchProduct . '%'));
            }

            $this->shelfProducts = $query->get();
            $this->products = $this->shelfProducts->pluck('product');
        } else {
            // Eager load productLocations to prevent N+1 queries
            $query = Product::where('account_id', auth()->user()->account_id)
                ->with(['category', 'unit', 'productLocations', 'productLocations.location']);

            if (!empty($this->searchProduct)) {
                $query->where('name', 'like', '%' . $this->searchProduct . '%');
            }

            $this->products = $query->get();
            $this->shelfProducts = collect([]);
        }
    }

    public function addToShelf($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        $shelfProduct = ShelfProduct::firstOrCreate(
            ['product_id' => $productId, 'account_id' => auth()->user()->account_id],
            ['unit_name' => 'Piece', 'unit_price' => $product->selling_price, 'conversion_factor' => 1, 'quantity' => 0]
        );

        ShelfStockLog::create([
            'shelf_product_id' => $shelfProduct->id,
            'quantity_change' => 0,
            'action' => 'add',
            'user_id' => auth()->id(),
            'account_id' => auth()->user()->account_id,
            'notes' => 'Added to shelf from POS',
        ]);

        $this->showToastMessage($product->name . ' added to shelf.', 'success');
        $this->loadProducts();
    }

    public function updateShelfStock($productId, $quantity)
    {
        if ($quantity < 0) {
            $this->showToastMessage('Quantity cannot be negative.', 'danger');
            return;
        }

        $shelfProduct = ShelfProduct::where('product_id', $productId)
            ->where('account_id', auth()->user()->account_id)
            ->first();

        if ($shelfProduct) {
            $old = $shelfProduct->quantity;
            $shelfProduct->update(['quantity' => $quantity]);

            ShelfStockLog::create([
                'shelf_product_id' => $shelfProduct->id,
                'quantity_change' => $quantity - $old,
                'action' => 'update',
                'user_id' => auth()->id(),
                'account_id' => auth()->user()->account_id,
            ]);

            $this->showToastMessage('Shelf stock updated successfully.', 'success');
            $this->loadProducts();
        }
    }

    public function addToCart($productId, $shelfProductId = null)
    {
        $product = Product::with('productLocations.location')->find($productId);
        if (!$product) {
            $this->showToastMessage('Product not found.', 'danger');
            return;
        }

        if ($this->productView === 'shelf' && $shelfProductId) {
            $shelf = ShelfProduct::find($shelfProductId);
            if (!$shelf || $shelf->quantity < 1) {
                $this->showToastMessage('Insufficient shelf stock.', 'danger');
                return;
            }
            $price = $shelf->unit_price;
            $unitName = $shelf->unit_name;
            $conversion = $shelf->conversion_factor;
            $locationId = null;
        } else {
            $price = $product->selling_price;
            $unitName = $product->unit?->name ?? 'Piece';
            $conversion = 1;

            if ($product->productLocations->sum('quantity') < 1) {
                $this->showToastMessage('Insufficient stock.', 'danger');
                return;
            }

            if ($product->productLocations->count() > 1) {
                $this->currentProductId = $productId;
                $this->currentShelfProductId = $shelfProductId;
                $this->showLocationModal = true;
                return;
            }

            $defaultLoc = $product->productLocations->first();
            $locationId = $defaultLoc?->location_id;
        }

        $tax = $price * ($this->taxRate / 100);
        $rowId = (string) Str::uuid();

        Cart::instance('customer' . $this->activeTab)->add([
            'id' => $product->id,
            'name' => $product->name . ' (' . $unitName . ')',
            'qty' => 1,
            'price' => $price,
            'weight' => 1,
            'options' => [
                'tax' => $tax,
                'shelf_product_id' => $shelfProductId,
                'conversion_factor' => $conversion,
                'location_id' => $locationId,
                'row_id' => $rowId,
            ],
        ]);

        $this->syncCartState();
        $this->saveCartToSession();
        $this->showToastMessage('Added to cart!', 'success');
    }

    public function selectLocation()
    {
        $product = Product::with('productLocations.location')->find($this->currentProductId);
        if (!$product) {
            $this->showToastMessage('Product not found.', 'danger');
            $this->showLocationModal = false;
            return;
        }

        $selectedLocationId = $this->locationSelections[$this->currentProductId] ?? null;

        if (!$selectedLocationId) {
            $this->showToastMessage('Please select a location.', 'danger');
            return;
        }

        $productLocation = $product->productLocations->where('location_id', $selectedLocationId)->first();

        if (!$productLocation || $productLocation->quantity < 1) {
            $this->showToastMessage('Selected location has insufficient stock.', 'danger');
            return;
        }

        $price = $product->selling_price;
        $unitName = $product->unit?->name ?? 'Piece';
        $tax = $price * ($this->taxRate / 100);
        $rowId = (string) Str::uuid();

        Cart::instance('customer' . $this->activeTab)->add([
            'id' => $product->id,
            'name' => $product->name . ' (' . $unitName . ')',
            'qty' => 1,
            'price' => $price,
            'weight' => 1,
            'options' => [
                'tax' => $tax,
                'shelf_product_id' => $this->currentShelfProductId,
                'conversion_factor' => 1,
                'location_id' => $selectedLocationId,
                'row_id' => $rowId,
            ],
        ]);

        $this->showLocationModal = false;
        $this->currentProductId = null;
        $this->currentShelfProductId = null;
        $this->syncCartState();
        $this->saveCartToSession();
        $this->showToastMessage('Product added after location selection.', 'success');
    }

    public function removeFromCart($rowId)
    {
        Cart::instance('customer' . $this->activeTab)->remove($rowId);
        unset($this->cartQty[$rowId], $this->cartDiscounts[$rowId], $this->locationSelections[$rowId]);
        $this->syncCartState();
        $this->saveCartToSession();
        $this->showToastMessage('Item removed from cart.', 'success');
    }

    public function updateCart($rowId, $qty)
    {
        $cartItem = Cart::instance('customer' . $this->activeTab)->get($rowId);
        if ($cartItem) {
            if ($qty < 1) {
                $this->removeFromCart($rowId);
                return;
            }

            Cart::instance('customer' . $this->activeTab)->update($rowId, $qty);
            $this->cartQty[$rowId] = $qty;
            $this->showToastMessage('Cart updated!', 'success');
            $this->saveCartToSession();
        }
    }

    public function updateDiscount($rowId, $discountPrice)
    {
        $cartItem = Cart::instance('customer' . $this->activeTab)->get($rowId);
        if ($cartItem) {
            $tax = $discountPrice * ($this->taxRate / 100);
            Cart::instance('customer' . $this->activeTab)->update($rowId, [
                'price' => $discountPrice,
                'options' => array_merge($cartItem->options->toArray(), ['tax' => $tax])
            ]);
            $this->cartDiscounts[$rowId] = $discountPrice;
            $this->showToastMessage('Discount updated!', 'success');
            $this->saveCartToSession();
        }
    }

    public function addCustomProduct()
    {
        $this->validate([
            'customProductName' => 'required|string|max:255',
            'customProductQuantity' => 'required|numeric|min:1',
            'customProductPrice' => 'required|numeric|min:0',
            'customLocationId' => 'required|exists:locations,id',
        ]);

        $tax = $this->customProductPrice * ($this->taxRate / 100);
        $rowId = (string) Str::uuid();

        Cart::instance('customer' . $this->activeTab)->add([
            'id' => $rowId,
            'name' => $this->customProductName,
            'qty' => $this->customProductQuantity,
            'price' => $this->customProductPrice,
            'weight' => 1,
            'options' => [
                'tax' => $tax,
                'location_id' => $this->customLocationId,
                'is_custom' => true,
                'row_id' => $rowId,
            ],
        ]);

        $this->syncCartState();
        $this->saveCartToSession();
        $this->resetCustomProductForm();
        $this->showToastMessage('Custom product added!', 'success');
        $this->dispatch('closeAddProductModal');
    }

    public function resetCustomProductForm()
    {
        $this->customProductName = '';
        $this->customProductQuantity = '';
        $this->customProductPrice = '';
        $this->customLocationId = '';
    }

    public function openPaymentModal()
    {
        if (Cart::instance('customer' . $this->activeTab)->count() === 0) {
            $this->showToastMessage('Cart is empty!', 'danger');
            return;
        }

        $this->showPaymentModal = true;
        $this->paymentType = 'HandCash';
        $this->amountPaid = $this->getCartTotal();
        $this->change = 0;
        $this->dueDate = now()->addDays(30)->format('Y-m-d');
    }

    private function getCartTotal()
    {
        $subtotal = Cart::instance('customer' . $this->activeTab)->subtotalFloat();
        $tax = Cart::instance('customer' . $this->activeTab)->content()->sum(fn($item) => ($item->options['tax'] ?? 0) * $item->qty);
        return $subtotal + $tax;
    }

    public function updatedAmountPaid()
    {
        $total = $this->getCartTotal();
        $this->change = max(0, $this->amountPaid - $total);
    }

    public function updatedPaymentType()
    {
        if ($this->paymentType === 'Due') {
            $this->amountPaid = 0;
            $this->change = 0;
        } else {
            $this->amountPaid = $this->getCartTotal();
            $this->change = 0;
        }
    }

    public function processPayment()
    {
        $currentCart = Cart::instance('customer' . $this->activeTab)->content();

        if ($currentCart->isEmpty()) {
            $this->showToastMessage('Cart is empty.', 'danger');
            $this->showPaymentModal = false;
            return;
        }

        if ($this->paymentType === 'Due') {
            $this->validate([
                'dueDate' => 'required|date|after_or_equal:today',
            ]);

            $this->processDebtOrder();
        } else {
            $this->validate([
                'amountPaid' => 'required|numeric|min:' . $this->getCartTotal(),
            ]);

            $this->processPaidOrder();
        }
    }

   private function processPaidOrder()
    {
        DB::beginTransaction();

        try {
            $currentCart = Cart::instance('customer' . $this->activeTab)->content();
            $subTotal = Cart::instance('customer' . $this->activeTab)->subtotalFloat();
            $vat = $currentCart->sum(fn($item) => ($item->options['tax'] ?? 0) * $item->qty);
            $total = $subTotal + $vat;

            // Get the enum case directly - DON'T use tryFrom with string
            $orderStatus = OrderStatus::COMPLETED; // Use the enum case directly

            // Create order
            $order = Order::create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'account_id' => auth()->user()->account_id,
                'customer_id' => $this->selectedCustomers[$this->activeTab] !== 'pass_by' ? $this->selectedCustomers[$this->activeTab] : null,
                'order_date' => $this->purchaseDate,
                'payment_type' => $this->paymentType,
                'sub_total' => $subTotal,
                'vat' => $vat,
                'total' => $total,
                'order_status' => $orderStatus->value, // Get the integer value
                'total_products' => $currentCart->count(),
                'pay' => $this->amountPaid,
                'due' => 0,
                'invoice_no' => 'INV-' . time(),
            ]);

            // Create order details and deduct stock
            foreach ($currentCart as $item) {
                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => isset($item->options['is_custom']) ? null : $item->id,
                    'product_name' => $item->name,
                    'quantity' => $item->qty,
                    'unit_price' => $item->price,
                    'subtotal' => $item->subtotal,
                    'tax' => ($item->options['tax'] ?? 0) * $item->qty,
                    'account_id' => auth()->user()->account_id,
                    'unitcost' => $item->price,
                    'total' => $item->subtotal,
                ]);

                // Deduct stock for non-custom products
                if (!isset($item->options['is_custom'])) {
                    if ($item->options['shelf_product_id'] ?? false) {
                        $shelfProduct = ShelfProduct::find($item->options['shelf_product_id']);
                        if ($shelfProduct) {
                            $shelfProduct->decrement('quantity', $item->qty);
                        }
                    } else {
                        $locationId = $item->options['location_id'] ?? null;
                        if ($locationId) {
                            $productLocation = ProductLocation::where('product_id', $item->id)
                                ->where('location_id', $locationId)
                                ->where('account_id', auth()->user()->account_id)
                                ->first();

                            if ($productLocation) {
                                $productLocation->decrement('quantity', $item->qty);
                            }
                        }
                    }
                }
            }

            DB::commit();

            // Clear the cart for this tab
            Cart::instance('customer' . $this->activeTab)->destroy();
            $this->syncCartState();
            $this->saveCartToSession();

            // Close modal and show success
            $this->showPaymentModal = false;
            $this->resetPaymentForm();

            $this->showToastMessage("Order #{$order->id} completed successfully! Change: " . number_format($this->change, 2), 'success');

            // Refresh products to update stock displays
            $this->loadProducts();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());
            $this->showToastMessage('Failed to create order: ' . $e->getMessage(), 'danger');
        }
    }

    private function processDebtOrder()
    {
        DB::beginTransaction();

        try {
            $currentCart = Cart::instance('customer' . $this->activeTab)->content();
            $subTotal = Cart::instance('customer' . $this->activeTab)->subtotalFloat();
            $vat = $currentCart->sum(fn($item) => ($item->options['tax'] ?? 0) * $item->qty);
            $total = $subTotal + $vat;

            // Get the enum case directly
            $orderStatus = OrderStatus::PENDING; // Use the enum case directly

            // Create order with pending status
            $order = Order::create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'account_id' => auth()->user()->account_id,
                'customer_id' => $this->selectedCustomers[$this->activeTab] !== 'pass_by' ? $this->selectedCustomers[$this->activeTab] : null,
                'order_date' => $this->purchaseDate,
                'payment_type' => 'Due',
                'sub_total' => $subTotal,
                'vat' => $vat,
                'total' => $total,
                'order_status' => $orderStatus->value, // Get the integer value
                'total_products' => $currentCart->count(),
                'pay' => 0,
                'due' => $total,
                'invoice_no' => 'INV-' . time(),
            ]);

            // Create order details
            foreach ($currentCart as $item) {
                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => isset($item->options['is_custom']) ? null : $item->id,
                    'product_name' => $item->name,
                    'quantity' => $item->qty,
                    'unit_price' => $item->price,
                    'subtotal' => $item->subtotal,
                    'tax' => ($item->options['tax'] ?? 0) * $item->qty,
                    'account_id' => auth()->user()->account_id,
                    'unitcost' => $item->price,
                    'total' => $item->subtotal,
                ]);
            }

            // Create debt record
            Debt::create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'account_id' => auth()->user()->account_id,
                'order_id' => $order->id,
                'customer_id' => $this->selectedCustomers[$this->activeTab] !== 'pass_by' ? $this->selectedCustomers[$this->activeTab] : null,
                'customer_set' => $this->customerSet,
                'amount' => $total,
                'due_date' => $this->dueDate,
                'status' => 'pending',
            ]);

            DB::commit();

            // Clear the cart for this tab
            Cart::instance('customer' . $this->activeTab)->destroy();
            $this->syncCartState();
            $this->saveCartToSession();

            // Close modal and show success
            $this->showPaymentModal = false;
            $this->resetPaymentForm();

            $this->showToastMessage("Debt order #{$order->id} created successfully! Due date: " . date('M d, Y', strtotime($this->dueDate)), 'success');

            // Refresh products
            $this->loadProducts();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Debt order creation failed: ' . $e->getMessage());
            $this->showToastMessage('Failed to create debt order: ' . $e->getMessage(), 'danger');
        }
    }
    private function resetPaymentForm()
    {
        $this->paymentType = 'HandCash';
        $this->amountPaid = 0;
        $this->change = 0;
        $this->dueDate = '';
        $this->customerSet = 'Order Goods';
    }

    private function showToastMessage($message, $type = 'success')
    {
        $this->toastMessage = $message;
        $this->toastType = $type;
        $this->showToast = true;
        $this->dispatch('hideToast');
    }

    public function hideToastNotification()
    {
        $this->showToast = false;
    }

    public function render()
    {
        $filteredProducts = $this->products ?? collect([]);
        $filteredCustomers = $this->customers->filter(fn($c) =>
            empty($this->searchCustomer) || str_contains(strtolower($c->name), strtolower($this->searchCustomer))
        )->values();

        $locations = \App\Models\Location::where('account_id', auth()->user()->account_id)->get();
        $currentCart = Cart::instance('customer' . $this->activeTab)->content();

        return view('livewire.create-order', [
            'filteredProducts' => $filteredProducts,
            'shelfProducts' => $this->shelfProducts ?? collect([]),
            'filteredCustomers' => $filteredCustomers,
            'currentCart' => $currentCart,
            'taxRate' => $this->taxRate,
            'locations' => $locations,
        ])->extends('layouts.tabler')->section('content');
    }
}
