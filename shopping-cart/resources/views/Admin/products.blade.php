@extends('layouts.master')


@section('content')





    <h3> Products&nbsp;<i class="fa fa-tags" aria-hidden="true"></i></h3>

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


    {{--=====================Search for a products==================--}}
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Search for a Product:</div>
                <div class="panel-body">
                    <div class="list-group">
                        <form class="form-inline" method="get" action="{{route('products.search')}}">
                            <div class="form-group">
                                <input type="text" class="form-control " name="search"  id="search" >
                                <button type="submit" name="add" class="btn btn-success form-control">Search for a Product </button>
                                {{-- <a href="#" class="btn btn-info fa fa-trash" role="button"></a>--}}
                            </div>

                            {{csrf_field()}}
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>


 {{-- ===============================display All products  ========================--}}
@if(isset($products))
    <div class="row">

        <div class="col-sm-12 col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">All Products:</div>

                <div class="panel-body">

                    <div class="list-group">
                        @foreach($products as $product)

                            <form class="form-inline" method="post" action="{{route('products.updateOrdelete')}}">
                                <div class="form-group">
                                    <span class="badge">{{6}}</span>
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

    @endif






@endsection