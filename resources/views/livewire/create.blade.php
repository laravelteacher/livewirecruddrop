<form>
    <!-- create new data by this form -->
	<div class="form-group mb-3">
  <label for="categoryDescription">Type:</label>
      <select wire:model="type">
  <option value="volvo">write something</option>
  <option value="food">food</option>
  <option value="shopping">shopping</option>
  <option value="entertainment">entertainment</option>
  <option value="travel">travel</option>
</select>
	  @error('amount') <span class="text-danger">{{ $message }}</span>@enderror
</div>

<div class="form-group mb-3">
  <label for="categoryDescription">Description:</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="categoryDescription" wire:model="description" placeholder="Enter Description"></textarea>
      @error('description') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group mb-3">
  <label for="categoryName">Amount:</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="categoryName" placeholder="Enter amount" wire:model="amount">
      @error('name') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="d-grid gap-2">
  <button wire:click.prevent="store()" class="btn btn-success btn-block">Save</button>
</div>
</form>

