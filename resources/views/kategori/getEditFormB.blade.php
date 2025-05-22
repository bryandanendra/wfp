<h3>Update Category</h3>
<div class="form-group mb-3">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="ename" name="name" aria-describedby="name"
           placeholder="Enter Category Name" value="{{ $data->name }}">
    <small id="name" class="form-text text-muted">Please write down Category Name here.</small>
</div>
<div class="form-group mb-3">
    <label for="description">Description</label>
    <textarea class="form-control" id="edescription" name="description" rows="3" placeholder="Enter Category Description">{{ $data->description }}</textarea>
</div>
<button type="button" onclick="saveDataUpdate({{ $data->id }})" class="btn btn-primary">Submit</button> 