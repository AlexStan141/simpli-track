<div class="ml-[51px]">
    @if ($values->count() == 0)
        <div></div>
    @else
        @foreach ($values as $value)
            <div class="flex gap-2">
                <li>{{ $value->name }}</li>
                @if (!$value->deleted_at)
                    <button wire:click="deleteItem({{ $value->id }})" class="text-red-500">Delete</button>
                @else
                    <button wire:click="restoreItem({{ $value->id }})" class="text-green-500">Restore</button>
                @endif
            </div>
        @endforeach
    @endif
</div>
