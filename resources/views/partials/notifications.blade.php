@if(count($data['notifications']) > 0)
	@foreach($data['notifications'] as $n)
	<li class="{{ $n->is_read ? '' : 'unread' }}" data-nid="{{ $n->id }}"> <i class="fa fa-bell-o" aria-hidden="true"></i> {!! $n->message !!}</li>
	@endforeach
@else
	<li>There is no any notification!</li>
@endif
