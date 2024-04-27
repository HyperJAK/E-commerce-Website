<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebarSeller activePage="seller-tables"></x-navbars.sidebarSeller>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Create Product'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset($store->image) }}" alt="profile_image"
                                 class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    @isset($store)
                    <div class="col-auto my-auto">
                        <div class="h-100">

                                <h5 class="mb-1">
                                    {{$store->name}}
                                </h5>

                            <p class="mb-0 font-weight-normal text-sm">
                                {{$store->description}}
                            </p>

                        </div>
                    </div>
                    @endisset

                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Store form filler</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <form method='POST' action='{{ route('seller-add-product') }}' enctype="multipart/form-data">
                            @csrf

                            <!-- Hidden input field for user ID -->
                            <input type="hidden" name="store_id" value="{{ $store->store_id }}">

                            <div class="row">
                                <div class="d-flex flex-row justify-content-center gap-2">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border border-2 p-2" placeholder="Your store name here">
                                        @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Category</label>
                                        <input type="text" name="category" class="form-control border border-2 p-2" placeholder="Your store main category here">
                                        @error('category')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-center gap-2">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-control border border-2 p-2" placeholder="How many to add">
                                        @error('quantity')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Price</label>
                                        <input type="number" name="price" class="form-control border border-2 p-2" placeholder="Price">
                                        @error('price')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>



                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">Description</label>
                                    <textarea class="form-control border border-2 p-2"
                                              placeholder=" Say something about your store" id="floatingTextarea2" name="description"
                                              rows="4" cols="50"></textarea>
                                    @error('description')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12 d-flex flex-column">
                                    <label for="path1">Image:</label>
                                    <input type="file" name="path1" id="path1">
                                </div>
                                <div class="mb-3 col-md-12 d-flex flex-column">
                                    <label for="path2">Image:</label>
                                    <input type="file" name="path2" id="path2">
                                </div>
                                <div class="mb-3 col-md-12 d-flex flex-column">
                                    <label for="path3">Image:</label>
                                    <input type="file" name="path3" id="path3">
                                </div>
                                <div class="mb-3 col-md-12 d-flex flex-column">
                                    <label for="path4">Image:</label>
                                    <input type="file" name="path4" id="path4">
                                </div>


                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
