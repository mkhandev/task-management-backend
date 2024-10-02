@if (session('success'))
    <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="w-6 h-6 text-green-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 5.652a1 1 0 011.415 1.415l-8 8a1 1 0 01-1.415 0l-4-4a1 1 0 011.415-1.415l3.293 3.293 7.293-7.293z" />
            </svg>
        </span>
    </div>
@endif

@if (session('error'))
    <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="w-6 h-6 text-red-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 5.652a1 1 0 011.415 1.415l-8 8a1 1 0 01-1.415 0l-4-4a1 1 0 011.415-1.415l3.293 3.293 7.293-7.293z" />
            </svg>
        </span>
    </div>
@endif
