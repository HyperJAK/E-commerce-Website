@extends('master2')
@section('title')
<title>Products</title>
@endsection
@section('content')

      <!-- fashion section start -->
      <div class="fashion_section">
    

        <div id="main_slider" class="carousel slide" data-ride="carousel">
           <div class="carousel-inner">
              <div class="carousel-item active">
                 <div class="container">
                 <h1 class="fashion_taital">@isset($title) {{ $title }} @else 
                 All Products
                  @endisset
               </h1>
                    <div class="fashion_section_2">
                       <div class="row">
   @isset($objs)
    @foreach($objs as $obj)
                <div class="col-lg-4 col-sm-4">
                 
<div class="box_main">
<h4 class="shirt_text">{{$obj->name}}</h4>
<h3 class="fashion_taital_Small">{{$obj->category_id[0]}}</h3>
    <p class="price_text">Price  <span style="color: #262626;">$ {{$obj->price}}</span></p>
            <div class="tshirt_img"><img src="{{asset($obj->path1)}}"></div>
            <p class="prod_desc">{{$obj->description}}</p>
    <div class="btn_main">
        <div class="buy_bt"><a href="#">Buy Now</a></div>
        <div class="seemore_bt"><a href="{{route('getProd',['id'=>$obj->product_id])}}">See More</a></div>
    </div>
</div>
            </div>
        

            @endforeach
            @else
            <div class="box_main">
<h4 class="shirt_text">Error</h4>
<h3 class="fashion_taital_Small">No data found</h3>
            <p class="prod_desc">Error fetching data or No data found</p>
    </div>
</div>
            </div>
            @endisset 
           
            </div>
                       </div>
                    </div>
                 </div>
              </div>
              <!-- <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
           <i class="fa fa-angle-left"></i>
           </a>
           <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
           <i class="fa fa-angle-right"></i>
           </a> -->
           </div> 
       </div>
   </div>
   </div>
           </div>
          
        </div>
        @isset($objs)
        <div class="pages">{{$objs->links()}}</div>
        @endisset
     </div>  
     
      <!-- fashion section end -->
      
@endsection
