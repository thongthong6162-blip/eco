@extends('frontend.layout.master')

@section('title', 'home')

@section('content')
    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                    </div>
                </div>
            </div>

            <div class="row special-list">


                @for ($i = 0; $i < count($products); $i++)
                    <div class="col-lg-3 col-md-6 special-grid">
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <img src="{{ asset($products[$i]->image_url) }}" class="img-fluid"
                                    alt="Image">
                                <div class="mask-icon">
                                    <ul>
                                        <li><a href="{{ route('product.detail', $products[$i]->product_id) }}"
                                                data-toggle="tooltip" data-placement="right" title="View"><i
                                                    style="font-size:20px">View</i></a></li>
                                    </ul>
                                    <a class="cart" href="{{ route('cart.add', $products[$i]->product_id) }}">Add to
                                        Cart</a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h3><strong>{{ $products[$i]->name }}</strong></h3>
                                <h4><strong>Description: {{ $products[$i]->description }}</strong></h4>
                                <h5> ${{ $products[$i]->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

    </div>
    <!-- End Products  -->
@endsection
