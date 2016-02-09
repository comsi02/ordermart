@extends('layouts.app')

@section('content')

{{ $data['product'] }}
{{ json_encode($data) }}

@endsection
