@extends('template_Dashboard')

@section('title')
    Update Alert Method
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="row">
            @component('flash_alert_message')

            @endcomponent
            <div class="col-lg-12">
                <h1 class="page-header">Update Alert Method</h1>
            </div>
            <div class="col-lg-12" style="margin: 20px 0">
                <a href="{{ route('alert-methods.index') }}">
                    <button type="button" class="btn btn-primary">List Alert Methods</button>
                </a>
            </div>
            <div class="panel panel-default col-lg-12" style="margin: 0 15px">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ route('alert-methods.update', [$alertMethod->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label">Methods Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{ !empty(old('name'))?old('name'):$alertMethod->name }}" required
                                       autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        @if(!empty($listAlertGroup))
                            <div class="form-group{{ $errors->has('alert_group_id') ? ' has-error' : '' }}">
                                <label for="alert_group_id" class="col-md-1 control-label">Alert Group</label>

                                <div class="col-md-6">
                                    <select id="alertGroupId" class="form-control" name="alert_group_id"
                                            value="{{ old('alert_group_id') }}">
                                        @foreach($listAlertGroup as $value)
                                            <option value="{{ $value->id }}" {{ isset($alertMethod->alertmethodalertgroup['alert_group_id'])&&$alertMethod->alertmethodalertgroup['alert_group_id'] == $value->id?'selected':''  }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-1 control-label">Type</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control" name="type" onchange="showDiv('type',this)"
                                        value="{{ !empty(old('type'))?old('type'):$alertMethod->type }}">
                                    @foreach($listType as $key => $value)
                                        <option value="{{ $key }}" {{ $alertMethod->type== $key?'selected':''  }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="type1" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-1 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ !empty(old('email'))?old('email'):$alertMethod->email }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div id="type2" class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}"
                             style="display: none;">
                            <label for="phone_number" class="col-md-1 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                       value="{{ !empty(old('phone_number'))?old('phone_number'):$alertMethod->phone_number }}"
                                       disabled autofocus>

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div id="type3" class="form-group{{ $errors->has('webhook') ? ' has-error' : '' }}"
                             style="display: none;">
                            <label for="webhook" class="col-md-1 control-label">Webhook</label>

                            <div class="col-md-6">
                                <input id="webhook" type="webhook" class="form-control" name="webhook"
                                       value="{{ !empty(old('webhook'))?old('webhook'):$alertMethod->webhook }}"
                                       disabled autofocus>

                                @if ($errors->has('webhook'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('webhook') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-1">
                                <button type="submit" class="btn btn-primary">
                                    Update Methods
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/alert_methods.js')}}"></script>
@endsection