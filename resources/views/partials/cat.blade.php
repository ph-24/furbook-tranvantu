<div id="list-cats">
	@foreach($cats as $cat)
		<div class="cat">
			<a href="{{ route('cats.show',$cat->id) }}">
				<strong>{{ $cat->name }}</strong> - {{$cat->breed->name}}
			</a>
		</div>
	@endforeach
	{{ $cats->links()}}
	<script type="application/javascript">
		$(function(){
			$('a.page-link').click(function(e){
				e.preventDefault();
				var url= $(this).attr('href');
				$.get(url,function(response){
					$('#list-cats').replaceWith(response);
				});
			});
		});
	</script>
</div>