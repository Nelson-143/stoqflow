<div>
    <div class="page-body">
        <div class="container-xl">
            <!-- Toast Notification -->
            @if($showToast)
                <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                    <div class="toast align-items-center text-white bg-{{ $toastType === 'success' ? 'success' : 'danger' }} border-0 show" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    @if($toastType === 'success')
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    @else
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 8v4m0 4h.01" />
                                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                    @endif
                                </svg>
                                {{ $toastMessage }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row row-cards">
                <!-- Left Column - Cart Section -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('New Order') }}</h3>
                            <div class="ms-auto">
                                <div class="btn-group">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button wire:click="switchTab({{ $i }})"
                                                class="btn btn-{{ $activeTab === $i ? 'primary' : 'outline-primary' }} btn-sm">
                                            {{ $i }}
                                        </button>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Order Info Row -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">{{ __('Date') }} <span class="text-danger">*</span></label>
                                    <input wire:model="purchaseDate" type="date" class="form-control" required>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">{{ __('Customer') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input wire:model.live.debounce.300ms="searchCustomer"
                                               type="text"
                                               class="form-control"
                                               placeholder="Search customers...">
                                        <select wire:model="selectedCustomers.{{ $activeTab }}" class="form-select">
                                            <!-- <option value="pass_by">PASS BY</option> -->
                                            @foreach ($filteredCustomers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Cart Table - Responsive -->
                            <div class="table-responsive">
                                <h4 class="mb-3">Cart (Tab {{ $activeTab }})</h4>
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th class="d-none d-md-table-cell">Location</th>
                                            <th>Price</th>
                                            <th class="d-none d-lg-table-cell">Discount</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($currentCart as $item)
                                            <tr>
                                                <td class="align-middle">
                                                    <strong>{{ $item->name }}</strong>
                                                    <small class="d-block d-md-none text-muted">
                                                        @if($item->options['shelf_product_id'] ?? false)
                                                            📦 Shelf
                                                        @else
                                                            📍 {{ $item->options['location_id'] ? ($locations->where('id', $item->options['location_id'])->first()->name ?? 'N/A') : 'N/A' }}
                                                        @endif
                                                    </small>
                                                </td>
                                                <td class="align-middle d-none d-md-table-cell">
                                                    @if($item->options['shelf_product_id'] ?? false)
                                                        <span class="badge bg-info">Shelf</span>
                                                    @else
                                                        @php
                                                            $locationId = $item->options['location_id'];
                                                            $location = $locations->where('id', $locationId)->first();
                                                        @endphp
                                                        {{ $location ? $location->name : 'N/A' }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">{{ number_format($item->price, 2) }}</td>
                                                <td class="align-middle d-none d-lg-table-cell">
                                                    <input type="number"
                                                           wire:model.live.debounce.500ms="cartDiscounts.{{ $item->rowId }}"
                                                           min="0"
                                                           step="0.01"
                                                           class="form-control form-control-sm"
                                                           style="width: 100px;">
                                                </td>
                                                <td class="align-middle" style="width: 80px;">
                                                    <input type="number"
                                                           wire:model.live.debounce.500ms="cartQty.{{ $item->rowId }}"
                                                           min="1"
                                                           class="form-control form-control-sm">
                                                </td>
                                                <td class="align-middle">{{ number_format($item->subtotal, 2) }}</td>
                                                <td class="align-middle text-center">
                                                    <button wire:click="removeFromCart('{{ $item->rowId }}')"
                                                            class="btn btn-icon btn-danger btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5 text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 17h-11v-14h-2" />
                                                        <path d="M6 5l14 1l-1 7h-13" />
                                                    </svg>
                                                    <p class="mt-2">Cart is empty</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    @if($currentCart->count() > 0)
                                        <tfoot class="table-light">
                                            <tr>
                                                <td colspan="4" class="text-end"><strong>Subtotal</strong></td>
                                                <td colspan="2"><strong>{{ number_format(Cart::instance('customer' . $activeTab)->subtotalFloat(), 2) }}</strong></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end"><strong>Tax ({{ $taxRate }}%)</strong></td>
                                                <td colspan="2"><strong>{{ number_format($currentCart->sum(fn($item) => ($item->options['tax'] ?? 0) * $item->qty), 2) }}</strong></td>
                                                <td></td>
                                            </tr>
                                            <tr class="table-primary">
                                                <td colspan="4" class="text-end"><strong>Total</strong></td>
                                                <td colspan="2"><strong>{{ number_format(Cart::instance('customer' . $activeTab)->subtotalFloat() + $currentCart->sum(fn($item) => ($item->options['tax'] ?? 0) * $item->qty), 2) }}</strong></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>

                            <div class="card-footer text-end mt-3">
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Add Custom
                                </button>
                                <button wire:click="openPaymentModal"
                                        class="btn btn-success {{ $currentCart->count() > 0 ? '' : 'disabled' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M7 11l10 0" />
                                        <path d="M9 15l2 0" />
                                    </svg>
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Products Section -->
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Products</h3>
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <button wire:click="toggleProductView('all')"
                                            class="btn btn-{{ $productView === 'all' ? 'primary' : 'outline-primary' }} btn-sm">
                                        All
                                    </button>
                                    <button wire:click="toggleProductView('shelf')"
                                            class="btn btn-{{ $productView === 'shelf' ? 'primary' : 'outline-primary' }} btn-sm">
                                        Shelf
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <input wire:model.live.debounce.500ms="searchProduct"
                                   type="text"
                                   class="form-control mb-3"
                                   placeholder="Search products...">

                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                <table class="table table-hover">
                                    <thead class="sticky-top bg-white">
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-end">Price</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($filteredProducts as $index => $product)
                                            @php
                                                $shelfProduct = $productView === 'shelf' ? ($shelfProducts[$index] ?? null) : null;
                                                $stock = $productView === 'shelf' && $shelfProduct
                                                    ? $shelfProduct->quantity
                                                    : ($product->quantity ?? 0);
                                                $price = $productView === 'shelf' && $shelfProduct
                                                    ? $shelfProduct->unit_price
                                                    : $product->selling_price;
                                                $unit = $productView === 'shelf' && $shelfProduct
                                                    ? $shelfProduct->unit_name
                                                    : ($product->unit ? $product->unit->name : 'Pc');
                                            @endphp
                                            <tr>
                                                <td>
                                                    <strong>{{ $product->name }}</strong>
                                                    <small class="d-block text-muted">{{ $unit }}</small>
                                                </td>
                                                <td class="text-center">
                                                    @if($productView === 'shelf' && $shelfProduct)
                                                        <div class="d-flex flex-column">
                                                            <input type="number"
                                                                   wire:model.live.debounce.500ms="shelfQuantities.{{ $product->id }}"
                                                                   class="form-control form-control-sm mb-1"
                                                                   style="width: 80px;">
                                                            <button wire:click="updateShelfStock({{ $product->id }}, {{ $shelfQuantities[$product->id] ?? 0 }})"
                                                                    class="btn btn-sm btn-outline-primary">
                                                                Update
                                                            </button>
                                                        </div>
                                                    @else
                                                        <span class="badge {{ $stock > 10 ? 'bg-success' : ($stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                            {{ number_format($stock, 0) }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-end">{{ number_format($price, 2) }}</td>
                                                <td class="text-center">
                                                    @if($productView === 'shelf' && $shelfProduct)
                                                        <button wire:click="addToCart({{ $product->id }}, {{ $shelfProduct->id }})"
                                                                class="btn btn-icon btn-sm btn-primary"
                                                                title="Add to cart">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                <path d="M17 17h-11v-14h-2" />
                                                                <path d="M6 5l14 1l-1 7h-13" />
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <div class="btn-group">
                                                            <button wire:click="addToShelf({{ $product->id }})"
                                                                    class="btn btn-icon btn-sm btn-outline-secondary"
                                                                    title="Add to shelf">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                    <path d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" />
                                                                </svg>
                                                            </button>
                                                            <button wire:click="addToCart({{ $product->id }})"
                                                                    class="btn btn-icon btn-sm btn-primary"
                                                                    title="Add to cart">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                    <path d="M17 17h-11v-14h-2" />
                                                                    <path d="M6 5l14 1l-1 7h-13" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5 text-muted">
                                                    No products found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Location Selection Modal -->
    @if($showLocationModal)
        <div class="modal modal-blur fade show" tabindex="-1" style="display: block; background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Location</h5>
                        <button type="button" class="btn-close" wire:click="$set('showLocationModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <p>Select location for <strong>{{ optional($products->find($currentProductId))->name ?? '' }}</strong></p>
                        @foreach((optional($products->find($currentProductId))->productLocations ?? []) as $productLocation)
                            <div class="form-check mb-2">
                                <input type="radio" class="form-check-input"
                                       wire:model="locationSelections.{{ $currentProductId }}"
                                       value="{{ $productLocation->location_id }}"
                                       id="loc_{{ $productLocation->location_id }}">
                                <label class="form-check-label" for="loc_{{ $productLocation->location_id }}">
                                    <strong>{{ $productLocation->location->name }}</strong>
                                    <span class="text-muted">(Stock: {{ number_format($productLocation->quantity) }})</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$set('showLocationModal', false)">Cancel</button>
                        <button class="btn btn-primary" wire:click="selectLocation">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Payment Modal -->
    @if($showPaymentModal)
        <div class="modal modal-blur fade show" tabindex="-1" style="display: block; background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment</h5>
                        <button type="button" class="btn-close" wire:click="$set('showPaymentModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Total Amount</label>
                            <input type="text" class="form-control form-control-lg text-center fw-bold"
                                   value="{{ number_format(Cart::instance('customer' . $activeTab)->subtotalFloat() + $currentCart->sum(fn($item) => ($item->options['tax'] ?? 0) * $item->qty), 2) }}"
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select wire:model.live="paymentType" class="form-select">
                                <option value="HandCash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Due">Credit / Due</option>
                            </select>
                        </div>

                        @if($paymentType !== 'Due')
                            <div class="mb-3">
                                <label class="form-label">Amount Received</label>
                                <input type="number" wire:model.live="amountPaid" class="form-control form-control-lg" step="0.01">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Change</label>
                                <input type="text" class="form-control form-control-lg text-success fw-bold" value="{{ number_format($change, 2) }}" readonly>
                            </div>
                        @endif

                        @if($paymentType === 'Due')
                            <div class="mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" wire:model="dueDate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Reference</label>
                                <input type="text" wire:model="customerSet" class="form-control">
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$set('showPaymentModal', false)">Cancel</button>
                        <button class="btn btn-success" wire:click="processPayment">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                            Confirm Payment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Custom Product Modal -->
    <div class="modal modal-blur fade" id="addProductModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Custom Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">Product Name</label>
                        <input wire:model="customProductName" type="text" class="form-control" placeholder="Enter product name">
                        @error('customProductName') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Quantity</label>
                            <input wire:model="customProductQuantity" type="number" class="form-control" min="1">
                            @error('customProductQuantity') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Price</label>
                            <input wire:model="customProductPrice" type="number" class="form-control" step="0.01" min="0">
                            @error('customProductPrice') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Location</label>
                        <select wire:model="customLocationId" class="form-select">
                            <option value="">Select Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('customLocationId') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="addCustomProduct">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 12px;
            }
            .btn-icon {
                padding: 0.25rem;
            }
            .form-control-sm {
                font-size: 11px;
            }
        }

        .sticky-top {
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .modal-blur {
            backdrop-filter: blur(4px);
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }
    </style>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        // Auto-hide toast after 3 seconds
        Livewire.on('hideToast', () => {
            setTimeout(() => {
                @this.set('showToast', false);
            }, 3000);
        });

        // Show success modal with receipt
        Livewire.on('showSuccessModal', (data) => {
            // Create modal dynamically
            const modalHtml = `
                <div class="modal modal-blur fade show" id="successModal" tabindex="-1" style="display: block; background: rgba(0,0,0,0.5);">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-status bg-success"></div>
                            <div class="modal-header">
                                <h5 class="modal-title">✅ Order Completed!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="document.getElementById('successModal').remove()"></button>
                            </div>
                            <div class="modal-body text-center py-4">
                                <div class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="1.5">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                </div>
                                <h4>${data.message}</h4>
                                <div class="mt-4 p-3 bg-light rounded">
                                    <div class="row">
                                        <div class="col-6 text-start">Total:</div>
                                        <div class="col-6 text-end fw-bold">${data.total}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-start">Paid:</div>
                                        <div class="col-6 text-end fw-bold">${data.paid}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-start">Change:</div>
                                        <div class="col-6 text-end fw-bold text-success">${data.change}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-start">Payment:</div>
                                        <div class="col-6 text-end">${data.paymentType}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" onclick="document.getElementById('successModal').remove()">
                                    Continue Shopping
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', modalHtml);

            // Auto remove after 5 seconds
            setTimeout(() => {
                const modal = document.getElementById('successModal');
                if(modal) modal.remove();
            }, 5000);
        });

        // Close modals properly
        Livewire.on('closeAddProductModal', () => {
            const modalElement = document.getElementById('addProductModal');
            if(modalElement) {
                const modal = bootstrap.Modal.getInstance(modalElement);
                if(modal) modal.hide();
                modalElement.classList.remove('show');
                document.body.classList.remove('modal-open');
                document.querySelector('.modal-backdrop')?.remove();
            }
        });
    });

    // Handle responsive touch events
    document.addEventListener('touchstart', function() {}, {passive: true});
</script>
