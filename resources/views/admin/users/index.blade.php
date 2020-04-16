@extends('layouts.default')
@section('custom-links')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Custom styles for this page -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Staff Management</li>
        </ol>
    </nav>
@endsection

@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 ml-3">
            <a class="btn btn-primary" href="{{ route("admin.users.create") }}">
                <i class="fa fa-user-plus"></i> {{ trans('global.add') }} Staff Member
            </a>
        </div>
    </div>
@endcan
 <div class="container-fluid">
     <div class="row">
         <div class="col-12">
             <div class="card shadow mb-4">
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class=" table table-bordered table-striped table-hover nowrap datatable datatable-User"
                                id="example" style="width:100%">
                             <thead>
                             <tr>
                                 <th>#</th>
                                 <th>{{ trans('cruds.user.fields.name') }}</th>
                                 <th>{{ trans('cruds.user.fields.email') }}</th>
                                 <th>{{ trans('cruds.user.fields.roles') }}</th>
                                 <th>Action &nbsp;</th>
                             </tr>
                             </thead>
                             <tbody>
                             @foreach($users as $key => $user)
                                 <tr data-entry-id="{{ $user->id }}">
                                     <td>{{ $user->id ?? '' }}</td>
                                     <td>{{ $user->name ?? '' }}</td>
                                     <td>{{ $user->email ?? '' }}</td>
                                     <td>
                                         @foreach($user->roles as $key => $item)
                                             <span class="badge badge-info">{{ $item->title }}</span>
                                         @endforeach
                                     </td>
                                     <td>
                                         @can('user_show')
                                             <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                                 <i class="fa fa-eye"></i>  {{ trans('global.view') }}
                                             </a>
                                         @endcan

                                         @can('user_edit')
                                             <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                                 <i class="fa fa-pencil-alt"></i> {{ trans('global.edit') }}
                                             </a>
                                         @endcan

                                         @can('user_delete')

                                             <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                   onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                   style="display: inline-block;">
                                                 <input type="hidden" name="_method" value="DELETE">
                                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                 <button type="submit" class="btn btn-xs btn-danger">
                                                     <i class="fa fa-trash"></i> {{ trans('global.delete') }}
                                                 </button>
                                             </form>
                                         @endcan

                                     </td>

                                 </tr>
                             @endforeach
                             </tbody>
                         </table>
                     </div>


                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection
@section('custom-scripts')
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'File Details for '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                }
            } );
        } );
    </script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}');

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  };
  dtButtons.push(deleteButton);
@endcan


</script>
@endsection
