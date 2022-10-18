<p>Town/Upazila *</p>
<select id="upazila_id" name="upazila_id" class="form-select js-example-basic-single">
    <option value="">Select a Upazila</option>
    @foreach ($upazilas as $upazila)
        <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
    @endforeach
</select>

