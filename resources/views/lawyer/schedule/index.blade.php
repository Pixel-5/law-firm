@extends('layouts.default')
@section('content')
@can('schedule_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("lawyer.schedule.create") }}">
                {{ trans('global.schedule') }} {{ trans('global.case') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.case') }} {{ trans('global.schedule') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.start_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.end_time') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $key => $event)
                        <tr data-entry-id="{{ $event->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $event->id ?? '' }}
                            </td>
                            <td>
                                {{ $event->venue ?? '' }}
                            </td>
                            <td>
                                {{ $event->start_time ?? '' }}
                            </td>
                            <td>
                                {{ $event->end_time ?? '' }}
                            </td>
                            <td>
                                @can('schedule_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('lawyer.schedule.show', $event->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('schedule_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('lawyer.schedule.edit', $event->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('schedule_delete')
                                    <form action="{{ route('lawyer.schedule.destroy', $event->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ $event->events_count || $event->event ? 'Do you want to delete future recurring events, too?' : trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
@can('event_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('lawyer.events.massDestroy') }}",
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  $('.datatable-Event:not(.ajaxTable)').DataTable({ buttons: dtButtons });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
