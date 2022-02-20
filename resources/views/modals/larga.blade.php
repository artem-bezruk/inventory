<div aria-hidden="true" aria-labelledby="staticBackdropLabel" class="modal fade" data-backdrop="static" data-keyboard="false" id="@yield('modal-id')" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">@yield('modal-title')</h5>
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				@yield('modal-content')
			</div>
			<div class="modal-footer">
				@yield('modal-footer')
			</div>
		</div>
	</div>
</div>
@yield('modal-script')
