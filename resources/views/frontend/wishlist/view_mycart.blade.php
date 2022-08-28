@extends('frontend.main_master')
@section('content')
@section('title')
  MyCart Page
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>MyCart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="my-wishlist-page">
			<div class="row ">
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                    
                                    <th class="cart-description item">Image</th>
                                    <th class="cart-product-name item"> Name</th>
                                    <th class="cart-edit item">Color</th>
                                    <th class="cart-qty item">Size</th>
                                    <th class="cart-sub-total item">Quantity</th>
                                    <th class="cart-total last-item">SubTotal</th>
                                    <th class="cart-romove item">Remove</th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody id="cartPage">
                               

                            </tbody>
                        </table>
                    </div>
                </div>	
                </div>		
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.body-content -->
    <br>
    @include('frontend.body.brands')

</div>


@endsection
