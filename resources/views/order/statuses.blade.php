@if ($settings['statuses'] && setting('statuses.status' . $status_id . '_name'))
{{ setting('statuses.status' . $status_id . '_name') }}
@else
-
@endif
@can('admin')
<div class="btn btn-sm btn-success btn-edit-status"><i class="fa fa-pencil"></i></div>
@endcan