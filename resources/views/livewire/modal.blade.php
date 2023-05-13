<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $header }} {{ $entityId}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="rounded-circle bg-danger pt-3 mx-auto mb-2" style="width:54px;height:54px;">
                    <i class="fa fa-trash text-white"></i>
                </div>
                <p>Are you sure to delete this customer? This proccess cannot be undo.</p>
            </div>
            <div class="modal-footer">
                <form id="delete-form" action="{{ route('customers.destroy', '') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
