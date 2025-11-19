@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="alert alert-success">
        Agendamento realizado com sucesso!
    </div>
    <a href="{{ route('appointment.create') }}" class="btn btn-primary">Novo Agendamento</a>
</div>
@endsection
