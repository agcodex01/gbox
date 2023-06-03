<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="font-weight-bold m-0">Components Info</h6>
        <button type="button" wire:click="add" class="btn btn-sm btn-primary">Add +</button>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            @foreach ($items as $key => $item)
                <div class="col-md-6">
                    <div class="form-group">
                        {{-- <label for="board">Component</label> --}}
                        <select name="board_id" id="board"
                            class="form-control  @error('board_id') is-invalid @enderror"
                            wire:model="items.{{ $key }}.id" name="items[{{ $key }}][id]"
                            >
                            <option value="0" selected>Select a component</option>
                            @foreach ($components as $id => $name)
                                <option value="{{ $id }}"> {{ $name }}</option>
                            @endforeach
                        </select>
                        @error('board_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        {{-- <label for="estimate">Qty</label> --}}
                        <input type="number" class="form-control  @error('estimate') is-invalid @enderror"
                            id="estimate" aria-describedby="estimateHelp"   wire:model="items.{{ $key }}.qty" name="items[{{ $key }}][qty]">
                        @error('estimate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-sm"><i class="fa text-danger fa-trash"></i></button>
                </div>
            @endforeach

        </div>
    </div>
</div>
