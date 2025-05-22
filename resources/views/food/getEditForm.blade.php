<h3>Update Food</h3>
<form method="POST" action="{{ route('food.update', $data->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="name"
               placeholder="Enter Food Name" value="{{ $data->name }}">
    </div>
    <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Food Description">{{ $data->description }}</textarea>
    </div>
    <div class="form-group mb-3">
        <label for="nutritions_fact">Nutritions Fact</label>
        <textarea class="form-control" id="nutritions_fact" name="nutritions_fact" rows="3" placeholder="Enter Nutritions Fact">{{ $data->nutritions_fact }}</textarea>
    </div>
    <div class="form-group mb-3">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{ $data->price }}">
    </div>
    <div class="form-group mb-3">
        <label for="category_id">Category</label>
        <select class="form-control" id="category_id" name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $data->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form> 