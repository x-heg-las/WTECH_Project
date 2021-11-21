<div>
    <div class="row"><input  class="w-100" wire:model="quantity" type="text" wire:input="changeInDatabase"  value="{{ $quantity }}"></div>
    <div class="row">
        <button class="col-6 btn border border-dark" wire:click="decrement">-</button>
        <button class="col-6 btn border border-dark" wire:click="increment">+</button>
    </div>
</div>
