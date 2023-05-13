<div class="form-group">
    <label for="customer">Customer</label>
    <select name="customer_id" id="customer" class="form-control @error('customer_id') is-invalid @enderror" wire:change="onSelect($event.target.value)">
        <option value="0" selected>Select a customer</option>
        @foreach ($customers as $id => $name)
            <option value="{{ $id }}" @if ($customer?->id == $id) selected @endif> {{ $name }}
            </option>
        @endforeach
    </select>
    <small>Note: You cannot change it after you create a product.</small>
    @error('customer_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
