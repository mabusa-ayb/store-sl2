<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>
                    @if($onlineSales != NULL)
                        {{ $onlineSales->count() }}
                    @else
                        0
                    @endif
                </h3>

                <p>Online Sales</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('onlinestore/onlinetransactions/onlinesales') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>
                    @if($sales != NULL)
                        {{ $sales->count() }}
                    @else
                        0
                    @endif
                </h3>

                <p>Physical Sales</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ url('transaction/sales') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>
                    @if($users != NULL)
                        {{ $users->count() }}
                    @else
                        0
                    @endif
                </h3>

                <p>Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('admin/users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    @if($purchases != NULL)
                        {{ $purchases->count() }}
                    @else
                        0
                    @endif
                </h3>

                <p>Purchases</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('transaction/purchase-order?_token=1kh3RBdyPh7m6ug1QWZMR7TyAAH4gVSJgauiWR7Y&status=0&startDate=01-04-2021&endDate=16-04-2021&mode=all') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
