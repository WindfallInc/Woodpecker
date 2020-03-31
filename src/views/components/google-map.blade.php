<div class="{{$component->columns}} columns google-map">
	@if($component->template == 1)
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2727.83770988452!2d-114.00544218364615!3d46.866566079142345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x535dcdf9fc24c295%3A0xfd01eaf7cab81f7!2sWindfall%2C+Inc.!5e0!3m2!1sen!2sus!4v1536270509792" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	@else
		{!!$component->content1!!}
	@endif
</div>