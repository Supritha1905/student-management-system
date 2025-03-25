@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Student List</h1>
        <a href="{{ route('students.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Student</a>
    </div>
    
    <div class="mb-4">
        <div class="flex">
            <input type="text" id="searchInput" placeholder="Search by name or course..." 
                   class="flex-grow px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ request('search') }}">
        </div>
    </div>
    
    <div class="mb-6">
        <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
            @csrf
            <div class="flex-1">
                <input type="file" 
                       name="csv_file" 
                       accept=".csv" 
                       required
                       class="block w-full text-sm text-gray-500 
                              file:mr-4 file:py-2 file:px-4 
                              file:rounded-lg file:border-0 
                              file:text-sm file:font-semibold 
                              file:bg-blue-50 file:text-blue-700 
                              hover:file:bg-blue-100">
                <p class="mt-1 text-sm text-gray-500">CSV format: name, email, phone, course</p>
            </div>
            <button type="submit" class="bg-green-600 text-gray-500 px-4 py-2 rounded hover:bg-green-700">
                Import Students
            </button>
        </form>
    </div>
    
    <div id="studentsTable">
        @include('partials.students_table', ['students' => $students])
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(() => {
                const searchValue = this.value;
                
                fetch(`{{ route('students.search') }}?search=${encodeURIComponent(searchValue)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('studentsTable').innerHTML = html;
                })
                .catch(error => console.error('Error:', error));
            }, 100); // 300ms delay to prevent too many requests
        });
    });
</script>
@endpush
@endsection