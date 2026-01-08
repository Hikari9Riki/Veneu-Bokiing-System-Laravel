@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ $user->name }}</h1>
            <p class="text-gray-600">Here are your upcoming venue reservations.</p>
        </div>
        <a href="{{ route('reservations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow">
            + Book a Venue
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm whitespace-nowrap">
                <thead class="uppercase tracking-wider border-b-2 border-gray-200 bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-500">Date Request</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-500">Venue</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-500">Booking Date</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-500">Time</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-500">Reason</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-500">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($reservations as $res)
                        <tr class="hover:bg-gray-50 transition">
                            
                            <td class="px-6 py-4 text-gray-500">
                                {{ $res->created_at->format('d M Y') }}
                                <div class="text-xs text-gray-400">{{ $res->created_at->format('h:i A') }}</div>
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $res->venue->name ?? 'Unknown Venue' }}
                                <div class="text-xs text-gray-400">{{ $res->venue->location ?? '' }}</div>
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ \Carbon\Carbon::parse($res->date)->format('D, d M Y') }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs font-bold">
                                    {{ \Carbon\Carbon::parse($res->startTime)->format('h:i A') }}
                                </span>
                                <span class="text-gray-400 mx-1">to</span>
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs font-bold">
                                    {{ \Carbon\Carbon::parse($res->endTime)->format('h:i A') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-gray-600 truncate max-w-xs" title="{{ $res->reason }}">
                                {{ $res->reason ?? 'N/A' }}
                            </td>

                            <td class="px-6 py-4">
                                @if($res->status === 'Approved')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span> Approved
                                    </span>
                                @elseif($res->status === 'Pending')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-semibold text-yellow-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-yellow-600"></span> Pending
                                    </span>
                                @elseif($res->status === 'Rejected')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span> Rejected
                                    </span>
                                @else
                                    <span class="text-gray-500">{{ $res->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <p class="text-lg">No upcoming reservations found.</p>
                                <a href="{{ route('reservations.create') }}" class="text-blue-600 hover:underline text-sm mt-2">
                                    Create your first booking
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection