@php
    $current_route = Route::currentRouteName();
@endphp

<aside id="sidebar"
    class="z-30 w-64 transition-transform transform bg-white shadow-md  md:relative md:top-0 md:translate-x-0 sidebar-hidden md:block">
    <div class="p-4">
        <nav>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('tasks.index') }}"
                        class="flex gap-1 p-2 text-[16px] text-[#090E18] font-normal hover:bg-[#f3f4f6]  @if ($current_route == 'tasks.index') bg-[#f3f4f6] @endif">
                        <img src="{{ asset('images/dashboard.png') }}"> Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('tasks.create') }}"
                        class="flex gap-1 p-2 text-[16px] text-[#090E18] font-normal hover:bg-[#f3f4f6]  @if ($current_route == 'tasks.create') bg-[#f3f4f6] @endif">
                        <img src="{{ asset('images/task.png') }}"> Add Task
                    </a>
                </li>
                <li>
                    {{-- <a href="{{ route('tasks.index') }}" class="flex gap-1 p-2 text-[16px] hover:bg-[#f3f4f6]  text-[#090E18] font-normal">
                        <img src="{{ asset('images/turn-off.png') }}" class="w-[25px]">
                        Logout
                    </a> --}}

                    <form action="{{ route('logout') }}" method="POST" class="flex gap-1 items-center w-full hover:bg-[#f3f4f6]">
                        @csrf
                        <img src="{{ asset('images/turn-off.png') }}" class="w-[25px] h-[25px] ml-[8px]">
                        <button type="submit"
                            class="block p-2 text-[16px]   text-[#090E18] font-normal">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
