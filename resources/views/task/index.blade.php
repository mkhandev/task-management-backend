@extends('layouts.app')

@section('title', 'Task List')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@section('content')

    <div class="flex">
        <form method="GET" action="{{ route('tasks.index') }}">
            <div class="border border-solid border-[#D2D6DC] flex gap-3 p-4 w-full rounded">
                <input type="text" name="title" value="{{ $filters['title'] ?? '' }}" class="p-2 rounded focus:outline-none"
                    placeholder="Task Name" />

                <select name="user_id" id="user_id" class="p-2 bg-white text-[#a6a4a4] focus:outline-none rounded">
                    <option value="">Assign User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"  {{ isset($filters['user_id']) && $user->id == $filters['user_id'] ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="due_date" id="due_date" value="{{ $filters['due_date'] ?? '' }}" autocomplete="off" placeholder="Due Date"
                    class="w-full p-2 border rounded focus:outline-none" value="{{ old('due_date') }}">

                <input type="submit" name="submit" value="Search"
                    class="bg-[#42ad7e] text-[#FFF] text-[16px] px-3 py-2 rounded" />
            </div>
        </form>
    </div>

    <h1 class="font-semibold text-[28px] py-5 border-b border-solid border-[#D2D6DC] mb-5 text-[#161E2E]">Task List</h1>

    <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <div class="w-full">
            <div class="bg-[#E9E9FF] py-3 px-4 rounded-[6px] mb-5 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="font-semibold text-[16px] text-[#252F3F]">To Do</div>
                    <div
                        class="rounded-[50%] min-w-[30px] min-h-[30px] px-[4px] box-border flex items-center justify-center bg-white font-bold text[12px] text-[#161919]">
                        {{ isset($tasksByStatus['To Do']) ? count($tasksByStatus['To Do']) : 0 }}
                    </div>
                </div>
                <div><a href="{{ route('tasks.create') }}"><img class="w-[11px]" src="{{ asset('images/plus.png') }}"></a>
                </div>
            </div>

            @if (isset($tasksByStatus['To Do']) && count($tasksByStatus['To Do']) > 0)
                <div class="border border-dotted border-[#AEAEAE] p-3 rounded-[9px]">
                    @foreach ($tasksByStatus['To Do'] as $toDoTask)
                        <div class="p-4 mb-5 bg-white rounded-[9px] shadow-md">
                            <div class="mb-3 font-semibold text-[16px] text-[#000000]">{{ $toDoTask->title }}</div>
                            <div class="border-b border-solid border-[#E3E6EA] mb-[10px]">
                                <div class="mb-[10px] font-normal text-[#2E3033] text-[16px]">{{ $toDoTask->description }}
                                </div>
                                <img class="w-[75px] mb-[10px]" src="{{ asset('images/group.png') }}">
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="rounded-[8px] bg-[#FA8223] flex gap-2 py-[8px] px-[10px]">
                                    <img class="w-[18px]" src="{{ asset('images/button.png') }}">
                                    <span class="text-[#FFF] text-[14px] font-normal">
                                        @php
                                            $date = \Carbon\Carbon::parse($toDoTask->due_date);
                                        @endphp
                                        {{ $date->format('j F, Y') }}
                                    </span>
                                </div>
                                <div class="relative flex gap-2 dropdown">
                                    <a href="#" class="optionsButton text-[20px] font-bold">...</a>

                                    <div
                                        class="absolute right-0 hidden w-32 mt-2 bg-white border rounded-md shadow-lg dropdownMenu">
                                        <a href="{{ route('tasks.edit', $toDoTask->id) }}"
                                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Edit</a>

                                        <form action="{{ route('tasks.destroy', $toDoTask->id) }}" method="POST"
                                            class="delete-form" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-gray-200 delete-button">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="w-full">
            <div class="bg-[#fffbe9] py-3 px-4 rounded-[6px] mb-5 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="font-semibold text-[16px] text-[#252F3F]">Work In Progress</div>
                    <div
                        class="rounded-[50%] min-w-[30px] min-h-[30px] px-[4px] box-border flex items-center justify-center bg-white font-bold text[12px] text-[#161919]">
                        {{ isset($tasksByStatus['Work In Progress']) ? count($tasksByStatus['Work In Progress']) : 0 }}
                    </div>
                </div>
                <div><a href="{{ route('tasks.create') }}"><img class="w-[11px]" src="{{ asset('images/plus.png') }}"></a>
                </div>
            </div>

            @if (isset($tasksByStatus['Work In Progress']) && count($tasksByStatus['Work In Progress']) > 0)
                <div class="border border-dotted border-[#AEAEAE] p-3 rounded-[9px]">
                    @foreach ($tasksByStatus['Work In Progress'] as $workTask)
                        <div class="p-4 mb-5 bg-white rounded-[9px] shadow-md">
                            <div class="mb-3 font-semibold text-[16px] text-[#000000]">{{ $workTask->title }}</div>
                            <div class="border-b border-solid border-[#E3E6EA] mb-[10px]">
                                <div class="mb-[10px] font-normal text-[#2E3033] text-[16px]">{{ $workTask->description }}
                                </div>
                                <img class="w-[75px] mb-[10px]" src="{{ asset('images/group.png') }}">
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="rounded-[8px] bg-[#42ad7e] flex gap-2 py-[8px] px-[10px]">
                                    <img class="w-[18px]" src="{{ asset('images/button.png') }}">
                                    <span class="text-[#FFF] text-[14px] font-normal">
                                        @php
                                            $date = \Carbon\Carbon::parse($workTask->due_date);
                                        @endphp
                                        {{ $date->format('j F, Y') }}
                                    </span>
                                </div>
                                <div class="relative flex gap-2 dropdown">
                                    <a href="#" class="optionsButton text-[20px] font-bold">...</a>

                                    <div
                                        class="absolute right-0 hidden w-32 mt-2 bg-white border rounded-md shadow-lg dropdownMenu">
                                        <a href="{{ route('tasks.edit', $workTask->id) }}"
                                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Edit</a>

                                        <form action="{{ route('tasks.destroy', $workTask->id) }}" method="POST"
                                            class="delete-form" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-gray-200 delete-button">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="w-full">
            <div class="bg-[#fedcc7] py-3 px-4 rounded-[6px] mb-5 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="font-semibold text-[16px] text-[#252F3F] uppercase">Under Review</div>
                    <div
                        class="rounded-[50%] min-w-[30px] min-h-[30px] px-[4px] box-border flex items-center justify-center bg-white font-bold text[12px] text-[#161919]">
                        {{ isset($tasksByStatus['Under Review']) ? count($tasksByStatus['Under Review']) : 0 }}
                    </div>
                </div>
                <div><a href="{{ route('tasks.create') }}"><img class="w-[11px]" src="{{ asset('images/plus.png') }}"></a>
                </div>
            </div>

            @if (isset($tasksByStatus['Under Review']) && count($tasksByStatus['Under Review']) > 0)
                <div class="border border-dotted border-[#AEAEAE] p-3 rounded-[9px]">
                    @foreach ($tasksByStatus['Under Review'] as $underReview)
                        <div class="p-4 mb-5 bg-white rounded-[9px] shadow-md">
                            <div class="mb-3 font-semibold text-[16px] text-[#000000]">{{ $underReview->title }}</div>
                            <div class="border-b border-solid border-[#E3E6EA] mb-[10px]">
                                <div class="mb-[10px] font-normal text-[#2E3033] text-[16px]">
                                    {{ $underReview->description }}</div>
                                <img class="w-[75px] mb-[10px]" src="{{ asset('images/group.png') }}">
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="rounded-[8px] bg-[#8c6afc] flex gap-2 py-[8px] px-[10px]">
                                    <img class="w-[18px]" src="{{ asset('images/button.png') }}">
                                    <span class="text-[#FFF] text-[14px] font-normal">
                                        @php
                                            $date = \Carbon\Carbon::parse($underReview->due_date);
                                        @endphp
                                        {{ $date->format('j F, Y') }}
                                    </span>
                                </div>
                                <div class="relative flex gap-2 dropdown">
                                    <a href="#" class="optionsButton text-[20px] font-bold">...</a>

                                    <div
                                        class="absolute right-0 hidden w-32 mt-2 bg-white border rounded-md shadow-lg dropdownMenu">
                                        <a href="{{ route('tasks.edit', $underReview->id) }}"
                                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Edit</a>

                                        <form action="{{ route('tasks.destroy', $underReview->id) }}" method="POST"
                                            class="delete-form" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-gray-200 delete-button">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="w-full">
            <div class="bg-[#e3f5e4] py-3 px-4 rounded-[6px] mb-5 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="font-semibold text-[16px] text-[#252F3F] uppercase">Complete</div>
                    <div
                        class="rounded-[50%] min-w-[30px] min-h-[30px] px-[4px] box-border flex items-center justify-center bg-white font-bold text[12px] text-[#161919]">
                        {{ isset($tasksByStatus['Complete']) ? count($tasksByStatus['Complete']) : 0 }}
                    </div>
                </div>
                <div><a href="{{ route('tasks.create') }}"><img class="w-[11px]"
                            src="{{ asset('images/plus.png') }}"></a></div>
            </div>

            @if (isset($tasksByStatus['Complete']) && count($tasksByStatus['Complete']) > 0)
                <div class="border border-dotted border-[#AEAEAE] p-3 rounded-[9px]">
                    @foreach ($tasksByStatus['Complete'] as $completeTask)
                        <div class="p-4 mb-5 bg-white rounded-[9px] shadow-md">
                            <div class="mb-3 font-semibold text-[16px] text-[#000000]">{{ $completeTask->title }}</div>
                            <div class="border-b border-solid border-[#E3E6EA] mb-[10px]">
                                <div class="mb-[10px] font-normal text-[#2E3033] text-[16px]">
                                    {{ $completeTask->description }}</div>
                                <img class="w-[75px] mb-[10px]" src="{{ asset('images/group.png') }}">
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="rounded-[8px] bg-[#FA8223] flex gap-2 py-[8px] px-[10px]">
                                    <img class="w-[18px]" src="{{ asset('images/button.png') }}">
                                    <span class="text-[#FFF] text-[14px] font-normal">
                                        @php
                                            $date = \Carbon\Carbon::parse($completeTask->due_date);
                                        @endphp
                                        {{ $date->format('j F, Y') }}
                                    </span>
                                </div>
                                <div class="relative flex gap-2 dropdown">
                                    <a href="#" class="optionsButton text-[20px] font-bold">...</a>

                                    <div
                                        class="absolute right-0 hidden w-32 mt-2 bg-white border rounded-md shadow-lg dropdownMenu">
                                        <a href="{{ route('tasks.edit', $completeTask->id) }}"
                                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Edit</a>

                                        <form action="{{ route('tasks.destroy', $completeTask->id) }}" method="POST"
                                            class="delete-form" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-gray-200 delete-button">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>


@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.optionsButton').click(function(event) {
                event.preventDefault();
                const dropdownMenu = $(this).siblings('.dropdownMenu');

                // Hide all other dropdown menus and show the current one
                $('.dropdownMenu').not(dropdownMenu).addClass('hidden');
                dropdownMenu.toggleClass('hidden');
            });

            // Close the dropdown when clicking outside of it
            $(document).click(function(event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $('.dropdownMenu').addClass('hidden');
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    }
                });
            });
        });

        $(document).ready(function() {
            $("#due_date").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
@endpush
