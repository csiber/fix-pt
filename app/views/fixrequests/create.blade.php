@extends('fixrequests/layout')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="well well-lg">

                {{Form::open(array(
                    "autocomplete" => "on",
                    "url" => "fixrequests/create" ))}}

                <form id="signup-form" role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" id="" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <input type="text" class="form-control" id="" placeholder="Enter category">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tags</label>
                        <input type="text" class="form-control" id="" placeholder="Enter category">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">City</label>
                        <input type="text" class="form-control" id="" placeholder="Enter category">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Days to receive offer</label>
                        <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Value</label>
                        <input type="number" class="form-control" value="5" id="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Add photos</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="well well-sm sidebar-steps">
                <ul>
                    <li>Descreva o trabalho que precisa ver realizado</li>
                    <li>Receba propostas dos nossos Prestadores de Serviço</li>
                    <li>Compare e contrate o melhor</li>
                </ul>
            </div>
            <div class="well well-sm sidebar-perks">
                <ul>
                    <li>Descreva o trabalho que precisa ver realizado</li>
                    <li>Receba propostas dos nossos Prestadores de Serviço</li>
                    <li>Compare e contrate o melhor</li>
                </ul>
            </div>
        </div>
    </div>
@stop
