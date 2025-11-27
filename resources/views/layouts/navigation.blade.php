<nav x-data="{ open: false }" class="border-b border-white py-[5px] bg-loginblue">
    <div class="max-w-auto">
        <div class="flex justify-between items-center">
            <div class="flex">
                <a href="/dashboard">
                    <img src="{{ asset('images/Logo.png') }}" alt="logo" width="462" height="90">
                </a>
            </div>
            <div class="flex gap-[12px] items-center" x-data="{ open: false }">
                <div class="bg-yellow p-[8px] flex gap-[16px] text-white items-center">
                    <div class="w-[32px] h-[32px] flex justify-end">
                        <div class="w-[8px] h-[8px] bg-green-500 rounded-full"></div>
                    </div>
                    <div class="flex flex-col gap-[4px]">
                        <span>{{ Auth::user()->first_name . ' ' . substr(Auth::user()->last_name, 0, 1) }}</span>
                        <span>{{ Auth::user()->phone }}</span>
                    </div>
                </div>
                <div class="bg-red-500 w-[60px] h-[60px] rounded-full mr-[26px] relative flex justify-center items-center" x-on:click="open = !open">
                    <p class="text-xl font-bold text-white">{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}</p>
                    <div class="absolute bg-loginblue w-max p-5 top-[4rem] left-[-15px] z-10 text-white border border-white" x-show="open">
                        <div>
                            <a href="{{ route('profile.edit') }}">Profile</a>
                        </div>
                        <form action="{{ route('auth.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
