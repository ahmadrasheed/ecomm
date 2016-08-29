@extends('layouts.master')


@section('content')


    <div class="list-group">
    <h4>
        <a href="{{route('categories.index')}}" class="list-inline"> Categories:</a>&nbsp;<i class="fa fa-tags" aria-hidden="true"></i>
        <a href="{{route('admin.products.index')}}" class="list-inline"> Products:</a>&nbsp;<i class="fa fa-tags" aria-hidden="true"></i>
    </h4>
   </div>
    @if(Session::has('success'))
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-offset-4 col-sm-offset-3">
                <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                    {{Session::forget('success')}}
                </div>
            </div>
        </div>
    @endif



    @if(count($products)>0)
    <div class="row">

        <div class="col-sm-12 col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">

                    <div class="list-group">
                        @foreach($products as $product)

                            <form class="form-inline" method="post" action="{{route('products.updateOrdelete')}}">
                                <div class="form-group">
                                    <span class="badge">{{0}}</span>
                                    <input type="text" class="form-control " value="{{$product->title}}" name="title" id="name" >


                                    <button type="submit" name="update" class="btn btn-primary form-control">update</button>
                                    <button type="submit" name="delete" class="btn btn-danger form-control">delete </button>

                                    {{-- <a href="#" class="btn btn-info fa fa-trash" role="button"></a>--}}

                                </div>
                                <input type="hidden" name="id" value="{{$product->id}}">

                                {{csrf_field()}}
                            </form>


                        @endforeach
                    </div>
                </div>
            </div>

        </div>


    </div>

@else
        <h2>sorry, No Items in this category. Please below add some.</h2>
    @endif

{{--
    ====================================Adding new products by category ======================
--}}
    <div class="row">


        <div class="col-sm-12 col-md-12">



            <div class="panel panel-default">
                <div class="panel-heading">Add products To Category:{{$category_name}}<b></b></div>

                <div class="panel-body">

                    <div class="list-group">

                        <form class="form-inline" method="post" action="{{route('products.add')}}">
                            <div class="form-group">

                                <input type="text" class="form-control " name="title" id="name" >


                                <button type="submit" name="add" class="btn btn-success form-control">Add New Product </button>

                                {{-- <a href="#" class="btn btn-info fa fa-trash" role="button"></a>--}}
                                <input type="hidden" name="category_id" value="{{$category_id}}">

                            </div>

                            {{csrf_field()}}
                        </form>



                    </div>
                </div>
            </div>

        </div>



    </div>


    </div>




@endsection