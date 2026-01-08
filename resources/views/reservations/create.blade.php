@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Make a Reservation</h2>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        {{-- Kuliyyah --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Select Kuliyyah</label>
            <select id="kuliyyah" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Choose Kuliyyah --</option>
                @foreach($venues->pluck('kuliyyah')->unique() as $kuliyyah)
                    <option value="{{ $kuliyyah }}">{{ $kuliyyah }}</option>
                @endforeach
            </select>
        </div>

        {{-- Venue --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Select Venue</label>
            <select name="venueID" id="venue" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Choose a Venue --</option>

                @foreach($venues as $venue)
                    <option 
                        value="{{ $venue->venueID }}"
                        data-kuliyyah="{{ $venue->kuliyyah }}"
                        class="hidden"
                    >
                        {{ $venue->name }} (Cap: {{ $venue->capacity }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Reservation Date</label>
            <input type="date" name="date" min="{{ date('Y-m-d') }}"
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500" required>
        </div>

        {{-- Time --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Start Time</label>
                <input type="time" name="startTime" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">End Time</label>
                <input type="time" name="endTime" class="w-full border p-2 rounded" required>
            </div>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">Cancel</a>
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Confirm Booking
            </button>
        </div>
    </form>
</div>

{{-- JS --}}
<script>
document.getElementById('kuliyyah').addEventListener('change', function () {
    const selected = this.value;
    const venueSelect = document.getElementById('venue');

    venueSelect.value = '';

    [...venueSelect.options].forEach(option => {
        if (!option.dataset.kuliyyah) return;

        option.classList.toggle(
            'hidden',
            option.dataset.kuliyyah !== selected
        );
    });
});
</script>
@endsection
