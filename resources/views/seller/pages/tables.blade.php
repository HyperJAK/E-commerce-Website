<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebarSeller activePage="seller-tables"></x-navbars.sidebarSeller>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="text-white text-capitalize ps-3">My stores</h6>

                                    <a class="nav-link text-white bg-gradient-dark rounded-2"
                                       href="{{ route('redirect-create-store') }}">
                                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                            <i class="material-icons opacity-10">receipt_long</i>
                                        </div>
                                        <span class="nav-link-text ms-1">Create new</span>
                                    </a>
                                </div>
                            </div>

                            @isset($stores)

                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Info</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Categories</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Status</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Deployed</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($stores as $store)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset($store->image) }}" alt="Store image"
                                                                 class="avatar avatar-sm me-3 border-radius-lg">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{$store->name}}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{$store->description}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                    <td>
                                                        <div class="d-flex flex-row justify-content-start gap-2">
                                                            @php
                                                                $counter = 0;
                                                            @endphp
                                                            @if ($store->categories)
                                                                @foreach($store->categories as $category)
                                                                    @if ($counter < 3)
                                                                        <div class="bg-gradient-dark text-white rounded-3 p-2">{{ ucfirst($category) }}</div>
                                                                        @php
                                                                            $counter++;
                                                                        @endphp
                                                                    @else
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                    </td>
                                                {{--<td>
                                                    <p class="text-xs font-weight-bold mb-0">Manager</p>
                                                    <p class="text-xs text-secondary mb-0">Organization</p>
                                                </td>--}}
                                                <td class="align-middle text-center text-sm">
                                                    <a href="{{route('store-status-change', ['store_id'=>$store->store_id])}}" class="btn badge badge-sm bg-gradient-success">{{$store->status == 1?'Open':'Pending approval'}}</a>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{$store->created_at}}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('specificStoreDashboard', ['store_id'=>$store->store_id]) }}"
                                                       class="text-white rounded-3 btn bg-gradient-dark">
                                                        Open Dashboard
                                                    </a>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('view-edit-store', ['store_id'=>$store->store_id]) }}"
                                                       class="text-secondary font-weight-bold text-xs"
                                                       data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
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
