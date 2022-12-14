<div>
    <title>{{ $title }}</title>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link">Approval</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/preport">Producting Report</a>
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
        <div class="row">
            <nav class="navbar navbar-light bg-light">
                <a type="button" class="btn btn-primary btn-sm" href="{{ url()->previous()}}"> <<</a>
                <div class="row">
                    <div class="container-fluid">
                        <form class="d-flex" action="{{url('/booking/search')}}" method="GET">
                            <input class="form-control me-2" name="searchItem" type="date" placeholder="Search by date" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="container-fluid">
                        <form class="d-flex" action="{{url('/booking/search')}}" method="GET">
                            <input class="form-control me-2" name="searchItem" type="text" placeholder="Search" aria-label="Search with Ref number, Team leader, producer, program or location">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container">
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
                @if ($bookings->count() > 0)
                    @foreach ($bookings as $booking)
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
                                    href="{{ url('/reportview', $booking->id) }}">
                                    <button type="button" class="btn btn-sm btn-primary" style="text-decoration: none">View</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="20" style="text-align: center"><small>Search by date</small></td>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        {{ $bookings->links() }}
    </div>
</div>
