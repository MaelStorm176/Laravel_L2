<!-- TOASTS -->
<div class="toast fixed-bottom" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
    <div class="toast-header">
        <!-- <img src="..." class="rounded mr-2" alt="..."> !-->
        <strong class="mr-auto">Information</strong>
        <small class="text-muted"><1 min</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body" id="input-toast">
    </div>
</div>

<!-- RECEPTION DE MESSAGE -->
@if(session()->get('message'))
    <input type="hidden" id="message" value="{{session()->get('message')}}">
    <script>
        window.onload=function()   {
            const message = $('#message').val();
            $('#input-toast').text(message);
            $('.toast').toast('show').slideDown();
        }
    </script>
@endif
