@extends('admin::admin.layout')

@section('body')

<div class="card">
    <div class="card-body">
    <h3 class="ab">
       &nbsp; @if (isset($editdata))
            {{ trans('lang_data.edit_lable') }} categories
        @else
        {{ trans('lang_data.add_lable') }} categories
        @endif
    </h3>

    @if (isset($editdata))
        {!! Form::model($editdata, [
            'url' => route('categories.update', $editdata->id),
            'id' => 'categories',
            'method' => 'put',
            'enctype' => 'multipart/form-data',
        ]) !!}
    @else
        {!! Form::open([
            'url' => route('categories.store'),
            'id' => 'categories',
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ]) !!}
    @endif

     @csrf

    <div class="form-group">
        <label>Name:</label>
        {!! Form::text('name', null, [
            'id' => 'name',
            'placeholder' => 'Enter name',
            'class' => 'form-control',
        ]) !!}
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class="form-group">
       <div>
        <label>Image:</label>
        </div>
        {!! Form::file('image', null, [
            'id' => 'image',
            'class' => 'form-control',
        ]) !!}

        <div>
            @if ($errors->has('image'))
            <span class="text-danger">{{ $errors->first('image') }}</span>
        @endif
        </div>

    </div>

    <div class="form-group">
        <label>Status:</label>
        {!! Form::select('status', ['1' => 'Active', '2' => 'Inactive'], null, [
            'id' => 'status',
            'placeholder' => 'select status',
            'class' => 'form-control',
        ]) !!}
        @if ($errors->has('status'))
            <span class="text-danger">{{ $errors->first('status') }}</span>
        @endif
    </div>

    {!! Form::submit(''.trans('lang_data.submit_lable').'', ['class' => 'btn btn-primary']) !!}

    <a href="{{ route('categories.index') }}" class="btn btn-danger">{{ trans('lang_data.cancle_lable') }}</a>

    {!! Form::close() !!}

    </div>
</div>
@endsection
