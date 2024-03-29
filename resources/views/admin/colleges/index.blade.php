@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">        
        <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Colleges</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/colleges/create') }}" class="btn btn-success btn-sm" title="Add New AdministerCollege">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/colleges') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Name</th><th>A.K.A</th><th>County</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($administercolleges as $item)
                                @foreach($countys as $county)
                                @if($county->id == $item->county_id )
                                    <tr>                                        
                                        <td>{{ $item->name }}</td><td>{{ $item->aka }}</td><td>{{ $county->name }}</td>
                                        <td>                                           
                                            <a href="{{ url('/admin/colleges/' . $item->id . '/edit') }}" title="Edit AdministerCollege"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/colleges' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete AdministerCollege" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                @endforeach                                
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $administercolleges->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
