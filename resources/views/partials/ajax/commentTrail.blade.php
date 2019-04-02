@if(count($comments)>0)
<table class="table table-striped">
 
	@foreach($comments as $comment)

	<tr>
		<td>Comment</td>
		<td>{{$comment->comment}}</td>
	</tr>
	<tr>
		<td>AddedBy</td>
		<td>{{$comment->user->name}}</td>
	</tr>
	<tr>
		<td>Date</td>
		<td>{{date('Y-m-d',strtotime($comment->created_at))}}</td>
	</tr>
	@endforeach
</table><br>	
<div class="linkTrail">
{!! $comments->appends(Request::capture()->except('page'))->render() !!}
</div>
@else

<h4>No Comment Added Yet</h4>

@endif
<script type="text/javascript">
	$(function(){
		  $('.linkTrail .page-link').click(function(){
          event.preventDefault();
          $('#dispCommentTrail').load($(this).attr('href'));
      })

	})
</script>