<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="py-3 px-4 text-left">Photo</th>
                <th class="py-3 px-4 text-left">Name</th>
                <th class="py-3 px-4 text-left">Email</th>
                <th class="py-3 px-4 text-left">Phone</th>
                <th class="py-3 px-4 text-left">Course</th>
                <th class="py-3 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @forelse ($students as $student)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-3 px-4">
                    @if ($student->profile_photo)
                        <img src="{{ asset('storage/' . $student->profile_photo) }}" alt="Profile Photo" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-500">No photo</span>
                        </div>
                    @endif
                </td>
                <td class="py-3 px-4">{{ $student->name }}</td>
                <td class="py-3 px-4">{{ $student->email }}</td>
                <td class="py-3 px-4">{{ $student->phone }}</td>
                <td class="py-3 px-4">{{ $student->course }}</td>
                <td class="py-3 px-4">
                    <div class="flex space-x-2">
                        <a href="{{ route('students.edit', $student->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="py-4 px-4 text-center">No students found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($students->hasPages())
<div class="mt-4">
    {{ $students->links() }}
</div>
@endif