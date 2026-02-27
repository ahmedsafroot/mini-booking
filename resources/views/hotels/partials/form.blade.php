<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name"
           class="form-control"
           value="{{ old('name', $hotel->name ?? '') }}">
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label>City</label>
    <input type="text" name="city"
           class="form-control"
           value="{{ old('city', $hotel->city ?? '') }}">
    @error('city')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label>Country</label>
    <input type="text" name="country"
           class="form-control"
           value="{{ old('country', $hotel->country ?? '') }}">
    @error('country')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label>Rating (1-5)</label>
    <input type="number" min="1" max="5"
           name="rating"
           class="form-control"
           value="{{ old('rating', $hotel->rating ?? '') }}">
    @error('rating')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
