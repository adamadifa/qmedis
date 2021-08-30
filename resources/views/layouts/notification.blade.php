@if ($message = Session::get('success'))
<div class="alert alert-important alert-success alert-dismissible" role="alert">
  <div class="d-flex">
    <div>
      <svg xmlns="http://www.w3.org/2000/svg" class="icon mr-2" width="24" height="24" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M7 12l5 5l10 -10" />
        <path d="M2 12l5 5m5 -5l5 -5" /></svg>
    </div>
    <div>
      {{ $message }}
    </div>
  </div>
  <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
</div>

@endif
@if ($message = Session::get('failed'))
<div class="alert alert-important alert-danger alert-dismissible" role="alert">
  <div class="d-flex">
    <div>
      <!-- Download SVG icon from http://tabler-icons.io/i/hand-stop -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon mr-2" width="24" height="24" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M8 13v-7.5a1.5 1.5 0 0 1 3 0v6.5" />
        <path d="M11 5.5v-2a1.5 1.5 0 1 1 3 0v8.5" />
        <path d="M14 5.5a1.5 1.5 0 0 1 3 0v6.5" />
        <path
          d="M17 7.5a1.5 1.5 0 0 1 3 0v8.5a6 6 0 0 1 -6 6h-2h.208a6 6 0 0 1 -5.012 -2.7a69.74 69.74 0 0 1 -.196 -.3c-.312 -.479 -1.407 -2.388 -3.286 -5.728a1.5 1.5 0 0 1 .536 -2.022a1.867 1.867 0 0 1 2.28 .28l1.47 1.47" />
      </svg>
    </div>
    <div>
      {{ $message }}
    </div>
  </div>
  <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
</div>

@endif

@if ($message = Session::get('warning'))
<div class="alert alert-important alert-warning alert-dismissible" role="alert">
  <div class="d-flex">
    <div>
      <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon mr-2" style="margin-right:10px" width="24" height="24"
        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M12 9v2m0 4v.01" />
        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
    </div>
    <div>
      {{ $message }}
    </div>
  </div>
  <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
</div>

@endif