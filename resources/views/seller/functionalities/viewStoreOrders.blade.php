<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebarSeller activePage="seller-tables"></x-navbars.sidebarSeller>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Orders"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex flex-row align-items-center justify-content-between">
                                @isset($store)
                                    <div class="d-flex flex-row justify-content-center gap-2 align-items-center">
                                        <img src="{{ asset($store->image) }}" alt="profile_image"
                                             class="w-100 border-radius-lg shadow-sm avatar-xl">
                                        <h6 class="text-white text-capitalize ps-3">{{$store->name}}: Store Products</h6>
                                    </div>

                                    <div class="d-flex flex-row justify-content-center gap-2">
                                        <a class="nav-link text-white bg-gradient-dark rounded-2"
                                           href="{{ route('view-edit-store', ['store_id'=>$store->store_id]) }}">
                                            <div class="text-white text-center d-flex align-items-center justify-content-center" style="margin: 0 auto">
                                                <i class="material-icons opacity-10">receipt_long</i>
                                            </div>
                                            <span class="nav-link-text ms-1">Go Back</span>
                                        </a>

                                    </div>
                                @endisset
                            </div>
                        </div>

                        @isset($orders)

                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Description</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Price</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Quantity</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Added at</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <div class="text-white text-center d-flex align-items-center justify-content-center" style="margin: 0 auto">
                                                                <i class="material-icons opacity-10">receipt_long</i>
                                                            </div>
                                                        </div>

                                                            <div class="dropdown">
                                                                <a class="btn badge badge-sm bg-gradient-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    {{$order->order_status_id}}
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a class="dropdown-item" href="{{ route('order-status-change', ['order_id'=>$order->order_id, 'store_id'=>$store->store_id, 'status'=>1]) }}">Pending</a>
                                                                    <a class="dropdown-item" href="{{ route('order-status-change', ['order_id'=>$order->order_id, 'store_id'=>$store->store_id, 'status'=>2]) }}">Confirmed</a>
                                                                    <a class="dropdown-item" href="{{ route('order-status-change', ['order_id'=>$order->order_id, 'store_id'=>$store->store_id, 'status'=>3]) }}">Shipped</a>
                                                                    <a class="dropdown-item" href="{{ route('order-status-change', ['order_id'=>$order->order_id, 'store_id'=>$store->store_id, 'status'=>4]) }}">Delivered</a>
                                                                    <a class="dropdown-item" href="{{ route('order-status-change', ['order_id'=>$order->order_id, 'store_id'=>$store->store_id, 'status'=>5]) }}">Cancelled</a>
                                                                </div>
                                                            </div>


                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0">{{$order->description}}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="bg-gradient-dark text-white rounded-3 p-2">${{ number_format($order->price) }}</div>

                                                </td>
                                                <td>
                                                    <div class="bg-gradient-dark text-white rounded-3 p-2">{{ number_format($order->quantity) }}</div>

                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{$order->order_placement_date}}</span>
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        @endisset


                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
