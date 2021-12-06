@extends('layout/master')
@section('title','Implementasi dan Deployment Sistem')
@section('content')
    <embed src="{{ asset('storage/prak_snapshot.pdf')}}" width="800px" height="800px"style=margin-left:auto;margin-right:auto />
    </br><center>==================</center>
    <embed src="{{ asset('storage/prak_barcode.pdf')}}" width="800px" height="800px"style=margin-left:auto;margin-right:auto />
    </br><center>==================</center>
    <embed src="{{ asset('storage/prak_geolocation.pdf')}}" width="800px" height="800px"style=margin-left:auto;margin-right:auto />
@endsection