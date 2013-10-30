@extends('fixrequests/layout')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="well well-lg">
                {{ Form::open(array(
                    "url" => "promotionpages/create",
                    "id" => "promotionpage-form",
                    "role" => "form",
                    "files" => true)
                )}}
                <!-- <form id="fix-request-form" action="{{ URL::to('fixrequests/create') }}" role="form" method="POST">
                    {{ Form::token() }} -->
                    <div class="form-group">
                        {{ Form::label("title", "Title") }}
                        {{ Form::text("title", "", array(
                            "id" => "promotionpage-title",
                            "placeholder" => "Enter title",
                            "class" => "form-control"
                        ))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label("body", "Body") }}
                        {{ Form::textarea("body", "", array(
                            "class" => "form-control",
                            "rows" => 20,
                            "placeholder" => "Enter text here"
                        ))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label("city", "City") }}
                        {{ Form::text("city", "", array(
                            "class" => "form-control",
                            "id" => "fixrequest-city",
                            "placeholder" => "Enter city"
                        ))}}
                    </div>
                    <div class="form-group">
                        <!-- {{ Form::label("photos", "Add photos") }}
                        {{ Form::file('photos[]', array('multiple' => true))}} -->
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                <!-- </form> -->
                {{ Form::close() }}
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
