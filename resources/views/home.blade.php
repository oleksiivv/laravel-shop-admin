@extends('base')

@section('title')
    Home
@endsection

@section('content')
    <center>
    <div class="row" id="plots">
        <div class="col-sm-5 alert alert-dark stats-block">
            <h3>Last month</h3>
            <hr/>
            <ul>
                <li><a href="/api/worker/{{$bestWorker->worker_id}}">Best worker ({{$bestWorker->carts_count}} carts)</a></li>
                <li><a href="/api/shop/{{$mostVisitedShop->shop_id}}">Most visited shop ({{$mostVisitedShop->carts_count}} carts)</a></li>
            </ul>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-6 alert alert-dark stats-block">
            <h3>Current stats</h3>
            <hr/>
            <ul>
                <li><a href="/api/product-manufacturer/{{$bestManufacturer->id}}">Highest rated manufacturer</a></li>
                <li><a href="/api/product-manufacturer/{{$mostPopularManufacturer->manufacturer_id}}">Most popular manufacturer</a></li>
                <li><a href="/api/product-category/{{$mostPopularCategory->category_id}}">Most popular category</a></li>
                <li><a href="/api/product-guarantee/{{$mostPopularGuarantee->guarantee_id}}">Most often sold guarantee</a></li>
            </ul>
        </div>
        <div class="col-sm-6">
            <center><h3>Workers sales</h3></center>
            <canvas id="workers_sales" width="50" height="30"></canvas>
        </div>
        <div class="col-sm-6">
            <center><h3>Workers by shop</h3></center>
            <canvas id="workers_in_shops" width="50" height="50"></canvas>
        </div>
        <br/>
        <div class="col-sm-6">
            <center><h3>Products by manufacturer</h3></center>
            <canvas id="products_in_manufacturer" width="50" height="50"></canvas>
        </div>
        <div class="col-sm-6">
            <center><h3>Products by category</h3></center>
            <canvas id="products_in_category" width="50" height="50"></canvas>
        </div>
        <div class="col-sm-6">
            <center><h3>Manufacturers raiting</h3></center>
            <canvas id="manufacturers_raiting" width="50" height="50"></canvas>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5 alert alert-warning">
            <h2>Top manufacturers</h2>
            <hr/>
            <ol>
            @foreach($sortedManufacturers as $manufacturer)
                    <li><a href="/api/product-manufacturer/{{$manufacturer->id}}">{{$manufacturer->name}}</a></li>
            @endforeach
            </ol>
        </div>
    </div>
        <hr/>
        <br/><br/>
    </center>

    <script>
        var ctxWorkersInShop = document.getElementById('workers_in_shops').getContext('2d');
        var chartWorkersInShop = new Chart(ctxWorkersInShop, {
            type: 'bar',
            data: {
                labels: @json($shopsAddress),
                datasets: [{
                    label: 'Number of workers',
                    data: @json($workersInShopsStats),
                    backgroundColor: 'rgb(252,189,202)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctxWorkersSales = document.getElementById('workers_sales').getContext('2d');
        var chartWorkersSales = new Chart(ctxWorkersSales, {
            type: 'bar',
            data: {
                labels: @json($workers),
                datasets: [{
                    label: 'Number of sales',
                    data: @json($workersSalesStats),
                    backgroundColor: 'rgba(64,140,255,0.2)',
                    borderColor: 'rgb(0,25,161)',
                    borderWidth: 1
                },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctxManufacturersRaiting = document.getElementById('manufacturers_raiting').getContext('2d');
        var chartManufacturersRaiting = new Chart(ctxManufacturersRaiting, {
            type: 'bar',
            data: {
                labels: @json($manufacturers),
                datasets: [{
                    label: 'Raiting',
                    data: @json($manufacturersRaitings),
                    backgroundColor: 'rgb(252,249,189)',
                    borderColor: 'rgb(231,160,29)',
                    borderWidth: 1
                },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctxProductsInCategory = document.getElementById('products_in_category').getContext('2d');
        var chartProductsInCategory = new Chart(ctxProductsInCategory, {
            type: 'bar',
            data: {
                labels: @json($categories),
                datasets: [{
                    label: 'Number of products',
                    data: @json($productsInCategoriesStats),
                    backgroundColor: 'rgba(50,134,0,0.2)',
                    borderColor: 'rgb(128,255,64)',
                    borderWidth: 1
                },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctxProductsInManufacturer = document.getElementById('products_in_manufacturer').getContext('2d');
        var chartProductsInManufacturer = new Chart(ctxProductsInManufacturer, {
            type: 'bar',
            data: {
                labels: @json($manufacturers),
                datasets: [{
                    label: 'Number of products',
                    data: @json($productsInManufacturersStats),
                    backgroundColor: 'rgba(217,111,111,0.2)',
                    borderColor: 'rgb(148,3,29)',
                    borderWidth: 1
                },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

@endsection
