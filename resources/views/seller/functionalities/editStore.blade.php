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
                                @isset($store)
                                <div class="d-flex flex-row justify-content-center gap-2 align-items-center">
                                    <img src="{{ asset($store->image) }}" alt="profile_image"
                                         class="w-100 border-radius-lg shadow-sm avatar-xl">
                                        <h6 class="text-white text-capitalize ps-3">{{$store->name}}: Store Products</h6>
                                </div>

                                <div class="d-flex flex-row justify-content-center gap-2">
                                    <a class="nav-link text-white bg-gradient-dark rounded-2"
                                       href="{{ route('redirect-view-store-orders', ['store_id'=>$store->store_id]) }}">
                                        <div class="text-white text-center d-flex align-items-center justify-content-center" style="margin: 0 auto">
                                            <i class="material-icons opacity-10">receipt_long</i>
                                        </div>
                                        <span class="nav-link-text ms-1">View Orders</span>
                                    </a>

                                    <a class="nav-link text-white bg-gradient-dark rounded-2"
                                       href="{{ route('redirect-edit-store', ['store_id'=>$store->store_id]) }}">
                                        <div class="text-white text-center d-flex align-items-center justify-content-center" style="margin: 0 auto">
                                            <i class="material-icons opacity-10">receipt_long</i>
                                        </div>
                                        <span class="nav-link-text ms-1">Edit Store</span>
                                    </a>

                                    <a class="nav-link text-white bg-gradient-dark rounded-2"
                                       href="{{ route('redirect-create-product', ['store_id'=>$store->store_id]) }}">
                                        <div class="text-white text-center d-flex align-items-center justify-content-center" style="margin: 0 auto">
                                            <i class="material-icons opacity-10">receipt_long</i>
                                        </div>
                                        <span class="nav-link-text ms-1">Create new</span>
                                    </a>
                                </div>
                                @endisset
                            </div>
                        </div>

                        @isset($products)

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
                                                Category</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Quantity</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Price</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Added at</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset($product->path1) }}" alt="Store image"
                                                                 class="avatar avatar-sm me-3 border-radius-lg">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{$product->name}}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{$product->description}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="bg-gradient-dark text-white rounded-3 p-2">{{ ucfirst($product->category_id[0]) }}</div>

                                                </td>
                                                {{--<td>
                                                    <p class="text-xs font-weight-bold mb-0">Manager</p>
                                                    <p class="text-xs text-secondary mb-0">Organization</p>
                                                </td>--}}
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-success">{{$product->quantity}}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{$product->price}}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{$product->created_at}}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('view-edit-product', ['product_id'=>$product->product_id]) }}"
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
