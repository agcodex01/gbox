<div class="dropdown">
    <a href="#" class="btn btn-sm btn-link" id="{{ $id }}" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
       {{ $label }}
    </a>
    <div class="dropdown-menu" aria-labelledby="{{ $id }}">
        <h6 class="dropdown-header">Other Details</h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item disabled" href="#"><strong>Type: </strong>
            {{ $board->type }}
        </a>
        <a class="dropdown-item disabled" href="#"><strong>Stocks: </strong>
            {{ $board->stocks }}
        </a>
        <a class="dropdown-item disabled" href="#"><strong>Dimension: </strong>
            {{ $board->width }} X
            {{ $board->heigth }}
        </a>
    </div>
</div>
