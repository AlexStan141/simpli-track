<div class="flex flex-col items-center">
    <h3 class="ml-[51px] mt-[49px] mb-[49px] font-inter text-[20px] h-[15px]">User List</h3>
    <table class="mb-[49px] mr-[25px] ml-[25px] w-[1000px]">
        <thead>
            <tr class="bg-formgray w-full h-[56px] border">
                <td class="pl-4">First Name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>Role</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="h-[56px] border">
                    <td class="pl-4">{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
