@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#EA624C]">Student List</h1>
        <a href="{{ route('students.create') }}" 
   class="border border-[#EA624C] text-white px-4 py-2 rounded bg-[#EA624C]">
   Add Student
</a>

    </div>
    
    <div class="mb-4 relative w-full">
        <!-- Search Icon -->
        <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-[#813F98]">
            <i class="fa-solid fa-search"></i>
        </span>
    
        <!-- Input Field -->
        <input type="text" id="searchInput" placeholder="Search by name or course..."
               class="w-full pl-10 pr-4 py-2 border border-[#813F98] text-gray-800 rounded-lg 
                      focus:outline-none focus:ring-2  focus:ring-[#813F98]"
               value="{{ request('search') }}">
    </div>
    
    <div class="mb-4">
        <div class="border border-gray-300 rounded-md p-3 bg-white shadow-sm">
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data"
                  class="flex flex-col sm:flex-row items-start sm:items-center gap-2 text-sm">
                @csrf
    
                <!-- File input + format text -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 flex-1 w-full">
                    <input type="file" name="csv_file" accept=".csv" required
                           class="block text-sm text-gray-700
                                  file:mr-3 file:py-1.5 file:px-3
                                  file:rounded file:border-0
                                  file:bg-[#813F98]/20 file:text-[#813F98]
                                  hover:file:bg-[#813F98]/30">
    
                    <p class="text-sm text-gray-500 whitespace-nowrap">
                        CSV format: name, email, phone, course
                    </p>
                </div>
    
                <!-- Import Button -->
                <button type="submit"
                        class="bg-[#813F98]/20 hover:bg-[#813F98]/30 text-[#813F98] px-3 py-1.5 rounded transition whitespace-nowrap">
                    Import Students
                </button>
            </form>
        </div>
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