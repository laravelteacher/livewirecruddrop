<form>
    <!-- edit data by this form amount-->
<input type="hidden" wire:model="category_id">
  <div class="form-group mb-3">
  <label for="categoryDescription">Type:</label>
      <select name="cars" id="cars"  wire:model="type">
  <option value="volvo">write something</option>
  <option value="food">food</option>
  <option value="shopping">shopping</option>
  <option value="entertainment">entertainment</option>
  <option value="travel">travel</option>
</select>
  <div class="form-group mb-3">
    <label for="categoryDescription">Description:</label>
      <textarea class="form-control @error('description') is-invalid @enderror" id="categoryDescription" wire:model="description" placeholder="Enter Description"></textarea>
        @error('description') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="form-group mb-3">
    <label for="categoryName">Amount:</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="categoryName" placeholder="Enter Amount" wire:model="amount">
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="d-grid gap-2">
    <button wire:click.prevent="update()" class="btn btn-success btn-block">Save</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
  </div>
</form>