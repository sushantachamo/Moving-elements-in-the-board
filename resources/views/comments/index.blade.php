<span class="text-muted">Task comments:</span>
<div class="comments">
  @foreach($comments as $comment)
    @include('partials.comments.comment')
  @endforeach
</div>
