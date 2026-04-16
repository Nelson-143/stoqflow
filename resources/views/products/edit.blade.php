@extends('layouts.tabler')
@section('title', 'Edit Product')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Edit Product') }}
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs', ['model' => $product])
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <form action="{{ route('products.update', $product->uuid) }}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Product Image') }}
                                    </h3>

                                    <img class="img-account-profile mb-2"
                                        src="{{ $product->product_image ? asset($product->product_image) : asset('assets/img/products/default.webp') }}"
                                        alt="" id="image-preview" style="width: 100%; max-height: 200px; object-fit: cover;">

                                    <div class="small font-italic text-muted mb-2">
                                        JPG or PNG no larger than 2 MB
                                    </div>

                                    <input type="file" accept="image/*" id="image" name="product_image"
                                        class="form-control @error('product_image') is-invalid @enderror"
                                        onchange="previewImage();">

                                    @error('product_image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Product Details') }}
                                    </h3>

                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('Name') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" id="name" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Product name" value="{{ old('name', $product->name) }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Category with Add Button -->
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">
                                                    {{ __('Product category') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <select name="category_id" id="category_id"
                                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                                        <option value="" selected disabled>{{ __('Select a category') }}:</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                @if (old('category_id', $product->category_id) == $category->id) selected="selected" @endif>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M12 5l0 14"/><path d="M5 12l14 0"/>
                                                        </svg>
                                                        Add New
                                                    </button>
                                                </div>
                                                @error('category_id')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Supplier with Add Button -->
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="supplier_id" class="form-label">
                                                    {{ __('Product supplier') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <select name="supplier_id" id="supplier_id"
                                                        class="form-select @error('supplier_id') is-invalid @enderror" required>
                                                        <option value="" selected disabled>{{ __('Select a supplier') }}:</option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @if (old('supplier_id', $product->supplier_id) == $supplier->id) selected="selected" @endif>
                                                                {{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#supplierModal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M12 5l0 14"/><path d="M5 12l14 0"/>
                                                        </svg>
                                                        Add New
                                                    </button>
                                                </div>
                                                @error('supplier_id')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Unit with Add Button -->
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="unit_id">
                                                    {{ __('Unit') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <select name="unit_id" id="unit_id"
                                                        class="form-select @error('unit_id') is-invalid @enderror" required>
                                                        <option value="" selected disabled>{{ __('Select a unit') }}:</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}"
                                                                @if (old('unit_id', $product->unit_id) == $unit->id) selected="selected" @endif>
                                                                {{ $unit->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#unitModal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M12 5l0 14"/><path d="M5 12l14 0"/>
                                                        </svg>
                                                        Add New
                                                    </button>
                                                </div>
                                                @error('unit_id')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="buying_price">
                                                    {{ __('Buying Price') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" step="0.01" id="buying_price" name="buying_price"
                                                    class="form-control @error('buying_price') is-invalid @enderror"
                                                    placeholder="0" value="{{ old('buying_price', $product->buying_price) }}" required>
                                                @error('buying_price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="selling_price" class="form-label">
                                                    {{ __('Selling Price') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" step="0.01" id="selling_price" name="selling_price"
                                                    class="form-control @error('selling_price') is-invalid @enderror"
                                                    placeholder="0" value="{{ old('selling_price', $product->selling_price) }}" required>
                                                @error('selling_price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Enhanced Locations Section -->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Stock Locations') }}</label>
                                                <div id="locationFields">
                                                    @php
                                                        $existingStocks = $product->stocks ?? collect();
                                                        $oldLocations = old('location_ids', []);
                                                        $oldQuantities = old('quantities', []);
                                                    @endphp

                                                    @if(count($oldLocations) > 0)
                                                        @foreach($oldLocations as $index => $locationId)
                                                            <div class="location-item row mb-2">
                                                                <div class="col-md-5">
                                                                    <select name="location_ids[]" class="form-select" required>
                                                                        <option value="" disabled>Select location</option>
                                                                        @foreach($locations as $location)
                                                                            <option value="{{ $location->id }}" {{ $locationId == $location->id ? 'selected' : '' }}>
                                                                                {{ $location->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <input type="number" name="quantities[]" class="form-control" placeholder="Quantity" min="0" step="1" value="{{ $oldQuantities[$index] ?? 0 }}" required>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="btn btn-danger remove-location w-100">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                            <path d="M4 7l16 0"/><path d="M10 11l0 6"/><path d="M14 11l0 6"/><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @elseif($existingStocks->count() > 0)
                                                        @foreach($existingStocks as $stock)
                                                            <div class="location-item row mb-2">
                                                                <div class="col-md-5">
                                                                    <select name="location_ids[]" class="form-select" required>
                                                                        <option value="" disabled>Select location</option>
                                                                        @foreach($locations as $location)
                                                                            <option value="{{ $location->id }}" {{ $stock->location_id == $location->id ? 'selected' : '' }}>
                                                                                {{ $location->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <input type="number" name="quantities[]" class="form-control" placeholder="Quantity" min="0" step="1" value="{{ $stock->quantity }}" required>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="btn btn-danger remove-location w-100">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                            <path d="M4 7l16 0"/><path d="M10 11l0 6"/><path d="M14 11l0 6"/><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="location-item row mb-2">
                                                            <div class="col-md-5">
                                                                <select name="location_ids[]" class="form-select" required>
                                                                    <option value="" selected disabled>Select location</option>
                                                                    @foreach($locations as $location)
                                                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <input type="number" name="quantities[]" class="form-control" placeholder="Quantity" min="0" step="1" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-danger remove-location w-100" style="display: none;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                        <path d="M4 7l16 0"/><path d="M10 11l0 6"/><path d="M14 11l0 6"/><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-secondary mt-2" id="addLocation">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M12 5l0 14"/><path d="M5 12l14 0"/>
                                                    </svg>
                                                    Add Another Location
                                                </button>
                                                <div class="form-text">Assign stock quantities to different locations</div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">
                                                    {{ __('Total Quantity') }}
                                                </label>
                                                <input class="form-control" name="quantity" type="text" readonly
                                                    value="{{ old('quantity', $product->quantity) }}"
                                                    style="color: var(--tblr-secondary); background-color: var(--tblr-bg-surface-secondary); opacity: 1;"/>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="code" class="form-label">
                                                    {{ __('Product Code (SKU)') }}
                                                </label>
                                                <input type="text" id="code" name="code"
                                                    class="form-control @error('code') is-invalid @enderror"
                                                    placeholder="Product code" value="{{ old('code', $product->code) }}">
                                                <div class="form-text">Leave empty to auto-generate</div>
                                                @error('code')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="quantity_alert" class="form-label">
                                                    {{ __('Minimum Stock Alert') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" id="quantity_alert" name="quantity_alert"
                                                    class="form-control @error('quantity_alert') is-invalid @enderror"
                                                    min="0" placeholder="0"
                                                    value="{{ old('quantity_alert', $product->quantity_alert) }}" required>
                                                @error('quantity_alert')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="tax" class="form-label">
                                                    {{ __('Tax (%)') }}
                                                </label>
                                                <input type="number" step="0.01" id="tax" name="tax"
                                                    class="form-control @error('tax') is-invalid @enderror"
                                                    min="0" placeholder="0"
                                                    value="{{ old('tax', $product->tax) }}">
                                                @error('tax')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="tax_type">
                                                    {{ __('Tax Type') }}
                                                </label>
                                                <select name="tax_type" id="tax_type"
                                                    class="form-select @error('tax_type') is-invalid @enderror">
                                                    @foreach (\App\Enums\TaxType::cases() as $taxType)
                                                        <option value="{{ $taxType->value }}"
                                                            @selected(old('tax_type', $product->tax_type) == $taxType->value)>
                                                            {{ $taxType->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tax_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Expiration Date -->
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="expire_date_toggle">
                                                    <input type="checkbox" name="expire_date_toggle" id="expire_date_toggle"
                                                        class="form-check-input me-2" {{ $product->expire_date ? 'checked' : '' }}>
                                                    {{ __('Enable Expiration Date') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6" id="expire_date_field" style="{{ $product->expire_date ? 'display: block;' : 'display: none;' }}">
                                            <div class="mb-3">
                                                <label for="expire_date" class="form-label">
                                                    {{ __('Expire Date') }}
                                                </label>
                                                <input type="date" name="expire_date" id="expire_date"
                                                    class="form-control @error('expire_date') is-invalid @enderror"
                                                    value="{{ old('expire_date', $product->expire_date ? $product->expire_date->format('Y-m-d') : '') }}">
                                                @error('expire_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">
                                                    {{ __('Notes') }}
                                                </label>
                                                <textarea name="notes" id="notes" rows="4"
                                                    class="form-control @error('notes') is-invalid @enderror"
                                                    placeholder="Product notes...">{{ old('notes', $product->notes) }}</textarea>
                                                @error('notes')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"/>
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                                            <path d="M14 4l0 4l-6 0l0 -4"/>
                                        </svg>
                                        {{ __('Update Product') }}
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('products.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"/>
                                        </svg>
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="new_category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="new_category_name" placeholder="Enter category name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveCategoryBtn">Save Category</button>
            </div>
        </div>
    </div>
</div>

<!-- Supplier Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supplierModalLabel">Add New Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="supplierForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="text-center">
                                <img class="img-account-profile rounded-circle mb-2"
                                     src="{{ asset('assets/img/demo/user-placeholder.svg') }}"
                                     alt="" id="supplier-image-preview"
                                     style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 1 MB</div>
                                <input class="form-control" type="file" id="supplier_photo" name="photo" accept="image/*" onchange="previewSupplierImage();">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Supplier Name</label>
                            <input type="text" class="form-control" id="new_supplier_name" name="name" placeholder="Enter supplier name" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Email Address</label>
                            <input type="email" class="form-control" id="new_supplier_email" name="email" placeholder="supplier@example.com" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Shop Name</label>
                            <input type="text" class="form-control" id="new_supplier_shopname" name="shopname" placeholder="Enter shop name" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Phone Number</label>
                            <input type="text" class="form-control" id="new_supplier_phone" name="phone" placeholder="+255 XXX XXX XXX" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Type of Supplier</label>
                            <select class="form-select" id="new_supplier_type" name="type" required>
                                <option value="" selected disabled>Select a type:</option>
                                <option value="individual">Individual</option>
                                <option value="company">Company</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Bank Name</label>
                            <select class="form-select" id="new_supplier_bank_name" name="bank_name" required>
                                <option value="" selected disabled>Select a bank:</option>
                                <option value="CRDB">CRDB</option>
                                <option value="NMB">NMB</option>
                                <option value="NBC">NBC</option>
                                <option value="TCB">TCB</option>
                                <option value="Other Bank">Other Bank</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Holder</label>
                            <input type="text" class="form-control" id="new_supplier_account_holder" name="account_holder" placeholder="Account holder name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Number</label>
                            <input type="text" class="form-control" id="new_supplier_account_number" name="account_number" placeholder="Account number">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label required">Address</label>
                            <textarea id="new_supplier_address" name="address" rows="3" class="form-control" placeholder="Enter full address" required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveSupplierBtn">Save Supplier</button>
            </div>
        </div>
    </div>
</div>

<!-- Unit Modal -->
<div class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unitModalLabel">Add New Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="new_unit_name" class="form-label">Unit Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="new_unit_name" placeholder="e.g., Piece, Kilogram, Meter">
                </div>
                <div class="mb-3">
                    <label for="new_unit_code" class="form-label">Short Code</label>
                    <input type="text" class="form-control" id="new_unit_code" placeholder="e.g., Pcs, Kg, M">
                    <div class="form-text">Optional abbreviation for the unit</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveUnitBtn">Save Unit</button>
            </div>
        </div>
    </div>
</div>

@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
<script>
    // Preview image function
    function previewImage() {
        const file = document.getElementById('image').files[0];
        const preview = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    // Preview supplier image function
    function previewSupplierImage() {
        const file = document.getElementById('supplier_photo').files[0];
        const preview = document.getElementById('supplier-image-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset('assets/img/demo/user-placeholder.svg') }}";
        }
    }

    // Expiration date toggle
    document.getElementById('expire_date_toggle').addEventListener('change', function() {
        const expireDateField = document.getElementById('expire_date_field');
        expireDateField.style.display = this.checked ? 'block' : 'none';
    });

    // Location management
    function updateRemoveButtons() {
        const locationItems = document.querySelectorAll('.location-item');
        locationItems.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-location');
            if (locationItems.length === 1) {
                removeBtn.style.display = 'none';
            } else {
                removeBtn.style.display = 'block';
            }
        });
    }

    document.getElementById('addLocation').addEventListener('click', function() {
        const locationFields = document.getElementById('locationFields');
        const firstItem = locationFields.querySelector('.location-item');
        const newItem = firstItem.cloneNode(true);

        // Clear values
        newItem.querySelector('select').value = '';
        newItem.querySelector('input').value = '';

        locationFields.appendChild(newItem);
        updateRemoveButtons();
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-location') || e.target.closest('.remove-location')) {
            const btn = e.target.classList.contains('remove-location') ? e.target : e.target.closest('.remove-location');
            const locationItem = btn.closest('.location-item');
            const locationFields = document.getElementById('locationFields');

            if (locationFields.children.length > 1) {
                locationItem.remove();
                updateRemoveButtons();
            }
        }
    });

    // Initialize remove buttons
    updateRemoveButtons();

    // Category creation via AJAX
    document.getElementById('saveCategoryBtn').addEventListener('click', function() {
        const categoryName = document.getElementById('new_category_name').value.trim();

        if (!categoryName) {
            showToast('Please enter a category name', 'danger');
            return;
        }

        fetch('{{ route("categories.store.ajax") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name: categoryName })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const select = document.getElementById('category_id');
                const option = document.createElement('option');
                option.value = data.category.id;
                option.textContent = data.category.name;
                option.selected = true;
                select.appendChild(option);

                bootstrap.Modal.getInstance(document.getElementById('categoryModal')).hide();
                document.getElementById('new_category_name').value = '';
                showToast('Category created successfully!', 'success');
            } else {
                showToast(data.message || 'Error creating category', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred while creating the category', 'danger');
        });
    });

    // Supplier creation via AJAX
    document.getElementById('saveSupplierBtn').addEventListener('click', function() {
        const formData = new FormData();
        formData.append('name', document.getElementById('new_supplier_name').value.trim());
        formData.append('email', document.getElementById('new_supplier_email').value.trim());
        formData.append('shopname', document.getElementById('new_supplier_shopname').value.trim());
        formData.append('phone', document.getElementById('new_supplier_phone').value.trim());
        formData.append('type', document.getElementById('new_supplier_type').value);
        formData.append('bank_name', document.getElementById('new_supplier_bank_name').value);
        formData.append('account_holder', document.getElementById('new_supplier_account_holder').value.trim());
        formData.append('account_number', document.getElementById('new_supplier_account_number').value.trim());
        formData.append('address', document.getElementById('new_supplier_address').value.trim());

        const photoFile = document.getElementById('supplier_photo').files[0];
        if (photoFile) {
            formData.append('photo', photoFile);
        }

        // Validate required fields
        const name = document.getElementById('new_supplier_name').value.trim();
        const email = document.getElementById('new_supplier_email').value.trim();
        const shopname = document.getElementById('new_supplier_shopname').value.trim();
        const phone = document.getElementById('new_supplier_phone').value.trim();
        const type = document.getElementById('new_supplier_type').value;
        const bank_name = document.getElementById('new_supplier_bank_name').value;
        const address = document.getElementById('new_supplier_address').value.trim();

        if (!name || !email || !shopname || !phone || !type || !bank_name || !address) {
            showToast('Please fill in all required fields', 'danger');
            return;
        }

        const saveBtn = document.getElementById('saveSupplierBtn');
        const originalText = saveBtn.innerHTML;
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';

        fetch('{{ route("suppliers.store.ajax") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const select = document.getElementById('supplier_id');
                const option = document.createElement('option');
                option.value = data.supplier.id;
                option.textContent = data.supplier.name + ' (' + data.supplier.shopname + ')';
                option.selected = true;
                select.appendChild(option);

                bootstrap.Modal.getInstance(document.getElementById('supplierModal')).hide();
                document.getElementById('supplierForm').reset();
                document.getElementById('supplier-image-preview').src = "{{ asset('assets/img/demo/user-placeholder.svg') }}";
                showToast('Supplier created successfully!', 'success');
            } else {
                showToast(data.message || 'Error creating supplier', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred while creating the supplier', 'danger');
        })
        .finally(() => {
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalText;
        });
    });

    // Unit creation via AJAX
    document.getElementById('saveUnitBtn').addEventListener('click', function() {
        const unitName = document.getElementById('new_unit_name').value.trim();
        const shortCode = document.getElementById('new_unit_code').value.trim();

        if (!unitName) {
            showToast('Please enter a unit name', 'danger');
            return;
        }

        fetch('{{ route("units.store.ajax") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                name: unitName,
                short_code: shortCode
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const select = document.getElementById('unit_id');
                const option = document.createElement('option');
                option.value = data.unit.id;
                option.textContent = data.unit.name + (data.unit.short_code ? ' (' + data.unit.short_code + ')' : '');
                option.selected = true;
                select.appendChild(option);

                bootstrap.Modal.getInstance(document.getElementById('unitModal')).hide();
                document.getElementById('new_unit_name').value = '';
                document.getElementById('new_unit_code').value = '';
                showToast('Unit created successfully!', 'success');
            } else {
                showToast(data.message || 'Error creating unit', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred while creating the unit', 'danger');
        });
    });

    // Toast notification function
    function showToast(message, type = 'success') {
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }

        const toastEl = document.createElement('div');
        toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');

        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        toastContainer.appendChild(toastEl);
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
    }

    // Reset modals when closed
    document.getElementById('categoryModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('new_category_name').value = '';
    });

    document.getElementById('unitModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('new_unit_name').value = '';
        document.getElementById('new_unit_code').value = '';
    });

    document.getElementById('supplierModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('supplierForm').reset();
        document.getElementById('supplier-image-preview').src = "{{ asset('assets/img/demo/user-placeholder.svg') }}";
    });
</script>
@endpushonce
