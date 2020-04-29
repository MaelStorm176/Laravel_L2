<!-- TOASTS -->
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
    <div class="toast-header bg-success text-white mt-1">
        <span class="fas fa-exclamation-triangle mt-n1 mr-2"></span>
        <strong class="mr-auto">Information</strong>
        <small>A l'instant</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body" id="input-toast"></div>
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
