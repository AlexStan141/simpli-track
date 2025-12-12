<div>
    <p class="mt-5 ml-2 font-bold">{{ $bill_message }}</p>
    <div class="flex gap-2">
        <button class="py-3 px-[93px] bg-loginblue text-white rounded-[80px] mt-5 ml-2" type="submit"
            wire:click="edit_note">Edit</button>
        <form action="{{ route('note.destroy', ['bill_id' => $bill_id]) }}" method="POST" class="mb-0">
            @csrf
            @method('DELETE')
            <button class="py-3 px-[93px] bg-red-500 text-white rounded-[80px] mt-5 ml-2" type="submit">Delete</button>
        </form>
    </div>
</div>
