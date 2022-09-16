<div class="d-flex justify-content-between">
    <div class="d-flex align-items-center">
        <label for="paginate" class="text-nowrap ml-2 mb-0">Per Page</label>
        <select wire:model="perPage" name="paginate" id="paginate" class="form-control form-control-sm mx-2">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
        </select>
    </div>
    <div class="d-flex align-items-center">
        <div>
            <input wire:model.debounce.1s="searchTerm" type="search" class="form-control form-control-sm" placeholder="Search....">
        </div>

        <div>
            @can($canCreate)
                <a href="{{$route}}" class="btn btn-sm btn-dark btn-rounded waves-effect waves-light mx-2">
                    <i class="bx bx-plus label-icon "></i>Create
                </a>
            @endcan

        </div>
    </div>
</div>
