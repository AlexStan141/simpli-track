<form action="{{ route('note.store', ['bill_id' => $bill_id]) }}" method="POST"
    class="flex flex-col gap-2 mt-5 ml-2 items-start">
    @csrf
    <label for="message">Add a note here</label>
    <textarea name="message" id="message" class="w-[75%] h-[100px] mt-2"></textarea>
    <input type="hidden" name="bill_id" value="{{ $bill_id }}"></input>
    @error('message')
        <p>{{ $message }}</p>
    @enderror
    <button class="py-3 px-[93px] bg-loginblue text-white rounded-[80px]" type="submit">Save</button>
</form>
