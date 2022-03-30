<x-master-index>
    @section('content')
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        @if($totalCustomers > 0)
                        <!-- Customers Card -->
                        <div class="col-md-4">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Customers <span> | Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$totalCustomers}}</h6>
                                            <span class="text-success small pt-1 fw-bold">{{round($increase)}}%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Customers Card -->
                        @endif

                        <!-- Today's Card -->
                        @if ($totalCustomersWithCollectionDatetoday > 0)
                        <div class="col-md-4">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Collection Today <span> | Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$totalCustomersWithCollectionDatetoday}}</h6>
                                            {{-- <span class="text-success small pt-1 fw-bold">{{$increase}}%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Today's Card -->
                        @endif

                        <!-- Next Tomorrow Card -->
                        @if ($totalCustomersWithCollectionDatetomorrow > 0)
                        <div class="col-md-4">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Collection Tomorrow <span> | Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$totalCustomersWithCollectionDatetomorrow}}</h6>
                                            {{-- <span class="text-success small pt-1 fw-bold">{{$increase}}%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Tomorrow Card -->
                        @endif

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
               <div class="col-lg-4 col-md-4">

                    <!-- Today customers table -->
                    @if(count($todayCustomers) > 0)
                    <div class="card">

                        {{-- <div class="filter">
                          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                              <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                          </ul>
                        </div> --}}

                        <div class="card-body pb-0">
                          <h5 class="card-title">Collection Today <span>| Customers</span></h5>

                            <table class="table table-borderless overflow-auto">
                                <tbody>
                                    @foreach ($todayCustomers as $todayCustomer)
                                    <tr>
                                        <td><a href="{{route('show.customer', $todayCustomer)}}">{{$todayCustomer->fullName}}</a></td>
                                        <td>0{{$todayCustomer->contact}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                      </div>
                      @endif
                   <!-- End Today customers table -->

                </div><!-- End Right side columns -->

                @isset($customers)
                <!-- Customers Table -->
                <div class="col-12 col-md-12">
                    <div class="card recent-sales overflow-auto">

                       <div class="filter">
                           <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                           <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                               <li class="dropdown-header text-start">
                                   <h6>Filter</h6>
                               </li>

                               <li><a class="dropdown-item" href="{{route('customers.created.today')}}">Today</a></li>
                               <li><a class="dropdown-item" href="{{route('customers.created.by.month')}}">This Month</a></li>
                               <li><a class="dropdown-item" href="{{route('customers.created.by.year')}}">This Year</a></li>
                           </ul>
                      </div>

                        <div class="card-body">
                            <h5 class="card-title">Customers <span>| Profile</span></h5>

                            <table class="table table-borderless datatable">
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
                                    <td><a href="{{route('show.customer', $customer)}}">{{$customer->fullName}}</td>
                                    <td>0{{$customer->contact}}</a></td>
                                    <td>{{$customer->address}}</td>
                                    @if($customer->collectionDate == date_format(now(), 'Y-m-d'))
                                    <td><a href="{{route('show.customer', $customer)}}"><span class="badge bg-danger">{{$customer->collectionDate}}</span></a></td>
                                    @elseif($customer->collectionDate < date_format(now(), 'Y-m-d'))
                                        <td><a href="{{route('show.customer', $customer)}}"><span class="badge bg-primary">{{$customer->collectionDate}}</span></a></td>
                                    @else
                                        <td><a href="{{route('show.customer', $customer)}}"><span class="badge bg-success">{{$customer->collectionDate}}</span></a></td>
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

                        </div>

                    </div>
                </div><!-- End Customers Table -->
                @endisset

            </div>
        </section>
    @endsection
</x-master-index>
