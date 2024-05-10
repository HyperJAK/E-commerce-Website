<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebarSeller activePage='seller-dashboard'></x-navbars.sidebarSeller>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Today's Money</p>
                                @isset($dailyIncome)
                                    <h4 class="mb-0">{{Auth::user()->currency_symbol}}{{number_format($dailyIncome)}}</h4>
                                @endisset
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{--<p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than
                                lask week</p>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Today's Users</p>

                                @isset($todayClients)
                                    <h4 class="mb-0">{{number_format(count($todayClients))}}</h4>
                                @endisset
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{--<p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than
                                lask month</p>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">New Clients</p>

                                @isset($todayNewClients)
                                    <h4 class="mb-0">{{number_format(count($todayNewClients))}}</h4>
                                @endisset
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{--<p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than
                                yesterday</p>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Sales</p>
                                @isset($totalSales)
                                    <h4 class="mb-0">{{Auth::user()->currency_symbol}}{{number_format($totalSales)}}</h4>
                                @endisset
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{--<p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than
                                yesterday</p>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Daily Sales</h6>
                            {{--<p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today's
                                sales. </p>--}}
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                {{--<p class="mb-0 text-sm"> campaign sent 2 days ago </p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2  ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 "> Monthly Sales </h6>
                            {{--<p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in this month's
                                sales. </p>--}}
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                {{--<p class="mb-0 text-sm"> updated 4 min ago </p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-4 mt-4 mb-3">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Completed Tasks</h6>
                            --}}{{--<p class="text-sm ">Last Campaign Performance</p>--}}{{--
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                --}}{{--<p class="mb-0 text-sm">just updated</p>--}}{{--
                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>
            <div class="row mb-4">
                <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h6>Events</h6>
                                    <p class="text-sm mb-0">
                                        <i class="fa fa-check text-info" aria-hidden="true"></i>
                                        {{--<span class="font-weight-bold ms-1">30 done</span> this month--}}
                                    </p>
                                </div>
                                <div class="col-lg-6 col-5 my-auto text-end">
                                    <div class="dropdown float-lg-end pe-4">
                                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                           aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-secondary"></i>
                                        </a>
                                        <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5"
                                            aria-labelledby="dropdownTable">
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a>
                                            </li>
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Another
                                                    action</a></li>
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Something
                                                    else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Store</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Event name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Start Date</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            End Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($allStoreEvents)

                                        @foreach($allStoreEvents as $event)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset($event->store->image) }}"
                                                                 class="avatar avatar-sm me-3" alt="xd">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{$event->store->name}}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">{{$event->name}}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold">{{$event->start_date}}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-xs font-weight-bold">{{$event->end_date}}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>Best Selling Products</h6>
                            <p class="text-sm">
                                {{--<i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                <span class="font-weight-bold">24%</span> this month--}}
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="timeline timeline-one-side">
                                @isset($bestSelling)
                                    @foreach($bestSelling as $product)
                                        <div class="timeline-block mb-3">
                                            <span class="timeline-step">
                                                <img src="{{ asset($product->path1) }}" alt="product picture" style="width: 100%;">
                                            </span>
                                            <div class="timeline-content">
                                                <h6 class="text-dark text-sm font-weight-bold mb-0">{{$product->name}}
                                                </h6>
                                                <div class="d-flex flex-row gap-2"></div>
                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{Auth::user()->currency_symbol}}{{number_format($product->price)}}
                                                </p>
                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Quantity: {{number_format($product->quantity)}}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
        <script src="{{ asset('material/assets') }}/js/plugins/chartjs.min.js"></script>
        <script>
            @isset($dailyOrders)
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["M", "T", "W", "T", "F", "S", "S"],
                    datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "rgba(255, 255, 255, .8)",
                        data: [{{count($dailyOrders[0])}}, {{count($dailyOrders[1])}}, {{count($dailyOrders[2])}}, {{count($dailyOrders[3])}}, {{count($dailyOrders[4])}}, {{count($dailyOrders[5])}}, {{count($dailyOrders[6])}}],
                        maxBarThickness: 6
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
            @endisset

            @isset($monthlyOrders)
            var ctx2 = document.getElementById("chart-line").getContext("2d");

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Sales",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255, 255, 255, .8)",
                        pointBorderColor: "transparent",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderWidth: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        data: [{{count($monthlyOrders[0])}}, {{count($monthlyOrders[1])}}, {{count($monthlyOrders[2])}}, {{count($monthlyOrders[3])}}, {{count($monthlyOrders[4])}}, {{count($monthlyOrders[5])}}, {{count($monthlyOrders[6])}}, {{count($monthlyOrders[7])}}, {{count($monthlyOrders[8])}}, {{count($monthlyOrders[9])}}, {{count($monthlyOrders[10])}}, {{count($monthlyOrders[11])}}],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });

            @endisset

            /*var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

            new Chart(ctx3, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Mobile apps",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255, 255, 255, .8)",
                        pointBorderColor: "transparent",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderWidth: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#f8f9fa',
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });*/



        </script>
    @endpush
</x-layout>
