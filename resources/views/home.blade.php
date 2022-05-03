@extends('base')

@section('title')
    Home
@endsection

@section('content')
    <center>
    <h1>Stats</h1>
    <div class="row" id="plots">
        <div class="col-sm-6">
            <center><h3>Workers by shop</h3></center>
            <canvas id="workers_in_shops" width="50" height="50"></canvas>
        </div>
        <div class="col-sm-6">
            <center><h3>Workers stats</h3></center>
            <canvas id="workers_sales" width="50" height="50"></canvas>
        </div>
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
    </div>
    </center>

    <script>
        var ctxWorkersInShop = document.getElementById('workers_in_shops').getContext('2d');
        var chartWorkersInShop = new Chart(ctxWorkersInShop, {
            type: 'line',
            data: {
                labels: @json($shopsAddress),
                datasets: [{
                    label: 'Number of workers',
                    data: @json($workersInShopsStats),
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 159, 64, 1)'
                    ],
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
            type: 'line',
            data: {
                labels: @json($workers),
                datasets: [{
                    label: 'Number of sales',
                    data: @json($workersSalesStats),
                    backgroundColor: [
                        'rgba(64,140,255,0.2)'
                    ],
                    borderColor: [
                        'rgb(0,25,161)'
                    ],
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

        var ctxManufacturersRaiting = document.getElementById('manufacturers_raiting').getContext('2d');
        var chartManufacturersRaiting = new Chart(ctxManufacturersRaiting, {
            type: 'bar',
            data: {
                labels: @json($manufacturers),
                datasets: [{
                    label: 'Raiting',
                    data: @json($manufacturersRaitings),
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
            type: 'line',
            data: {
                labels: @json($categories),
                datasets: [{
                    label: 'Number of products',
                    data: @json($productsInCategoriesStats),
                    backgroundColor: [
                        'rgba(50,134,0,0.2)'
                    ],
                    borderColor: [
                        'rgb(128,255,64)'
                    ],
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
            type: 'line',
            data: {
                labels: @json($manufacturers),
                datasets: [{
                    label: 'Number of products',
                    data: @json($productsInManufacturersStats),
                    backgroundColor: [
                        'rgba(134,0,47,0.2)'
                    ],
                    borderColor: [
                        'rgb(255,118,187)'
                    ],
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
