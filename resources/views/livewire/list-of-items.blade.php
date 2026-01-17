<div class="ml-[51px]">
   @if ($entity === 'category')
        <div>
            @foreach ($values as $value)
                <livewire:editable_input :old_value="$value->name" :new_value="$value->name" role="category_settings" :edit_mode="false"
                    :editable="$entity !== 'currency'" :deletable="true" :deleted="isset($value->deleted_at)" wire:key="category-{{ $value->id }}" />
            @endforeach
        </div>
   @endif
</div>
