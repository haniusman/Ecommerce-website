@extends('layouts.front_layout.front_design')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                 @include('layouts.front_layout.front_sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    @if(Session::has('update_message'))

                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! session('update_message') !!}</strong>
                        </div>
                    @endif
                    @if(Session::has('error'))

                        <div class="alert alert-warning alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! session('error') !!}</strong>
                        </div>
                    @endif
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{asset('images/products/medium/'.$productDetails->image)}}" alt=""  class="mainImage"/>
                               <!--  <h3>ZOOM</h3>-->
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        @foreach($productAltImages as $image)
                                        <a href=""><img src="{{asset('images/products/small/'.$image->image)}}" alt="" class="changeImage" style="width: 80px; cursor: pointer;"></a>
                                            @endforeach
                                    </div>

                                </div>

                                <!-- Controls -->
                                <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <form name="addtocartForm" id="addtocartForm" action="{{url('add-cart')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                                <input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
                                <input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
                                <input type="hidden" name="product_color" value="{{$productDetails->product_color}}">
                                <input type="hidden" name="price" id="price" value="{{$productDetails->price}}">

                                <div class="product-information"><!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                <h2>{{$productDetails->product_name}}</h2>
                                <p>Code: {{$productDetails->product_code}}</p>
                                <p>
                                    <select id="selSize" name="size">
                                        <option value="">Select size</option>
                                        @foreach($productDetails->attributes as $sizes)
                                            <option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
                                            @endforeach
                                    </select>
                                </p>
                                <img src="images/product-details/rating.png" alt="" />
                                <span>
									<span id="getPrice">PKR {{$productDetails->price}}</span>
									<label>Quantity:</label>
									<input id ="" name="quantity" type="number" value="1" min="1" max="10"/>

                                    @if($total_stock > 0)
									<button type="submit" class="btn btn-fefault cart" id="cartButton">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
                                        @endif
								</span>
                                <p><b>Availability:</b><span id="Availability" >@if($total_stock > 0) In Stock @else Out Of Stock @endif</p>
                                <p><b>Condition:</b> New</p></span>
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->
                            </form>

                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li><a href="#description" data-toggle="tab">Description</a></li>
                                <li><a href="#care" data-toggle="tab">Material and care</a></li>
                                <li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active in" id="description" >
                                <p>{{$productDetails->description}}</p>
                            </div>

                            <div class="tab-pane fade" id="care" >
                                <p>{{$productDetails->care}}</p>
                            </div>

                            <div class="tab-pane fade" id="delivery" >
                                <p>100% original products<br>
                                CAsh on delivery</p>
                            </div>

                        </div>
                    </div><!--/category-tab-->

                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $count = 1; ?>
                                @foreach($relatedProducts->chunk(3) as $chunk)
                                <div <?php if($count == 1){ ?> class="item active" <?php } else{?> class="item" <?php }?> >
                                    @foreach($chunk as $item)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset('images/products/medium/'.$item->image)}}" alt="" />
                                                    <h2>{{$item->product_name}}</h2>
                                                    <p>Code : {{$item->product_code}} </p>
                                                    <a href="{{ url('product/'.$item->id) }}" type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach
                                </div>
                                    <?php $count++; ?>
                                    @endforeach
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>

    @endsection