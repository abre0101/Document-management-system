@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📋 Dashboard — Welcome, {{ Auth::user()->name }}</h2>
        <a href="{{ route('employee.profile.edit') }}" class="btn btn-outline-secondary px-3 py-2">
            👤 Edit Profile
        </a>
    </div>

 


    <div class="mb-4 d-flex flex-wrap gap-3">
        <a href="{{ route('employee.documents.create') }}" class="btn btn-primary px-4 py-2 shadow-sm">📤 Upload Document</a>
        <a href="{{ route('approval_requests.create') }}" class="btn btn-warning px-4 py-2 shadow-sm text-white">✅ Start Approval Request</a>
        <a href="{{ route('collaboration.index') }}" class="btn btn-outline-success px-4 py-2">🤝 Collaborate</a>
        <a href="{{ route('employee.tasks.assigned_to_me') }}" class="btn btn-outline-info px-4 py-2">📋 My Assigned Tasks</a>
    </div>

    
    <div class="row mb-4">
        @foreach ($integrationStatuses as $integration)
            @php
                $badgeColors = [
                    'connected' => 'bg-success',
                    'active' => 'bg-info',
                    'pending' => 'bg-warning text-dark',
                    'disconnected' => 'bg-danger',
                ];
                $color = $badgeColors[$integration->status] ?? 'bg-secondary';
            @endphp

            <div class="col-md-3 mb-2">
                <span class="badge {{ $color }} bg-opacity-75 py-2 px-3 rounded-pill d-inline-flex align-items-center gap-2 shadow-sm">
                    {!! $integration->icon !!} {{ $integration->name }}
                </span>
            </div>
        @endforeach

        <div class="col-md-3 mb-2">
            <span class="badge bg-dark text-light px-4 py-2 rounded-pill shadow">
                🔐 Role: {{ ucfirst(Auth::user()->role->name) }}
            </span>
        </div>
    </div>

 
    <x-section-title icon="📥" title="Received Correspondence" />
    @include('partials.letters.inbox', ['letters' => $receivedLetters])

<form method="GET" action="{{ route('employee.dashboard') }}" class="mb-4">
  <div class="row g-2">
    <div class="col-md-3">
      <input type="text" name="title" placeholder="Title"
             value="{{ request('title') }}" class="form-control" />
    </div>
    <div class="col-md-3">
      <input type="text" name="submitter" placeholder="Submitter"
             value="{{ request('submitter') }}" class="form-control" />
    </div>
    <div class="col-md-2">
      <input type="date" name="upload_date"
             value="{{ request('upload_date') }}" class="form-control" />
    </div>
    <div class="col-md-2">
      <input type="text" name="tag" placeholder="Tag/Keyword"
             value="{{ request('tag') }}" class="form-control" />
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary w-100" type="submit">Filter</button>
    </div>
  </div>
</form>

    <x-section-title icon="📂" title="My Documents" />
    @include('partials.documents.list', ['documents' => $documents])

    <x-section-title icon="📄" title="My Letters (Drafts & Sent)" />
    @include('partials.letters.sent', ['letters' => $sentLetters])

    <x-section-title icon="🔔" title="Pending Approval Requests" />
    @include('partials.approvals.pending', ['pendingApprovals' => $pendingApprovals])

    <x-section-title icon="💬" title="Notifications & Comments" />
    @include('partials.notifications.grouped', ['notificationsGroupedByDocument' => $notificationsGroupedByDocument])

    <x-section-title icon="📅" title="Tasks & Reminders" />
    @include('partials.tasks.list', ['tasks' => $tasks])
</div>

<!-- Hover Shadow Style -->
<style>
    .hover-shadow:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
        cursor: pointer;
        transition: box-shadow 0.2s ease;
    }
</style>
@endsection
