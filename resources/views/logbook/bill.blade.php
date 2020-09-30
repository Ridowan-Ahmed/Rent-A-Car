@extends('layouts.main')
@section('content')
        <table class="table table-responsive-sm">
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td><a href="{{route('car.companyReport', $company->slug)}}"
                               class="font-weight-bold" data-toggle="tooltip" data-html="true"
                               data-toggle="tooltip" data-html="true" data-placement="top"
                               title="<i class='fa fa-taxi'></i> Details"><span class="mt-0 h3">{{$company->name}}</span> has  {{count($company->car)}} Car <i
                                    class="fa fa-taxi"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
@stop

@section('script')
@stop