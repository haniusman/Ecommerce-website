<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
<?php //echo $categories_menu; ?>
        @foreach($categories as $cat)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$cat->name}}
                        </a>
                    </h4>
                </div>
                <div id="{{$cat->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($cat->categories as $subcat)
                                <li><a href="{{asset('/products/'.$subcat->url) }}">{{$subcat->name}} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach

    </div><!--/category-products-->

    <div class="shipping text-center"><!--shipping-->
        <img src="{{asset('images/frontend_images/home/shipping.jpg')}}" alt="" />
    </div><!--/shipping-->

</div>