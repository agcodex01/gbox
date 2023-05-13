<div>
    <div wire:loading>
        Updating products...
    </div>
    <div wire:loading.remove>

        <div class="d-flex justify-content-between align-items-end mb-3">
            List Items
            <button class="btn btn-sm btn-outline-primary" wire:click="addItem">Add Item</button>
        </div>
        <div class="row mb-2">
            <div class="col-md-4">
                Product
            </div>
            <div class="col-md-3">
                Quantity
            </div>
            <div class="col-md-2">
                Price
            </div>
            <div class="col-md-2">
                Sub Total
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach ($items as $key => $item)
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control  @error("items.$key.productId") is-invalid @enderror"
                            wire:model="items.{{ $key }}.productId" name="items[{{ $key }}][productId]">
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} </option>
                            @endforeach
                        </select>
                        @error("items.$key.productId")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="number" class="form-control   @error("items.$key.quantity") is-invalid @enderror"
                            aria-describedby="nameHelp" wire:model="items.{{ $key }}.quantity"
                            name="items[{{ $key }}][quantity]">
                        @error("items.$key.quantity")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    {{ $item['price'] }}
                </div>
                <div class="col-md-2">
                    {{ $item['subTotal'] }}
                </div>
                <div class="col-md-1">
                    <button type="button" wire:click="remove({{ $key }})" class="btn btn-danger"><i
                            class="fa fa-trash"></i></button>
                </div>
            @endforeach
            <hr class="my-2 w-100">
            <div class="col-md-9">
                Total
            </div>
            <div class="col-md-3">
                {{ $total }}
            </div>
        </div>
    </div>
</div>
