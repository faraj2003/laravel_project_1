<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h2 class="text-xl font-bold mb-4">Add Episode</h2>

        <form method="POST" action="{{ route('episodes.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block">Course</label>
                <select name="course_id" class="border w-full">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block">Title</label>
                <input type="text" name="title" class="border w-full">
            </div>

            <div class="mb-4">
                <label class="block">Content</label>
                <textarea name="content" class="border w-full"></textarea>
            </div>

            <div class="mb-4">
                <label class="block">Order</label>
                <input type="number" name="order" class="border w-full">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2">
                Save Episode
            </button>
        </form>
    </div>
</x-app-layout>
