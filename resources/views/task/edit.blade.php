@extends('layouts.app')

@section('title', 'Edit Task')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
    .border-red{
        border: 1px solid red;
        border-radius: 0.25rem;
    }

    .select2.select2-container.select2-container--default .select2-selection--multiple{
        padding: 4px 10px 14px 2px;
        border: 1px solid #e5e7eb;
        border-radius: 0.25rem;
    }
    </style>
@endpush

@section('content')
    <h1 class="font-600 text-[28px] py-5 border-b border-solid border-[#D2D6DC] mb-5 text-[#161E2E]">Edit Task</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="status" class="block font-500 text-[#001F3E] text-[16px] pb-1">Assign To</label>
            <select name="user_ids[]" id="user_ids" multiple class="block w-full ">
                <option value="">Select users</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        {{ in_array($user->id, $task->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

       

        <div class="mb-4">
            <label for="title" class="block font-500 text-[#001F3E] text-[16px] pb-1">Title</label>
            <input type="text" name="title" id="title"
                class="border rounded w-full p-2 focus:outline-none @error('title') border-red-500 @enderror" value="{{ old('title', $task->title) }}">
            @error('title')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block font-500 text-[#001F3E] text-[16px] pb-1">Description</label>
            <textarea name="description" id="description"
                class="border rounded w-full p-2 focus:outline-none @error('description') border-red-500 @enderror">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block font-500 text-[#001F3E] text-[16px] pb-1">Status</label>
            <select name="status" id="status"
                class="border rounded w-full p-2 focus:outline-none @error('status') border-red-500 @enderror">
                <option value="">Select a status</option>
                <option value="To Do" {{ old('status',  $task->status) === 'To Do' ? 'selected' : '' }}>To Do</option>
                <option value="Work In Progress" {{ old('status',  $task->status) === 'Work In Progress' ? 'selected' : '' }}>In Progress
                </option>
                <option value="Under Review" {{ old('status',  $task->status) === 'Under Review' ? 'selected' : '' }}>Under Review</option>
                <option value="Complete" {{ old('status',  $task->status) === 'Complete' ? 'selected' : '' }}>Complete</option>
            </select>
            @error('status')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="due_date" class="block font-500 text-[#001F3E] text-[16px] pb-1">Due Date</label>
            <input type="date" name="due_date" id="due_date"
                class="border rounded w-full p-2 focus:outline-none @error('due_date',) border-red-500 @enderror"
                value="{{ old('due_date', $task->due_date) }}">
            @error('due_date')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="p-2 text-white bg-blue-500 rounded">Update Task</button>
    </form>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize Select2
            $('#user_ids').select2({
                placeholder: "Select User",
                allowClear: true
            });

            // Check for validation errors on page load
            @error('user_ids')
                $('#user_ids').next('.select2-container').addClass('border-red');
            @enderror

            // Optional: If you want to remove the error class on change
            $('#user_ids').on('change', function() {
                $(this).next('.select2-container').removeClass('border-red');
            });
        });
    </script>
@endpush
