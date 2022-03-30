@extends('components.master-index')

@isset($customers)
@section('content')
    <div class="pagetitle">
        <h1>Measurement</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item">Profile</li>
                <li class="breadcrumb-item active">Measurement</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">All <span> | Customers</span></h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">Full name</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Address</th>
                                <th scope="col">Collection date</th>
                                <th scope="col">Fee charge GHS</th>
                                <th scope="col">Balance GHS</th>
                                <th scope="col">Action</th>
                                <th scope="col">SMS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td><a href="{{route('customer.selection', $customer)}}">{{$customer->fullName}}</a></td>
                                    <td>0{{$customer->contact}}</td>
                                    <td>{{$customer->address}}</td>
                                    @if($customer->collectionDate == date_format(now(), 'Y-m-d'))
                                        <td><a href="{{route('customer.selection', $customer)}}"><span class="badge bg-danger">{{$customer->collectionDate}}</span></a></td>
                                    @elseif($customer->collectionDate < date_format(now(), 'Y-m-d'))
                                        <td><a href="{{route('customer.selection', $customer)}}"><span class="badge bg-primary">{{$customer->collectionDate}}</span></a></td>
                                    @else
                                        <td><a href="{{route('customer.selection', $customer)}}"><span class="badge bg-success">{{$customer->collectionDate}}</span></a></td>
                                    @endif
                                    <td>{{$customer->charge}}</td>
                                    <td>{{$customer->balance}}</td>
                                    <td>
                                        <form method="POST" action="{{route('delete.customer', $customer)}}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="badge bg-danger">Delete</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{route('subscription', $customer)}}">Pick up</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@endisset
