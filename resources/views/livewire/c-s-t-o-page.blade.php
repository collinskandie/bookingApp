<title>{{$title}}</title>
<div class="container-fluid">
    <div class="div">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page">Approval</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/preport">Producting Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/assign">Assign </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Admin Panel </a>
                        </li>
                    </ul>
                </div>
                @include('logout')
            </div>
        </nav>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="ctopage">Pending Approval</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/ctoapproved">Approved</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/ctorejected">Rejected</a>
        </li>

    </ul>
</div>
<div class="container">
    <div class="row">
        @if (Session::get('Success'))
            <div class="alert alert-success">
                {{ Session::get('Success') }}
            </div>
        @endif
        @if (Session::get('Failed'))
            <div class="alert alert-danger">
                {{ Session::get('Failed') }}
            </div>
        @endif

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Ref</th>
                    <th scope="col">Date</th>
                    <th scope="col">User</th>
                    <th scope="col">Recording Time</th>
                    <th scope="col">Team Leader</th>
                    <th scope="col">Approval</th>
                    <th scope="col">Modify</th>

                </tr>
            </thead>
            <tbody>
                @if ($userBoking->count() > 0)
                    @foreach ($userBoking as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->date_booked }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->recording_time }}</td>
                            <td>{{ $booking->shift_leader }}</td>
                            <td>
                                @if ($booking->approval_level3 == 'Pending')
                                    <span class="badge bg-secondary">Awaiting your approval</span>
                                @elseif ($booking->approval_level3 == 'Approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($booking->approval_level3 == 'Rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn-group" role="group"
                                    href="{{ url('/cstoapprovelinePview', $booking->id) }}">
                                    <button type="button" class="btn btn-sm btn-primary">Approve</button>
                                </a>
                                <a class="btn-group" role="group"
                                    href="{{ url('/ctorejectlineview', $booking->id) }}">
                                    <button type="button" class="btn btn-sm btn-danger">Reject</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="20" style="text-align: center"><small>No entries yet</small></td>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- editing facility bookings --}}
    <div class="conta">
        <h5>
            Editing Facilities awaiting approval
        </h5>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Ref</th>
                <th scope="col">Suit</th>
                <th scope="col">User</th>
                <th scope="col">Editing Date</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Approval</th>
                <th scope="col">Modify</th>

            </tr>
        </thead>
        <tbody>
            @if ($userBooking->count() > 0)
                @foreach ($userBooking as $fbooking)
                    <tr>
                        <td>{{ $fbooking->id }}</td>
                        <td>{{ $fbooking->suitName }}</td>
                        <td>{{ $fbooking->name }}</td>
                        <td>{{ $fbooking->editing_date }}</td>
                        <td>{{ $fbooking->start_time }}</td>
                        <td>{{ $fbooking->endtime_time }}</td>
                        <td>
                            @if ($fbooking->approval_level3 == 'Pending')
                                <span class="badge bg-secondary">Awaiting your approval</span>
                            @elseif ($fbooking->approval_level3 == 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($fbooking->approval_level3 == 'Rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn-group" role="group"
                                href="{{ url('/cstoapprovelineview', $fbooking->id) }}">
                                <button type="button" class="btn btn-sm btn-primary">Approve</button>
                            </a>
                            <a class="btn-group" role="group" href="{{ url('/cstorejectlineview', $fbooking->id) }}">
                                <button type="button" class="btn btn-sm btn-danger">Reject</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="20" style="text-align: center"><small>No entries yet</small></td>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
