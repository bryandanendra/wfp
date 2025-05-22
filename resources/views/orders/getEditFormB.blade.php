<h3>Quick Update Order</h3>
<div class="form-group mb-3">
    <label for="tanggal">Tanggal</label>
    <input type="date" class="form-control" id="etanggal" name="tanggal" value="{{ $data->tanggal }}">
</div>
<div class="form-group mb-3">
    <label for="status">Status</label>
    <select class="form-control" id="estatus" name="status">
        <option value="new" {{ $data->status == 'new' ? 'selected' : '' }}>New</option>
        <option value="process" {{ $data->status == 'process' ? 'selected' : '' }}>Process</option>
        <option value="done" {{ $data->status == 'done' ? 'selected' : '' }}>Done</option>
        <option value="cancel" {{ $data->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
    </select>
</div>
<div class="form-group mb-3">
    <label for="type">Type</label>
    <select class="form-control" id="etype" name="type">
        <option value="dinein" {{ $data->type == 'dinein' ? 'selected' : '' }}>Dine In</option>
        <option value="takeaway" {{ $data->type == 'takeaway' ? 'selected' : '' }}>Take Away</option>
    </select>
</div>
<div class="form-group mb-3">
    <label for="member_id">Member</label>
    <select class="form-control" id="emember_id" name="member_id">
        <option value="">-- Pilih Member --</option>
        @foreach($members as $member)
            <option value="{{ $member->id }}" {{ $data->member_id == $member->id ? 'selected' : '' }}>
                {{ $member->name }}
            </option>
        @endforeach
    </select>
</div>
<button type="button" onclick="saveDataUpdate({{ $data->id }})" class="btn btn-primary">Submit</button> 