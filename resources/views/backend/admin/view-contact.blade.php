@extends('backend.admin.layout.app')

@section('content')
    <h1>Contact List</h1>
    
    @if ($contacts->isEmpty())
        <p>No contacts found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Received Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->full_name }}</td>
                            <td>
                                <div class="email-box">
                                    {{ $contact->email }}
                                </div>
                            </td>
                            <td>{{ $contact->subject }}</td>
                            <td>
                                <div class="message-box">
                                    {{ Str::limit($contact->message, 50) }} <!-- Limit message to 50 chars for display -->
                                </div>
                            </td>
                            <td>{{ $contact->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

@section('styles')
    <style>
        /* Style for table to make it responsive */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        /* Box design for email and message */
        .email-box, .message-box {
            word-wrap: break-word;  /* To avoid the text overflow */
            white-space: normal;    /* Allow text to wrap naturally */
            max-width: 250px;       /* Ensure a max width for email */
            overflow: hidden;       /* Hide overflow text */
            text-overflow: ellipsis; /* Show ellipsis for overflow */
        }

        .message-box {
            max-width: 300px; /* Limit message width */
        }

        /* Optional: Add some padding and border for better design */
        .table td, .table th {
            padding: 12px;
            vertical-align: middle;
        }

        /* Optional: Add hover effect for rows */
        tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
@endsection
