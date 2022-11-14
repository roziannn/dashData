@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')

    {{-- greetings based on real-time --}}
    <?php
    $hour = date('G');
    $minute = date('i');
    $second = date('s');
    $msg = ' Today is ' . date('l, M. d, Y.') . ' And the time is ' . date('g:i a');
    
    if ((int) $hour == 0 && (int) $hour <= 9) {
        $greet = 'Good Morning,';
    } elseif ((int) $hour >= 10 && (int) $hour <= 11) {
        $greet = 'Good Day,';
    } elseif ((int) $hour >= 12 && (int) $hour <= 15) {
        $greet = 'Good Afternoon,';
    } elseif ((int) $hour >= 16 && (int) $hour <= 23) {
        $greet = 'Good Evening,';
    } else {
        $greet = 'Welcome,';
    }    
    ?>

    <h1> <?php echo $greet; ?> {{ auth()->user()->first_name }}</h1>
@endsection
